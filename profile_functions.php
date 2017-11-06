<?php
  if($_POST['func_type'] == 'followUser'){
    $leader_name = $_POST['leader_name'];
    $follower_name = $_POST['follower_name'];

    $servername = "mysql2.gear.host";
    $db_username = "storys";
    $db_password = "Bf0Y~t?2zfRp";
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

    $servername = "mysql2.gear.host";
    $db_username = "storys";
    $db_password = "Bf0Y~t?2zfRp";
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
