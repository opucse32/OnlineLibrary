
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php
    $message ="";

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
		    background-image: url(images/as1.jpg);
		    background-repeat: no-repeat;
		    padding: 10px;
		    margin: 5px;
                }
		#pageTitle{
			font-size: large;
			color: white;
		}
                
                #main{
		        background-image: url(images/cart.jpg);
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
		fieldset{
		    color: white;
		}
		#check{
		    color: white;
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
                            <p>Every reader finds himself. The writer's work is merely a kind of optical instrument that makes it possible for the reader to discern what, without this book, he would perhaps never have seen in himself-"Marcel Proust"
                            </p>
                        </div>
                </aside>
                <section id = "main">
                    <div id="first">
                        <p>Book Information</p>
                    </div>
		      

			<!--<div id= "check">List of books you currently checked out:</div>-->

<?php 
            $uID = $_SESSION["uID"];

                echo("<table width=\"100%\" border =\"1\" style=\"color:black;\"><tr><th width=\"15%\" style = \"background-color: gray;\">Title</th><th width=\"15%\" style = \"background-color: gray;\">Author</th><th width=\"10%\" style = \"background-color: gray;\">Genre</th><th width=\"60%\" style = \"background-color: gray;\">Description</th></tr>"); 
			   // for ($i = 0; $i < $rowNum; $i++)
               // {                    
                    $isbn = $_REQUEST['isbn'];
                    //Get Book info
                    $queryBook = "SELECT * FROM BOOK where isbn='$isbn'";
                    $resultBook = mysqli_query($connection, $queryBook);
                    $rowBook = mysqli_fetch_assoc($resultBook);

                    //Get CATEGORY info
                    $queryCategory = "SELECT * FROM CATEGORY where isbn='$isbn'";
                    $resultCategory = mysqli_query($connection, $queryCategory);
                    $rowCategory = mysqli_fetch_assoc($resultCategory);
    
				    echo "<tr>"."<td>".$rowBook['title']."</td>". "<td>".$rowBook['author'].
                        "</td>". "<td>".$rowCategory['genre']."</td>". "<td>".
                        $rowCategory['description'].
                        "</td>"."</tr>";
                    //$row = mysqli_fetch_assoc($result);
			  //  }//for
			    echo "</table>";
          //  }//else

?>			
  
		     
            <div id= "check"><?php echo $message;?> </div>
			<?php
	       // echo $message;
	
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
	    
        </body>
    </html>    
