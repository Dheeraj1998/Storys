<!DOCTYPE html>

<?php
$username = $_COOKIE['username'];
$name = "";
if ($username == null) {
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
    <link href="paperkit2/assets/img/apple-icon.png" rel="apple-touch-icon" sizes="76x76">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="paperkit2/assets/img/favicon.ico" rel="icon" type="image/png">
    <link href="paperkit2/assets/css/nucleo-icons.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script src="dashboard.js"></script>

    <script>
      function logoutUser(){
        var user_status = confirm('Are you sure you want to logout?');

        if (user_status == true) {
          document.cookie = 'username=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
          window.location = 'login.php';
        }
      }
    </script>

    <title>Dashboard</title>
</head>

<body>
<?php
$servername = "localhost";
$db_username = "root";
$db_password = "Dheeraj@1998";
$db_name = "Storys";

//Create connection
$conn = new mysqli("$servername", $db_username, $db_password, $db_name);

$sql = "SELECT * FROM UserAccounts WHERE username = '" . $username . "';";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $name = $row["Name"];
    }
}
?>

<div class="outer-container">
    <nav>

        <h5><span>Story</span><?php echo $name; ?></h5>

        <h4 class="logout" onclick="logoutUser()">Logout</h4>
    </nav>

    <section>

        <?php
        $sql = "SELECT * FROM PostDetails;";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sql = "SELECT * FROM UserAccounts WHERE username = '" . $row["Username"] . "';";
                $curr_result = mysqli_query($conn, $sql);

                if ($curr_result->num_rows > 0) {
                    if ($curr_row = $curr_result->fetch_assoc()) {
                        $name = $curr_row["Name"];
                    }
                }


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
        } else {
            echo "0 results";
        }

        ?>
    </section>
</div>
</body>
</html>
