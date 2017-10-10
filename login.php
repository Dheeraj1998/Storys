<html>
<head>
	<link rel="stylesheet" type="text/css">
	<meta charset="utf-8">
	<link href="login_styles.css" rel="stylesheet" type="text/css">
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
  <title>Login</title>
</head>

<body>

  <div class="outer-container">
    <form class="inner-container" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

      <input class="username" type="text" name="username" placeholder="Username"> <br>
      <input class="password" type="password" name="password" placeholder="Password"> <br>

      <input class="login" type="submit" name="submit" value="Login"> <br>
      <a class="register" href="register.php">Not a Member? Sign Up here.</a>

    </form>
  </div>

</body>

  <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username = $_POST['username'];
      $password = hash('md4',$_POST['password']);

      $servername = "localhost";
      $db_username = "root";
      $db_password = "Dheeraj@1998";
      $db_name = "Storys";

      //Create connection
      $conn = new mysqli("$servername", $db_username, $db_password, $db_name);

      $sql = "SELECT * FROM UserAccounts WHERE Username = '" . $username . "' AND Password = '" . $password . "';";

      $result = mysqli_query($conn ,$sql);

      if(mysqli_num_rows($result) == 0){
        echo "Fail";
      }

      else{
        header("Location: dashboard.php");
        die();
      }
    }

  ?>

</html>
