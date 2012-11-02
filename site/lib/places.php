<?php
require_once("database_settings.php");

// This function fetches a list of places in JSON format, given a longitude
// and latitude.
// For now, this ignores location and just returns all the places.
function GetPlacesFromLocation($longitude, $latitude, $DBH) {
    try {
		//(lat - :lat1) * (lat - :lat2) + (lng - :lng1) * (lng - :lng2)
        $STH = $DBH->prepare("SELECT id, name, description, lat, lng, score, ACOS(SIN(radians(lat))*SIN(radians(:lat1))+COS(radians(lat))*COS(radians(:lat1))*COS(radians(lng-:lng1)))*6371/1.60934
 AS distance FROM places ORDER BY distance");
		$STH->bindParam(':lat1', $latitude);
		$STH->bindParam(':lat2', $latitude);
		$STH->bindParam(':lng1', $longitude);
		//$STH->bindParam(':lng2', $longitude);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->execute();
        $results_array = $STH->fetchAll();
        return json_encode($results_array); 
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

