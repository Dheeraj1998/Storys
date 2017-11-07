<!DOCTYPE HTML>
<html>
<head>
  <title>Analysis</title>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/series-label.js"></script>
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
    var locationRef = firebase.database().ref('user_details');
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
        snapshot.forEach(function(inner_snapshot){
          inner_snapshot.forEach(function(child){
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
          });
        }
    </script>
</head>

<body onload="initMap()" >
  <?php
    $servername = "mysql2.gear.host";
    $db_username = "storys";
    $db_password = "Bf0Y~t?2zfRp";
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

    $sql = "SELECT DISTINCT Username FROM PostDetails";
    $result_users = mysqli_query($conn, $sql);

    $post_timeline = array();

    while($user_row = $result_users->fetch_assoc()){
      $sql = "SELECT Time FROM PostDetails WHERE Username = '" . $user_row['Username'] . "' ORDER BY Time";
      $user_post_result = mysqli_query($conn, $sql);
      $post_timeline[$user_row['Username']] = array();

      while($post_row = $user_post_result->fetch_assoc()){
        array_push($post_timeline[$user_row['Username']], substr($post_row['Time'], 0, 2));
      }
    }
  ?>

  <div id="category_plot" style="min-width: 600px; height: 600px; max-width: 600px; margin: 0 auto"></div>
  <div id="timeline_plot" style="min-width: 600px; height: 400px; max-width: 600px; margin: 0 auto"></div>

  <script>
    // Build the chart
    Highcharts.chart('category_plot', {
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie',
          backgroundColor:'rgba(255, 255, 255, 0.0)'
      },
      title: {
          text: 'Category Wise Popularity',
          style: {
            color: '#ECF0F1'
          }
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

  <script>
  Highcharts.chart('timeline_plot', {
    chart: {
        backgroundColor:'rgba(255, 255, 255, 0.0)'
    },

    title: {
        text: 'User Activity'
    },

    subtitle: {
        text: 'Timeline'
    },

		xAxis: {
        title: {
            text: 'Number of posts'
        }
    },

    yAxis: {
        title: {
            text: 'Hours'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 1
        }
    },

    series: [
      <?php
        $res_string = "";
        foreach($post_timeline as $key => $value) {
          $res_string = $res_string . "{
            name: '" . $key . "'," .
            "data: [";
              foreach($value as $item) {
                $res_string = $res_string . $item . ", ";
              }

              $res_string = $res_string . "]".
            "}, ";
        }

        echo $res_string;
      ?>
    ],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>

<div id="map_canvas" style="width:700px; height:500px">

</body>
</html>
