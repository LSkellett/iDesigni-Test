<!DOCTYPE html>
<html>
<head>
	<meta charset="utf=8">
	<title>Testing</title>
</head>
<hr>

<table border="1">
	<thead>
		<th>ID</th>
		<th>date</th>
		<th>time</th>
		<th>title</th>
		<th>description</th>
		<th>attendees</th>
	</thead>
	<tbody>
		<?php
			$json = file_get_contents('events.json');

			$events = json_decode($json, true);
			foreach($events['events'] as $row){
				echo " <tr>
					<td>".$row['id']."</td>
					<td>".$row['date']."</td>
					<td>".$row['time']."</td>
					<td>".$row['title']."</td>
					<td>".$row['description']."</td>
					<td>";
						if (array_key_exists('attendees', $row)){
							foreach($row['attendees'] as $attendee){
								echo $attendee['name']."<br>";
							};
						}else{
							echo"No attendees";
						};
				echo "</td>
					<td><a href='event.php?index=".$row['id']."'>See event</a>
				</tr>";
			};
		?>
	</tbody>
</table>
</body>
</html>