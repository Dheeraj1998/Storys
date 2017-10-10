<html>
<head>
	<link rel="stylesheet" type="text/css">
	<meta charset="utf-8">
	<link href="register_styles.css" rel="stylesheet" type="text/css">
	<!--    <link href="paperkit2/assets/css/bootstrap.min.css" rel="stylesheet"/>-->
	<link href="paperkit2/assets/css/paper-kit.css" rel="stylesheet">
	<link href="paperkit2/assets/css/demo.css" rel="stylesheet">
	<!--     Fonts and icons     -->
	<link href="paperkit2/assets/img/apple-icon.png" rel="apple-touch-icon" sizes=
	"76x76">
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
  <title>Register</title>
</head>

<body>

  <div class="outer-container">
    <form class="inner-container" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

      <input type="text" name="username" placeholder="Username"> <br>
      <input type="password" name="password" placeholder="Password"> <br>
      <input type="text" name="name" placeholder="Name"> <br>

      <input type="submit" name="submit" value="Register"> <br>
      <a href="login.php">Already a Member? Sign in here.</a>

    </form>
  </div>

</body>

  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username = $_POST['username'];
      $password = hash('md4',$_POST['password']);
      $name = $_POST['name'];

      $servername = "localhost";
      $db_username = "root";
      $db_password = "Dheeraj@1998";
      $db_name = "Storys";

      //Create connection
      $conn = new mysqli("$servername", $db_username, $db_password, $db_name);

      $sql = "INSERT INTO UserAccounts (Username, Password, Name) VALUES ('" . $username . "', '" . $password . "', '" . $name . "');";

      if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        echo "New record created successfully";
        die();
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

  ?>

</html>
