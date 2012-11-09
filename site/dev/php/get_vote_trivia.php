<?php
require("../../lib/votetrivia.php");
$triviaid = $_GET["triviaid"];
$uid = $_GET["uid"];

$voteplace = GetVoteTrivia($triviaid, $uid, $DBH);
echo $voteplace;
