<?php

    // Connect to database
    include("config/db_connect.php");

    // Functions used for database
    include("config/functions.php");

    // Determine current page number
    // If doesn't exist or on a negative number, default to first page
    if (!isset($_GET['page']) || $_GET['page'] < 1){
        $page = 1;
    }
    else {
        $page = $_GET['page'];
    }

    // Determine how to sort
    // If doesn't exist, default to sort by date submitted ascending
    if (!isset($_GET['sort']) || !isset($_GET['order']) ){
        $order = 'ASC';
        $sort = 'createdAt';
    }
    else {
        $order = $_GET['order'];
        $sort = $_GET['sort'];
    }

    // Determine first query result for current page
    $resultsPerPage = 10;
    $firstResult = ($page - 1) * $resultsPerPage;

    // Write query for all records
    // Limit first number is starting index, second number is how much you rows you want to show
    $sql = 'SELECT runID, run.accountID, characterID, time, placeID, money, accounts.username, createdAt FROM (run INNER JOIN accounts ON run.accountID = accounts.accountID) ORDER BY ' . $sort . ' ' . $order . ' LIMIT ' . $firstResult . ',' . $resultsPerPage;

    // Get result from made query
    $result = mysqli_query($conn, $sql);

    // Variables use for paginamtion
    $totalResults = mysqli_num_rows($result);
    $totalPages = ceil($totalResults / $resultsPerPage);

    // Make the results into an array
    $records = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free result from memory
    mysqli_free_result($result);

?>

<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>
    <main style = "background : url('images/backgrounds/background.png'); background-size : cover">
        <section class = "container">
            <div class = "brand">
                <h1 class = "center white-text brand"> Submitted Runs </h1>
                <table class = "striped bordered white-text">
                    <thead>
                        <tr>
                            <!-- Set the width so the table will stay same size -->
                            <th style = "width : 225px"><a class = "white-text" href = <?php echo reload($page, 'accountID', $order, $sort) ?>> Username </a> </th>
                            <th><a class = "white-text" href = <?php echo reload($page, 'characterID', $order, $sort) ?>> Character </a> </th>
                            <th><a class = "white-text" href = <?php echo reload($page, 'time', $order, $sort) ?>> Time </a> </th>
                            <th><a class = "white-text" href = <?php echo reload($page, 'placeID', $order, $sort) ?>> Furthest </a> </th>
                            <th><a class = "white-text" href = <?php echo reload($page, 'money', $order, $sort) ?>> Total Money ($) </a> </th>
                            <th><a class = "white-text" href = <?php echo reload($page, 'createdAt', $order, $sort) ?>> Date Submitted </a> </th>
                            <th>
                                <ul class="pagination">
                                    <li class = "waves-effect"> <a href = <?php echo reload($page - 1, $sort, $order, 'no') ?>> <i class = "material-icons white-text">chevron_left</i></a></li>
                                    <li class = "waves-effect"> <?php echo $page ?> </li>
                                    <li class = "waves-effect"> <a href = <?php echo reload($page + 1, $sort, $order, 'no') ?>> <i class = "material-icons white-text">chevron_right</i></a></li>
                                </ul>
                            </th>
                        </tr>
                    </thead>
                    <tbody class = "white-text">
                        <!-- One row for each record -->
                        <?php foreach($records as $record){ ?>
                            <tr>
                                <th> <a class = "white-text" href = "stats.php?user=<?php echo $record['accountID']?>"><?php echo htmlspecialchars($record['username'])?> </th>
                                <th> <img src = "<?php echo characterToImage(htmlspecialchars($record['characterID'])) ?>" width="64" height="64"> </th>
                                <th> <?php echo htmlspecialchars($record['time']) ?> </th>
                                <th> <img src = "<?php echo levelToImage(htmlspecialchars($record['placeID'])) ?>" width="128" height="64"> </th>
                                <th> <?php echo htmlspecialchars($record['money']) ?></th>
                                <th> <?php echo htmlspecialchars($record['createdAt']) ?> </th>
                                <th> &nbsp&nbsp&nbsp&nbsp&nbsp <a class = "white-text" href = "detail.php?id=<?php echo $record['runID']?>">More info </a> </th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <?php include('footer.php'); ?>
</html>
