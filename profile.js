function followUser(leader_name, follower_name) {
  var xmlhttp = new XMLHttpRequest();
  var url = "profile_functions.php";

  var follow_div = document.getElementById('follow-button');

  if(follow_div.innerHTML == 'FOLLOW'){
    var params = "func_type=followUser&leader_name=" + leader_name + "&follower_name=" + follower_name;

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(xmlhttp.responseText == 'sucess'){
          follow_div.innerHTML = "FOLLOWING";
        }
      }
    }
    xmlhttp.send(params);
  }

  else {
    if(confirm('Are you sure you want to unfollow ' + leader_name + ' ?')){
      var params = "func_type=unfollowUser&leader_name=" + leader_name + "&follower_name=" + follower_name;

      xmlhttp.open("POST", url, true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if(xmlhttp.responseText == 'sucess'){
            follow_div.innerHTML = "FOLLOW";
          }
        }
      }
      xmlhttp.send(params);
    }
  }
}
