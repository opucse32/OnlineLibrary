
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/session.php"); ?>
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
                    background-image: url(images/a1.jpg);
                    background-repeat: no-repeat;
                    
                }
                #content{
                    margin-left:auto;
                    margin-right:auto;
		    background-color: black;
		    width:1050px;
		    height: 900px
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
		        background-image: url();
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
		        background-image: url();
			background-repeat: no-repeat;
		        padding: 10px 10px 10px 0px;
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
                        border:dotted 1px white;
                        padding:0px 15px 0px 15px;
		}
                th{
			background-color:gray;
			padding:0px 15px 0px 15px;
                   
                }
                fieldset{
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
                            <p>I don't go by the rule book...
							I lead from the heart, not the head-"Princess Diana"
                            </p>
                        </div>
                </aside>
                <section id = "main">
                    <div id="first">
                        <p>Library Books</p>
                    </div>
                <?php echo "<p style=\"color:white;\">". "Please select one of the options to search:"."</p>"; ?>
                <form action="books.php" method= "post">
	            <fieldset><legend>Options</legend>
                        <input name="options" value="title" id="title" type="radio"/><label for ="title">Title</label><br/>
                        <input name="options" value="author" id="author" type="radio"/><label for ="author">Author</label><br/>
                        <input name="options" value="copies" id="copies" type="radio"/><label for ="number of Copes">Number of Copies</label><br/>
                        <input name="options" value="isbn" id="isbn" type="radio"/><label for ="isbn">ISBN</label><br/>
	            </fieldset>
	            <fieldset><legend>Functions</legend>
                        <input id= "button" type=submit name="search" value="Search"/>
                        <input class="text" type=text name="search_box" placeholder="Title/Author/Copies/ISBN"/>
	                <br/>
	            </fieldset>
	            </form>
	   
                <?php
		$query = "SELECT * ";
		$query .= "FROM Book ";
		
		
		if(isset($_POST['search']))
		{
			$search = $_POST['search_box'];
			if(isset($_POST['options']))
            {
			    switch($_POST['options']) 
                {
				    case "title":
					    $query .= "WHERE title LIKE '%$search%' ";
					    $value = "title";
					    break;
					case "author":
					    $query .= "WHERE author LIKE '%$search%' ";
					    $value = "author";
					    break;
					case "copies":
					    $query .= "WHERE copies LIKE '$search' ";
					    $value = "copies";
					    break;
					case "isbn":
					    $query .= "WHERE isbn LIKE '$search' ";
					    $value = "isbn";
					    break;
					default:
					    echo("Please select one of the options");
			    }//switch
			    $result = mysqli_query($connection, $query);
			    if (!$result)
                {
				    die("Database query failed.");
			    }//if

			    print("<table width=\"100%\" border =\"1\" style=\"color:black;\"><tr><th width=\"30%\" style = \"background-color: white;\">Title</th><th width:\"40%\" style = \"background-color: white;\">Author</th><th width:\"10%\" style = \"background-color: gray;\">Copies</th><th width:\"20%\" style = \"background-color: gray;\">ISBN</th></tr>");
			
			    while($row = mysqli_fetch_assoc($result))
                {
                    $title = $row['title'];
                    $isbn = $row['isbn'];
				    print("<tr>"."<td width=\"35%\">". "<a href='category.php?e=$title&amp;isbn=$isbn'>" .$title. "</td>". "<td width=\"35%\">".$row['author']. 
"</td>". "<td width=\"10%\">".$row['copies']."</td>"."<td width=\"20%\">".$row['isbn']."</td>"."</tr>");
			    }//while
			    print("</table>");
			}//if
			else
            {				
				$query = "SELECT title, author, copies, isbn ";
				$query .= "FROM Book ";
				$result = mysqli_query($connection, $query);
                
                //Get info from CATEGORY table
                

			    print("<table width=\"100%\" border =\"1\" style=\"color:black;\"><tr><th width=\"30%\" style = \"background-color: white;\">Title</th><th width:\"40%\" style = \"background-color: gray;\">Author</th><th width:\"10%\" style = \"background-color: gray;\">Copies</th><th width:\"20%\" style = \"background-color: gray;\">ISBN</th></tr>");
			
				while($row = mysqli_fetch_assoc($result))
                {
                    $title = $row['title'];
                    $isbn = $row['isbn'];
				    print("<tr>"."<td width=\"35%\">". "<a href='category.php?e=$title&amp;isbn=$isbn'>" .$title. "</td>". "<td width=\"35%\">".$row['author']. 
"</td>". "<td width=\"10%\">".$row['copies']."</td>"."<td width=\"20%\">".$row['isbn']."</td>"."</tr>");
			    }//while
			    print("</table>");
			}//else
		}//if
		?>	
                </section>    
                        
		        

	 
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
	    
        </body>
    </html>    
