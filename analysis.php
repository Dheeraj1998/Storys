<!DOCTYPE HTML>
<html>
<head>
  <title>Analysis</title>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>

</head>

<body>
  <?php
  $servername = "localhost";
  $db_username = "root";
  $db_password = file_get_contents('password.txt');
  $db_name = "Storys";

  //Create connection
  $conn = new mysqli("$servername", $db_username, $db_password, $db_name);

  $sql = "SELECT * FROM PostDetails;";
  $result = mysqli_query($conn, $sql);

  $num_total = $result->num_rows;

  $sql = "SELECT * FROM PostDetails WHERE Category = 'tech';";
  $result = mysqli_query($conn, $sql);

  $num_tech = $result->num_rows/$num_total * 100;

  $sql = "SELECT * FROM PostDetails WHERE Category = 'photography';";
  $result = mysqli_query($conn, $sql);

  $num_photo = $result->num_rows/$num_total * 100;

  $sql = "SELECT * FROM PostDetails WHERE Category = 'literature';";
  $result = mysqli_query($conn, $sql);

  $num_lit = $result->num_rows/$num_total * 100;

  $sql = "SELECT * FROM PostDetails WHERE Category = 'music';";
  $result = mysqli_query($conn, $sql);

  $num_music = $result->num_rows/$num_total * 100;

  $sql = "SELECT * FROM PostDetails WHERE Category = 'lifestyle';";
  $result = mysqli_query($conn, $sql);

  $num_life = $result->num_rows/$num_total * 100;
  ?>

  <div id="container" style="min-width: 600px; height: 600px; max-width: 600px; margin: 0 auto"></div>

  <script>
  // Build the chart
Highcharts.chart('container', {
  chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
  },
  title: {
      text: 'Category Wise Popularity'
  },
  tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
      pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
              enabled: false
          },
          showInLegend: true
      }
  },
  series: [{
      name: 'Categories',
      colorByPoint: true,
      data: [{
          name: '#Technology',
          y: <?php echo $num_tech ?>
      }, {
          name: '#Lifestyle',
          y: <?php echo $num_life ?>,
          sliced: true,
          selected: true
      }, {
          name: '#Music',
          y: <?php echo $num_music ?>
      }, {
          name: '#Literature',
          y: <?php echo $num_lit ?>
      }, {
          name: '#Photography',
          y: <?php echo $num_photo ?>
      }]
  }]
});
  </script>

</body>
</html>
