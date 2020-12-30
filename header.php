<head>
    <title> Spelunky Leaderboards </title>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

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
                <ul id="nav-mobile" class="right">
                    <li><a href = "login.php">Login</a></li>
                    <li><a href = "stats.php">Your Stats</a></li>
                    <li><a href = "add.php">Add Run</a></li>
                </ul>
            </div>
        </nav>
