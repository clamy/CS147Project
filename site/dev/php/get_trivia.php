<?php
require("../../lib/trivia.php");

$place_id = $_GET["place_id"];

$trivia = GetTriviaById($place_id, $DBH);
echo $trivia;

// Here is how to use this:
/*

<script>
function onSuccess(data) {
    console.log("Success!");
    console.log(data);
}
var ajax_request = $.getJSON(
    "php/get_pictures.php",
    {id: 0},
    onSuccess);
</script>
*/
