
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php
    global $message;

    if(isset($_POST['submit']))
    {
	$uID = $_SESSION["uID"];
	$isbn= mysql_prep($_POST['isbn']);
        //Check if is invalid isbn
        $queryBook = "SELECT isbn FROM BOOK where isbn = '$isbn'";
	$resultBook = mysqli_query($connection, $queryBook);
        $rowBook = mysqli_fetch_assoc($resultBook);
        $validateIsbn = $rowBook['isbn'];

        //Check if user has the same book already taken. If not, allow taking it
        $query = "SELECT isbn FROM checkout where uID = '$uID' AND isbn = '$isbn'";
	$result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $storedIsbn = $row['isbn'];

        if (strcmp($validateIsbn, "") === 0)
            $message = "You entered an invalid ISBN. Please try again";

        else if (strcmp($storedIsbn, $isbn) == 0)
        {
            $message = "Sorry! You have already taken the same book!";
            $message .= "<br />" . "No change has been made to your cart."."<br />";
        }//if

        else if(checkoutBook($isbn))
        {            
            $message = "Congratulations! The book has been added to your cart successfully."."<br />";
	    }//else if
        else  
        {
            $message = "Sorry! The selected book has no available copy in the library";
        }
	
   }

?>   
<!DOCTYPE html>
    <html>
	<head>
	    <meta charset="utf-8">
	    <title>User</title>
            <script>
            </script>
	    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>
	    <style type="text/css">
                body{
                    font-family: Verdana,Helvetica, sans-serif;
                    background-image: url(images/b2.jpg);
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
		    background-image: url(images/l4.png);
		    background-repeat: no-repeat;
		    padding: 10px;
		    margin: 5px;
                }
		#pageTitle{
			font-size: large;
			color: white;
		}
                
                #main{
		        background-image: url(images/b42.jpg);
			background-repeat: no-repeat;
			margin: 10px 10px 5px 330px;
			padding: 10px 10px 40px 20px;
			
                }
		#second{
			padding-left: 20px;
			padding-right: auto;
		}
                aside{
			float: left;
			color: white;
		        background-image: url(images/tab1.jpg);
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
		fieldset{
		    color: white;
		}
		#check{
		    color: white;
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
                    <div id ="pageTitle"><h1>METROPOLITAN UNIVERSITY LIBRARY</h1></div>
                </header>
		<aside>
                        <ul><?php if(isset($_SESSION["uID"])){
				      echo "<li>";
				      echo "Hi ".$_SESSION["uID"];
				      echo "</li>";
				}
				?>
                               
			</ul>
                        <div id ="message">
				<h4>
					Today's Message:
				</h4>
                            <p>The new year stands before us, like a chapter in a book, waiting to be written. We can help write that story by setting goals-"Melody Beattie"
                            </p>
                        </div>
                </aside>
                <section id = "main">
                    <div id="first">
                        <p>Checkout Book</p>
                    </div>
		      
                    <form action="user.php" method="post" id="myform">
			<div id= "check">Check out your book from library.</div>
			<fieldset><legend>Check out</legend>
			    <label for="isbn">Isbn</label>
			    <input type="number" pattern="/d{13}" maxlength="13" name="isbn" id="isbn" placeholder="ISBN" required >
			    <input type="submit" name="submit" id="submit" value="Submit"> 
			</fieldset>
			
		    </form>    
		     
            <div id= "check"><?php echo $message;?> </div>
			<?php
	       
	
        mysqli_close($connection);

?>
			<script>
				$(document).ready(function(){
				        $("#myform").Validate();
					
				});
			</script>
                </section>		


                
                <footer>
                 <p>Copyright, Tawfiquzzaman Opu
		 &copy2016</p>
		 
                </footer>
            </div>
        </body>
</html>
	    
        </body>
    </html>    
