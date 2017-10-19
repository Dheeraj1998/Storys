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
      echo "Unlike||";

      $sql = "SELECT * FROM LikeDetails WHERE ID = '" . $post_id . "'";
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

    }
  }

  elseif($_POST['func_type'] == 'unlikePost'){
    $post_id = $_POST['post_id'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "Dheeraj@1998";
    $db_name = "Storys";

    $username = $_COOKIE['username'];

    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
    $sql = "DELETE FROM LikeDetails WHERE ID = " . $post_id . " AND Username = '" . $username . "'";

    if ($conn->query($sql) === TRUE) {
      echo "Like||";

      $sql = "SELECT * FROM LikeDetails WHERE ID = '" . $post_id . "'";
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

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  elseif($_POST['func_type'] == 'commentPost'){
    $post_id = $_POST['post_id'];
    $comment_content = $_POST['comment_content'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "Dheeraj@1998";
    $db_name = "Storys";

    $username = $_COOKIE['username'];

    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
    $sql = "INSERT INTO CommentDetails(ID, Username, Content) VALUES (" . $post_id . ", '" . $username . "', '" . $comment_content . "')";

    if ($conn->query($sql) === TRUE) {
      $sql = "SELECT * FROM CommentDetails WHERE ID = '" . $post_id . "';";
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

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

 ?>
