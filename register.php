<html>
<head>
    <link rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <link href="register_styles.css" rel="stylesheet" type="text/css">
    <!--    <link href="paperkit2/assets/css/bootstrap.min.css" rel="stylesheet"/>-->
    <link href="assets_folder/assets/css/main.css" rel="stylesheet">
    <link href="assets_folder/assets/css/demo.css" rel="stylesheet">
    <!--     Fonts and icons     -->
    <link href="assets_folder/assets/img/apple-icon.png" rel="apple-touch-icon" sizes="76x76">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets_folder/assets/img/favicon.ico" rel="icon" type="image/png">
    <link href="assets_folder/assets/css/nucleo-icons.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.6.1/firebase.js"></script>
    <script>
      // Initialize Firebase
      var config = {
        apiKey: "AIzaSyC5jz22XXOsoMhBQC5m8Is3ocn7rctWn5s",
        authDomain: "storys-analytics.firebaseapp.com",
        databaseURL: "https://storys-analytics.firebaseio.com",
        projectId: "storys-analytics",
        storageBucket: "storys-analytics.appspot.com",
        messagingSenderId: "497967477864"
      };
      firebase.initializeApp(config);

      var database = firebase.database();
    </script>
    <title>Register</title>
</head>

<body>

<div class="outer-container">
    <nav>

        <h5>Be a part of <span>Story</span></h5>

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
                <td><input class="username" type="text" name="username" placeholder="Username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input class="password" type="password" name="password" placeholder="Password"></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input class="name" type="text" name="name" placeholder="Name"></td>
            </tr>
            <tr>
                <td>Location</td>
                <td><input class="name" type="text" name="location" placeholder="Location"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input class="email" type="email" name="email" placeholder="Email"></td>
            </tr>
            <tr>
                <td colspan="2"><input class="register" type="submit" name="submit" value="Register"></td>
            </tr>
            <tr>
                <td colspan="2"><a class="login" href="login.php">Already a Member? Sign in here.</a></td>
            </tr>
        </table>
    </form>
</div>

</body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = hash('md4', $_POST['password']);
    $name = $_POST['name'];
    $location = $_POST['location'];
    $email = $_POST['email'];

    $user_credentials = file_get_contents("credentials.txt");
    $user_credentials = explode('|', $user_credentials);

    $servername = $user_credentials[0];
    $db_username = $user_credentials[1];
    $db_password = $user_credentials[2];
    $db_name = "Storys";
    $firebase_database = "user_location";

    //Create connection
    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
    $sql = "INSERT INTO UserAccounts (Username, Password, Name, Email) VALUES ('" . $username . "', '" . $password . "', '" . $name . "', '" . $email . "');";

    if ($conn->query($sql) === TRUE) {
      echo "<script>
              var rootRef = database.ref();
              var storeRef = rootRef.child('user_details');
              var databaseRef = storeRef.push();

              databaseRef.set({
                '" . $username . "': '" . $location . "'
              });

              alert('The registration has been done!');
            </script>";
        die();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

</html>
