<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php
    
    if(isset($_POST['submit']))
    {
        $isbn = $_POST["isbn"];
	$userID = $_POST["username"];	
	$checkout_set = find_userIbsn($userID, $isbn);
	
	if($checkout_set)
	{
	    $fine = $checkout_set['fine'];
	    return_book($checkout_set);
	    if($fine == 0)
	        $message1 = "The book successfully returned with no charge.";
	    else
	        $message2 = "The book returned successfully, but the charge is ". $fine; 
	}
	else
	{
            $message2 = "Wrong isbn or username.";
	}
    }
    else $message3 = "Return the book by inserting isbn and username";

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
	    <script  src="http://code.jquery.com/jquery-1.10.1.min.js" type="text/javascript" language="javascript"></script>
	    <style type="text/css">
                body{
                    font-family: Verdana,Helvetica, sans-serif;
                    background-image: url(images/a1.jpg);
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
		        background-image: url(images/kip.jpg);
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
		        background-image: url(images/ad.jpg);
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
		ul li.selected {
		    font-weight:bold;
		}
		#check1{
		    color: #33FA29;
		}
		#check2{
		    color: red;
		}
		#check3{
		    color: white;
		}
		message{
		    color: green;
		    
		}
		#box{
		    font-size: small;
		}
		
        a:hover
        { 
        color:black;
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
				      echo "Hi Admin ".$_SESSION["uID"];
				      echo "</li>";
				}
				?>
                                <li class="selected"><a href="admin.php" >ADMIN</a></li>
								<li><a href="adminBooks.php">LIBRARY BOOKS</a></li>
                                <li><a href="addBook.php">ADD BOOKS</a></li>
                                <li><a href="archive.php">LIBRARAY ARCHIVE</a></li>
                                <li><a href="logout.php">SIGN OUT</a></li>
			</ul>
                        <div id ="message">
				<h4>
					Today's Message:
				</h4>
                            <p style="color:black;">Every reader finds himself. The writer's work is merely a kind of optical instrument that makes it possible for the reader to discern what, without this book, he would perhaps never have seen in himself-"Marcel Proust"
                            </p>
                        </div>
                </aside>
                <section id = "main">
                    <div id="first">
                        <p>ADMIN AREA</p>
                    </div>
		      
                    <form action="admin.php" method="post" id="myform">
			<div id= "check">Check out your book from library.</div>
			<fieldset><legend>Return Book</legend>
			    <input type="number" pattern="/d{13}" maxlength="13" name="isbn" id="isbn" placeholder="ISBN" required >
			    <input type="text" pattern="[a-zA-Z0-9]+" maxlength="10" name="username" id="username" placeholder="Username" required >
			    <input type="submit" name="submit" id="submit" value="Submit">
			    <div id = "check1"><?php if(isset($message1)) echo $message1?></div>
			    <div id = "check2"><?php if(isset($message2)) echo $message2?></div>
			    <div id = "check3"><?php if(isset($message3)) echo $message3?></div>
			    
			</fieldset>
			
		    </form>    
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
