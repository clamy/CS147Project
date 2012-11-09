<?php

require_once("database_settings.php");

// Wide picture first, then tall picture next.
function GetPicturesById($id, $DBH) {
    try {
        $STH = $DBH->prepare("SELECT * FROM pictures WHERE placeid=:id ORDER BY mode DESC");
        $STH->bindParam(':id', $id);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->execute();
        $results_array = $STH->fetchAll();
        return json_encode($results_array); 
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}

function GetPicturesByIdAndMode($id, $mode, $DBH) {
    try {
        $STH = $DBH->prepare("SELECT * FROM pictures WHERE placeid=:id AND mode=:mode");
        $STH->bindParam(':id', $id);
        $STH->bindParam(':mode', $mode);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->execute();
        $results_array = $STH->fetchAll();
        return json_encode($results_array); 
    } catch (PDOException $e) {
        print $e->getMessage();
    }
}
