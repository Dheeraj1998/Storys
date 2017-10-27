<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css">
		<meta charset="utf-8">
		<link href="search_styles.css" rel="stylesheet" type="text/css">
		<link href="dashboard_styles.css" rel="stylesheet" type="text/css">
		<link href="assets_folder/assets/css/paper-kit.css" rel="stylesheet">
		<link href="assets_folder/assets/css/demo.css" rel="stylesheet">

		<!--     Fonts and icons     -->
		<link href="assets_folder/assets/img/apple-icon.png" rel="apple-touch-icon" sizes = "76x76">
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type = 'text/css'>
		<link href = "http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
		<link href = "assets_folder/assets/img/favicon.ico" rel = "icon" type = "image/png">
		<link href = "assets_folder/assets/css/nucleo-icons.css" rel = "stylesheet">
		<script src = "https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
		<script src = "search.js"></script>
		<script src= "dashboard.js"></script>
        <script>
            function logoutUser() {
                var user_status = confirm('Are you sure you want to logout?');

                if (user_status == true) {
                    document.cookie = 'username=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                    window.location = 'login.php';
                }
            }

            function sharePost(element_id){
                text = 'http://localhost/Dheeraj_Files/Storys/view_story.php?post_id=' + element_id;
                var textArea = document.createElement("textarea");

                // Place in top-left corner of screen regardless of scroll position.
                textArea.style.position = 'fixed';
                textArea.style.top = 0;
                textArea.style.left = 0;

                // Ensure it has a small width and height. Setting to 1px / 1em
                // doesn't work as this gives a negative w/h on some browsers.
                textArea.style.width = '2em';
                textArea.style.height = '2em';

                // We don't need padding, reducing the size if it does flash render.
                textArea.style.padding = 0;

                // Clean up any borders.
                textArea.style.border = 'none';
                textArea.style.outline = 'none';
                textArea.style.boxShadow = 'none';

                // Avoid flash of white box if rendered for any reason.
                textArea.style.background = 'transparent';
                textArea.value = text;

                document.body.appendChild(textArea);
                textArea.select();

                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                    console.log('Copying text command was ' + msg);
                } catch (err) {
                    console.log('Oops, unable to copy');
                }

                document.body.removeChild(textArea);
                alert('The link has been copied to your clipboard!');
            }

        </script>

		<title>Search</title>
	</head>

	<body>
		<div class="outer-container">
			<div class="search-container">
				<input id="search-text" type="text" onkeyup="startSearch()" placeholder="Search Query ...">
			</div>
			<div id = "search-result" class="search-result-container">

			</div>
		</div>
</body>
</html>
