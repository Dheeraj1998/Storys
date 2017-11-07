<?php
  if($_POST['func_type'] == 'followUser'){
    $leader_name = $_POST['leader_name'];
    $follower_name = $_POST['follower_name'];

    $user_credentials = file_get_contents("credentials.txt");
    $user_credentials = explode('|', $user_credentials);

    $servername = $user_credentials[0];
    $db_username = $user_credentials[1];
    $db_password = $user_credentials[2];
    $db_name = "Storys";

    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
    $sql = "INSERT INTO FollowingDetails(Leader, Follower) VALUES ('" . $leader_name . "', '" . $follower_name . "')";

    if ($conn->query($sql) === TRUE) {
      echo "sucess";
    }

    else{
      echo "error";
    }
  }

if($_POST['func_type'] == 'unfollowUser'){
    $leader_name = $_POST['leader_name'];
    $follower_name = $_POST['follower_name'];

    $user_credentials = file_get_contents("credentials.txt");
    $user_credentials = explode('|', $user_credentials);

    $servername = $user_credentials[0];
    $db_username = $user_credentials[1];
    $db_password = $user_credentials[2];
    $db_name = "Storys";

    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
    $sql = "DELETE FROM FollowingDetails WHERE Leader = '" . $leader_name . "' AND Follower = '" . $follower_name . "'";

    if ($conn->query($sql) === TRUE) {
      echo "sucess";
    }

    else{
      echo "error";
    }
  }

  if($_POST['func_type'] == 'deletePost'){
    $post_id = $_POST['post_id'];

    $user_credentials = file_get_contents("credentials.txt");
    $user_credentials = explode('|', $user_credentials);

    $servername = $user_credentials[0];
    $db_username = $user_credentials[1];
    $db_password = $user_credentials[2];
    $db_name = "Storys";

    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
    $sql = "DELETE FROM PostDetails WHERE ID = " . $post_id;

    if ($conn->query($sql) === TRUE) {
      echo "sucess";
    }

    else{
      echo $conn->error;
    }
  }
?>
