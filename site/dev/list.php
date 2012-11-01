<?php
require("../lib/session.php");
require("php/header.php");
?>
<script>
function display_places(places) {
    console.log("Successfully fetched places: ");
    console.log(places);
}
var ajax_request = $.getJSON(
    "php/get_places.php",
    {longitude: 0, latitude: 0},
    display_places);
</script>

<div data-role="page" data-add-back-btn="true">

	<div data-role="header" data-theme="a">
    	<a href="loading.php" data-icon="arrow-l">Back</a>
		<h1>Serentripity</h1>
        <a href="#popupHelp" data-rel="popup" data-position-to="window" data-transition="fade" data-icon="info">Help</a>
	</div><!-- /header -->
    
	<div data-role="content" data-theme="a">
        <!-- Username <?php echo $username ?> -->
    	<div id="serentripity-montage" data-role="collapsible"  data-collapsed="false">
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

<?php
require("php/footer.php");
?>
