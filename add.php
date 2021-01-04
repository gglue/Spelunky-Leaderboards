<?php

    // Connect to database
    include("config/db_connect.php");

    $character = $money = $place = $time = $vod = $comment = '';
    $errors = array('character' => '', 'money' => '', 'time' => '', 'place' => '', 'vod' => '');
    if(isset($_POST['submit'])){

        // Check if there is a character is selected
        if (empty($_POST['character'])){
            $errors['character'] = 'Please choose a character first! <br>';
        }
        else {
            $character = htmlspecialchars($_POST['character']);
        }

        // Check if money input is properly filled in
        if (empty($_POST['money'])){
            // Allow 0 value
            if (!(is_numeric($_POST['money']))){
                $errors['money'] = 'Please fill in the amount of money you earned!';
            }
        }
        else {
            $money = htmlspecialchars($_POST['money']);
            if (!preg_match('/^[0-9]*$/', $money)){
                $errors['money'] = "MONEY NOT CLEAR";
            }
        }

        // Check if time input is properly filled in
        if (empty($_POST['time'])){
            $errors['time'] = 'Please fill in the elapsed time!';
        }
        else {
            $time = htmlspecialchars($_POST['time']);
            if (!preg_match('/^(((([0-1][0-9])|(2[0-3])):?[0-5][0-9]:?[0-5][0-9]+$))/', $time)){
                $errors['time'] = "TIME NOT CLEAR";
            }
        }

        // Check if there is a place is selected
        if (empty($_POST['place'])){
            $errors['place'] = 'Please choose your furthest area!';
        }
        else {
            $place = htmlspecialchars($_POST['place']);
        }

        // Check if VOD is selected, then must paste valid input
        if (!empty($_POST['vodCheck'])){
            if (!empty($_POST['vod'])){
                $vod = htmlspecialchars($_POST['vod']);
                if (!strpos($vod, 'www.youtube.com/watch?v') !== false) {
                    $errors['vod'] = 'Please paste a valid YouTube link!';
                }
            }
            else {
                $errors['vod'] = 'Please paste your link!';
            }
        }

        // Get input from comment regardless
        $comment = htmlspecialchars($_POST['comment']);

        // Put the information into database and redirect if no query errors
        if (!array_filter($errors)){

            // Change VOD url to embeded
            $vod = str_replace("watch?v=", "embed/", $vod);

            // Save the input into sqli compatible variables
            $character = mysqli_real_escape_string($conn, $character);
            $time = mysqli_real_escape_string($conn, $time);
            $place = mysqli_real_escape_string($conn, $place);
            $vod = mysqli_real_escape_string($conn, $vod);
            $comment = mysqli_real_escape_string($conn, $comment);
            $money = mysqli_real_escape_string($conn, $money);
            $savedID = mysqli_real_escape_string($conn,$_SESSION['savedID']);
            // Create SQL
            $sql = "INSERT INTO run(characterID, time, placeID, url, comment, accountID, money) VALUES('$character', '$time', $place, '$vod', '$comment', $savedID, '$money')";

            // Check if action is successful
            if (mysqli_query($conn, $sql)){
                // success
                header('Location: index.php');
            }
            else {
                // fail
                echo 'Query error: ' . mysqli_error($conn);
            }
        }
    }


?>

<!DOCTYPE html>
<html>
    <?php include("header.php"); ?>
    <main style = "background : url('images/backgrounds/background.jpg'); background-size : cover">
        <section class = "container grey-text">
            <?php if (isset($saveduser)): ?>
                <h4 class = "center">Add your Run!</h4>
                <form class = "col s12" action = "add.php" method = "POST">
                    <div class = "row">
                        <div class = "input-field col s6 offset-s3">
                            <select name = "character">
                                <!--This place can be made for effficient in the future -->
                                <option value = 0 disabled selected>Choose your adventurer! </option>
                                <?php
                                    // Get all character names
                                    $sql = "SELECT characterName FROM characters";

                                    // Get query results
                                    $tempResult = mysqli_query($conn, $sql);

                                    // Get result in array format
                                    $characters = mysqli_fetch_all($tempResult, MYSQLI_ASSOC);

                                    // Free result from memory
                                    mysqli_free_result($tempResult);

                                    $x = 0;
                                ?>

                                <!-- For statement to display characters -->
                                <?php foreach($characters as $character) {?>
                                    <?php $x++ ?>
                                    <option value = <?php echo $x ?> <?php if(isset($_POST['character']) && $_POST['character'] == $x) echo ' selected="selected"'; ?>><?php echo $character['characterName']?></option>
                                <?php } ?>

                            </select>
                            <label> Character used: </label>
                            <div class = "red-text"><?php echo $errors['character']; ?> </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class="input-field col s6 offset-s3">
                            <input placeholder = "$$$ obtained" name = "money" type = "text" value = "<?php echo $money ?>">
                            <label>Total money: </label>
                            <div class = "red-text"><?php echo $errors['money']; ?> </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class="input-field col s6 offset-s3">
                            <input placeholder = "Time (HH:MM:SS)" name = "time" type = "text" value = "<?php echo $time ?>">
                            <label>Elapsed time: </label>
                            <div class = "red-text"><?php echo $errors['time']; ?> </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "input-field col s6 offset-s3">
                            <!-- This can and will be remade later -->
                            <select name = "place">
                                <option value = "" disabled selected>How far did you go? </option>

                                <?php
                                    // Get all stage names
                                    $sql = "SELECT placeName FROM places";

                                    // Get query results
                                    $tempResult = mysqli_query($conn, $sql);

                                    // Get result in array format
                                    $places = mysqli_fetch_all($tempResult, MYSQLI_ASSOC);

                                    // Free result from memory
                                    mysqli_free_result($tempResult);

                                    $x = 0;
                                ?>

                                <!-- For statement to display places -->
                                <?php foreach($places as $place) {?>
                                    <?php $x++ ?>
                                    <option value = <?php echo $x ?> <?php if(isset($_POST['place']) && $_POST['place'] == $x) echo ' selected="selected"'; ?>><?php echo $place['placeName']?></option>
                                <?php } ?>

                            </select>
                            <label> Furthest Area: </label>
                            <div class = "red-text"><?php echo $errors['place']; ?> </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "input-field col s3 offset-s3">
                            <label>
                              <!--Remembers if checkbox was checked before or not -->
                              <input type="checkbox" class="filled-in" id = "vod-check" name = "vodCheck"
                                     <?php echo empty($_POST['vodCheck']) ? '' : ' checked="checked" '; ?>/>
                              <span>VOD available?</span>
                            </label>
                        </div>
                        <div class = "input-field col s3">
                            <!-- Enables/disables text box depending on checkbox -->
                            <input placeholder="Paste URL here" id="vod" name = "vod" type="text" value = "<?php echo $vod ?>"
                            <?php if (empty($_POST['vodCheck'])) echo ' disabled="disabled"'; ?> >
                            <label>If VOD available, please paste.</label>
                            <div class = "red-text"><?php echo $errors['vod']; ?> </div>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "input-field col s6 offset-s3">
                            <textarea name ="comment" class="materialize-textarea" placeholder ="Any noteworthy details go here"><?php echo $comment ?></textarea>
                            <label>Extra notes:</label>
                        </div>
                    </div>
                    <div class = "row">
                        <div class = "center">
                            <div class = "input-field">
                                <button class="btn waves-effect waves-light" type="submit" value = TRUE name="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <h1 class = "black-text center"> Please login to submit a run! :) </h1>
            <?php endif; ?>
        </section>

        <script type = "text/javascript">
            $('#vod-check').change(function(){
                if ($('#vod-check').is(':checked') == true){
                  $('#vod').prop('disabled', false);
               } else {
                 $('#vod').prop('disabled', true);
               }
            });
        </script>
    </main>
    <?php include('footer.php'); ?>

</html>
