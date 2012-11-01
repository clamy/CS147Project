<?php
require("../lib/database_settings.php");

session_start();

if (isset($_SESSION["last_page"])) {
  $last_page = $_SESSION["last_page"];
} else {
  $last_page = "index.php";
}
$_SESSION["last_page"] = "list.php";

function GetUserPassword($username, $DBH) {
    try {
        $STH = $DBH->prepare("SELECT * FROM users WHERE username=:username");
        $STH->bindParam(':username', $username);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->execute();
        if ($row = $STH->fetch()) {
            return $row["password"];
        } else {
            return NULL;
        }
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function CheckPassword($username, $password, $DBH) {
    $submitted = $password;
    $actual = GetUserPassword($username, $DBH);
    echo "<!--";
    echo $submitted;
    echo "  ";
    echo $actual;
    echo "-->";
    if (empty($actual)) {
        return FALSE;
    }
    return strcmp($submitted, $actual) == 0;
}

if (isset($_POST["logout"])) {
	session_destroy();
	session_start();
} else if (isset($_POST["username"]) && isset($_POST["password"])) {
    if (CheckPassword($_POST["username"], $_POST["password"], $DBH)) {
        $_SESSION["username"] = $_POST["username"];
    }
}

$username = $_SESSION["username"];
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
<script src="js/montage.js"></script>
</head> 

	
<body> 
<?php
if (empty($username)) {
	require("php/login.php");
} else {
	require("php/list.php");
}
?>
</body>
</html>
