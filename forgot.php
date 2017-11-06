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

    $servername = "mysql2.gear.host";
    $db_username = "storys";
    $db_password = "Bf0Y~t?2zfRp";
    $db_name = "Storys";

    //Create connection
    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
    $sql = "SELECT * FROM UserAccounts WHERE Username = '" . $username . "';";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo "<script>
                alert('No such username found!');
              </script>";
    } else {
        $row = $result->fetch_assoc();
        $password = substr(uniqid(rand(), true), 0, 10);

        $sql = "UPDATE UserAccounts SET Password = '" . hash('md4', $password) . "' WHERE Username = '" . $username . "';";
        $result = mysqli_query($conn, $sql);

        require 'PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Port = 465;
        $mail->Username = 'help.storys@gmail.com';                 // SMTP username
        $mail->Password = 'lVjopiaLRF5uaHG';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted

        $mail->From = 'help.storys@gmail.com';
        $mail->FromName = 'Customer Support - Storys';
        $mail->addAddress($row['Email'], $row['Name']);     // Add a recipient
        $mail->addReplyTo('help.storys@gmail.com', 'Customer Support - Storys');

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Forgot your password';
        $mail->Body    = "Hey <b>" . $row['Name'] . "</b>,
                            <br><br>There was a recent request at Storys that you had forgotten your password.
                            <br>The password for your account has been reset to <b>" . $password . "</b>.
                            <br>Have a great day ahead!
                            <br><br>Storys";

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo '<script>alert("An email with the password has been sent to the associated email account!");</script>';
        }
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
                <td>Username</td>
                <td><input class="<?php echo $username_class; ?>" type="text" name="username" value="<?php echo $username; ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><input class="login" type="submit" name="submit" value="Reset Password"></td>
            </tr>
    </form>
</div>

</body>
</html>
