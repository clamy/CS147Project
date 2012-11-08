<?php
session_start();
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

function CheckLoggedIn($DBH) {
		$username = $_SESSION["username"];
		$STH = $DBH->prepare("SELECT * FROM users WHERE username=:uname");
        $STH->bindParam(':uname', $username);
		$STH->setFetchMode(PDO::FETCH_ASSOC);		
		$STH->execute();
        $row = $STH->fetch();
        $userid = $row["userid"];
        if (is_null($userid)) {
        	echo "not logged";
        	$_SESSION["loginalert"] = 1;
        } else {
        	 unset($_SESSION["loginalert"]);
        }
}
$adding = $_GET["adding"];
echo $adding;
if($adding == 1){
	$text = $_GET["trivia"];
	try {
        //$STH = $DBH->prepare("INSERT INTO trivia (placeid,text) VALUES (:id,:text)");
		$STH = $DBH->prepare("SELECT COUNT(*) AS c from trivia WHERE placeid=:id and text=:text");
        $STH->bindParam(':id', $id);
		$STH->bindParam(':text', $text);
		$STH->setFetchMode(PDO::FETCH_ASSOC);		
        $STH->execute();
        $row = $STH->fetch();
        $countTrivia = intval($row["c"]);
        if ($countTrivia > 0) {
			
        }
        else {
        	$STH = $DBH->prepare("INSERT INTO trivia (placeid,text) VALUES (:id,:text)");
        	$STH->bindParam(':id', $id);
			$STH->bindParam(':text', $text);			
        	$STH->execute();
        }                      
    } catch (PDOException $e) {
        print $e->getMessage();
    }
	
}
$voteplace = $_GET["voteplace"];
if ($voteplace == 1){	

	$value = $_GET["value"];
	try {
		CheckLoggedIn($DBH);
		if (isset($notloggedin)) {
		}
        else {
        	echo "logged";
        	$STH = $DBH->prepare("UPDATE voteplace SET vote=:value WHERE placeid=:id AND userid=:uid");
        	$STH->bindParam(':id', $id);
			$STH->bindParam(':value', $value);
			$STH->bindParam(':uid', $userid);
        	$STH->execute();
    	}
      
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
$votetrivia = $_GET["votetrivia"];
if($votetrivia == 1){
	$value = $_GET["value"];
	$trivia = $_GET["triviaid"];
	try {
		CheckLoggedIn($DBH);
		if (isset($notloggedin)) {
		}
		else {
        	$STH = $DBH->prepare("UPDATE votetrivia SET vote=:value WHERE triviaid=:triviaid AND userid=:uid");
    	    $STH->bindParam(':triviaid', $trivia);
			$STH->bindParam(':value', $value);
			$STH->bindParam(':uid', $userid);
        	$STH->execute();
      	}
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
$associated_array = GetAssociatedArray($id,$DBH);

//This code checks if the user is logged in
$logged_in = 0;
if($_SESSION["username"]){
	$logged_in = 1;
}
require("php/header.php");
?>


<div data-role="page" data-add-back-btn="true" id="page">
	<script type="text/javascript">
	//Script to hide the navbar if the user is not logged in
		var logged = <?php echo $logged_in;?>;
		if(logged == 1){
			console.log("I am logged in");
			var str ='<div data-role="footer">';
			str += '<div data-role="navbar" id = "navbar">';
			str += '<ul>';
			str += '<li><a href="#popupAdd" data-rel="popup" data-position-to="window" data-transition="fade">Add Trivia</a></li>';
			str += '<li><a href="info_page.php?id=<?php echo $id;?>&voteplace=1&value=1" data-ajax="false">Upvote</a></li>';
			str += '<li><a href="info_page.php?id=<?php echo $id;?>&voteplace=1&value=-1" data-ajax="false" >Downvote</a></li>';
			str += '</ul>';
			str += '</div>';
			str += '</div>';
			
			$("#page").append(str);
			
	}
	</script>

	<div data-role="header" data-theme="a" id="header">
    	<a href="list.php" data-icon="arrow-l" data-ajax="false">Back</a>
		<h1><?php echo $associated_array["name"];?></h1>
        <a href="#popupHelp" data-rel="popup" data-position-to="window" data-transition="fade" data-icon="info">Help</a>
       	
	</div><!-- /header -->
	<div data-role="content" data-theme="a" style="width:100%; height:100%; padding:0;">
    
   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
   
		<script type="text/javascript">
		//Script for the map popup
		var map;
		var wayA;
		var wayB;
		var debug;
		
		
		
		// This is the display window
		var infowindow = new google.maps.InfoWindow({
		    size: new google.maps.Size(150, 50)
		});
		
		
		// Create the marker
		function createMarker(latlng, name, html) {
		    var contentString = html;
		    var marker = new google.maps.Marker({
		        position: latlng,
		        map: map
		    });
		
		    google.maps.event.addListener(marker, 'click', function () {
		        infowindow.setContent(contentString);
		        infowindow.open(map, marker);
		    });
		    google.maps.event.trigger(marker, 'click');
		    return marker;
		}
		
		function success(position) {
			
		    
		    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		    var myOptions = {
		        zoom: 15,
		        center: latlng,
		        mapTypeControl: false,
		        navigationControlOptions: {
		            style: google.maps.NavigationControlStyle.SMALL
		        },
		        mapTypeId: google.maps.MapTypeId.ROADMAP
		    };
		
		    map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);
		
		    wayA = new google.maps.Marker({
		        position: latlng,
		        map: map,
		        title: "You are here!",
		        
		    });
			
			var objectLatLng = new google.maps.LatLng(<?php echo $associated_array["lat"];?>,
				<?php echo $associated_array["lng"];?>);
			
			wayB = new google.maps.Marker({
		
		                position: objectLatLng,
		                map: map,
		
		    });
		    
		    var renderer;
			
			// Directions
		    renderer = new google.maps.DirectionsRenderer({
		        'draggable': true
		    });
		   	renderer.setMap(map);
			service = new google.maps.DirectionsService();
		
		            service.route({
		                'origin': wayA.getPosition(),
		                'destination': wayB.getPosition(),
		                'travelMode': google.maps.DirectionsTravelMode.WALKING
		            }, function (result, status) {
		            	
		            	
		    			
		                if (status == 'OK') renderer.setDirections(result);
		                	wayA.setMap(null);
				            wayA = null;
				            wayB.setMap(null);
				            wayB = null;
		            })
					
		}
		
		function error(msg) {
		    var s = document.querySelector('#status');
		    s.innerHTML = typeof msg == 'string' ? msg : "failed";
		    s.className = 'fail';
		}
		
		if (navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(success, error);
		} else {
		    error('not supported');
		}		
		</script>
        
     <script  type="text/javascript">
	 	//Script to get the pictures
		function onSuccess(data) {
    		console.log("Success!");
    		console.log(data);
			var location = "img/places/"+data[0].file;
			console.log(location);
			$("#pictureW").attr("src",location);
			$("#pictureWP").attr("src",location);
			for(var i = 0; i<data.length; i++){
				var str= '<img src="img/places/'+data[i].file+'" width = "100%"></a>';
				console.log(str);
				$("#pictureList").append(str);
			}
			
			
		}
		console.log("Trying to get the pictures");
		var ajax_request = $.getJSON(
    		"php/get_pictures.php",
    		{place_id: <?php echo $id?>},
    	onSuccess);
	</script>
    <script  type="text/javascript">
		//Script to get the trivia
		function onSuccessTrivia(data) {
    		console.log("Success!");
    		console.log(data);
			for(var i = 0; i<data.length; i++){
				var str = '<li>';
				str+='<div class="ui-grid-solo">';
				str+='<div class="ui-block-a">';
				if(logged == 1){
					str+='<div data-role="controlgroup" data-type="horizontal" data-mini="true">';
					var link = '"info_page.php?id='+<?php echo $id;?>+'&votetrivia=1&triviaid='+data[i].id+'&value=1"';
					
					str+='<a href='+link+'data-role="button" data-icon="arrow-u" data-ajax="false"></a>';
				
					str+='<a href="info_page.php?id='+<?php echo $id;?>+'&votetrivia=1&triviaid='+data[i].id+'&value=-1"';
					str+= ' data-role="button" data-icon="arrow-d" data-ajax="false" ></a>';
					str+='</div>';
				}
				str+=data[i].text;
				str+='</div>';
				str+='</div>';				
				str+='</li>';
				$("#triviaList").append(str).trigger('create');
				$("#triviaList").listview('refresh'); 
				console.log(str);
				
				
			}
			
			
		}
		console.log("Trying to get the trivia");
		var ajax_request = $.getJSON(
    		"php/get_trivia.php",
    		{place_id: <?php echo $id?>},
    	onSuccessTrivia);
	</script>
    <ul id="triviaList" data-role="listview" >
    <li>
    <div class="ui-grid-a">
		<div class="ui-block-a">
            <a href="#popupPhoto" data-rel="popup" data-position-to="window" data-transition="fade"><img id="pictureW" width = "90%"></a>
       	</div>
		<div class="ui-block-b">
                <a href="#popupMap" data-rel="popup" data-position-to="window" data-transition="fade"><img src="https://maps.googleapis.com/maps/api/staticmap?center=
				<?php echo $associated_array["lat"];?>,<?php echo $associated_array["lng"];?>&amp;zoom=15&amp;size=210x149&amp;markers=
				<?php echo $associated_array["lat"];?>,<?php echo $associated_array["lng"];?>&amp;sensor=false" width="90%"></a> 
            
                    
        </div>
	</div><!-- /grid-a -->
    </li>
    <li>
    	<div data-role="collapsible" >
   			<h3>Pictures</h3>
   			<div id="pictureList" class="ui-grid-solo">
				
			</div><!-- /grid-a -->
		</div>
    </li>
		
	</ul>
    <div data-role="popup" id="popupPhoto" data-overlay-theme="a" data-theme="a" data-corners="false">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a><img id="pictureWP" width = "85%">
	</div>
    
    <div data-role="popup" id="popupAdd" data-theme="a" class="ui-corner-all">
    <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
			<form action="info_page.php" method="GET" data-ajax="false">
				  
		          <label for="un" class="ui-hidden-accessible">Trivia:</label>
		          <input type="text" name="trivia" value="" data-theme="a" />
                  <input type="hidden" name="id" value="<?php echo $id;?>" />
                  <input type="hidden" name="adding" value="1" />
                  <button type="submit" data-theme="b">Add trivia</button>
				
			</form>
		</div>
    <div data-role="popup" id="popupHelp" data-theme="a" class="ui-corner-all">
    		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
            <h3>Upvote/Downvote this place</h3>
    		<p>Click on the upvote and downvote button in the navigation bar on top.</p>
            <h3>Upvote/Downvote trivia</h3>
            <p>Click on the up and down arrows next to the chosen trivia.</p>
            <h3>Directions</h3>
            <p>Click on the map to get directions to this place</p>
   	</div>
    
    <div data-role="popup" id="popupMap" data-overlay-theme="a" data-theme="a" data-corners="false">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a><div id="mapcanvas" style="height:350px;width:250px"></div>
	</div>
    
    
    
   

</div>

<?php 
	if (isset($_SESSION["loginalert"])) {
		echo "<script type=\"text/javascript\">alert('You must be logged in to do that!')</script>";
	}
	else {
		echo "<script type=\"text/javascript\">alert('You are logged in!')</script>";	
	}
require("php/footer.php");
?>