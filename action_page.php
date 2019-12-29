<?php

    //Database credentials
    require_once('config.php');
	//Assign the value from the dashboard page to the database
	//$scorerTeam = $_POST['teamName'];
	$playerName =strtolower( $_POST['scorer']);
	$score = $_POST['score'];

	$userQueryString = "SELECT * FROM users";
	$queryHandle = $connect->prepare($userQueryString);
	$queryHandle->execute();
	$count = 0;
	while ($row = $queryHandle->fetch()) {
		if($row['player_name'] == $playerName){
			$count ++ ;	
		}
	}
	if($count > 0){
		$updateString = "UPDATE users SET score = score + '$score' WHERE player_name = '$playerName'";
		$queryHandle = $connect->prepare($updateString);
		$queryHandle->execute();
	}
	else{
		$userQueryString = "INSERT INTO `users`(`player_name`, `score`) VALUES (?,?)";
		$queryHandle = $connect->prepare($userQueryString);
		//$queryHandle->bindParam(1, $scorerTeam);
		$queryHandle->bindParam(1, $playerName);
		$queryHandle->bindParam(2, $score);
		$queryHandle->execute();
	}

	//Redirect to index.php	
	header("Location: index.php");
?>

