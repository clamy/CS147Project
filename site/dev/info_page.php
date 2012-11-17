<?php
session_start();
require("../lib/database_settings.php");
$id = $_GET["id"];
$logged_in = 0;
$uid = 0;

//Checks if we are logged in and gets userid -> we only do it once when getting the page
if($_SESSION["username"]){
	$logged_in = 1;
	$STH = $DBH->prepare("SELECT * FROM users WHERE username=:name");
	$STH->bindParam(':name', $_SESSION["username"]);
    $STH->setFetchMode(PDO::FETCH_ASSOC);
   	$STH->execute();
	if ($row = $STH->fetch()) {
           $uid = $row["userid"];
    }
	else{
		$logged_in = 0;
	}
}
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


$adding = $_GET["adding"];

if($adding == 1){
	$text = $_GET["trivia"];
	try {
        
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
	print "voting\n";
	$value = $_GET["value"];
	try {
		
		if ($logged_in == 0) {
		}
        else {
        	//Check if we already have no vote for the place
			print "logged in\n";
			
        	$STH = $DBH->prepare("SELECT * FROM voteplace WHERE userid = :uid AND placeid = :placeid ");
        	$STH->bindParam(':placeid', $id);
			$STH->bindParam(':uid', $uid);
        	$STH->execute();
			$difference = $value;
			if($row = $STH->fetch()){
				print "has row\n";
				//We need to compute the new score
				if($value == $row["vote"]){
					//We are tacking back our vote
					$difference = -$value;
					$value = 0;
				}
				else{
					//We already have a different vote
					$difference = $value - $row["vote"];
				}
				//We already have an entry, so we update it
        		$STH = $DBH->prepare("UPDATE voteplace SET vote=:value WHERE placeid=:id AND userid=:uid");
        		$STH->bindParam(':id', $id);
				$STH->bindParam(':value', $value);
				$STH->bindParam(':uid', $uid);
        		$STH->execute();
			}
			else{
				print "inserting\n";
				//We don't have an entry, so we create it
				$STH = $DBH->prepare("INSERT INTO voteplace (placeid,userid,vote) VALUES (:id,:uid,:vote)");
        		$STH->bindParam(':id', $id);
				$STH->bindParam(':uid', $uid);
				$STH->bindParam(':vote', $value);			
        		$STH->execute();
			}
			
			// DO NOT DELETE : we NEED to update the place table as well
			$STH = $DBH->prepare("UPDATE places SET score = score + :value WHERE id = :id");
  			$STH->bindParam(':id', $id);
  			$STH->bindParam(':value', $difference);
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
	try{
	if ($logged_in == 0) {
		}
        else {
        	//Check if we already have no vote for the place
			print "logged in\n";
			
        	$STH = $DBH->prepare("SELECT * FROM votetrivia WHERE userid = :uid AND triviaid = :triviaid ");
        	$STH->bindParam(':triviaid', $trivia);
			$STH->bindParam(':uid', $uid);
        	$STH->execute();
			$difference = $value;
			if($row = $STH->fetch()){
				print "has row\n";
				//We need to compute the new score
				if($value == $row["vote"]){
					//We are tacking back our vote
					$difference = -$value;
					$value = 0;
				}
				else{
					//We already have a different vote
					$difference = $value - $row["vote"];
				}
				//We already have an entry, so we update it
        		$STH = $DBH->prepare("UPDATE votetrivia SET vote=:value WHERE triviaid=:id AND userid=:uid");
        		$STH->bindParam(':id', $trivia);
				$STH->bindParam(':value', $value);
				$STH->bindParam(':uid', $uid);
        		$STH->execute();
			}
			else{
				print "inserting\n";
				//We don't have an entry, so we create it
				$STH = $DBH->prepare("INSERT INTO votetrivia (triviaid,userid,vote) VALUES (:id,:uid,:vote)");
        		$STH->bindParam(':id', $trivia);
				$STH->bindParam(':uid', $uid);
				$STH->bindParam(':vote', $value);			
        		$STH->execute();
			}
			
			// DO NOT DELETE : we NEED to update the trivia table as well
			$STH = $DBH->prepare("UPDATE trivia SET score = score + :value WHERE id = :id");
  			$STH->bindParam(':id', $trivia);
  			$STH->bindParam(':value', $difference);
	  		$STH->execute();
    	}
      
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
$associated_array = GetAssociatedArray($id,$DBH);

//This code checks if the user is logged in

require("php/header.php");
?>


	

	
	<div data-role="content" data-theme="a" style="width:100%; height:100%; padding:0;">
    <div data-role="page" id="page">
    <div data-role="header" data-theme="a" id="header">
    <a href="list.php" data-icon="arrow-l" data-ajax="false">Back</a>
	<h1>Serentripity</h1>
    <a href="#popupHelp" data-rel="popup" data-position-to="window" data-transition="fade" data-icon="info">Help</a>
       	
	</div>
			
			
	<script type="text/javascript">
	//Script to hide the navbar if the user is not logged in
		var logged = <?php echo $logged_in;?>;
	</script>	
		
		
	
    
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
			for(var i = 1; i<data.length; i++){
				
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
		//Script to highlight the buttons for a specific trivia id
		function onSuccessId(data){
			if(data.length > 0){
					var triviavote = data[0].vote;
					
					if(triviavote == 1){
						var upname = "#up"+data[0].triviaid;
						$(upname).addClass("ui-btn-active");
					}
					else if(triviavote == -1){
						var downname = "#down"+data[0].triviaid;
						$(downname).addClass("ui-btn-active");
					}
			}
		}
		//Script to get the trivia
		function onSuccessTrivia(data) {
    		console.log("Success!");
    		console.log(data);
			var str3 = '<li data-role="list-divider" id="name"><?php echo $associated_array["name"];?>';
    		str3 += '<div data-role="controlgroup" data-type="horizontal" data-mini="true">';
    
   
			if(logged == 1){
				console.log("I am logged in");
				str3 += '<a href="info_page.php?id=<?php echo $id;?>&voteplace=1&value=1" data-role = "button" data-ajax="false" data-icon = "plus" id="upvote">Like</a>';
				str3 += '<a href="info_page.php?id=<?php echo $id;?>&voteplace=1&value=-1" data-role = "button" data-ajax="false" data-icon = "minus"id="downvote">Dislike</a>';
			
			}
			str3 += '<div data-role = "button" >Score: <?php echo $associated_array["score"];?></div>';
			str3 += ' </div>';
    		str3 += '</li>';
			$("#triviaList").prepend(str3);
			$("#triviaList").trigger('create');
			$("#triviaList").listview("refresh");
			if(logged == 1){
		
			//Script to highlight the buttons if we have already voted
			function onSuccess(data) {
    			if(data.length > 0){
					var placevote = data[0].vote;
					
					
					if(placevote == 1){
						$("#upvote").addClass("ui-btn-active");
					}
					else if(placevote == -1){
						$("#downvote").addClass("ui-btn-active");
					}
				}
			
			
			
			}
			
		
			var ajax_request = $.getJSON("php/get_vote_place.php",{placeid: <?php echo $id?>,uid: <?php echo $uid;?>},onSuccess);
			
			}
			//Add the add button if we are logged in
			if(logged == 1){
				var str2 = '<li>';
				str2 += '<div class="ui-grid-solo">';
				str2 += '<div class="ui-block-a">';
			 	str2 += '<a href="#popupAdd" data-role = "button" data-rel="popup" data-position-to="window" data-icon = "plus" data-transition="fade" data-mini="true">Add Fact</a>';
				str2 += '</div>';
				str2 += '</div>';
				str2 += '</li>';
				$("#triviaList").append(str2).trigger('create');
				$("#triviaList").listview('refresh');
				
			}
			
			
			for(var i = 0; i<data.length; i++){
				var str = '<li>';
				str+='<div class="ui-grid-solo">';
				str+='<div class="ui-block-a">';
				
					str+='<div data-role="controlgroup" data-type="horizontal" data-mini="true">';
					
					if(logged == 1){
					var link = '"info_page.php?id='+<?php echo $id;?>+'&votetrivia=1&triviaid='+data[i].id+'&value=1"';
					
					str+='<a href='+link+'data-role="button" data-icon="plus" data-ajax="false"'
					str += 'id="up'+data[i].id+'"';
					str+='>Like</a>';
				
					str+='<a href="info_page.php?id='+<?php echo $id;?>+'&votetrivia=1&triviaid='+data[i].id+'&value=-1"';
					str+= ' data-role="button" data-icon="minus" data-ajax="false"'
					str += 'id="down'+data[i].id+'"';
					str+='>Dislike</a>';
					}
					str+='<div data-role ="button">Score: '+data[i].score+'</div>';
					str+='</div>';
					
					
				
				str+=data[i].text;
				str+='</div>';
				str+='</div>';				
				str+='</li>';
				$("#triviaList").append(str).trigger('create');
				$("#triviaList").listview('refresh'); 
				
				if(logged == 1){
					var ajax_request = $.getJSON("php/get_vote_trivia.php",{triviaid: data[i].id,uid: <?php echo $uid;?>},onSuccessId);
				}
				
				
			}
			var str5 = '<li data-role="list-divider">';
				if(logged == 1){
					str5 += 'You are currently logged in as <?php echo $_SESSION["username"];?>.';
				}
				else{
					str5 += 'You are not logged in. Log in to use the voting features.';
				}
				str5 += '</li>';
				$("#triviaList").append(str5).trigger('create');
				$("#triviaList").listview('refresh');
			
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
    
    	<div data-role="collapsible" data-mini="true" >
   			<h3>See more pictures of this place</h3>
   			<div id="pictureList" class="ui-grid-solo">
				
			</div><!-- /grid-a -->
		</div>
    </li>
	<li data-role="list-divider">User-submitted facts</li>
    
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
    		<p>If you are logged in, click on the upvote and downvote button in the navigation bar on top.</p>
            <h3>Upvote/Downvote trivia</h3>
            <p>If you are logged in, click on the up and down arrows next to the chosen trivia.</p>
            <h3>Directions</h3>
            <p>Click on the map to get directions to this place</p>
   	</div>
    
    <div data-role="popup" id="popupMap" data-overlay-theme="a" data-theme="a" data-corners="false">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a><div id="mapcanvas" style="height:350px;width:250px"></div>
	</div>
    
    
    
   

</div>

<?php 
	
require("php/footer.php");
?>