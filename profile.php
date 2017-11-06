<?php
$servername = "mysql2.gear.host";
$db_username = "storys";
$db_password = "Bf0Y~t?2zfRp";
$db_name = "Storys";
$username = $_GET['username'];

$conn = new mysqli("$servername", $db_username, $db_password, $db_name);
$sql = "SELECT * FROM UserAccounts WHERE Username = '" . $username . "';";

$result = mysqli_query($conn, $sql);

if ($result->num_rows == 0) {
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
    <link href="assets_folder/assets/css/main.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?fa  mily=Montserrat:400,300,700'
          rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"
          rel="stylesheet">
    <script src="profile.js"></script>
    <script src="dashboard.js"></script>
    <script>
        function logoutUser() {
            var user_status = confirm('Are you sure you want to logout?');

            if (user_status == true) {
                document.cookie = 'username=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                window.location = 'login.php';
            }
        }

        function sharePost(element_id){
            text = 'https://storys.herokuapp.com/view_story.php?post_id=' + element_id;
            var textArea = document.createElement("textarea");

            // Place in top-left corner of screen regardless of scroll position.
            textArea.style.position = 'fixed';
            textArea.style.top = 0;
            textArea.style.left = 0;

            // Ensure it has a small width and height. Setting to 1px / 1em
            // doesn't work as this gives a negative w/h on some browsers.
            textArea.style.width = '2em';
            textArea.style.height = '2em';

            // We don't need padding, reducing the size if it does flash render.
            textArea.style.padding = 0;

            // Clean up any borders.
            textArea.style.border = 'none';
            textArea.style.outline = 'none';
            textArea.style.boxShadow = 'none';

            // Avoid flash of white box if rendered for any reason.
            textArea.style.background = 'transparent';
            textArea.value = text;

            document.body.appendChild(textArea);
            textArea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Copying text command was ' + msg);
            } catch (err) {
                console.log('Oops, unable to copy');
            }

            document.body.removeChild(textArea);
            alert('The link has been copied to your clipboard!');
        }

    </script>

</head>

<body>
<nav>
    <h5><a href = 'dashboard.php'><span>Story</span></a><?php echo $name; ?></h5>
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
            <img src="assets_folder/assets/img/faces/shantanu.jpg"> <br>
            <h4><?php echo $name; ?></h4>
            <h4><?php echo $email; ?></h4>
            <br> <br>
            <div class="follow-container">
                <!--                <div>Follows</div>-->
                <!--                    <div>Following</div>-->

                <?php
                if ($profile_username != $username) {
                    $follow_check_sql = "SELECT * FROM FollowingDetails WHERE Leader = '" . $profile_username . "' AND Follower = '" . $username . "';";
                    $follow_result = mysqli_query($conn, $follow_check_sql);

                    if ($follow_result->num_rows == 0) {
                        echo "<div id = 'follow-button' class='follow' onclick = 'followUser(\"" . $profile_username . "\",\"" . $username . "\")'>FOLLOW</div>";
                    } else {
                        echo "<div id = 'follow-button' class='following' onclick = 'followUser(\"" . $profile_username . "\",\"" . $username . "\")'>FOLLOWING</div>";
                    }
                }
                ?>
            </div>
        </div>
        <div class="hashtags-container">
        </div>
    </div>
    <div class="middle-container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            //Create connection
            $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
            $sql = "SELECT * FROM PostDetails WHERE Username = '" . $profile_username . "';";
            $result = mysqli_query($conn, $sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $url = "assets_folder/assets/img/scenery" . mt_rand(1, 15) . ".jpg";

                    echo "
          <div class = 'post-container'>
          <table class='user-details'>
              <tr>
                  <td rowspan='2' width='10%' class='profile-pic-container'>
                      <img src='assets_folder/assets/img/faces/shantanu.jpg'>
                  </td>
                  <td colspan='2' class='name-container'> $name | <a href = 'profile.php?username=" . $row["Username"] . "' class='username-container'> " . $row["Username"] . "</a></td>
                  <td rowspan='2' width='10%' class='settings-container'>
                      <img src='assets_folder/assets/img/icons/settings.png'>
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
                  <td colspan='2' class='content-container' style=" . "\"background-image: url('" . $url . "');\">"
                        . nl2br($row["Content"]) . "</td>
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
                  <td width='33.33%' class='share-btn-container' onclick = 'sharePost(" . $row["ID"] . ")'>Share</td>
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
            } else {
                echo "0 results";
            }
        }
        ?>

    </div>
    <div class="right-container">
    </div>
</div>
</body>
</html>
