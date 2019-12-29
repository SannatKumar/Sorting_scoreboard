<?php

require_once('config.php');

$teamA = $_POST['team_name'];
$inputsql = "INSERT INTO `teamname`(`teamname`) VALUES (?)";
$inputQuery = $connect->prepare($inputsql);
$inputQuery->bindParam(1, $firstTeam);
$inputQuery->execute();

header("Location: index.php")

?>