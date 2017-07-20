
<?php

?>
<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <title>Main</title>
            <script>
            </script>
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
			padding-left: 150px;
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
			text-decoration: none;
			color: green;
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
			padding: 0px 5px 5px 5px;
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
    I think of life as a good book. The further you get into it, the more it begins to make sense.

    –"Harold Kushner"
                            </p>
                        </div>
                </aside>
                <section id = "main">
                    <div id="first">
                        <p>About Us</p>
                    </div>
                    <div id= "second">
                        <img src="images/bh2.png" title="Hosted by imgur.com"/>
                    </div>
                    <div id="third">
                        <p>With Library Management System you will be able to check out a book, add books to your chart, updating your profile after Sign in of your choice to read anywhere.</p>
                    </div>
                    <div style="color:white;">
                    Metropolitan University Library, was established with the purpose of 
                    providing great resource books for all researchers, students, and professors. Metropolitan University will be gradually enhanced with more features and functionalities to help you reach your goal.
					Thank you.
                   
                    </div>
                </section>		


            <br />    
                <footer>
                 <p>Copyright, Tawfiquzzaman Opu
		 &copy2016</p>
		 
                </footer>
            </div>
        </body>
</html>
