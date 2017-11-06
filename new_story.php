<html>
<head>
    <title>Create your story</title>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="new_story_styles.css"/>
    <!-- <link href="paperkit2/assets/css/paper-kit.css" rel="stylesheet"> -->
    <!--    <link href="paperkit2/assets/css/demo.css" rel="stylesheet">-->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700'
          rel='stylesheet' type='text/css'>
    <link href=
          "http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"
          rel="stylesheet">
    <link href="assets_folder/assets/img/favicon.ico" rel="icon" type="image/png">
    <link href="assets_folder/assets/css/nucleo-icons.css" rel="stylesheet">
    <script src=
            "https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js">
    </script>

</head>

<body>
<nav>
    <a href='dashboard.php'><h5><span>Story</span></h5></a>
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

<div class="story-container">
    <form class="inner-container" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <input class="title-container" type="text" name="title" placeholder="Title"> <br>
        <input class="tagline-container" type="text" name="tagline" placeholder="Tagline"> <br>
        <textarea name="content" placeholder="Enter content here."></textarea> <br>

        Category : <select name="category">
            <option value="lifestyle">Lifestyle</option>
            <option value="tech">Technology</option>
            <option value="literature">Literature</option>
            <option value="photography">Photography</option>
            <option value="music">Music</option>
        </select> <br>

        <input class="bLogin" type="submit" name="submit" value="Upload it!"> <br>
    </form>
</div>

</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $tagline = $_POST['tagline'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $post_date = date("Y-m-d");
    $post_time = date("h:i:s");

    $title = str_replace("'", "''", $title);
    $tagline = str_replace("'", "''", $tagline);
    $content = str_replace("'", "''", $content);

    $username = $_COOKIE['username'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = file_get_contents('password.txt');
    $db_name = "Storys";

    //Create connection
    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);

    $sql = "INSERT INTO PostDetails (Username, Title, Tagline, Content, Category, Date, Time) VALUES ('" . $username . "', '" . $title . "', '" . $tagline . "', '" . $content . "', '" . $category . "', '" . $post_date . "', '" . $post_time . "');";

    if ($conn->query($sql) === TRUE) {
//        echo "New record created successfully";
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
