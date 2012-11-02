<?php

require_once("database_settings.php");

// Wide picture first, then tall picture next.
function GetTriviaById($id, $DBH) {
    try {
        $STH = $DBH->prepare("SELECT * FROM trivia WHERE placeid=:id ORDER BY score DESC");
        $STH->bindParam(':id', $id);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->execute();
        $results_array = $STH->fetchAll();
        return json_encode($results_array); 
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
