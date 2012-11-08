<?php
require("../lib/database_settings.php");
$id = $_GET["id"];
echo $id
?>

<!DOCTYPE html> 
<html>

<head>
	<title>Serentripity - Hoover Tower</title> 
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="jquery.mobile-1.2.0.css" />
	<link rel="stylesheet" href="rick-style.css" />
	
	<script src="jquery-1.8.2.min.js"></script>
	<script src="jquery.mobile-1.2.0.js"></script>

</head>

<body>
	<div data-role="page" id="one" data-add-back-btn="true">
		<div id="header" data-role="header">
			<a id="serentripity-back-button" href="#" data-rel="back">Back</a>

			<h1>Serentripity</h1>
			<form id="serentripity-logout-form" action="index.php" method="post">
			<input type="hidden" name="logout" value="1" />
			</form>
			<a id="serentripity-logout-button">Logout</a>
			<a id="serentripity-help-button">Help</a>
		</div><!-- /header -->		
		
	<div data-role="content">			

		<div class="ui-grid-a-content">
			<div class="ui-block-a-content"><img src="hoover.jpg" class="placeimg">
			</div>
			<div class="ui-block-b-content">
				<h3> Hoover Tower at Stanford University </h3>
				Hoover Tower is a 285 feet structure on the campus of Stanford University in Stanford, California.
						<div class="ui-grid-a-content-vote">
							<div class="ui-block-a-content-vote">
								<div data-role="controlgroup" >
									<a href="index.html" data-role="button" data-icon="arrow-u" data-iconpos="notext" data-mini="true" data-inline="true"></a><br>
									<a href="index.html" data-role="button" data-icon="arrow-d" data-iconpos="notext" data-mini="true"data-inline="true"></a>
								</div>
							</div>
							<div class="ui-block-b-content-vote">
									<img class="mapimg" src="https://maps.googleapis.com/maps/api/staticmap?center=Hoover Tower&amp;zoom=15&amp;size=210x180&amp;markers=Hoover Tower&amp;sensor=false">
							</div>
						</div>
				
        		
			</div>	   
		</div>					
					<ul data-role="listview" data-inset="true" data-divider-theme="a" >
					<li data-role="list-divider">Trivia</li> <li>
						<div class="ui-grid-a-vote">
							<div class="ui-block-a-vote">
								<div data-role="controlgroup">
									<a href="index.html" data-role="button" data-icon="arrow-u" data-iconpos="notext" data-mini="true" data-inline="true"></a><br>
									<a href="index.html" data-role="button" data-icon="arrow-d" data-iconpos="notext" data-mini="true"data-inline="true"></a>
								</div>
							</div>
							<div class="ui-block-b-vote"><span class="triviatext">Hoover trivia 1</span></div>
						</div>
					</li>						
						
					<li data-inline="true">
						<div class="ui-grid-a-vote">
							<div class="ui-block-a-vote">
								<div data-role="controlgroup" >
									<a href="index.html" data-role="button" data-icon="arrow-u" data-iconpos="notext" data-mini="true" data-inline="true"></a><br>
									<a href="index.html" data-role="button" data-icon="arrow-d" data-iconpos="notext" data-mini="true" data-inline="true"></a>
								</div>
							</div>
							<div class="ui-block-b-vote"><span class="triviatext">Hoover trivia 1</span></div>
						</div>
					</li>						
					<li data-inline="true">
						<div class="ui-grid-a-vote">
							<div class="ui-block-a-vote">
								<div data-role="controlgroup" >
									<a href="index.html" data-role="button" data-icon="arrow-u" data-iconpos="notext" data-mini="true" data-inline="true"></a><br>
									<a href="index.html" data-role="button" data-icon="arrow-d" data-iconpos="notext" data-mini="true" data-inline="true"></a>
								</div>
							</div>
							<div class="ui-block-b-vote"><span class="triviatext">Hoover trivia 1</span></div>
						</div>
					</li>						
				</ul>
			
		
	</div><!-- /content -->
	
	</div>
</body>
</html>
