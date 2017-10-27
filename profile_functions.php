<?php
  if($_POST['func_type'] == 'followUser'){
    $leader_name = $_POST['leader_name'];
    $follower_name = $_POST['follower_name'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "Dheeraj@1998";
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

    $servername = "localhost";
    $db_username = "root";
    $db_password = "Dheeraj@1998";
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
?>
