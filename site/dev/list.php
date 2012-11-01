<!DOCTYPE html> 
<html>

<head>
	<title>Serentripity</title> 
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    
    <script type="text/javascript" src="photoswipe/lib/klass.min.js"></script>
	<script type="text/javascript" src="photoswipe/code.photoswipe-3.0.4.min.js"></script>
    

});

</head> 

	
<body> 
<div data-role="page" data-add-back-btn="true">

	<div data-role="header" data-theme="a">
    	<a href="loading.php" data-icon="arrow-l">Back</a>
		<h1>Serentripity</h1>
        <a href="#popupHelp" data-rel="popup" data-position-to="window" data-transition="fade" data-icon="info">Help</a>
	</div><!-- /header -->
    
	<div data-role="content" data-theme="a">
    	<div data-role="collapsible"  data-collapsed="false">
   			<h3>Less than 0.5 miles away</h3>
            <div class="ui-grid-solo">
				<div class="ui-block-a">
            		<img src="img/places/main_quad/main_quad_w.jpg" width = "100%">
            	</div>
			</div>
    		<div class="ui-grid-a">
				<div class="ui-block-a" >
            		<img src="img/places/memorial_church/memorial_church_h.jpg" width = "100%" height = "100%">
        		</div>
				<div class="ui-block-b">
            		<img src="img/places/burghers/burghers_w.jpg" width = "100%" height = "50%">
                    <img src="img/places/cantor_art_museum/cantor_art_museum_w.jpg" width = "100%" height = "50%">
        		</div>	   
			</div>
			<div class="ui-grid-solo">
				<div class="ui-block-a">
            		<img src="img/places/palm_drive/palm_drive_w.jpg" width = "100%">
            	</div>
			</div>
            <div class="ui-grid-a">
				<div class="ui-block-a" >
                	<a href="info_page.php" data-icon="arrow-l"><img src="img/places/hoover_tower/hoover_tower_h.jpg" width = "100%" height = "100%"></a>
            		<img src="img/places/mausoleum/mausoleum_w.jpg" width = "100%" height = "100%">
        		</div>
				<div class="ui-block-b">
            		<img src="img/places/angel_of_grief/angel_of_grief_w.jpg" width = "100%" height = "50%">
                    <img src="img/places/lake_lagunita/lake_lagunita_h.jpg" width = "100%" height = "50%">
        		</div>	   
			</div>
    	</div>
    	<div data-role="popup" id="popupHelp" data-theme="a" class="ui-corner-all">
    		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    		<p>This is the help page</p>
    	</div>
    </div>

</div>

</body>
</html>