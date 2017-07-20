
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php
        $uID = $_SESSION["uID"];
        if(isset($_POST['submit']))
	    {
		    $hashed_password= password_encrypt($_POST['password']);
	        $name= mysql_prep( $_POST['name']);
		    $age= mysql_prep($_POST['age']);
		    $zipcode= mysql_prep($_POST['zipcode']);
		    $phone= mysql_prep($_POST['phone']);
		    $email= mysql_prep($_POST['email']);
		    $query = "UPDATE USER SET hashed_password='$hashed_password', name='$name', 
                age='$age', zipcode='$zipcode', PhoneNumber='$phone', email='$email' 
                where uID='$uID'";
		    $result = mysqli_query($connection, $query);
		    if ($result) 
            {
                $_SESSION["message"] = "Successfully saved.";
		        redirect_to("user.php");
            } 
            else 
            {
                $_SESSION["error"] = "Saving information failed.";
            }		                
        }//if
?>

<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <title>Main</title>
            <script>
            </script>
	    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>
	    <style type="text/css">
                body{
                    font-family: Verdana,Helvetica, sans-serif;
                    background-image: url(images/b1.jpeg);
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
		    background-image: url(images/bt1.jpg);
		    background-repeat: no-repeat;
		    padding: 10px;
		    margin: 5px;
                }
		#pageTitle{
			font-size: large;
			color: white;
		}
                
                #main{
		        background-image: url(images/b41.jpg);
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
                                <li><a href="userDashboard.php">USER DASHBOARD</a></li>
                                <li><a href="user.php">CHECK OUT BOOK</a></li>
                                <li><a href="cart.php">VIEW YOUR CART</a></li>
                                <li><a href="books.php">LIBRARY BOOKS</a></li>
                                <li><a href="logout.php">SIGN OUT</a></li>
                        </ul>
                        <div id ="message">
				<h4>
					Today's Message:
				</h4>
                            <p>A wild and crazy weekend involves sitting on the front porch, smoking a cigar, reading a book-"Robert M. Gates"
                            </p>
                        </div>
                </aside>
                <section id = "main">
                    <div id="first">
                        <p>Edit Your Profile</p>
                    </div>
                    <div id="second">
                        <form id ="myform" action="userDashboard.php" method="post">
                            <table>
                                <tr><td>Please edit your information:</td>
				<?php if(isset($_SESSION["error"])){
				      echo "<td";
				      echo $_SESSION["error"];
				      echo "<td>";
				}
				?>
				</tr>
				
                                <tr><td><label for= "name">Name:</label></td>
                                <td><input type="text" pattern="[a-zA-Z]+" maxlength= "10" name="name" id="name" placeholder="Please enter your name." autofocus required ></td></tr>
				
                                <tr><td><label for= "age">Age:</label></td>
                                <td><input type="number" min="13" max=130 name="age" id="age" placeholder="age" required ></td></tr>
				
                                <tr><td><label for= "zipcode">Zipcode:</label></td>
                                <td><input type="number" pattern="/d{5}" maxlength="5" name="zipcode" id="zipcode" placeholder="zipcode" required ></td></tr>
				
                                <tr><td><label for= "phone">Phone:</label></td>
                                <td><input type="number" pattern="/d{10}" maxlength="10" name="phone" id="phone" placeholder="phone" required ></td></tr>
				
                                <tr><td><label for= "email">Email:</label></td>
                                <td><input type="email" name="email" id="email" placeholder="email" required ></td></tr>
				
                                <tr><td><label for= "password">Password:</label></td>
                                <td><input type="password" pattern="[a-zA-Z0-9]{6,10}" maxlength="10" name="password"  id="password" placeholder="password" required ></td></tr>
				
                                <tr><td><label for= "passwordconf">Password (confirm):</label></td>
                                <td><input type="password" pattern="[a-zA-Z0-9]{6,10}" maxlength="10" name="passwordconf" id="passwordconf" placeholder="password" required ></td></tr>
				
                                <tr><td><label for= "signup">Save:</label></td>
                                <td><input type="submit" name="submit" id="submit" value="Submit"></td></tr>
                                
                                
                            </table>
                        </form>
		        
			<?php
	 
	
        mysqli_close($connection);

?>
			<script>
				$(document).ready(function(){
				        $("#myform").Validate();
					
				});
			</script>
                    </div>
                </section>		


                
                <footer>
                 <p>Copyright, Tawfiquzzaman Opu
		 &copy2016</p>
		 
                </footer>
            </div>
        </body>
</html>
