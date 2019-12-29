<?php 

	// Go through config.php
	require_once('config.php');
	
		if(isset($_POST['column']) && isset($_POST['sortOrder']))
	{
		$columnName = str_replace(" ","_",strtolower($_POST['column']));
		$sortOrder  = $_POST['sortOrder'];
		
		$sql = "select id, player_name, score from users order by ".$columnName." ".$sortOrder;
		$queryHandle = $connect->prepare($sql);
		$queryHandle->execute();
		
		//Display the data into a table
			
		while($rows = $queryHandle->fetch())
			{
				echo "<tr>";
					//echo "<td>".$rows['team_name']."</td>";
					echo "<td>".$rows['player_name']."</td>";
					echo "<td>".$rows['score']."</td>";
				echo "</tr>";
			}
		
			
		
	}
?>