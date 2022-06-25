<?php

    //Start session
    session_start();

    define('SITEURL', 'http://localhost/hotel-booking-fyp/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'hotel_booking');

        //execute query and save it into daabase
        $conn = mysqli_connect('LOCALHOST',DB_USERNAME,DB_PASSWORD) or die(mysqli_error($conn));
        $db_select = mysqli_select_db($conn, 'hotel_booking') or die(mysqli_error($conn)); 



?>