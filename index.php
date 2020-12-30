<?php
    // Connect to database
    $conn = mysqli_connect('localhost', 'victor', '1234567890', 'records');

    // Check connection
    if (!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }

    function characterToImage(int $number){
        $imageFile = "images/characters/";
        $imageFile .= $number;
        $imageFile .= ".png";
        return $imageFile;
    }

    function levelToImage(int $number){
        $imageFile = "images/places/";
        // Choosing the area image based on numeric input
        if ($number >= 1 && $number <= 4){
            $imageFile .= 1;
        }
        elseif ($number >= 5 && $number <= 8){
            $imageFile .= 2;
        }
        elseif ($number >= 9 && $number <= 12){
            $imageFile .= 3;
        }
        elseif ($number == 13){
            $imageFile .= 4;
        }
        elseif ($number >= 14 && $number <= 17){
            $imageFile .= 5;
        }
        elseif ($number == 18){
            $imageFile .= 6;
        }
        elseif ($number >= 19 && $number <= 21){
            $imageFile .= 7;
        }
        elseif ($number == 22){
            $imageFile .= 8;
        }
        elseif ($number == 23){
            $imageFile .= 7;
        }
        elseif ($number == 24){
            $imageFile .= 9;
        }
        elseif ($number == 25){
            $imageFile .= 10;
        }
        elseif ($number >= 26 && $number <= 28){
            $imageFile .= 11;
        }
        elseif ($number == 29){
            $imageFile .= 12;
        }
        elseif ($number >= 30 && $number <= 31){
            $imageFile .= 13;
        }
        elseif ($number == 32){
            $imageFile .= 14;
        }
        elseif ($number == 33){
            $imageFile .= 13;
        }
        elseif ($number == 34){
            $imageFile .= 15;
        }
        $imageFile .= ".png";
        return $imageFile;
    }
    // Write query for all records
    $sql = 'SELECT accountID, selectedCharacter, time, furthest, money, createdAt FROM run ORDER BY createdAt';

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

    <section class = "container">
        <h4 class = "center"> Submitted Runs </h4>
        <div class = "row">
            <table class = "col s12 striped bordered">
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
                <tbody class = "grey-text">
                    <!-- One row for each record -->
                    <?php foreach($records as $record){ ?>
                        <tr>
                            <th> <?php echo htmlspecialchars($record['accountID']) ?> </th>
                            <th> <img src = "<?php echo characterToImage(htmlspecialchars($record['selectedCharacter'])) ?>" width="64" height="64"> </th>
                            <th> <?php echo htmlspecialchars($record['time']) ?> </th>
                            <th> <img src = "<?php echo levelToImage(htmlspecialchars($record['furthest'])) ?>" width="128" height="64"> </th>
                            <th> <?php echo htmlspecialchars($record['money']) ?> </th>
                            <th> <?php echo htmlspecialchars($record['createdAt']) ?> </th>
                            <th> More info </th>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </section>



    <?php include('footer.php'); ?>
</html>
