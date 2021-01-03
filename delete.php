<?php

    // Connect to database
    include("config/db_connect.php");

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $id = mysqli_real_escape_string($conn, $id);

        // Query to delete record
        $sql = 'DELETE from run WHERE runID = ' . $id;
        $result = mysqli_query($conn, $sql);

    }

?>
