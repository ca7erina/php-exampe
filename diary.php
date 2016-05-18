<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/lab6/diary_style.css">
	<script type="text/javascript" src="/lab6/diary.js"></script>
	<title>Diary</title>
</head>
<body>
	<div id = 'warn'>
	<?php
		if (isset($_POST["submit"])){				
		
			$servername = "localhost";
			$username = "root";
			$password = "123456";
			$dbname = "lab6";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			// prepare and bind
			$stmt = $conn->prepare("INSERT INTO diary (whenwhere, event, emotion, thoughts, response) VALUES (?, ?, ?,?,?)");
			$stmt->bind_param("sssss",$whenwhere, $event, $emotion, $thoughts, $response);

			// set parameters and execute
			$whenwhere = test_input($_POST["whenwhere"]);
			$event = test_input($_POST["event"]);
			$emotion = test_input($_POST["emotion"]);
			$thoughts = test_input($_POST["thoughts"]);
			$response = test_input($_POST["response"]);
			$stmt->execute();

			echo "New records created successfully.";

			$stmt->close();
			$conn->close();	
		}

		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
	?>
	</div>
		<div class = 'diarytable' id = 'input'>
			Diary:
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="doSubmit();return false;">
				 <table>
					  <tr>
					    <td>When/Where</td>
					    <td>Event</td>
					    <td>Emotion</td>
					    <td>Automatic thoughts</td>
					    <td>Rational response</td>
					  </tr>

					  <tr style="text-align:center;">
						<td><input type="text" name="whenwhere" id="frm_whenwhere"  placeholder="input date and location here"/></td>
						<td><input type="text" name="event" id="frm_event" placeholder="input event here"/></td>
						<td><input type="text" name="emotion" id="frm_emotion" placeholder="input emotion here"/></td>
						<td><input type="text" name="thoughts" id="frm_thoughts" placeholder="input toughts here"/></td>
						<td><input type="text" name="response" id="frm_response" placeholder="input response here"/></td>
					  </tr>
				</table>
				<div id ='buttons'>
				<input class = "bottum_btn" type="submit" name="submit" value="Save Entry"/>
				

				</div>
			</form>

			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
				<div id ='buttons'>
				<input class = "bottum_btn" type="submit" name="display" value="Show Entry"/>
				</div>
			</form>	
		</div>
	</div>


	<div id ='output'>
	<?php

		if (isset($_POST["display"])){
			$servername = "localhost";
			$username = "root";
			$password = "123456";
			$dbname = "lab6";
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT whenwhere, event, emotion, thoughts, response FROM diary";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo "<div class ='diarytable' ><table ><tr><td>When/Where</td><td>Event</td><td>Emotion</td><td>Automatic thoughts</td><td>Rational response</td></tr>";
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["whenwhere"]. "</td><td>" . $row["event"]. "</td><td>" . $row["emotion"]. "</td><td>" . $row["thoughts"]."</td><td>" . $row["response"]."</td></tr>";
				}
				echo "</table></div>";
			} 
			$conn->close();
		}
	
	?> 
	</div>
</body>


</html>
