
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php
        if(isset($_POST['submit']))
	{
		$passwordconf = $_POST['passwordconf'];
		$password = $_POST['password'];
		$uID= mysql_prep($_POST['username']);
        $_SESSION['uID'] = $uID;
		$name= mysql_prep( $_POST['name']);
		$age= mysql_prep($_POST['age']);
		$zipcode= mysql_prep($_POST['zipcode']);
		$phone= mysql_prep($_POST['phone']);
		$email= mysql_prep($_POST['email']);		
		if($passwordconf === $password)
		{
	            $hashed_password= password_encrypt($_POST['password']);
					
		        $query1 = "INSERT INTO User ";
		        $query1 .= "(uID, hashed_password, name, age,zipcode, PhoneNumber, email, operatorType) ";
		        $query1 .= "VALUES (";
		        $query1 .= " '{$uID}', '{$hashed_password}', '{$name}', '{$age}', '{$zipcode}', '{$phone}', '{$email}', 'USER'";
		        $query1 .= ")";
		        $date = date_create(date("Y-m-d"));
                        date_add($date,date_interval_create_from_date_string("0 days"));
                        $archiveDate = date_format($date,"Y-m-d");
		
		        $none= NULL;
		        $query2 = "INSERT INTO history ";
		        $query2 .= "(uID, transactionID, isbn, returnedDate, checkoutDate, dueDate, fine,  archiveDate) ";
		        $query2 .= "VALUES ('$uID', '$none', '$none', '$none', '$none', '$none', 0, '{$archiveDate}')";
				
				
				
		        $result = mysqli_query($connection, $query2);
		        $result = mysqli_query($connection, $query1);
		        if ($result) 
                        {
		                redirect_to("user.php");
                        } 
                        else 
                        {
                                $_SESSION["error"] = mysqli_error($connection);
                        }
		}
		else $error = "Mismatched password";
        }
	
?>

<!DOCTYPE html>
<html>
	<head>  
	    <meta charset="utf-8">
	    <title>Sign Up</title>
	    <script  src="http://code.jquery.com/jquery-1.10.1.min.js" type="text/javascript" language="javascript"></script>
	   <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.0/jquery.validate.min.js"></script>
	    <script language="javascript" type="text/javascript">
                $(document).ready(function()
                {	$("#username").blur(function() {
			        $("#check").text('Checking.....').fadeIn("slow");
                                $.ajax({
                                        type: "POST",
                                        url : "checkUser.php",
                                        data: { username: this.value }
                                        }).done(function(data) {
                                                if(data > 0 ){
                                                        $("#username").css("border", "3px solid red");
                                                        $("#check1").text('Username has been used.').css("color", "red");                                
                                                }
                                                else{
                                                        $("#username").css("border", "3px solid green");
                                                        $("#check1").text('Username has not been used.').css("color", "green");;
                                                }
                                        });
                        });
	        });

			
	    </script>
  	    <style type="text/css">
                body{
                    font-family: Verdana,Helvetica, sans-serif;
                    background-image: url(images/b5.jpg);
                    background-repeat: no-repeat;
                    
                }
                #content{
                    margin-left:auto;
                    margin-right:auto;
		    background-color: black;
		    width:1050px;
		    height: 700px
                }
                header{

		    text-align: center;
		    height: 100px;
		    background-image: url(images/mu1.png);
		    background-repeat: no-repeat;
		    padding: 10px;
		    margin: 5px;
                }
		#pageTitle{
			font-size: large;
			color: white;
		}
                
                #main{
		        background-image: url(images/b4.jpg);
			background-repeat: no-repeat;
			margin: 10px 10px 5px 330px;
			padding: 10px 10px 40px 20px;
			
                }
		#second{
			padding-left: 20px;
		}
                aside{
			float: left;
			color: white;
		        background-image: url(images/nu1.jpg);
			background-repeat: no-repeat;
		        padding: 10px 10px 150px 0px;
			margin:5px 5px 5px 5px;
			width:300px;
                }
		li{
			list-style-type: none;
			padding: 5px 0px 5px 0px;
			color: white;
		}
		a:link{
			text-decoration: none;
			color: white;
		}
		a:hover{
			color: #33FA29;
		}
		a:visited{
			text-decoration: none;
			color: white;
		}
                #first{
                        color: #33FA29;
		        font-style: oblique;
		        font-size:1.5em;
                }
		#third{
			border-bottom:solid 1px gray;
			color: white;
		   
		}
		#message h4{
			text-align: left;
			color: green;
		}
		#message{
			padding-left:20px;
			padding-right:20px;
		}
		footer { 
	                clear: both;
			color: white;
	                height: 2em; margin: 0; padding: 1em; 
	                text-align: left;
			font-size: 0.6em;
		}
		td{
			color: white;
			padding: 0px 3px 5px 0px;
		}
		legend{
			color: white;
		}
		#check3{
			color: red;
		}
		#submit{
                    width: 11.8em;
                    height: 2em;
                }
        a:hover
        { 
        color:#33FA29;
        }
                
            </style>
        </head>
        <body>
            <div id="content">
                <header>
                    <div id ="pageTitle"><h1 style="color:black;">METROPOLITAN UNIVERSITY LIBRARY</h1></div>
                </header>
		<aside>
                        <ul style="font-weight:bold;">
                                <li><a href="index.php">HOME</a></li>
                                <li><a href="signup.php">SIGN UP</a></li>
                                <li><a href="aboutUs.php">ABOUT US</a></li>
                        </ul>
                        <div id ="message">
				<h4>
					Today's Message:
				</h4>
                            <p>
    Whenever you read a good book, somewhere in the world a door opens to allow in more light.

    –"Vera Nazarian"
                            </p>
                        </div>
                </aside>
                <section id = "main">
                    <div id="first">
                        <p>Sign Up</p>
                    </div>
                    <div id="second">
                        <form id ="myform" action="signup.php" method="post">
			<fieldset><legend>Personal Infromation</legend>	
                                <table>
				
                                        <tr><td><label for= "name">Name:</label></td>
                                        <td><input type="text" pattern="[a-zA-Z]+" maxlength= "10" name="name" id="name" placeholder="Please enter your name." autofocus required value="<?php if (isset($name)) { echo $name; } ?>" /></td></tr>
				
                                        <tr><td><label for= "age">Age:</label></td>
                                        <td><input type="number" min="13" max=130 name="age" id="age" placeholder="age" required value="<?php if (isset($age)) { echo $age; } ?>" /></td></tr>
				
                                        <tr><td><label for= "zipcode">Zipcode:</label></td>
                                        <td><input type="number" pattern="/d{5}" maxlength="5" name="zipcode" id="zipcode" placeholder="zipcode" required value="<?php if (isset($zipcode)) { echo $zipcode; } ?>" /></td></tr>
				
                                        <tr><td><label for= "phone">Phone:</label></td>
                                        <td><input type="number" pattern="/d{10}" maxlength="10" name="phone" id="phone" placeholder="phone" required value="<?php if (isset($phone)) { echo $phone; } ?>" /></td></tr>
				
                                        <tr><td><label for= "email">Email:</label></td>
                                        <td><input type="email" name="email" id="email" placeholder="email" required value="<?php if (isset($email)) { echo $email; } ?>" /></td></tr>
					
                                        <tr><td><label for= "Username">Username:</label></td>
                                        <td><input type="text" pattern="[a-zA-Z0-9]+" maxlength="10" name="username" id="username" placeholder="username" required value="<?php if (isset($uID)) { echo $uID; } ?>" /></td><td id= "check1"></td></tr>
				
                                        <tr><td><label for= "password">Password:</label></td>
                                        <td><input type="password" pattern="[a-zA-Z0-9]{6,10}" maxlength="10" name="password"  id="password" placeholder="password" required value="<?php if (isset($password)) { echo $password; } ?>" /></td></tr>
				
                                        <tr><td><label for= "passwordconf">Password (confirm):</label></td>
                                        <td><input type="password" pattern="[a-zA-Z0-9]{6,10}" maxlength="10" name="passwordconf" id="passwordconf" placeholder="password" required value="<?php if (isset($passwordconf)) { echo $passwordconf; } ?>" /></td><td id= "check3"><?php if (isset($error)) echo $error;?></td></tr>
				
                                        <tr><td><label for= "signup">Sign up:</label></td>
                                        <td><input type="submit" name="submit" id="submit" value="Submit"></td></tr>
			    </table>		
                        </fieldset>
                                
                            
                        </form>
		        
			<?php 
            mysqli_close($connection);	
            if(isset($_SESSION["error"])){
	            echo "<p style = \"color:white;\">"  . $_SESSION["error"] . "</p>";
                session_destroy(); 

            }//if   
            else echo "<br />" . "<br />" ;
?>

                </section>		


         <div>
                <br />
                <br />
                <br />
                <br />
                <footer>
                 <p>Copyright: Tawfiquzzaman Opu
		 &copy2016</p>
		 
                </footer>
        </div>
            </div>
        </body>
</html>
