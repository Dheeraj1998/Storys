<?php
  $servername = "localhost";
  $db_username = "root";
  $db_password = "Dheeraj@1998";
  $db_name = "Storys";

  $search_text = $_POST['search_text'];
  $sql = "SELECT * FROM PostDetails WHERE Username LIKE '%" . $search_text . "%' OR
                                          Title LIKE '%" . $search_text . "%' OR
                                          Tagline LIKE '%" . $search_text . "%' OR
                                          Content LIKE '%" . $search_text . "%';";

  $conn = new mysqli("$servername", $db_username, $db_password, $db_name);
  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<div class = 'post-container'>
              <div class = 'title-container'>" . $row["Title"] . "</div>
              <div class = 'tagline-container'>" . $row["Tagline"]. "</div>
              <div class = 'date-container'>" .$row["Date"]. "</div>
              <div class = 'time-container'>" .$row["Time"]. "</div>
              <div class = 'content-container'>" . $row["Content"]. "</div>
              <div class = 'category-container'>" .$row["Category"]. "</div>
              <div class = 'username-container'>" .$row["Username"]. "</div>
            </div>";
    }
  }

  else{
    echo "0 results";
  }

?>
