<html>
<head>
    <link rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <link href="login_styles.css" rel="stylesheet" type="text/css">
    <link href="assets_folder/assets/css/main.css" rel="stylesheet">

    <!--     Fonts and icons     -->
    <link href="assets_folder/assets/img/apple-icon.png" rel="apple-touch-icon" sizes=
    "76x76">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700'
          rel='stylesheet' type='text/css'>
    <link href=
          "http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"
          rel="stylesheet">
    <link href="assets_folder/assets/img/favicon.ico" rel="icon" type="image/png">
    <link href="assets_folder/assets/css/nucleo-icons.css" rel="stylesheet">
    <script src=
            "https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js">
    </script>
    <title>Login</title>
</head>

<?php

$incorrect_class = "correct";
$username_class = "username";
$password_class = "password";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = hash('md4', $_POST['password']);

    $user_credentials = file_get_contents("credentials.txt");
    $user_credentials = explode('|', $user_credentials);

    $servername = $user_credentials[0];
    $db_username = $user_credentials[1];
    $db_password = $user_credentials[2];
    $db_name = "Storys";

    //Create connection
    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);

    $sql = "SELECT * FROM UserAccounts WHERE Username = '" . $username . "' AND Password = '" . $password . "';";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        $incorrect_class = "incorrect";
        $username_class = "username-incorrect";
        $password_class = "password-incorrect";
    } else {
        $cookie_value = $username;
        setcookie('username', $cookie_value, time() + 10000, "/");

        header("Location: dashboard.php");
        die();
    }
}
?>

<body>

<div class="outer-container">

    <nav>

        <h5>Start <span>Story</span> - ing</h5>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-placement="bottom" href=
                "https://twitter.com/shantanu0323" rel="tooltip" target="_blank" title=
                   "Follow us on Twitter"><i class="fa fa-twitter"></i></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-placement="bottom" href=
                "https://www.facebook.com/shantanu.pramanik1" rel="tooltip" target="_blank"
                   title="Like us on Facebook"><i class="fa fa-facebook-square"></i></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-placement="bottom" href=
                "https://www.instagram.com/shantanu0323" rel="tooltip" target="_blank"
                   title="Follow us on Instagram"><i class="fa fa-instagram"></i></a>
            </li>
        </ul>
    </nav>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <table class="inner-container">
            <tr>
                <td colspan="2" class="<?php echo $incorrect_class;?>">Incorrect Username and/or Password !!!</td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input class="<?php echo $username_class;?>" type="text" name="username" placeholder="Username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input class="<?php echo $password_class;?>" type="password" name="password" placeholder="Password"></td>
            </tr>
            <tr>
                <td colspan="2"><input class="login" type="submit" name="submit" value="Login"></td>
            </tr>
            <tr>
                <td colspan="2"><a class="forgot" href="forgot.php">Forgot your password?</a></td>
            </tr>
            <tr>
                <td colspan="2"><a class="register" href="register.php">Not yet a part of <span>Storys</span>? Sign Up
                        here.</a></td>
            </tr>
    </form>
</div>

</body>



</html>
