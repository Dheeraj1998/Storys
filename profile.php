<?php
  $username = basename($_SERVER["REQUEST_URI"], ".php");

  $servername = "localhost";
  $db_username = "root";
  $db_password = "Dheeraj@1998";
  $db_name = "Storys";

  $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
  $sql = "SELECT * FROM UserAccounts WHERE Username = '" . $username . "';";

  $result = mysqli_query($conn, $sql);
  $row = $result->fetch_assoc();

  $name = $row['Name'];
  $email = $row['Email'];
?>

<html>
<head>
    <title>Create your story</title>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="profile_styles.css"/>
    <link href="paperkit2/assets/css/paper-kit.css" rel="stylesheet">
<!--    <link href="paperkit2/assets/css/demo.css" rel="stylesheet">-->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700'
          rel='stylesheet' type='text/css'>
    <link href=
          "http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"
          rel="stylesheet">
    <link href="paperkit2/assets/img/favicon.ico" rel="icon" type="image/png">
    <link href="paperkit2/assets/css/nucleo-icons.css" rel="stylesheet">
    <script src=
            "https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js">
    </script>

</head>

<body>

<nav>
    <h5>Create Your <span>Story</span></h5>

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
<br>

<div class="main-container">

    <div class="left-container">
        <div class="author-container">
            <img src="paperkit2/assets/img/faces/shantanu.jpg"> <br>
            <h4><?php echo $name; ?></h4>
            <h5><?php echo $email; ?></h5> <br>
            <div class="follow-container">
                <div>Follows</div>
                <div>Following</div>
            </div>
        </div>

        <div class="hashtags-container">

        </div>
    </div>

    <div class="middle-container">

    </div>

    <div class="right-container">

    </div>
</div>

</body>

</html>

<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $tagline = $_POST['tagline'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $post_date = date("Y-m-d");
    $post_time = date("h:i:s");

    $username = $_COOKIE['username'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "Dheeraj@1998";
    $db_name = "Storys";

    //Create connection
    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);

    $sql = "INSERT INTO PostDetails (Username, Title, Tagline, Content, Category, Date, Time) VALUES ('" . $username . "', '" . $title . "', '" . $tagline . "', '" . $content . "', '" . $category . "', '" . $post_date . "', '" . $post_time . "');";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
?>
