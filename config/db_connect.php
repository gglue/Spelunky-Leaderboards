<?php
    // Connect to database
    $conn = mysqli_connect('localhost', 'victor', '1234567890', 'records');

    // Check connection
    if (!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }
?>
