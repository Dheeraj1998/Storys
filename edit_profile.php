<html>
<head>
    <link rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <link href="register_styles.css" rel="stylesheet" type="text/css">
    <link href="assets_folder/assets/css/main.css" rel="stylesheet">
    <link href="assets_folder/assets/css/demo.css" rel="stylesheet">
    <!--     Fonts and icons     -->
    <link href="assets_folder/assets/img/apple-icon.png" rel="apple-touch-icon" sizes="76x76">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets_folder/assets/img/favicon.ico" rel="icon" type="image/png">
    <link href="assets_folder/assets/css/nucleo-icons.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <title>Edit Profile Details</title>
</head>

<body>

<?php
$servername = "mysql2.gear.host";
$db_username = "storys";
$db_password = "Bf0Y~t?2zfRp";
$db_name = "Storys";
$firebase_database = "user_location";

//Create connection
$conn = new mysqli("$servername", $db_username, $db_password, $db_name);
$username = $_COOKIE['username'];

if ($username == null) {
    header("Location: login.php");
}

$sql = "SELECT * FROM UserAccounts WHERE Username = '" . $username . "'";
$results = mysqli_query($conn, $sql);
$row = $results->fetch_assoc();
$name = $row['Name'];
$email = $row['Email'];
?>
<div class="outer-container">
    <nav>

        <a href='dashboard.php'><h5><span>Story</span></h5></a>

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
                <td>Username</td>
                <td><input class="username" type="text" name="username" placeholder="Username" disabled
                           value="<?php echo $username; ?>"></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input class="name" type="text" name="name" placeholder="Name" value="<?php echo $name; ?>">
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input class="email" type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2"><input class="update" type="submit" name="submit" value="Update Details"></td>
            </tr>
            <tr>
                <td colspan="2"><a class="login" href="change_password.php">Change Password</a></td>
            </tr>
        </table>
    </form>
</div>

</body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE UserAccounts SET Name = '" . $name . "', Email = '" . $email . "' " . "WHERE Username = '" . $username . "';";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) <= 0) {
      echo "<script>alert('The details have been changed successfully!');</script>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

</html>
