<?php
    define("DBHOST" , "182.50.133.168");
    define("DBUSER" , "studDB19a");
    define("DBPASS" , "stud19DB1!");
    define("DBNAME" , "studDB19a");

    $connection = mysqli_connect(DBHOST, DBUSER , DBPASS , DBNAME);

    //testing connection success
    if(mysqli_connect_errno()) {
                die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
        }