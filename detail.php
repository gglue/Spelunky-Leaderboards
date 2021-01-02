<?php
    // Connect to database
    include("config/db_connect.php");

    // Functions used for database
    include("config/functions.php");

    // Check if a run is selected
    if (isset($_GET["id"])){

        // Receieve the data from the specified run
        $id = mysqli_real_escape_string($conn, $_GET["id"]);

        // Make the SQL for finding the run
        $sql = "SELECT * FROM (((run INNER JOIN characters ON run.characterID = characters.characterID) INNER JOIN places ON run.placeID = places.placeID) INNER JOIN accounts ON run.accountID = accounts.accountID) WHERE runID = $id";

        // Get query results
        $result = mysqli_query($conn, $sql);

        // Get result in array format
        $record = mysqli_fetch_assoc($result);

        // Free result from memory
        mysqli_free_result($result);

    }
?>

<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>
    <!-- Displays run only if it exists -->
    <section class = "container white-text center">
        <?php if ($record): ?>
            <div class = "row">
                <div class = "col s8 offset-s2">
                    <div class = "brand">
                        <h2> Run Details </h2>
                        <div class = "brandLight">
                            <img src = "<?php echo characterToImage(htmlspecialchars($record['characterID'])) ?>" width="64" height="64">
                            <img src = "<?php echo levelToImage(htmlspecialchars($record['placeID'])) ?>" width="128" height="64">
                            <p><b>Runner: </b> <?php echo htmlspecialchars($record['username']) ?></p>
                            <p><b>Character used: </b> <?php echo htmlspecialchars($record['characterName']) ?></p>
                            <p><b>Furthest location: </b> <?php echo htmlspecialchars($record['placeName']) ?></p>
                            <p><b>Total elapsed time: </b> <?php echo htmlspecialchars($record['time']) ?></p>
                            <p><b>Total money ($): </b> <?php echo htmlspecialchars($record['money']) ?></p>
                            <p><b>Runner's comments: </b> <?php echo htmlspecialchars($record['comment']) ?></p>

                            <!-- Embed vod only if it exists -->
                            <?php if ($record['url'] != NULL): ?>
                                <iframe width="420" height="345" src=<?php echo htmlspecialchars($record['url'])?> > </iframe>
                            <?php else: ?>
                                <h4> VOD not uploaded! </h4>
                            <?php endif; ?>

                            <p><b>Date submitted: </b> <?php echo htmlspecialchars($record['createdAt']) ?></p>
                        </div>
                    </div>

                </div>
            </div>

        <?php else: ?>
            <h1 class = "black-text"> No run exists! </h1>

        <?php endif; ?>
    </section>
    <?php include('footer.php'); ?>
</html>
