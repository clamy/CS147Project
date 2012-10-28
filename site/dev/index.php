<?php
session_start();

if (isset($_SESSION["last_page"])) {
  $last_page = $_SESSION["last_page"];
} else {
  $last_page = "index.php";
}
$_SESSION["last_page"] = "index.php";
?>

<!DOCTYPE html> 
<html>

<head>
	<title>Serentripity</title> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
<!-- Internal  -->
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/montage.css" rel="stylesheet" type="text/css" />
<script src="js/site.js"></script>
</head> 

	
<body> 
<div data-role="page">
  <div data-role="content" class="ui-content">
    <p>
      <img width="200" src="img/logo_loading.png" />
    </p>
    <h4>
      Login to find places near you.
    </h4>
    <p>
      <form action="list.php" method="post" data-ajax="false">
        <fieldset>
          <div data-role="field-contain">
            <label for="user">Username:</label>
            <input type="text" name="username" id="user" />
          </div>
          <div data-role="field-contain">
            <label for="pass">Password:</label>
            <input type="password" name="password" id="pass" />
            <input type="submit" value="Login" />
          </div>
        </fieldset>
      </form>
    </p>
  </div>
</div>
</body>
</html>