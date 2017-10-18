<?php
  if($_POST['func_type'] == 'likePost'){
    $post_id = $_POST['post_id'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "Dheeraj@1998";
    $db_name = "Storys";

    $username = $_COOKIE['username'];

    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
    $sql = "INSERT INTO LikeDetails(ID, Username) VALUES (" . $post_id . ", '" . $username . "')";

    if ($conn->query($sql) === TRUE) {
      echo "The like has been recorded.";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  if($_POST['func_type'] == 'unlikePost'){
    $post_id = $_POST['post_id'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "Dheeraj@1998";
    $db_name = "Storys";

    $username = $_COOKIE['username'];

    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
    $sql = "DELETE FROM LikeDetails WHERE ID = " . $post_id . " AND Username = '" . $username . "'";

    if ($conn->query($sql) === TRUE) {
      echo "The post has been unliked.";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  elseif($_POST['func_type'] == 'commentPost'){

  }

 ?>
