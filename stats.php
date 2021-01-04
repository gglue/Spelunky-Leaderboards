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
    $resultsPerPage = 6;
    $firstResult = ($page - 1) * $resultsPerPage;

    $user = $userExists = $runExists = '';

    // Get all the user's records if user exists
    if ($_GET["user"]){

        // Receieve the data from the specified run
        $user = mysqli_real_escape_string($conn, $_GET["user"]);

        // Make the SQL for finding all runs of user
        $sql = 'SELECT runID, run.accountID, run.characterID, time, run.placeID, money, createdAt FROM (run INNER JOIN characters ON characters.characterID = run.characterID) WHERE run.accountID = ' . $user . ' ORDER BY ' . $sort . ' ' . $order . ' LIMIT ' . $firstResult . ',' . $resultsPerPage;

        // Get result from made query
        $result = mysqli_query($conn, $sql);

        // Variables use for paginamtion
        $totalResults = mysqli_num_rows($result);
        $totalPages = ceil($totalResults / $resultsPerPage);

        // Make the results into an array
        $records = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Free result from memory
        mysqli_free_result($result);
    }
?>

<!DOCTYPE html>
<html>
    <main style = "background : url('images/backgrounds/background.png'); background-size : cover">
        <?php include("header.php"); ?>
        <section class = "container">
            <h4 class = "center"> &nbsp </h1>
            <?php
                // Query checks if user exists
                if ($user){
                    $userSQL = 'SELECT accountID FROM accounts WHERE accountID = ' . $user . ' LIMIT 1';
                    $userResult = mysqli_query($conn, $userSQL);
                    $userExists = mysqli_fetch_assoc($userResult);

                    // Query checks if at least one run exists
                    $userSQL = 'SELECT accountID FROM run WHERE accountID = ' . $user . ' LIMIT 1';
                    $userResult = mysqli_query($conn, $userSQL);
                    $runExists = mysqli_fetch_assoc($userResult);
                }
                if($userExists && $runExists):
            ?>
                <div class = "row">
                    <div class = "col s5 brand">
                        <?php

                        // Get all user's stats by queries
                        $stats = array('username' => '', 'mostPlayed' => 1, 'runs' => 0, 'money' => 0, 'fastestWin' => "", 'wins' => 0, 'winRate' => 0.0, 'averageMoney' => 0, 'meanLevel' => 0);

                        // Make the SQL for finding all runs
                        $statSQL = 'SELECT runID, run.accountID, characterID, username, time, placeID, money FROM (run INNER JOIN accounts ON run.accountID = accounts.accountID)  WHERE accounts.accountID = ' . $user . ' ORDER BY ' . $sort . ' ' . $order;

                        // Get result from made query
                        $statResult = mysqli_query($conn, $statSQL);

                        // Make the results into an array
                        $statRecords = mysqli_fetch_all($statResult, MYSQLI_ASSOC);

                        $stats['username'] = $statRecords[0]['username'];

                        foreach ($statRecords as $statRecord){
                            // These are increment variables so simply increase
                            $stats['runs'] += 1;
                            $stats['money'] += $statRecord['money'];
                            if ($statRecord['placeID'] >= 29){
                                $stats['wins'] += 1;
                            }
                        }

                        // Second query for the counting variables
                        $statSQL = 'SELECT MIN(time) as fastest, AVG(money) as averageIncome, AVG(placeID) as averageLevel FROM run WHERE run.accountID = ' . $user;

                        // Get result from made query
                        $statResult = mysqli_query($conn, $statSQL);

                        // Make the results into an array
                        $statRecords = mysqli_fetch_all($statResult, MYSQLI_ASSOC);

                        $stats['fastestWin'] = $statRecords[0]['fastest'];
                        $stats['winRate'] = round($stats['wins'] / $stats['runs'], 3) *  100;
                        $stats['averageMoney'] = round($statRecords[0]['averageIncome'], 0);
                        $stats['meanLevel'] = round($statRecords[0]['averageLevel'], 1);

                        // Third query to get the mode of chosen characters
                        $statSQL = 'SELECT characterID FROM run WHERE accountID = ' . $user . ' GROUP BY characterID ORDER BY COUNT(characterID) DESC LIMIT 1';

                        // Get result from made query
                        $statResult = mysqli_query($conn, $statSQL);

                        // Make the results into an array
                        $statRecords = mysqli_fetch_all($statResult, MYSQLI_ASSOC);

                        $stats['mostPlayed'] = $statRecords[0]['characterID'];

                        ?>
                        <h4 class = "center white-text"> <?php echo $stats['username'] ?> </h4>
                        <p class = "center"> <img src = "<?php echo characterToImage(htmlspecialchars($stats['mostPlayed'])) ?>" width="101" height="101"> </p>
                        <p class = "center white-text"> Total Runs: <?php echo $stats['runs'] ?> </p>
                        <p class = "center white-text"> Total Wins: <?php echo $stats['wins'] ?> wins</p>
                        <p class = "center white-text"> Win Rate: <?php echo $stats['winRate'] ?>%</p>
                        <p class = "center white-text"> Total Money: $<?php echo $stats['money'] ?> </p>
                        <p class = "center white-text"> Average Money: $<?php echo $stats['averageMoney'] ?> </p>
                        <p class = "center white-text"> Fastest Win: <?php echo $stats['fastestWin'] ?></p>
                        <p class = "center white-text"> Average Level: <?php echo $stats['meanLevel'] ?> floors</p>
                        <p>&nbsp</p>
                    </div>
                    <div class = "col s7">
                            <table class = "striped bordered white-text brand">
                                <thead class = brand>
                                    <tr>
                                        <th><a class = "white-text" href = <?php echo userReload($page, $user, 'characterID', $order, $sort) ?>> Character </a> </th>
                                        <th><a class = "white-text" href = <?php echo userReload($page, $user, 'time', $order, $sort) ?>> Time </a> </th>
                                        <th><a class = "white-text" href = <?php echo userReload($page, $user, 'placeID', $order, $sort) ?>> Furthest </a> </th>
                                        <th><a class = "white-text" href = <?php echo userReload($page, $user, 'money', $order, $sort) ?>> Total Money ($) </a> </th>
                                        <th><a class = "white-text" href = <?php echo userReload($page, $user, 'createdAt', $order, $sort) ?>> Date Submitted </a> </th>
                                        <th>
                                            <ul class="pagination">
                                                <li class = "waves-effect"> <a href = <?php echo userReload($page - 1, $user, $sort, $order, 'no') ?>> <i class = "material-icons white-text">chevron_left</i></a></li>
                                                <li class = "waves-effect"> <?php echo $page ?> </li>
                                                <li class = "waves-effect"> <a href = <?php echo userReload($page + 1, $user, $sort, $order, 'no') ?>> <i class = "material-icons white-text">chevron_right</i></a></li>
                                            </ul>
                                        </th>
                                        <?php
                                            if (isset($_SESSION['savedID'])){
                                                if ($_SESSION['savedID'] == $user){
                                                    echo "<th> Delete? </th>";
                                                }
                                            }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody class = "white-text">
                                    <!-- One row for each record -->
                                    <?php foreach($records as $record){ ?>
                                        <tr>
                                            <th class = "center"> <img src = "<?php echo characterToImage(htmlspecialchars($record['characterID'])) ?>" width="32" height="32"> </th>
                                            <th> <?php echo htmlspecialchars($record['time']) ?> </th>
                                            <th> <img src = "<?php echo levelToImage(htmlspecialchars($record['placeID'])) ?>" width="64" height="32"> </th>
                                            <th class = "center"> <?php echo htmlspecialchars($record['money']) ?> </th>
                                            <th> <?php echo htmlspecialchars($record['createdAt']) ?> </th>
                                            <th> &nbsp&nbsp&nbsp&nbsp&nbsp <a class = "white-text" href = "detail.php?id=<?php echo $record['runID']?>">More info </a> </th>
                                            <?php if (isset($_SESSION['savedID'])): ?>
                                                <?php if ($_SESSION['savedID'] == $user): ?>
                                                    <th class = "center"> <a href = "#" onclick="deleteRecord(<?php echo $record['runID'] ?>)"><i class="material-icons red-text">clear</i></a></th>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            <?php else: ?>
                <h3 class = "white-text center"> This user does not exist or has not submitted a run yet! </h1>
            </section>
        <?php endif; ?>
        </main>
    <script type = "text/javascript">
        function deleteRecord(num){
            var id = num;
            if (confirm("Are you sure you want to delete this record?")){
                $.ajax({
                    type: "POST",
                    url: "delete.php",
                    data: "id=" + id,
                    success: function(data){
                        location.reload();
                    }
                });
            }
        }
    </script>
    <?php include('footer.php'); ?>
</html>
