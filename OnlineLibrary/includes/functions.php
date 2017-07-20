<?php

    function redirect_to($new_location) {
        header("Location: " . $new_location);
        exit;
    }


    function confirm_query($result_set) {
	if (!$result_set) {
            die("Database query failed.");
	}
    }

    function mysql_prep($string) {
        global $connection;
        $escaped_string = mysqli_real_escape_string($connection, $string);
	return $escaped_string;
    }
    
       
    function find_username($username) {
	global $connection;
	$safe_username = mysqli_real_escape_string($connection, $username);
        $query  = "SELECT * ";
        $query .= "FROM user ";
    	$query .= "WHERE uID = '{$safe_username}' ";
	$query .= "LIMIT 1";
	$user_set = mysqli_query($connection, $query);
	confirm_query($user_set);
	if($user = mysqli_fetch_assoc($user_set)) {
	    return $user;
	} else {
	    return null;
	}
    }
    function isbn_check($isbn){
	global $connection;
	$safe_isbn = mysql_prep($isbn);
	$query  = "SELECT * ";
	$query .= "FROM book ";
	$query .= "WHERE isbn = '$safe_isbn'";
	$book_set = mysqli_query($connection, $query);
	confirm_query($book_set);
	if($book_set)
	    return true;
	else return false;
    }
    
 function find_userIbsn($usercheck, $isbn){
	global $connection;
	$safe_user = mysql_prep($usercheck);
	$safe_isbn = mysql_prep($isbn);
	$query  = "SELECT * ";
        $query .= "FROM checkout ";
   	$query .= "WHERE isbn = '{$safe_isbn}' AND uID = '{$safe_user}'";
	$query .= "LIMIT 1";
	$checkout_set = mysqli_query($connection, $query);
	confirm_query($checkout_set);
	if($checkout_set = mysqli_fetch_assoc($checkout_set)) {
	    return $checkout_set;
	} else {
	    return false;
	}
    }
    
    function return_book($checkout_set){
	global $connection;
	$uID = $checkout_set['uID'];
	$transactionID = $checkout_set['transactionID'];
	$isbn = $checkout_set['isbn'];
	$checkoutDate = $checkout_set['checkoutDate'];
	$due = $checkout_set['due'];
	$fine = $checkout_set['fine'];
	
        $date = date_create(date("Y-m-d"));
        date_add($date,date_interval_create_from_date_string("0 days"));
        $returnedDate = date_format($date,"Y-m-d");
	
	$query = "INSERT INTO history(uID, transactionID, isbn, checkoutDate, dueDate, returnedDate, fine, archiveDate ) ";
	$query .= "values ('$uID', '$transactionID', '$isbn', '$checkoutDate', '$due', '$returnedDate', '$fine', '$returnedDate')";
	mysqli_query($connection, $query);  
	
        $query = "DELETE FROM checkout ";
	$query .= "WHERE transactionID = '$transactionID'";
	$result = mysqli_query($connection, $query);
	
	$query = "UPDATE book ";
	$query .= "SET copies = copies +1 ";
	$query .= "WHERE isbn = '$isbn'";
	mysqli_query($connection, $query);
    }
    function add_book($book){
	global $connection;
	$query = "INSERT INTO category(isbn, genre, description) ";
	$query .= "values ('$book[3]', '$book[4]', '$book[5]')";
	mysqli_query($connection, $query);

	$query = "INSERT INTO BOOK(title, author, copies, isbn) ";
	$query .= "values ('$book[0]', '$book[1]', '$book[2]', '$book[3]')";
	mysqli_query($connection, $query);
	

	
	
    }
    
    function attempt_login($user, $pass) {
		$username = find_username($user);
		if ($username) {
			// found username, now check password
			if (password_check($pass, $username["hashed_password"])) {
				// password matches
				return $username;
			} else {
				// password does not match
				return false;
			}
		} else {
			// admin not found
			return false;
		}
    }

    function password_check($password, $existing_hash) {
		// existing hash contains format and salt at start
	$hash = crypt($password, $existing_hash);
	if ($hash === $existing_hash) {
	    return true;
	} else {
	    return false;
	}
    }
    
    function generate_salt($length) {
	  // Not 100% unique, not 100% random, but good enough for a salt
	  // MD5 returns 32 characters
        $unique_random_string = md5(uniqid(mt_rand(), true));
	  
		// Valid characters for a salt are [a-zA-Z0-9./]
	$base64_string = base64_encode($unique_random_string);
	  
		// But not '+' which is valid in base64 encoding
	$modified_base64_string = str_replace('+', '.', $base64_string);
	  
		// Truncate string to the correct length
	$salt = substr($modified_base64_string, 0, $length);
	  
	return $salt;
    }
    
    function password_encrypt($password) {
  	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	$salt_length = 22; 					// Blowfish salts should be 22-characters or more
	$salt = generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash = crypt($password, $format_and_salt);
	return $hash;
    }
    
    function isbnCopy_check($number)
    {
    	global $connection;
	    $safe_isbn = mysqli_real_escape_string($connection, $number);
        $query  = "SELECT * ";
        $query .= "FROM BOOK ";
    	$query .= "WHERE isbn = '$safe_isbn'";

	    $result = mysqli_query($connection, $query);
        $book = mysqli_fetch_assoc($result);
        $copyNum = $book['copies'];
        if ($copyNum > 0)
        {
            return $book;
        }//if
        else 
            return null;

    }//isbnCopy_check

    function checkoutBook($isbn)
    {
        global $connection;
        $message="";
        //Check if BOOK has a copy left of the requested book
	    $book = isbnCopy_check($isbn);
	    if ($book)
        {       	
	        $copyNum = $book["copies"];
            $newCopyNum = $copyNum - 1;

            $uID = $_SESSION["uID"];
            //$query = "DROP TRIGGER IF EXISTS `UpdateTrigger`";
            //mysqli_query($connection, $query);

            //time: used for generating a unique transactionID
            $transactionID  = time();
            //Get current date
            $date = date_create(date("Y-m-d"));
            date_add($date,date_interval_create_from_date_string("0 days"));
            $checkoutDate = date_format($date,"Y-m-d");

            //Calculate due date
            date_add($date,date_interval_create_from_date_string("15 days"));
            $due = date_format($date,"Y-m-d");

            $query = "DROP TRIGGER IF EXISTS `UpdateTrigger`";
            mysqli_query($connection, $query);
            $query = "CREATE TRIGGER UpdateTrigger AFTER UPDATE ON BOOK FOR EACH ROW INSERT INTO checkout(transactionID, isbn, uID, checkoutDate, due, fine) VALUES ('$transactionID', '$isbn', '$uID', '$checkoutDate', '$due', 0.0)";
            mysqli_query($connection, $query);

	        $query = "UPDATE BOOK SET copies = '$newCopyNum' WHERE isbn = '$isbn'";
	        mysqli_query($connection, $query);
		
            $query = "INSERT INTO history(uID, transactionID, isbn, checkoutDate, dueDate, returnedDate, fine, archiveDate) ";
	    $query .= "values ('$uID', '$transactionID', '$isbn', '$checkoutDate', '$due', '0', 0.0, '$checkoutDate')";
	    mysqli_query($connection, $query);     
		
            
            return true;
        }//if
        else
        {
            return false;
        }
    }

?>
