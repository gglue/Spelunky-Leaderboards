<?php
    // Start the session if it has not been started yet
    if(!isset($_SESSION)){
        session_start();
    }
    else{
        if (isset($_SESSION['saveduser'])){
            $saveduser = $_SESSION['saveduser'];
        }
    }
?>
<head>
    <title> Spelunky Leaderboards </title>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Mini icons used -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type = "text/javascript">
        $(document).ready(function(){
          $('select').formSelect();
        });
    </script>

   <style type = "text/css">
        .brand{
            background: #00a86b !important;
        }
        .brandLight{
            background: #79CDAE !important;
        }
   </style>
</head>

    <body class = "grey lighten-4">
        <nav class = "brand z-depth-0">
            <div class = "container">
                <a href = "index.php" class = "brand-logo left"> Spelunky Leaderboards </a>
                <?php if (isset($saveduser)): ?>
                    <ul id="nav-mobile" class="right">
                        <li> Welcome back <?php echo $saveduser ?>! &nbsp&nbsp&nbsp&nbsp</li>
                        <li><a href = "logout.php">Logout</a></li>
                        <li><a href = "stats.php">Your Stats</a></li>
                        <li><a href = "stats.php">Find Users</a></li>
                        <li><a href = "add.php">Add Run</a></li>
                    </ul>
                <?php else: ?>
                    <ul id="nav-mobile" class="right">
                        <li> Not logged in! &nbsp&nbsp&nbsp&nbsp</li>
                        <li><a href = "login.php">Login</a></li>
                        <li><a href = "stats.php">Find Users</a></li>
                    </ul>
                <?php endif; ?>
            </div>
        </nav>
