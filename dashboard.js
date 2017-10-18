function likePost(element_id) {
    var xmlhttp = new XMLHttpRequest();
    var url = "dashboard_functions.php";

    var like_div = document.getElementById('like-button-id' + element_id);
    var button_type = like_div.innerHTML;

    if(button_type == 'Like'){
      var params = "func_type=likePost&post_id=" + element_id;
    }

    else{
      var params = "func_type=unlikePost&post_id=" + element_id;
    }

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        alert(xmlhttp.responseText);
        location.reload();
      }
    };

    xmlhttp.send(params);
}
