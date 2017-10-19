function likePost(element_id) {
    var xmlhttp = new XMLHttpRequest();
    var url = "dashboard_functions.php";

    var like_div = document.getElementById('like-button-id' + element_id);
    var like_counter_div = document.getElementById('like-counter-id' + element_id);

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
        var function_response = xmlhttp.responseText.split("||");

        like_div.innerHTML = function_response[0];
        like_counter_div.innerHTML = function_response[1];
      }
    };

    xmlhttp.send(params);
}

function commentPost(element_id) {
    var xmlhttp = new XMLHttpRequest();
    var url = "dashboard_functions.php";

    var comment_counter = document.getElementById('comment-counter-id' + element_id);

    var comment_content = prompt('enter your comment');
    var params = "func_type=commentPost&post_id=" + element_id + "&comment_content=" + comment_content;

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var function_response = xmlhttp.responseText;
        comment_counter.innerHTML = function_response;
      }
    };

    xmlhttp.send(params);
}
