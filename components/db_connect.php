<?php
    // XAMPP Apache and MySQL needs to run

    $host = "localhost";        // hostname, you can find the information in phpMyAdmin at the house symbol you can write localhost or 127.0.0.1 
    $user = "root";             // username, root is mostly default root
    $pass = "";                 // password, by default normaly not set
    $dbName = "BE20_CR5_animal_adoption_sahrastursa";   // Databasename like in phpMyAdmin

    // connection to the database
    $conn = mysqli_connect($host, $user, $pass, $dbName);

    // if the connection failed you get a message
    if(!$conn){
        die("connection failed");
    }