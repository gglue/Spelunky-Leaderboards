<?php

    // Connect to database
    include("config/db_connect.php");
    $username = $password = '';
    $errors = array('username' => '', 'password' => '');
    if(isset($_POST['login'])){

        // Check if there is a username is typed
        if (empty($_POST['username'])){
            $errors['username'] = 'Please type your username! <br>';
        }
        else {
            $username = htmlspecialchars($_POST['username']);
        }
        // Check if there is a password is typed
        if (empty($_POST['password'])){
            $errors['password'] = 'Please type your password! <br>';
        }
        else {
            $password = htmlspecialchars($_POST['password']);
        }

        // Check if username and password matches database information
        if (!array_filter($errors)){

            // Save the input into sqli compatible variables
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);

            // Write query for SQL
            $sql = "SELECT * FROM accounts WHERE username = \"" . $username . "\"";

            // Get query results
            $result = mysqli_query($conn, $sql);

            // Get result in array format
            $account = mysqli_fetch_assoc($result);

            // Free result from memory
            mysqli_free_result($result);
            // If account doesn't exist let them know
            if (!isset($account)){
                $errors['username'] = 'User does not exist! <br>';
            }

            // If password wrong let them know
            else{
                if (!password_verify($password, $account['password'])){
                    $errors['password'] = 'Wrong password! <br>';
                }

                // If everything goes right, redirect home
                else{
                    $_SESSION['saveduser'] = $username;
                    $_SESSION['savedID'] = $account['accountID'];
                    header('Location: index.php');
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>
    <main style = "background : url('images/backgrounds/background.jpg'); background-size : cover">
        <section class = "container grey-text">
            <h3 class = "center">Login!</h3>
            <form class = "col s12" action = "login.php" method = "POST">
                <div class = "row">
                    <div class = "input-field col s4 offset-s4">
                        <input placeholder = "&nbsp" name = "username" type = "text" value = <?php echo $username ?>>
                        <label>Username: </label>
                        <div class = "red-text"><?php echo $errors['username']; ?> </div>
                    </div>
                </div>
                <div class = "row">
                    <div class = "input-field col s4 offset-s4">
                        <input placeholder = "&nbsp" name = "password" type = "password">
                        <label>Password: </label>
                        <div class = "red-text"><?php echo $errors['password']; ?> </div>
                        <a href = "signup.php"> <p class = "center"> No account? Sign up now! </p> </a>
                    </div>
                </div>
                <div class = "row">
                    <div class = "center">
                        <div class = "input-field">
                            <button class="btn waves-effect waves-light" type="submit" value = TRUE name="login">Login</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
    <?php include('footer.php'); ?>

</section>
</html>
