<!DOCTYPE html>

<?php
	$username = $_COOKIE['username'];

	if($username == null) {
		header("Location: login.php");
	}

?>

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

	<title>Dashboard</title>
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

		$sql = "SELECT * FROM PostDetails;";
		$result = mysqli_query($conn, $sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<div class = 'post-container'>
								<div class = 'title-container'>" . $row["Title"] . "</div>
		            <div class = 'tagline-container'>" . $row["Tagline"]. "</div>
								<div class = 'date-container'>" .$row["Date"]. "</div>
								<div class = 'time-container'>" .$row["Time"]. "</div>
		            <div class = 'content-container'>" . $row["Content"]. "</div>
		            <div class = 'category-container'>" .$row["Category"]. "</div>
								<div class = 'username-container'><a href = 'profile.php?username=" . $row["Username"] . "'>" .$row["Username"]. "</a></div>
								<div class = 'like-container'>
									<div class = 'like-button' id = 'like-button-id" . $row["ID"] . "' onclick = 'likePost(" . $row["ID"] . ")'>";
											$sql = "SELECT * FROM LikeDetails WHERE Username = '" . $username . "'";
											$user_like_result = mysqli_query($conn, $sql);
											$found = false;

											if ($user_like_result->num_rows > 0) {
												while($like_row = $user_like_result->fetch_assoc()) {
													if ($row["ID"] == $like_row["ID"]){
														$found = true;
														echo "Unlike";
														break;
													}
												}
											}

											else {
												$found = true;
												echo "Like";
											}

											if($found == false){
												echo "Like";
											}

						echo "</div>
									<div class = 'like-counter' id = 'like-counter-id" . $row["ID"] . "'>";
										$sql = "SELECT * FROM LikeDetails WHERE ID = '" . $row["ID"] . "'";
										$like_counter_result = mysqli_query($conn, $sql);

										if ($like_counter_result->num_rows > 0) {
											while($counter_row = $like_counter_result->fetch_assoc()) {
												echo $counter_row["Username"];
												echo " ";
											}

											echo " likes this.";
										}

										else {
											// No message displayed
										}

						echo "</div>
									<div class = 'comment-button' onclick = 'commentPost(" . $row["ID"] . ")'>Comment now!</div>
									<div class = 'comment-counter' id = 'comment-counter-id" . $row["ID"] . "'>";
										$sql = "SELECT * FROM CommentDetails WHERE ID = '" . $row["ID"] . "';";
								    $comment_list = mysqli_query($conn, $sql);

								    if ($comment_list->num_rows > 0) {
											while($counter_row = $comment_list->fetch_assoc()) {
												echo $counter_row["Username"];
												echo " - ";
												echo $counter_row["Content"];
												echo "<br>";
											}
										}

										else {
								        // No message displayed
										}

						echo "</div>
								</div>
							</div>";
			}
		}
		else {
				echo "0 results";
		}

?>
	</div>
</body>
</html>
