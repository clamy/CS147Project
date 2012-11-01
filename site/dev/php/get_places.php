<?php
require("../../lib/places.php");
$longitude = $_GET["lon"];
$latitude = $_GET["lat"];

$places = GetPlacesFromLocation($longitude, $latitude, $DBH);
echo $places;
