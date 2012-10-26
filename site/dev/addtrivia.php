<!DOCTYPE html> 
<html>

<head>
	<title>Serentripity</title> 
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="jquery.mobile-1.2.0.css" />

	<link rel="stylesheet" href="css/loading.css" />
    <link rel="stylesheet" href="css/jquery.mobile.swatch.i.css" />
	
	
	<script src="jquery-1.8.2.min.js"></script>
	<script src="jquery.mobile-1.2.0.js"></script>

</head> 

	
<body> 
<div data-role="page">

	<div data-role="header" data-theme="i">
    <a href="#" data-icon="check" id="back" class="ui-btn-left">Back</a>
		<h1>Serentripity</h1>
        
	</div><!-- /header -->
	<div data-role="content" class="ui-content">
    <form action="index.htm" method="get">
	<label for="user">Add info on this place:</label>
	<input type="text" size = "300" name="trivia" id="trivia">
	<input type="submit" value="Add info">
	</form></p>
    </div>

</div>

</body>
</html>