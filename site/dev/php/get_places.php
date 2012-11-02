<?php
require("../../lib/places.php");
$longitude = $_GET["longitude"];
$latitude = $_GET["latitude"];

$places = GetPlacesFromLocation($longitude, $latitude, $DBH);
echo $places;
