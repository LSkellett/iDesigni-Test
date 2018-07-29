<!DOCTYPE html>
<html>
<head>
	<meta charset="utf=8">
	<title>Testing</title>
</head>
<body>
	<?php
		$index = $_GET['index'];

		$events = json_decode(file_get_contents('events.json'), true);	
		
		$event = $events['events'][$index];
	?>
	<form method="POST">
		<p>
			<label>Event Name: </label>
			<input type="text" id="title" name="title" value="<?php echo $event['title'];?>">
		</p>
		<p>
			<label>Description: </label>
			<input type="text" id="description" name="description" value="<?php echo $event['description'];?>">
		</p>
		<p>
			<label>Date: </label>
			<input type="date" id="date" name="date" value="<?php echo $event['date'];?>">
		</p>
		<p>
			<label>Time: </label>
			<input type="time" id="time" name="time" value="<?php echo $event['time'];?>">
		</p>
		<input type="submit" name="save" value="save">
	</form>
	<hr>
	<a href="index.php"><button>Return to events List</button></a>
	<?php
		if(isset($_POST['save'])){
			
			$same = FALSE;
			foreach($events['events'] as $row){
				if($_POST['date']==$row['date']){
					if($row['id'] != $index){
						$same = TRUE;
					}
				}
			}
			if($same){
				echo"<p>The Date Matches a different event</p>";
			}else{
				$input = array(
					'id' => $index,
					'title' => $_POST['title'],
					'description' => $_POST['description'],
					'date' => $_POST['date'],
					'time' => $_POST['time'],
					'attendees' => $events['events'][$index]['attendees']
				);
			
				$events['events'][$index] = $input;
				file_put_contents('events.json',json_encode($events,JSON_PRETTY_PRINT));
				
				header('location: index.php');
			}
		};
		if(isset($_POST['return'])){
			header('location: index.php');
		}
	?>
</body>
</html>