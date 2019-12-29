<?php 

require_once('config.php');
$gameQuery = "select id, team_name, player_name, score from users";
$queryHandle = $connect->prepare($gameQuery);
$queryHandle->execute();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Scoreboard</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<style>
	    #header {
            text-align: center;
            background: skyblue;
            height: 150px;
        }
		.sort-heading{
			cursor:pointer;	
		}
		.container .box {
            width: 1024px;
            display: table;
        }

        .container .box .box-row {
            display: table-row;
        }

        .container .box .box-cell {
            display: table-cell;
            width: 50%;
            padding: 10px;
        }

        .form-group {
            width: 100%;
            padding-left: 5%;
            padding-right: 5%;
        }

        .form-control {
            float: left;
            width: 20%;
        }

        .form-group btn btn-primary {
            margin-top: 5%;
        }

        #exampleFormControlInputp {
            width: 400px;
        }

        #submitbutton {
            width: 25%;
            margin-left: 35%;
        }
</style>
<body>
<header id="header">
	<h1 style="text-align: center;">Scoreboard</h1>
	<div class="container">
		<div class="box">
			<div class="box-row">
				<div class="box-cell box1">                     
				</div>
			</div>
		</div>
	</div>
</header>	
	<table class="table">
		<tr>
			<!--<th class="sort-heading" id="team_name-asc" >Team Name</th>-->
			<th class="sort-heading" id="player_name-asc" >Player Name</th>
			<th class="sort-heading" id="score-asc" >Score</th>
		</tr>
		<?php 
			while($rows = $queryHandle->fetch())
			{
				echo "<tr>";
					//echo "<td>".$rows['team_name']."</td>";
					echo "<td>".$rows['player_name']."</td>";
					echo "<td>".$rows['score']."</td>";
				echo "</tr>";
			}
		?>
	</table>
	<form action="action_page.php" method="post">
	<div class="container">
        <div class="form-group">
            <div class="container px-lg-5">
                <div class="row mx-lg-n5">
                    <div class="col py-3 px-lg-5 border bg-light"><input type="text" name="scorer" class="form-control" id="exampleFormControlInputp" placeholder="Player Name" required></div>
                    <div class="col py-3 px-lg-5 border bg-light"><input type="number" name="score" class="form-control" placeholder="Score" min="1" required><br /><br /></div>
                </div>
            </div>
            <br /><br /><br /> <br />
            <div class="container">
                <div class="row">
                    <div class="col">
                        <button type="submit" value="submit" class="btn btn-primary" id="submitbutton">Submit</button>
                    </div>
                </div>
            </div>
		</div>
		</div>
    </form>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
	$(document).ready(function(){
		$(".sort-heading").click(function(){
			//get data-nex-order value
			var getSortHeading = $(this);
			var getNextSortOrder = getSortHeading.attr('id');
			var splitID = getNextSortOrder.split('-');
			var splitIDName = splitID[0];
			var splitOrder = splitID[1];
			//get current td value
			var getColumnName = getSortHeading.text();
			
			$.ajax({
				url:'get_player_data.php',
				type:'post',
				data:{'column':getColumnName,'sortOrder':splitOrder},
				success: function(response){
					if(splitOrder == 'asc')
					{
						getSortHeading.attr('id',splitIDName+'-desc');
					}
					else
					{
						getSortHeading.attr('id',splitIDName+'-asc');
					}	
					
					$(".table tr:not(:first)").remove();
					$(".table").append(response);
				}
			});
			
		});
	});
</script>
</body>
</html>