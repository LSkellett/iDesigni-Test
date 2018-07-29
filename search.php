<!DOCTYPE html>
<html>
<head>
	<meta charset="utf=8">
	<title>Testing</title>
</head>

<body>
	<?php
		$events = json_decode(file_get_contents('events.json'), true);
		
	?>
	<a href="index.php"><button>Return to events List</button></a>
	<form method="GET">
		<h2>Search by value</h2>
		<p>
			<label>ID: </label>
			<input type="number" id="id" name="id">
		</p>
		<p>
			<label>Event Name: </label>
			<input type="text" id="title" name="title">
		</p>
		<p>
			<label>Description: </label>
			<input type="text" id="description" name="description">
		</p>
		<p>
			<label>Time: </label>
			<input type="time" id="time" name="time" >
		
		</p>
		<p>
			<label>Number of attendees: </label>
			<input type="number" id="attendee" name="attendee" >
		</p>
		<input type="submit" name="search" value="search">
	</form>
	<hr>
	<form method="GET">
		<h2> Search between Dates</h2>
		<p>
			<label>Date start: </label>
			<input type="date" id="date1" name="date1" required>
		</p>
		<p>
			<label>Date end: </label>
			<input type="date" id="date2" name="date2" required>
		</p>
		<input type="submit" name="dSearch" value="dSearch">
	</form>
	<hr>
	<?php
		if(isset($_GET['search'])){
			$indexs = [];
			
			if(!$_GET['id'] == ""){
				foreach($events['events'] as $row){
					if($_GET['id']==$row['id']){
						array_push($indexs,$row['id']);
					}
				}
			}
			if(!$_GET['title'] == ""){
				if (empty($indexs)){
					foreach($events['events'] as $row){
						if (stripos($row['title'], $_GET['title']) !== false){
							array_push($indexs,$row['id']);
						}
					}
				}else{
					foreach($events['events'] as $row){					
						if (in_array($row['id'],$indexs)){
							if (!(stripos($row['title'], $_GET['title']) !== false)){
								unset($indexs[$row['id']]);
							}
						}
					}
				}
			}
			if(!$_GET['description'] == ""){
				if (empty($indexs)){
					foreach($events['events'] as $row){
						if (stripos($row['description'], $_GET['description']) !== false){
							array_push($indexs,$row['id']);
						}
					}
				}else{
					foreach($events['events'] as $row){					
						if (in_array($row['id'],$indexs)){
							if (!(stripos($row['description'], $_GET['description']) !== false)){
								unset($indexs[$row['id']]);
							}
						}
					}
				}
			}
			if(!$_GET['time'] == ""){
				if (empty($indexs)){
					foreach($events['events'] as $row){
						if ($_GET['time']==$row['time']){
							array_push($indexs,$row['id']);
						}
					}
				}else{
					foreach($events['events'] as $row){					
						if (in_array($row['id'],$indexs)){
							if (!($_GET['time']==$row['time'])){
								echo $row['id'];
								unset($indexs[$row['id']]);
							}
						}
					}
				}
			}
			if(!$_GET['attendee'] == ""){
				if (empty($indexs)){
					foreach($events['events'] as $row){
						echo count($row['attendees']);
						if ($_GET['attendee']== (count($row['attendees']))){
							echo count($row['attendees']);
							array_push($indexs,$row['id']);
						}
					}
				}else{
					foreach($events['events'] as $row){					
						if (in_array($row['id'],$indexs)){
							if (!($_GET['attendee']==count($row['attendees']))){
								echo $row['id'];
								unset($indexs[$row['id']]);
							}
						}
					}
				}
			}
			if (!empty($indexs)){
				createResultTable($indexs);
			}else{
				echo "Nothing matches this search";
			}
		}

		if(isset($_GET['dSearch'])){
			$indexs = [];
			foreach($events['events'] as $row){	
				if ($row['date']>=$_GET['date1'] && $row['date']<=$_GET['date2']){
					array_push($indexs,$row['id']);
				}
			}
			if (!empty($indexs)){
				createResultTable($indexs);
			}else{
				echo "Nothing matches this search";
			}
		}	
		
		function createResultTable($indexs){
			$events = json_decode(file_get_contents('events.json'), true);
			echo '<table border="1">
				<thead>
					<th>ID</th>
					<th>date</th>
					<th>time</th>
					<th>title</th>
					<th>description</th>
					<th>attendees</th>
				</thead>
				<tbody>';
				foreach($events['events'] as $row){
					foreach($indexs as $index){
						if($index==$row['id']){
							echo"<tr>
							<td>".$row['id']."</td>
							<td>".$row['date']."</td>
							<td>".$row['time']."</td>
							<td>".$row['title']."</td>
							<td>".$row['description']."</td>
							<td>";
								if (empty($row['attendees'])){
									echo"No attendees";
								}else{
									foreach($row['attendees'] as $attendee){
										echo $attendee['name']."<br>";
									};
								};
						}					
					}
				}
		}
	?>
</body>