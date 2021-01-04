<?php

    // Connect to database
    include("config/db_connect.php");

    $username = $password = $confirmPassword = '';
    $errors = array('username' => '', 'password' => '', 'confirmPassword' => '');
    if(isset($_POST['signup'])){

        // Check if there is a username is typed and satisifies requirements
        if (empty($_POST['username'])){
            $errors['username'] = 'Please type your username! <br>';
        }
        else {
            if(!preg_match('/^(?=[a-zA-Z0-9.]{8,20}$)(?!.*[.]{2})[^.].*[^.]$/', $_POST['username'])){
                $errors['username'] = 'Please satisfy the requirements for the username! <br>';
            }
            else{
                $username = htmlspecialchars($_POST['username']);
            }
        }

        // Check if there is a username is typed and satisifies requirements
        if (empty($_POST['password'])){
            $errors['password'] = 'Please type your password! <br>';
        }
        else {
            if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/', $_POST['password'])) {
                $errors['password'] = 'Please satisfy the requirements for the password! <br>';
            }
        }

        // Check if there is the confirmed password is typed and is equal to password
        if (empty($_POST['confirmPassword'])){
            $errors['confirmPassword'] = 'Please confirm your password! <br>';
        }
        else{
            // Use the POST values because it should be right even if first password doesn't satisify requirements
            if (!($_POST['confirmPassword'] == $_POST['password'])){
                $errors['confirmPassword'] = 'Does not match to the password! <br>';
            }
            else{
                //Honestly should use htmlspecialchars(), but regex covered it lol
                $password = $_POST['password'];
            }
        }

        // Add user into the database with encrypted password
        if (!array_filter($errors)){

            // Save the input into sqli compatible variables
            $username = mysqli_real_escape_string($conn, $username);
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Write query for SQL
            $sql = "INSERT INTO accounts(username, password) VALUES ('$username', '$password')";

            // Check if action is successful
            if (mysqli_query($conn, $sql)){
                // success, then go back to login
                header('Location: login.php');
            }
            else {
                // fail, probably due to bad input
                $errors['username'] = 'User already exists!';
            }
        }

    }
?>

<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>
    <main style = "background : url('images/backgrounds/background.jpg'); background-size : cover">
        <section class = "container grey-text">
            <h3 class = "center"> Sign up! </h3>
            <form class = "col s12" action = "signup.php" method = "POST">
                <div class = "row">
                    <div class = "input-field col s4 offset-s4">
                        <input placeholder = "8-20 characters, no special letters!" name = "username" type = "text" value = <?php echo $username ?>>
                        <label>Username: </label>
                        <div class = "red-text"><?php echo $errors['username']; ?> </div>
                    </div>
                </div>
                <div class = "row">
                    <div class = "input-field col s4 offset-s4">
                        <input placeholder = "8-20 characters, 1 letter, 1 capital, no special letters!" name = "password" type = "password">
                        <label>Password: </label>
                        <div class = "red-text"><?php echo $errors['password']; ?> </div>
                    </div>
                </div>
                <div class = "row">
                    <div class = "input-field col s4 offset-s4">
                        <input placeholder = "Re-type the same password" name = "confirmPassword" type = "password">
                        <label>Confirm password: </label>
                        <div class = "red-text"><?php echo $errors['confirmPassword']; ?> </div>
                    </div>
                </div>
                <div class = "row">
                    <div class = "center">
                        <div class = "input-field">
                            <button class="btn waves-effect waves-light" type="submit" value = TRUE name="signup">Sign up</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
    <?php include('footer.php'); ?>
</html>
