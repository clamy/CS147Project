<?php
require("../../lib/voteplaces.php");
$placeid = $_GET["placeid"];
$uid = $_GET["uid"];

$voteplace = GetVotePlace($placeid, $uid, $DBH);
echo $voteplace;
