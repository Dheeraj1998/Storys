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
    <title>Forgot Password</title>
</head>

<?php

$incorrect_class = "correct";
$username_class = "username";
$password_class = "password-hidden";
$display_password_label = "none";

$password = "";
$username = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
//    $password = hash('md4', $_POST['password']);

    $servername = "mysql2.gear.host";
    $db_username = "storys";
    $db_password = "Bf0Y~t?2zfRp";
    $db_name = "Storys";

    //Create connection
    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);

    $sql = "SELECT * FROM UserAccounts WHERE Username = '" . $username . "';";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        $incorrect_class = "incorrect";
        $username_class = "username-incorrect";
    } else {
        $row = $result->fetch_assoc();
        $password = $row['Password'];
        $password_class = "password";
        $display_password_label = "table-cell";

        $password = substr($password, 0, 8);
        $sql = "UPDATE UserAccounts SET Password = '" . hash('md4', $password) . "' WHERE Username = '" . $username . "';";
        mysqli_query($conn, $sql);

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
                <td colspan="2" class="<?php echo $incorrect_class; ?>">Incorrect Username !!!</td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input class="<?php echo $username_class; ?>" type="text" name="username" placeholder="Username"
                           value="<?php echo $username; ?>"></td>
            </tr>
            <tr>
                <td style="display: <?php echo $display_password_label; ?>;">Password</td>
                <td><input class="<?php echo $password_class; ?>" type="text" name="password" placeholder="Password"
                           value="<?php echo $password; ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><input class="login" type="submit" name="submit" value="Get Password"></td>
            </tr>
    </form>
</div>

</body>

<?php
if ($password != '') {
    echo "<script>alert('Your password has been reset to \'" . $password . "\'');</script>";
}
?>


</html>
