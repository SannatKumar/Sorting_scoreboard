<?php

// This file can be added wherever database connection is needed.
// Data base connection
	$servername = "localhost";
	$dusername = "root";
	$dpassword = "";
	$dbname = "userdb";

	try {
		$connect = new PDO("mysql:host=$servername; dbname=$dbname", $dusername, $dpassword);
		// set the PDO error mode to exception
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully";
	} catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
?>