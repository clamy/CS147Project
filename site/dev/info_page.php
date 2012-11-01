<?php
require("../lib/database_settings.php");
$id = $_GET["id"];

function GetAssociatedArray($id, $DBH){
	try {
        $STH = $DBH->prepare("SELECT * FROM places WHERE id=:id");
        $STH->bindParam(':id', $id);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->execute();
        if ($row = $STH->fetch()) {
            return $row;
        } else {
            return NULL;
        }
    } catch (PDOException $e) {
        print $e->getMessage();
    }
	
}

$associated_array = GetAssociatedArray($id,$DBH);

function GetPicturesArray($id,$DBH){
	try {
        $STH = $DBH->prepare("SELECT * FROM pictures WHERE placeid=:id");
        $STH->bindParam(':id', $id);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->execute();
        if ($row = $STH->fetchAll()) {
            return $row;
        } else {
            return NULL;
        }
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

$pictures_array = GetPicturesArray($id,$DBH);

?>

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
    	<a href="list.php" data-icon="arrow-l">Back</a>
		<h1><?php echo $associated_array["name"];?></h1>
        <a href="#popupHelp" data-rel="popup" data-position-to="window" data-transition="fade" data-icon="info">Help</a>
        <div data-role="navbar">
			<ul>
				<li><a href="#popupAdd" data-rel="popup" data-position-to="window" data-transition="fade">Add Trivia</a></li>
                <li><a href="info_page.php" >Upvote</a></li>
                <li><a href="info_page.php" >Downvote</a></li>
			</ul>
		</div><!-- /navbar -->
	</div><!-- /header -->
	<div data-role="content" data-theme="a">
    
    
    
    <ul data-role="listview">
    <li>
    <div class="ui-grid-a">
		<div class="ui-block-a">
            <a href="#popupPhoto" data-rel="popup" data-position-to="window" data-transition="fade"><img src="img/places/hoover_tower/hoover_tower.jpg" width = "90%"></a>
       	</div>
		<div class="ui-block-b">
                	<a href="#popupMap" data-rel="popup" data-position-to="window" data-transition="fade"><img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $associated_array["lat"];?>,<?php echo $associated_array["lng"];?>&amp;zoom=15&amp;size=210x149&amp;markers=<?php echo $associated_array["lat"];?>,<?php echo $associated_array["lng"];?>&amp;sensor=false" width="90%"></a>
        </div>
	</div><!-- /grid-a -->
    </li>
    <li>
    	<div data-role="collapsible" >
   			<h3>Pictures</h3>
   			<div class="ui-grid-a">
				<div class="ui-block-a">
            		<a href="#popupPhoto" data-rel="popup" data-position-to="window" data-transition="fade"><img src="img/places/hoover_tower/hoover_tower_h.jpg" width = "90%"></a>
            	</div>
				<div class="ui-block-b">
                	<a href="#popupPhoto2" data-rel="popup" data-position-to="window" data-transition="fade">
            		<img src="img/places/hoover_tower/hoover_tower_w.jpg" width = "90%"></a>
            	</div>
			</div><!-- /grid-a -->
		</div>
    	</li>
		<li>
        <div class="ui-grid-solo">
			<div class="ui-block-a">
            	<div data-role="controlgroup" data-type="horizontal" data-mini="true">
					<a href="index.html" data-role="button" data-icon="arrow-u" ></a>
					<a href="index.html" data-role="button" data-icon="arrow-d" ></a>
                
           	 	</div>
            	On clear days it is possible to see all the way to the distant skyline of San Francisco.
            </div>
			
		</div><!-- /grid-a -->
        	
            
		</li>   
		<li><div class="ui-grid-solo">
			<div class="ui-block-a">
            	<div data-role="controlgroup" data-type="horizontal" data-mini="true">
					<a href="index.html" data-role="button" data-icon="arrow-u" ></a>
					<a href="index.html" data-role="button" data-icon="arrow-d" ></a>
                
           	 	</div>
            	Exiled Aleksandr Solzhenitsyn lived on the 11th floor for some time upon invitation by Stanford 	University before he moved in 1976.
            </div>
			
		</div><!-- /grid-a -->
        </li>
		<li>
        <div class="ui-grid-solo">
			<div class="ui-block-a">
            	<div data-role="controlgroup" data-type="horizontal" data-mini="true">
					<a href="index.html" data-role="button" data-icon="arrow-u" ></a>
					<a href="index.html" data-role="button" data-icon="arrow-d" ></a>
                
           	 	</div>
            	The tower has a carillon of 48 bells cast in Belgium and the Netherlands, and the general public is not allowed at the top of the tower when the bells ring. The largest bell weighs in at 2.5 tons.
            </div>
        </li>
	</ul>
    <div data-role="popup" id="popupPhoto" data-overlay-theme="a" data-theme="d" data-corners="false">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a><img src="img/places/hoover_tower/hoover_tower_h.jpg" width = "85%">
	</div>
    
    <div data-role="popup" id="popupPhoto2" data-overlay-theme="a" data-theme="d" data-corners="false">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a><img src="img/places/hoover_tower/hoover_tower_w.jpg" width = "85%">
	</div>
    
    <div data-role="popup" id="popupAdd" data-theme="a" class="ui-corner-all">
    <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
			<form>
				
				  
		          <label for="un" class="ui-hidden-accessible">Trivia:</label>
		          <input type="text" name="trivia" id="t" value="" data-theme="a" />

		    	  <button type="submit" data-theme="b">Add trivia</button>
				
			</form>
		</div>
    <div data-role="popup" id="popupHelp" data-theme="a" class="ui-corner-all">
    		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    		<p>This is the help page</p>
   	</div>
    
    <div data-role="popup" id="popupMap" data-overlay-theme="a" data-theme="d" data-corners="false">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a><img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo $associated_array["lat"];?>,<?php echo $associated_array["lng"];?>&amp;zoom=15&amp;size=210x300&amp;markers=<?php echo $associated_array["lat"];?>,<?php echo $associated_array["lng"];?>&amp;sensor=false" width="90%">
	</div>
    
    </div>

</div>

</body>
</html>