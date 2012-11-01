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


	<div data-role="content" data-theme="a">
    <?php
		// This is a hack. You should connect to a database here.
		if ($_POST["username"] == "test" && $_POST["password"] == "test") {
			
		}
		
	?>
    	<div class="ui-grid-solo">
			<div class="ui-block-a">
        		<img width="100%" src="img/logo_loading.png" />
    
    			<form action="list.php" method="get">
				<label for="user">Username:</label>
				<input type="text" name="username" id="loadUser">
				<label for="pass">Password:</label>
				<input type="password" name="password" id="passUser">
				<input type="submit" value="Login">
				</form>
    		</div>
    	</div>
    </div>

</div>

</body>
</html>