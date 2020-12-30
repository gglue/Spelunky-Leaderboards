<?php

    // Connect to database
    include("config/db_connect.php");

    // Functions used for database
    include("config/functions.php");

    // Write query for all records
    $sql = 'SELECT runID, accountID, characterID, time, placeID, money, createdAt FROM run ORDER BY createdAt';

    // Get result from made query
    $result = mysqli_query($conn, $sql);

    // Make the results into an array
    $records = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free result from memory
    mysqli_free_result($result);

    // Close connection to database
    mysqli_close($conn);

    //print_r($records);
?>

<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>

    <section class = "container brand">
        <h1 class = "center white-text"> Submitted Runs </h1>
            <table class = "striped bordered white-text">
                <thead>
                    <tr>
                        <th> Username </th>
                        <th> Character </th>
                        <th> Time </th>
                        <th> Furthest </th>
                        <th> Total Money </th>
                        <th> Date Submitted </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody class = "white-text">
                    <!-- One row for each record -->
                    <?php foreach($records as $record){ ?>
                        <tr>
                            <th> <?php echo htmlspecialchars($record['accountID']) ?> </th>
                            <th> <img src = "<?php echo characterToImage(htmlspecialchars($record['characterID'])) ?>" width="64" height="64"> </th>
                            <th> <?php echo htmlspecialchars($record['time']) ?> </th>
                            <th> <img src = "<?php echo levelToImage(htmlspecialchars($record['placeID'])) ?>" width="128" height="64"> </th>
                            <th> <?php echo htmlspecialchars($record['money']) ?> </th>
                            <th> <?php echo htmlspecialchars($record['createdAt']) ?> </th>
                            <th> <a class = "white-text" href = "detail.php?id=<?php echo $record['runID']?>">More info </a> </th>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

    </section>



    <?php include('footer.php'); ?>
</html>
