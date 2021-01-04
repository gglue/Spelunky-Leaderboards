<?php
    // Connect to database
    include("config/db_connect.php");

    // Write query for all records
    // Limit first number is starting index, second number is how much you rows you want to show
    $sql = 'SELECT * FROM (accounts) ORDER BY accountID ASC';

    // Get result from made query
    $result = mysqli_query($conn, $sql);

    // Make the results into an array
    $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>
    <main style = "background : url('images/backgrounds/background.png'); background-size : cover">
        <section class = "container">
            <div class = "row">
                <div class = "col s4 offset-s4">
                    <h1 class = "center white-text brand"> All Users </h1>
                    <table class = "striped bordered white-text">
                        <thead class = "brand">
                            <tr>
                                <!-- Set the width so the table will stay same size -->
                                <th style = 'width : 50px'>User ID</th>
                                <th style = "width : 225px">Username</th>
                            </tr>
                        </thead>
                        <tbody class = "white-text brand">
                            <!-- One row for each record -->
                            <?php foreach($records as $record){ ?>
                                <tr>
                                    <th> <a class = "white-text" href = "stats.php?user=<?php echo $record['accountID']?>"><?php echo htmlspecialchars($record['accountID'])?> </th>
                                    <th> <a class = "white-text" href = "stats.php?user=<?php echo $record['accountID']?>"><?php echo htmlspecialchars($record['username'])?> </th>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
    <?php include('footer.php'); ?>
</html>
