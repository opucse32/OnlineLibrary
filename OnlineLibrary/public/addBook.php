<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php
    
    if(isset($_POST['submit']))
    {
        $title= mysql_prep($_POST['title']);
        $author= mysql_prep($_POST['author']);
        $copies= mysql_prep($_POST['copies']);
        $isbn= mysql_prep($_POST['isbn']);
        $genre= mysql_prep($_POST['genre']);
        $description= mysql_prep($_POST['description']);
        $book = array($title, $author, $copies, $isbn, $genre, $description);
        add_book($book);
    }
?>   
<!DOCTYPE html>
    <html>
	<head>
	    <meta charset="utf-8">
	    <title>User</title>
	    <script  src="http://code.jquery.com/jquery-1.10.1.min.js" type="text/javascript" language="javascript"></script>
	    <script language="javascript" type="text/javascript">
                $(document).ready(function()
                {
                    $("#isbn").blur(function() {
                        $("#check").text('Checking.....').fadeIn("slow");
                        $.ajax({
                            type: "POST",
                            url : "checkIsbn.php",
                            data: { isbn: this.value }
                        }).done(function(data) {
                             if(data > 0 ){
                                $("#isbn").css("border", "3px solid red");
                                $("#check").text('The book is in the library.');                                
                             }
                             else{
                                $("#isbn").css("border", "3px solid green");
                                $("#check").text('The book is not in the library');
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
		        background-image: url(images/ln.jpg);
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
		        background-image: url(images/bf.jpg);
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
                #submit{
                    width: 11.8em;
                    height: 2em;
                }
		ul li.selected {
		    font-weight:bold;
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
				      echo "Hi Admin ".$_SESSION["uID"];
				      echo "</li>";
				}
				?>
                                <li><a href="admin.php" >ADMIN</a></li>
			        <li><a href="adminBooks.php">LIBRARY BOOKS</a></li>
                                <li class="selected"><a href="addBook.php">ADD BOOKS</a></li>
                                <li><a href="archive.php">LIBRARAY ARCHIVE</a></li>
                                <li><a href="logout.php">SIGN OUT</a></li>

			</ul>
                        <div id ="message">
				<h4>
					Today's Message:
				</h4>
                            <p>Never regard study as a duty but as an enviable opportunity to learn to know the liberating influence of beauty in the realm of the spirit for your own personal joy and to the profit of the community to which your later works belong.
							-"Albert Einstein"
                            </p>
                        </div>
                </aside>
                <section id = "main">
                    <div id="first">
                        <p>ADMIN AREA</p>
                    </div>
		      
                    <form action="addBook.php" method="post" id="myform">

			<fieldset><legend>ADD Book</legend>
                            <table>
			    <tr><td><input type="text" pattern="[a-zA-Z0-9 ]+" maxlength="20" name="title" id="title" placeholder="Title" required ></td>
                                <td><input type="text" pattern="[a-zA-Z ]+" maxlength="20" name="author" id="author" placeholder="Author" required ></td>  
                            </tr>
                            <tr><td><input type="number" pattern="/d{2}" maxlength = "2" name="copies" id="copies" placeholder="Copies" required ></td>
                                <td><input type="number" pattern="/d{13}" min = "13" maxlength = "13" name="isbn" id="isbn" placeholder="ISBN" required ></td><td id= "check"></td>
                            </tr>
                            <tr><td colspan = "2"><textarea id="textarea" name="description" rows="5" cols="37" placeholder= Description></textarea></td>
                            </tr>
                            <tr><td><input type="text" pattern="[a-zA-Z]+" maxlength="10" name="genre" id="genre" placeholder="Genre" required ></td>
                                <td><input type="submit" name="submit" id="submit" value="Submit"></td>
                            </tr>
			    <div id = "check1"><?php if(isset($message1)) echo $message1?></div>
			    <div id = "check2"><?php if(isset($message2)) echo $message2?></div>
			    <div id = "check3"><?php if(isset($message3)) echo $message3?></div>
			    </table>
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
