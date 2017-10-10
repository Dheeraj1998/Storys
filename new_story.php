<html>
<head>
    <title>Create your story</title>

    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="new_story_styles.css"/>
    <link href="paperkit2/assets/css/paper-kit.css" rel="stylesheet">
<!--    <link href="paperkit2/assets/css/demo.css" rel="stylesheet">-->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700'
          rel='stylesheet' type='text/css'>
    <link href=
          "http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"
          rel="stylesheet">
    <link href="paperkit2/assets/img/favicon.ico" rel="icon" type="image/png">
    <link href="paperkit2/assets/css/nucleo-icons.css" rel="stylesheet">
    <script src=
            "https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js">
    </script>

</head>

<body>

<nav>

    <h5>Create Your <span>Story</span></h5>

    <ul class="navbar-nav ml-auto">
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
            <img src="paperkit2/assets/img/faces/shantanu.jpg"> <br>
            <h4>Shantanu Pramanik</h4>
            <div class="follow-container">
                <div>Follows</div>
                <div>Following</div>
            </div>
        </div>

        <div class="hashtags-container">

        </div>
    </div>

    <div class="middle-container">

    </div>

    <div class="right-container">

    </div>
</div>

<div class="story-container">
  <form class="inner-container" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

    <input type="text" name="title" placeholder="Title"> <br>
    <input type="text" name="tagline" placeholder="Tagline"> <br>
    <textarea name="content" placeholder="Enter content here."></textarea> <br>

    Select a category: <select name="category">
      <option value="lifestyle">Lifestyle</option>
      <option value="tech">Technology</option>
      <option value="literature">Literature</option>
      <option value="photography">Photography</option>
      <option value="music">Music</option>
    </select> <br>

    <input type="submit" name="submit" value="Upload it!"> <br>
  </form>
</div>

</body>

</html>

<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $tagline = $_POST['tagline'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "Dheeraj@1998";
    $db_name = "Storys";

    //Create connection
    $conn = new mysqli("$servername", $db_username, $db_password, $db_name);

    $sql = "INSERT INTO PostDetails (Title, Tagline, Content, Category) VALUES ('" . $title . "', '" . $tagline . "', '" . $content . "', '" . $category . "');";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
?>
