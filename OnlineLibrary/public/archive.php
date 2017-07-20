<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/session.php"); ?>
<!DOCTYPE html>
    <html>
	<head>
	    <meta charset="utf-8">
	    <title>Archive</title>
            <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
            <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
            <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function() {
                $('#table_id').dataTable({

                });
            } );             
            </script>
            <style type="text/css">
            body{
                font-family: Verdana,Helvetica, sans-serif;
                background-image: url(images/vy.jpg);
                background-repeat: no-repeat;       
                }
                #content{
                    margin-left:auto;
                    margin-right:auto;

		    
		    width:1050px;
		    height: 900px
                }
                header{
		    text-align: center;
		    height: 100px;
		    background-image: url(images/op.jpg);
		    background-repeat: no-repeat;
		    opacity: .6;
		    padding: 10px;
		    margin: 5px;
                }
		#pageTitle{
		    font-size: large;
		    color: white;
		}
		#table_id{
                      opacity: .9;
		}
		th{
		    color: black;
		}
		ul {
                    background-image: url(images/oq.jpg);
		    opacity: .6;
                    margin: 10px 10px 0px 10px;
                    text-decoration: none;
                    padding: 5px 0px 5px 0px;
                }
		ul li {
                    display: inline;
                    padding: 5px 10px 5px 10px;

                }
		ul li a:link, ul li a:visited {
                    color: white;
		    text-decoration: none;
		    border-bottom: dotted white 1px;
                    font-weight: bold;
                }
		ul li.selected {
                    background-color: darkgray;
		    opacity: .9;
                }

            </style>    
        </head>
        <body>
            <div id="content">
                <header>
                    <div id ="pageTitle"><h1>METROPOLITAN UNIVERSITY LIBRARY</h1></div>
                </header>
		<nav>
		    <ul>
		    <li><a href="admin.php">ADMIN</a></li>
		    <li><a href="adminBooks.php">LIBRARY BOOKS</a></li>
                    <li><a href="addBook.php">ADD BOOKS</a></li>
                    <li class="selected"><a href="archive.php">LIBRARAY ARCHIVE</a></li>
                    <li><a href="logout.php">SIGN OUT</a></li>
		    </ul>
		</nav>
                <table id="table_id">
                    <thead>
                        <tr>
                                <th>Username</th>
				<th>TrasactionID</th>
                                <th>ISBN</th>
                                <th>Checkout</th>
				<th>Due</th>
                                <th>Returned</th>
                                <th>Fine</th>
				<th>Archive</th>
                                
                        </tr>
                    </thead>
                <tbody>
        
            <?php
            $query = "SELECT * ";
            $query .= "FROM history";	
	    $result = mysqli_query($connection, $query);
	    if (!$result){
		die("Database query failed.");
	    }	
		while($row = mysqli_fetch_assoc($result)){
			print("<tr><td> ".$row['uID']."</td><td> ".$row['transactionID']." </td><td> ".$row['isbn']." </td>
				 <td> ".$row['checkoutDate']." </td><td> ".$row['dueDate']."</td><td> "
                                 .$row['returnedDate']."</td><td> ".$row['fine']."</td><td> ".$row['archiveDate']."</td></tr>");
			}
			print("</tbody></table>");
            ?>
        </body>
    </html>
            
        </body>
    </html>