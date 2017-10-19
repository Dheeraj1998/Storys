function startSearch(){
  var xmlhttp = new XMLHttpRequest();
  var url = "search_functions.php";

  var search_text = document.getElementById('search-text').value;
  var search_result = document.getElementById('search-result');
  var params = "search_text=" + search_text;

  if(search_text == ''){
    search_result.innerHTML = '';

  }

  else{
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        search_result.innerHTML = xmlhttp.responseText;
      }
    };

    xmlhttp.send(params);
  }
}
