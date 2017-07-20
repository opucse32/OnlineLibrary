<?php
require_once('./config.php');

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "library";

    $connection = mysqli_connect(dbhost, dbuser, dbpass);
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error(). "<br />";
    }
    // Create Database
    $dbname = dbname;
    $sql = "DROP DATABASE if exists $dbname";
    mysqli_query($connection, $sql);
    $sql = "CREATE DATABASE $dbname";
    if (mysqli_query($connection, $sql))
    {
        echo "Database $dbname created successfully.". "<br />";
    }
    else
    {
        echo "Error creating database: " . mysqli_error($connection). "<br />";
    }

    $connection = mysqli_connect(dbhost, dbuser, dbpass, dbname);
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error(). "<br />";
    }
    
    //Create CATEGORY table
    $sql = "CREATE TABLE CATEGORY (isbn varchar(30) PRIMARY KEY, genre varchar (30), description varchar(900))";

    // Execute query
    if (mysqli_query($connection, $sql))
    {
        echo "<br />" . "CATEGORY Table created successfully." . "<br />";
    }
    else
    {
        echo "Error creating table: " . mysqli_error($connection) . "<br />";
    }

    //Insert some initial books in the CATEGORY table
    $insertedRows = 0;
    //row 1
    $description = "This book is about the database systems. It describes the 
                meaning of the DBMS, how to configure it, and how to use it in 
                programs that need database";
    $description = mysqli_real_escape_string($connection, $description);
    $sql = "INSERT INTO CATEGORY values('9780136067016', 'Science', '$description')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 2
    $description = "This is an introduction to JAVA book. It explains the concepts 
            of JAVA programming language in a simple way for the beginners to 
            learn the concept of JAVA faster and easier. The author of the book 
            received Honnor of the Best Book of the Year for this book in January 2012.";
    $description = mysqli_real_escape_string($connection, $description);
    $sql = "INSERT INTO CATEGORY values('9784587957849', 'Science', '$description')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 3
    $description = "This is an intermediate JAVA book. It covers some advanced 
            topics in JAVA programming language. The author of the book' attempt 
            was to make the concepts easier to grasp. The author believes in 
            this country there is an advanced need to learn JAVA.";
    $description = mysqli_real_escape_string($connection, $description);
    $sql = "INSERT INTO CATEGORY values('9784400007840', 'Science', '$description')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 4
    $description = "Operating System concepts are very important to learn. The 
            concepts help users to know their systems better. This can benefit 
            them to configure their suystem in a way to utilize the resources 
            of the system in much more efficient way.";
    $description = mysqli_real_escape_string($connection, $description);
    $sql = "INSERT INTO CATEGORY values('9784587257841', 'Science', '$description')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 5
    $description = "Operating System II has more concepts to cover. It explains 
            the memory management system, CPU utilization, 
            DISK managaement, and many more.";
    $description = mysqli_real_escape_string($connection, $description);
    $sql = "INSERT INTO CATEGORY values('9784587157111', 'Science', '$description')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 6
    $description = "Harry Potter is a series of seven fantasy novels written by 
            the British author J. K. Rowling. The series, named after the titular 
            character, chronicle the adventures of a wizard, Harry Potter, and 
            his friends Ronald Weasley and Hermione Granger, all of whom are 
            students at Hogwarts School of Witchcraft and Wizardry.";
    $description = mysqli_real_escape_string($connection, $description);
    $sql = "INSERT INTO CATEGORY values('9984587211842', 'Fiction', '$description')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 7
    $description = "The Hunger Games is a 2008 science fiction novel by the 
            American writer Suzanne Collins. It is written in the voice of 
            16-year-old Katniss Everdeen, who lives in the post-apocalyptic 
            nation of Panem in North America. The Capitol, a highly advanced 
            metropolis, exercises political control over the rest of the nation.";
    $description = mysqli_real_escape_string($connection, $description);
    $sql = "INSERT INTO CATEGORY values('9974587333843', 'Novel', '$description')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 8
    $description = "Pride and Prejudice is a novel by Jane Austen, first 
        published in 1813. The story follows the main character Elizabeth Bennet 
        as she deals with issues of manners, upbringing, morality, education, 
        and marriage in the society of the landed gentry of early 19th-century 
        England. Elizabeth is the second of five daughters of a country gentleman 
        living near the fictional town of Meryton in Hertfordshire, near London.";
    $description = mysqli_real_escape_string($connection, $description);
    $sql = "INSERT INTO CATEGORY values('9787458744484', 'Novel', '$description')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 9
    $description = "Gone with the Wind is a novel written by Margaret Mitchell, 
        first published in 1936. The story is set in Clayton County, Georgia, 
        and Atlanta during the American Civil War and Reconstruction. It depicts 
        the experiences of Scarlett OHara, the spoiled daughter of a well-to-do 
        plantation owner, who must use every means at her disposal to come out of 
        the poverty she finds herself in after Shermans March to the Sea.";
    $description = mysqli_real_escape_string($connection, $description);
    $sql = "INSERT INTO CATEGORY values('9787458723484', 'Novel', '$description')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 10
    $description = "The Giving Tree is a children's picture book written and 
        illustrated by Shel Silverstein. First published in 1964 by Harper & Row, 
        it has become one of Silverstein's best known titles and has been 
        translated into numerous languages.";
    $description = mysqli_real_escape_string($connection, $description);
    $sql = "INSERT INTO CATEGORY values('9787458798656', 'Children', '$description')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 11
    $description = "Catching Fire is a 2009 science fiction young adult novel by 
        American novelist Suzanne Collins, the second book in The Hunger Games 
        trilogy. As the sequel to the 2008 bestseller ";
    $description = mysqli_real_escape_string($connection, $description);
    $sql = "INSERT INTO CATEGORY values('9787458722056', 'Science Fiction', '$description')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }




    echo $insertedRows . ' ' . 'rows inserted into CATEGORY table.'. "<br />";


    // Create BOOK table
    $sql = "CREATE TABLE BOOK (title varchar(30),
        author varchar(30), copies int, isbn varchar(30) PRIMARY KEY, FOREIGN KEY(isbn) REFERENCES CATEGORY(isbn))";

    // Execute query
    if (mysqli_query($connection, $sql))
    {
        echo "<br />" . "BOOK Table created successfully." . "<br />";

    }
    else
    {
        echo "Error creating table: " . mysqli_error($connection) . "<br />";
    }

    //Insert some initial books in the BOOK table
    $insertedRows = 0;
    //row 1
    $sql = "INSERT INTO BOOK values('Intro to Database', 'Hector Garcia-Molina' , 3, '9780136067016')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 2
    $sql = "INSERT INTO BOOK values('Intro to Java', 'John McL' , 
 2, '9784587957849')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 3
    $sql = "INSERT INTO BOOK values('Intermediate Java', 'Jack McL' , 
 10, '9784400007840')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 4
    $sql = "INSERT INTO BOOK values('Operating Systems', 'David Peterson' , 1, '9784587257841')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 5
    $sql = "INSERT INTO BOOK values('Operating Systems II', 'David Peterson' , 1, '9784587157111')";
     if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 6
    $sql = "INSERT INTO BOOK values('Harry Potter', 'J. K. Rowling' , 5, '9984587211842')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }


    //row 7
    $sql = "INSERT INTO BOOK values('The Hunger Games', 'Suzanne Collins' , 4, '9974587333843')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 8
    $sql = "INSERT INTO BOOK values('Pride and Prejudice', 'Jane Austen' , 4, '9787458744484')";
     if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 9
    $sql = "INSERT INTO BOOK values('Gone with the Wind', 'Margaret Mitchell' , 9, '9787458723484')";
     if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 10
    $sql = "INSERT INTO BOOK values('The Giving Tree', 'Shel Silverstein' , 12, '9787458798656')";
     if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 11
    $sql = "INSERT INTO BOOK values('Catching Fire', 'Suzanne Collins' , 0, '9787458722056')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }//if
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }//else
    echo $insertedRows . ' ' . 'rows inserted into BOOK table.'. "<br />";



    //Create USER Table
    $sql = "CREATE TABLE USER (uID varchar(30) PRIMARY KEY, hashed_password varchar (800) not null,
        name varchar(30), age int, zipcode int(5), PhoneNumber varchar(12),email varchar(30), operatorType varchar(5))";

    // Execute query
    if (mysqli_query($connection, $sql))
    {
        echo "<br />" . "USER created Table successfully." . "<br />";

    }
    else
    {
        echo "Error creating table: " . mysqli_error($connection) . "<br />";
    }        

    //Create Stored Procedures
    $sql = "DROP PROCEDURE IF EXISTS insertUser";
    mysqli_query($connection, $sql);

    $sql = "CREATE PROCEDURE insertUser(IN newUid varchar(30), IN pass varchar(800), IN newName varchar(30), IN newAge int, IN newZip int(5), IN newPhone varchar (12), IN newEmail varchar (30), IN newType varchar (5)) BEGIN INSERT INTO USER VALUES (newUid, pass, newName, newAge, newZip, newPhone, newEmail, newType); END;";
    // Execute query
    if (mysqli_query($connection, $sql))
    {
        echo "'insertUser' Stored Procedure created successfully." . "<br />";

    }
    else
    {
        echo "Error creating 'insertUser' Stored Procedure: " . mysqli_error($connection) . "<br />";
    }  


    //insert some initial USERs in the USER table
    $insertedRows = 0;
    //row 1
    //$sql = "INSERT INTO USER values(1234, 'secretpass' , 'Jerry', 25, 95120, '408-111-1111', 'test@example.com', 'admin')";
    //CALL STORED PROCEDURE
    $sql = "CALL insertUser('1234', 'secretpass' , 'Jerry', 25, 95120, '408-111-1111', 'test@example.com', 'admin')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }

    //row 2
    //CALL STORED PROCEDURE
    //$sql = "INSERT INTO USER values(2345, 'secretpass' , 'John', 30, 95120, '408-111-1111', 'test@gmail.com', 'USER')";
    $sql = "CALL insertUser('2345', 'secretpass' , 'John', 30, 95120, '408-111-1111', 'test@gmail.com', 'USER')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }
    //row 3
    //CALL STORED PROCEDURE
    //$sql = "INSERT INTO USER values(3456, 'secretpass' , 'Jack', 40, 95120, '408-111-1111', 'test@gmail.com', 'USER')";
    $sql = "CALL insertUser('3456', 'secretpass' , 'Jack', 40, 95120, '408-111-1111', 'test@gmail.com', 'USER')";
    if (mysqli_query($connection, $sql))
    {
        echo "Row inserted successfully." . "<br />";
        $insertedRows += mysqli_affected_rows($connection);
    }
    else
    {
        echo "Error inserting row: " . mysqli_error($connection) . "<br />";
    }
    echo $insertedRows . ' ' . 'rows inserted into USER table.';


    //Create checkout table
    $sql = "CREATE TABLE checkout (transactionID varchar(11) PRIMARY KEY, isbn varchar(13), uID varchar(30), checkoutDate varchar(10), due varchar(10), fine double)";

    // Execute query
    if (mysqli_query($connection, $sql))
    {
        echo "<br />" . "<br />" . "checkout Table created successfully." . "<br />";

    }
    else
    {
        echo "Error creating table: " . mysqli_error($connection) . "<br />";
    }  


    //Create Stored Procedures
    $sql = "DROP PROCEDURE IF EXISTS searchBook";
    mysqli_query($connection, $sql);

    $sql = "CREATE PROCEDURE searchBook(IN newIsbn varchar(30)) BEGIN SELECT * FROM BOOK WHERE isbn=newIsbn; END;";
    // Execute query
    if (mysqli_query($connection, $sql))
    {
        echo "<br />" . "'searchBook' Stored Procedure created successfully." . "<br />";

    }
    else
    {
        echo "Error creating 'searchBook' Stored Procedure: " . mysqli_error($connection) . "<br />";
    }  

    //Create History Table
    $sql = "CREATE TABLE history (uID varchar(30), transactionID varchar(11), isbn varchar (13), checkoutDate varchar(30), dueDate varchar (10), returnedDate varchar(10), fine double, archiveDate varchar (30))";

    // Execute query
    if (mysqli_query($connection, $sql))
    {
        echo "<br />" . "'history' Table created successfully." . "<br />";

    }
    else
    {
        echo "Error creating table: " . mysqli_error($connection) . "<br />";
    }  

    //Close connection
    if (mysqli_close($connection))
        echo "<br />" ."Database connection is successfully closed.";











    

?>
