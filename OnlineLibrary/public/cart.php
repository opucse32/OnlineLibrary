
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
                    background-image: url(images/cc.jpg);
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
		        background-image: url(images/lul.jpg);
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
                            <p>In ninth grade, I came up with a new form of rebellion. I hadn't been getting good grades, but I decided to get all A's without taking a book home. I didn't go to math class, because I knew enough and had read ahead, and I placed within the top 10 people in the nation on an aptitude exam-"Bil Gates"
                            </p>
                        </div>
                </aside>
                <section id = "main">
                    <div id="first">
                        <p>View Your Cart</p>
                    </div>
		      

			<div id= "check">List of books you currently checked out:</div>

<?php 
            $uID = $_SESSION["uID"];
            $query = "SELECT * FROM checkout where uID='$uID'";
			$result = mysqli_query($connection, $query);
			if (!$result){
				die("Database query failed.");			
            }
            $row = mysqli_fetch_assoc($result);
            $rowNum = mysqli_num_rows($result);
            if ($rowNum == 0)
                echo "<p style = \"color:white;\">"."Your cart is empty!";
            else 
            {
                echo("<table width=\"100%\" border =\"1\" style=\"color:black;\"><tr><th style = \"background-color: gray;\">Title</th><th style = \"background-color: gray;\">Author</th><th style = \"background-color: gray;\">Checkout Date</th><th style = \"background-color: gray;\">Due Date</th><th style = \"background-color: gray;\">Fine</th></tr>"); 
			    for ($i = 0; $i < $rowNum; $i++)
                {                    
                    $isbn = $row['isbn'];
                    //Calculate fine:
                    //Get current date
                    $date = date_create(date("Y-m-d"));
                    date_add($date,date_interval_create_from_date_string("0 days"));
                    $currentDate = date_format($date,"Y-m-d");
                    $dueDate = $row['due'];
                    $fine = $row['fine'];
                    if (strcmp ($dueDate, $currentDate) < 0) 
                    {
                        $difference = $currentDate - $dueDate;
                        $currentDate = str_replace('-', '', $currentDate);
                        $dueDate = str_replace('-', '', $dueDate);
                        $difference = $currentDate - $dueDate;
                        $fine = $difference * 0.35;
                    }//if
                    //Set maximum amount of fine to be $100 if already more than $100
                    if ($fine > 100)
                        $fine = 100;
                    
                    //$queryBook = "SELECT * FROM BOOK where isbn='$isbn'";
                    //CALL STORED PROCEDURE
                    $queryBook = "CALL searchBook($isbn)";
                    $resultBook = mysqli_query($connection, $queryBook);
                    $rowBook = mysqli_fetch_assoc($resultBook);
                    $title = $rowBook['title'];
                    $isbn = $rowBook['isbn'];
				    echo "<tr>"."<td>"."<a href='category.php?e=$title&amp;isbn=$isbn'>".$title."</td>". "<td>".$rowBook['author'].
                        "</td>". "<td>".$row['checkoutDate']."</td>". "<td>".$row['due'].
                        "</td>". "<td>"."$".$fine."</td>"."</tr>";
                    $row = mysqli_fetch_assoc($result);
			    }//for
			    echo "</table>";
            }//else

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
