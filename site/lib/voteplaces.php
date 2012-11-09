<?php
require_once("database_settings.php");

// This function fetches a list of places in JSON format, given a longitude
// and latitude.
// For now, this ignores location and just returns all the places.
function GetVotePlace($placeid, $uid, $DBH) {
    try {
		
        $STH = $DBH->prepare("SELECT * FROM voteplace WHERE (userid,placeid) = (:userid,:placeid) ");
		$STH->bindParam(':userid', $uid);
		$STH->bindParam(':placeid', $placeid);
		
		//$STH->bindParam(':lng2', $longitude);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->execute();
        $results_array = $STH->fetchAll();
        return json_encode($results_array); 
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

