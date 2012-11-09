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
	<link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/jquery.mobile.swatch.i.css" />
    
    <link rel="apple-touch-icon" href="img/startup_icon.jpg" />
	<link rel="apple-touch-startup-image" href="img/logo_loading.png">
    
	<link rel="stylesheet" href="css/jquery-mobile-theme/themes/serentripity-theme.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" /> 
    <link rel="stylesheet" href="css/serentripity-jquery-modifications.css"/>
	
	<script src="jquery-1.8.2.min.js"></script>
	<script src="jquery.mobile-1.2.0.js"></script>
    <script src="js/site.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/montage.js"></script>
    <script>
    // Session initialization.
    <?php
    // For now, we consider that if the user has a token, it's gravy.
    $session_json = json_encode($_SESSION);
    echo "var session_data = ${session_json};";
    ?>
    console.log("Session info:");
    console.log(session_data);
    </script>
</head> 
	
<body> 
