<!DOCTYPE HTML>
<html>
<head>
  <title>Analysis</title>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://www.gstatic.com/firebasejs/4.6.1/firebase.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxv4bVHpxdauO3Huermqgoy86jPun8BUQ&callback=initMap" type="text/javascript"></script>
  <script>
    // Initialize Firebase
    var config = {
      apiKey: "AIzaSyC5jz22XXOsoMhBQC5m8Is3ocn7rctWn5s",
      authDomain: "storys-analytics.firebaseapp.com",
      databaseURL: "https://storys-analytics.firebaseio.com",
      projectId: "storys-analytics",
      storageBucket: "storys-analytics.appspot.com",
      messagingSenderId: "497967477864"
    };

    firebase.initializeApp(config);
    var database = firebase.database();
    var locationRef = firebase.database().ref('user_location');
  </script>
</head>

<body onload="initMap()" >
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

<script type="text/javascript">
  var geocoder;
  var map;

  function initMap() {
    geocoder = new google.maps.Geocoder();
    var myOptions = {
      zoom: 2,
      center: new google.maps.LatLng(0, 0),
      mapTypeControl: true,
      mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
      navigationControl: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    locationRef.on('value', function(snapshot){
      snapshot.forEach(function(child){
        var address = child.val();

        geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {

              var infowindow = new google.maps.InfoWindow({
                  content: '<b>' + child.key + '</b> - ' + address,
                  size: new google.maps.Size(150,50)
              });

              var marker = new google.maps.Marker({
                  position: results[0].geometry.location,
                  map: map,
                  title:address
              });
              google.maps.event.addListener(marker, 'click', function() {
                  infowindow.open(map,marker);
              });

            } else {
              alert("No results found");
            }
          } else {
            alert("Geocode was not successful for the following reason: " + status);
          }
        });
      });
    });
  }
</script>

<div id="map_canvas" style="width:700px; height:500px">

</body>
</html>
