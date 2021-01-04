<?php
    // Start the session if it has not been started yet
    // It's only formatted like this because this is tested in XAMPP, otherwise there would be no if statement checking
    // if session already started
    if(!isset($_SESSION)){
        session_start();
    }
    else{
        if (isset($_SESSION['saveduser'])){
            $saveduser = $_SESSION['saveduser'];
            $savedID = $_SESSION['savedID'];
        }
    }

    // Connect to database
    $conn = mysqli_connect('localhost', 'victor', '1234567890', 'records');

    // Check connection
    if (!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }
?>
