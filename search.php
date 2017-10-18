<!DOCTYPE html>

<html>
<head>
	<link rel="stylesheet" type="text/css">
	<meta charset="utf-8">
	<link href="dashboard_styles.css" rel="stylesheet" type="text/css">
	<link href="paperkit2/assets/css/paper-kit.css" rel="stylesheet">
	<link href="paperkit2/assets/css/demo.css" rel="stylesheet">

	<!--     Fonts and icons     -->
	<link href="paperkit2/assets/img/apple-icon.png" rel="apple-touch-icon" sizes = "76x76">
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type = 'text/css'>
	<link href = "http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href = "paperkit2/assets/img/favicon.ico" rel = "icon" type = "image/png">
	<link href = "paperkit2/assets/css/nucleo-icons.css" rel = "stylesheet">
	<script src = "https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
	<script src = "dashboard.js"></script>

	<title>Search</title>
</head>

<body>
	<div class="outer-container">
    <?php
    $servername = "localhost";
    $db_username = "root";
    $db_password = "Dheeraj@1998";
    $db_name = "Storys";

    //Create connection
    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
		if($_SERVER["REQUEST_METHOD"] == 'POST') {
			echo $_POST['post_id'];
		}

		else {
	    $sql = "SELECT * FROM PostDetails;";

	    $result = mysqli_query($conn, $sql);

	    if ($result->num_rows > 0) {
	      while($row = $result->fetch_assoc()) {
	          echo "<div class = 'post-container'>
	                  <div class = 'title-container'>" . $row["Title"] . "</div>
	                  <div class = 'tagline-container'>" . $row["Tagline"]. "</div>
	                  <div class = 'content-container'>" . $row["Content"]. "</div>
	                  <div class = 'category-container'>" .$row["Category"]. "</div>
										<div class = 'like-container'>
											<div class = 'like-button' onclick = 'likePost(" . $row["ID"] . ")'>
												Like
												" . $row['Likes'] . "
											</div>
										</div>
	                </div>";
	      }
	    } else {
	      echo "0 results";
	    }
		}

     ?>
	</div>
</body>
</html>
