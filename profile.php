<?php
   $servername = "localhost";
   $db_username = "root";
   $db_password = "Dheeraj@1998";
   $db_name = "Storys";
   $username = $_GET['username'];

   $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
   $sql = "SELECT * FROM UserAccounts WHERE Username = '" . $username . "';";

   $result = mysqli_query($conn, $sql);

   if($result->num_rows == 0){
     header("Location: error.php");
   }

   $row = $result->fetch_assoc();
   $name = $row['Name'];
   $email = $row['Email'];

   $profile_username = $_GET['username'];
   $username = $_COOKIE['username'];
?>

<html>
   <head>
      <title>Create your story</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="dashboard_styles.css"/>
      <link rel="stylesheet" type="text/css" href="profile_styles.css"/>
      <!-- <link href="paperkit2/assets/css/paper-kit.css" rel="stylesheet"> -->
      <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700'
         rel='stylesheet' type='text/css'>
      <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"
         rel="stylesheet">
      <script src = "profile.js"></script>
      <script src = "dashboard.js"></script>
   </head>

   <body>
      <nav>
         <a href = 'dashboard.php'><h5><span>Story</span></h5></a>
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-placement="bottom" href=
                  "https://twitter.com/shantanu0323" rel="tooltip" target="_blank" title=
                  "Follow us on Twitter"><i class="fa fa-twitter"></i></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-placement="bottom" href=
                  "https://www.facebook.com/shantanu.pramanik1" rel="tooltip" target="_blank"
                  title="Like us on Facebook"><i class="fa fa-facebook-square"></i></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-placement="bottom" href=
                  "https://www.instagram.com/shantanu0323" rel="tooltip" target="_blank"
                  title="Follow us on Instagram"><i class="fa fa-instagram"></i></a>
            </li>
         </ul>
      </nav>
      <br>
      <div class="main-container">
         <div class="left-container">
            <div class="author-container">
               <img src="paperkit2/assets/img/faces/shantanu.jpg" > <br>
               <h4><?php echo $name; ?></h4>
               <h5><?php echo $email; ?></h5>
               <br> <br>
               <div class="follow-container">
                  <div>Follows</div>
                  <div>Following</div>
               </div>
               <?php
                  if($profile_username != $username){
                    $follow_check_sql = "SELECT * FROM FollowingDetails WHERE Leader = '" . $profile_username . "' AND Follower = '" . $username . "';";
                    $follow_result = mysqli_query($conn, $follow_check_sql);

                    if($follow_result->num_rows == 0){
                      echo "<div id = 'follow-button' onclick = 'followUser(\"" . $profile_username . "\",\"" . $username . "\")'>FOLLOW</div>";
                    }

                    else{
                      echo "<div id = 'follow-button' onclick = 'followUser(\"" . $profile_username . "\",\"" . $username . "\")'>FOLLOWING</div>";
                    }
                  }
               ?>
            </div>
            <div class="hashtags-container">
            </div>
         </div>
         <div class="middle-container">
         </div>
         <div class="right-container">
         </div>
      </div>
   </body>
</html>

<?php
   if($_SERVER['REQUEST_METHOD'] == 'GET'){
     //Create connection
     $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
     $sql = "SELECT * FROM PostDetails WHERE Username = '" . $profile_username . "';";
     $result = mysqli_query($conn, $sql);

     if ($result->num_rows > 0) {
   	while($row = $result->fetch_assoc()) {
      echo "
          <div class = 'post-container'>
          <table class='user-details'>
              <tr>
                  <td rowspan='2' width='10%' class='profile-pic-container'>
                      <img src='paperkit2/assets/img/faces/shantanu.jpg'>
                  </td>
                  <td colspan='2' class='name-container'> $name | <a href = 'profile.php?username=" . $row["Username"] . "' class='username-container'> " . $row["Username"] . "</a></td>
                  <td rowspan='2' width='10%' class='settings-container'>
                      <img src='paperkit2/assets/img/icons/settings.png'>
                  </td>
              </tr>
              <tr>
                  <td width='13%' class='time-container'>" . $row["Time"] . " | </td>
                  <td width='*' class='date-container'>" . $row["Date"] . "</td>
              </tr>

          </tableclass>
          <table>
              <tr>
                  <td width='*' class='title-container'>" . $row["Title"] . "</td>
                  <td rowspan='2' width='15%' class='category-container'>" . $row["Category"] . "</td>
              </tr>
              <tr>
                  <td class='tagline-container'> --> " . $row["Tagline"] . "</td>
              </tr>
              <tr>
                  <td colspan='2' class='content-container'>" . nl2br($row["Content"]) . "</td>
              </tr>
          </table>
          <table>
              <tr>
                  <td width='33.33%' class='like-btn-container'>
                      <div class = 'like-button' id = 'like-button-id" . $row["ID"] . "' onclick = 'likePost(" . $row["ID"] . ")'>";

      $sql = "SELECT * FROM LikeDetails WHERE Username = '" . $username . "'";
      $user_like_result = mysqli_query($conn, $sql);
      $found = false;

      if ($user_like_result->num_rows > 0) {
          while ($like_row = $user_like_result->fetch_assoc()) {
              if ($row["ID"] == $like_row["ID"]) {
                  $found = true;
                  echo "<span class='unlike'>Unlike</span>";
                  break;
              }
          }
      } else {
          $found = true;
          echo "<span class='like'>Like</span>";
      }

      if ($found == false) {
          echo "<span class='like'>Like</span>";
      }




      echo "            </div>
                  </td>
                  <td width='33.33%' class='share-btn-container'>Share</td>
                  <td width='33.33%' class='comment-btn-container'><div class = 'comment-button' onclick = 'commentPost(" . $row["ID"] . ")'>Comment</div></td>
              </tr>
              <tr>
                  <td colspan='3' class='likes-container'>
                      <div class = 'like-counter' id = 'like-counter-id" . $row["ID"] . "'>";

      $sql = "SELECT * FROM LikeDetails WHERE ID = '" . $row["ID"] . "'";
      $like_counter_result = mysqli_query($conn, $sql);

      if ($like_counter_result->num_rows > 0) {
          while ($counter_row = $like_counter_result->fetch_assoc()) {
              echo $counter_row["Username"];
              echo " ";
          }

          echo " likes this.";
      } else {
          // No message displayed
      }

      echo "                </div>
                   </td>
              </tr>
              <tr>
                  <td colspan='3' class='comments-container'>
                      <div class = 'comment-counter' id = 'comment-counter-id" . $row["ID"] . "'>";

      $sql = "SELECT * FROM CommentDetails WHERE ID = '" . $row["ID"] . "';";
      $comment_list = mysqli_query($conn, $sql);

      if ($comment_list->num_rows > 0) {
          while ($counter_row = $comment_list->fetch_assoc()) {
              echo "<a href = 'profile.php?username=" . $counter_row["Username"] . "' class='username-container'> " . $counter_row["Username"] . "</a>";
              echo "<span> says </span>";
              echo $counter_row["Content"];
              echo "<br>";
          }
      } else {
          // No message displayed
      }

      echo "          </div>
                  </td>
              </tr>
          </table>
          </div>
      ";
    }
  }
  else {
      echo "0 results";
  }
   }
   ?>
