<?php
  if($_POST['func_type'] == 'likePost'){
    $post_id = $_POST['post_id'];

    $servername = "mysql2.gear.host";
    $db_username = "storys";
    $db_password = "Bf0Y~t?2zfRp";
    $db_name = "Storys";

    $username = $_COOKIE['username'];

    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
    $sql = "INSERT INTO LikeDetails(ID, Username) VALUES (" . $post_id . ", '" . $username . "')";

    if ($conn->query($sql) === TRUE) {
      echo "<span class='unlike'>Unlike</span>||";

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

    $servername = "mysql2.gear.host";
    $db_username = "storys";
    $db_password = "Bf0Y~t?2zfRp";
    $db_name = "Storys";

    $username = $_COOKIE['username'];

    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
    $sql = "DELETE FROM LikeDetails WHERE ID = " . $post_id . " AND Username = '" . $username . "'";

    if ($conn->query($sql) === TRUE) {
      echo "<span class='like'>Like</span>||";

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

    $servername = "mysql2.gear.host";
    $db_username = "storys";
    $db_password = "Bf0Y~t?2zfRp";
    $db_name = "Storys";

    $username = $_COOKIE['username'];

    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);

    if($comment_content != 'null'){
      $sql = "INSERT INTO CommentDetails(ID, Username, Content) VALUES (" . $post_id . ", '" . $username . "', '" . $comment_content . "')";

      if ($conn->query($sql) === TRUE) {
        $sql = "SELECT * FROM CommentDetails WHERE ID = '" . $post_id . "';";
        $comment_list = mysqli_query($conn, $sql);

        if ($comment_list->num_rows > 0) {
          while($counter_row = $comment_list->fetch_assoc()) {
            echo "<a href = 'profile.php?username=" . $counter_row["Username"] . "' class='username-container'> " . $counter_row["Username"] . "</a>";
            echo "<span> says </span>";
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
  }
?>
