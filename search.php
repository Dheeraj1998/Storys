<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css">
		<meta charset="utf-8">
		<link href="search_styles.css" rel="stylesheet" type="text/css">
		<link href="paperkit2/assets/css/paper-kit.css" rel="stylesheet">
		<link href="paperkit2/assets/css/demo.css" rel="stylesheet">

		<!--     Fonts and icons     -->
		<link href="paperkit2/assets/img/apple-icon.png" rel="apple-touch-icon" sizes = "76x76">
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type = 'text/css'>
		<link href = "http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
		<link href = "paperkit2/assets/img/favicon.ico" rel = "icon" type = "image/png">
		<link href = "paperkit2/assets/css/nucleo-icons.css" rel = "stylesheet">
		<script src = "https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
		<script src = "search.js"></script>

		<title>Search</title>
	</head>

	<body>
		<div class="outer-container">
			<div class="search-container">
				<input id="search-text" type="text" onkeyup="startSearch()">
			</div>

			<div id = "search-result" class="search-result-container">

			</div>
		</div>
</body>
</html>
