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

        // Redirect to home page if we found no errors
        if (!array_filter($errors)){

            // Change VOD url to embeded
            $vod = str_replace("watch?v=", "embed/", $vod);

            // Save the input into variables
            $character = mysqli_real_escape_string($conn, $character);
            $time = mysqli_real_escape_string($conn, $time);
            $place = mysqli_real_escape_string($conn, $place);
            $vod = mysqli_real_escape_string($conn, $vod);
            $comment = mysqli_real_escape_string($conn, $comment);
            $money = mysqli_real_escape_string($conn, $money);

            // Create SQL
            $sql = "INSERT INTO run(characterID, time, placeID, url, comment, accountID, money) VALUES('$character', '$time', '$place', '$vod', '$comment', 1, '$money')";

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
    <section class = "container grey-text">
        <h4 class = "center">Add your Run!</h4>
        <form class = "col s12" action = "add.php" method = "POST">
            <div class = "row">
                <div class = "input-field col s6 offset-s3">
                    <select name = "character">
                        <!--This place can be made for effficient in the future -->
                        <option value = 0 disabled selected>Choose your adventurer! </option>
                        <option value = 1 <?php if(isset($_POST['character']) && $_POST['character'] == 1) echo ' selected="selected"'; ?>>Ana Speleunky</option>
                        <option value = 2 <?php if(isset($_POST['character']) && $_POST['character'] == 2) echo ' selected="selected"'; ?>>Margaret Tunnel</option>
                        <option value = 3 <?php if(isset($_POST['character']) && $_POST['character'] == 3) echo ' selected="selected"'; ?>>Colin Northward</option>
                        <option value = 4 <?php if(isset($_POST['character']) && $_POST['character'] == 4) echo ' selected="selected"'; ?>>Roffy D. Sloth</option>
                        <option value = 5 <?php if(isset($_POST['character']) && $_POST['character'] == 5) echo ' selected="selected"'; ?>>Alto Singh</option>
                        <option value = 6 <?php if(isset($_POST['character']) && $_POST['character'] == 6) echo ' selected="selected"'; ?>>Liz Mutton</option>
                        <option value = 7 <?php if(isset($_POST['character']) && $_POST['character'] == 7) echo ' selected="selected"'; ?>>Nekka the Eagle</option>
                        <option value = 8 <?php if(isset($_POST['character']) && $_POST['character'] == 8) echo ' selected="selected"'; ?>>LISE Project</option>
                        <option value = 9 <?php if(isset($_POST['character']) && $_POST['character'] == 9) echo ' selected="selected"'; ?>>Coco von Diamonds</option>
                        <option value = 10 <?php if(isset($_POST['character']) && $_POST['character'] == 10) echo ' selected="selected"'; ?>>Manfred Tunnel</option>
                        <option value = 11 <?php if(isset($_POST['character']) && $_POST['character'] == 11) echo ' selected="selected"'; ?>>Little Jay</option>
                        <option value = 12 <?php if(isset($_POST['character']) && $_POST['character'] == 12) echo ' selected="selected"'; ?>>Tina Flan</option>
                        <option value = 13 <?php if(isset($_POST['character']) && $_POST['character'] == 13) echo ' selected="selected"'; ?>>Valerie Crump</option>
                        <option value = 14 <?php if(isset($_POST['character']) && $_POST['character'] == 14) echo ' selected="selected"'; ?>>Au</option>
                        <option value = 15 <?php if(isset($_POST['character']) && $_POST['character'] == 15) echo ' selected="selected"'; ?>>Demi von Diamonds</option>
                        <option value = 16 <?php if(isset($_POST['character']) && $_POST['character'] == 16) echo ' selected="selected"'; ?>>Pilot</option>
                        <option value = 17 <?php if(isset($_POST['character']) && $_POST['character'] == 17) echo ' selected="selected"'; ?>>Princess Airyn</option>
                        <option value = 18 <?php if(isset($_POST['character']) && $_POST['character'] == 18) echo ' selected="selected"'; ?>>Dirk Yamoaka</option>
                        <option value = 19 <?php if(isset($_POST['character']) && $_POST['character'] == 19) echo ' selected="selected"'; ?>>Guy Spelunky</option>
                        <option value = 20 <?php if(isset($_POST['character']) && $_POST['character'] == 20) echo ' selected="selected"'; ?>>Classic Guy</option>
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
                        <optgroup label = "The Dwellings">
                            <option value = 1 <?php if(isset($_POST['place']) && $_POST['place'] == 1) echo ' selected="selected"'; ?>>1-1</option>
                            <option value = 2 <?php if(isset($_POST['place']) && $_POST['place'] == 2) echo ' selected="selected"'; ?>>1-2</option>
                            <option value = 3 <?php if(isset($_POST['place']) && $_POST['place'] == 3) echo ' selected="selected"'; ?>>1-3</option>
                            <option value = 4 <?php if(isset($_POST['place']) && $_POST['place'] == 4) echo ' selected="selected"'; ?>>1-4</option>
                        </optgroup>
                        <optgroup label = "The Jungle">
                            <option value = 5 <?php if(isset($_POST['place']) && $_POST['place'] == 5) echo ' selected="selected"'; ?>>2-1</option>
                            <option value = 6 <?php if(isset($_POST['place']) && $_POST['place'] == 6) echo ' selected="selected"'; ?>>2-2</option>
                            <option value = 7 <?php if(isset($_POST['place']) && $_POST['place'] == 7) echo ' selected="selected"'; ?>>2-3</option>
                            <option value = 8 <?php if(isset($_POST['place']) && $_POST['place'] == 8) echo ' selected="selected"'; ?>>2-4</option>
                        </optgroup>
                        <optgroup label = "The Volcana">
                            <option value = 9 <?php if(isset($_POST['place']) && $_POST['place'] == 9) echo ' selected="selected"'; ?>>2-1</option>
                            <option value = 10 <?php if(isset($_POST['place']) && $_POST['place'] == 10) echo ' selected="selected"'; ?>>2-2</option>
                            <option value = 11 <?php if(isset($_POST['place']) && $_POST['place'] == 11) echo ' selected="selected"'; ?>>2-3</option>
                            <option value = 12 <?php if(isset($_POST['place']) && $_POST['place'] == 12) echo ' selected="selected"'; ?>>2-4</option>
                        </optgroup>
                        <option value = 13 <?php if(isset($_POST['place']) && $_POST['place'] == 13) echo ' selected="selected"'; ?>>3-1 (Olmec's Lair)</option>
                        <optgroup label = "The Tide Pool">
                            <option value = 14 <?php if(isset($_POST['place']) && $_POST['place'] == 14) echo ' selected="selected"'; ?>>4-1</option>
                            <option value = 15 <?php if(isset($_POST['place']) && $_POST['place'] == 15) echo ' selected="selected"'; ?>>4-2</option>
                            <option value = 16 <?php if(isset($_POST['place']) && $_POST['place'] == 16) echo ' selected="selected"'; ?>>4-3</option>
                            <option value = 17 <?php if(isset($_POST['place']) && $_POST['place'] == 17) echo ' selected="selected"'; ?>>4-4</option>
                            <option value = 18 <?php if(isset($_POST['place']) && $_POST['place'] == 18) echo ' selected="selected"'; ?>>4-4 (Kingu Boss Fight)</option>
                        </optgroup>
                        <optgroup label = "The Temple of Anubis">
                            <option value = 19 <?php if(isset($_POST['place']) && $_POST['place'] == 19) echo ' selected="selected"'; ?>>4-1</option>
                            <option value = 20 <?php if(isset($_POST['place']) && $_POST['place'] == 20) echo ' selected="selected"'; ?>>4-2</option>
                            <option value = 21 <?php if(isset($_POST['place']) && $_POST['place'] == 21) echo ' selected="selected"'; ?>>4-3</option>
                            <option value = 22 <?php if(isset($_POST['place']) && $_POST['place'] == 22) echo ' selected="selected"'; ?>>4-3 (City of Gold)</option>
                            <option value = 23 <?php if(isset($_POST['place']) && $_POST['place'] == 23) echo ' selected="selected"'; ?>>4-4</option>
                            <option value = 24 <?php if(isset($_POST['place']) && $_POST['place'] == 24) echo ' selected="selected"'; ?>>4-4 (Anubis II Boss Fight)</option>
                        </optgroup>
                        <option value = 25 <?php if(isset($_POST['place']) && $_POST['place'] == 25) echo ' selected="selected"'; ?>>5-1 (Ice Caves)</option>
                        <optgroup label = "The Neo Babylon">
                            <option value = 26 <?php if(isset($_POST['place']) && $_POST['place'] == 26) echo ' selected="selected"'; ?>>6-1</option>
                            <option value = 27 <?php if(isset($_POST['place']) && $_POST['place'] == 27) echo ' selected="selected"'; ?>>6-2</option>
                            <option value = 28 <?php if(isset($_POST['place']) && $_POST['place'] == 28) echo ' selected="selected"'; ?>>6-3</option>
                            <option value = 29 <?php if(isset($_POST['place']) && $_POST['place'] == 29) echo ' selected="selected"'; ?>>6-4 (Tiamat Boss Fight)</option>
                        </optgroup>
                        <optgroup label = "The Sunken City">
                            <option value = 30 <?php if(isset($_POST['place']) && $_POST['place'] == 30) echo ' selected="selected"'; ?>>7-1</option>
                            <option value = 31 <?php if(isset($_POST['place']) && $_POST['place'] == 31) echo ' selected="selected"'; ?>>7-2</option>
                            <option value = 32 <?php if(isset($_POST['place']) && $_POST['place'] == 32) echo ' selected="selected"'; ?>>7-2 (Eggplant World)</option>
                            <option value = 33 <?php if(isset($_POST['place']) && $_POST['place'] == 33) echo ' selected="selected"'; ?>>7-3</option>
                            <option value = 34 <?php if(isset($_POST['place']) && $_POST['place'] == 34) echo ' selected="selected"'; ?>>7-4 (Hundun Boss Fight)</option>
                        </optgroup>
                        <option value = 35 <?php if(isset($_POST['place']) && $_POST['place'] == 35) echo ' selected="selected"'; ?>>Cosmic Ocean</option>

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
    <?php include('footer.php'); ?>

</html>
