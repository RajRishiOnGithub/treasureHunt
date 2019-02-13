<?php
include "conn.php";
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title> MINING THE JEWELS</title>
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>

  <h1> <span class="yellow">MINING THE JEWELS</pan></h1>

<table class="container">
	<thead>
		<tr>
			<th><h1>RANK</h1></th>
			<th><h1>NAME</h1></th>
			<th><h1>SCORE</h1></th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$sql = "SELECT * FROM detail ORDER BY TOTALSCORE DESC,UT ASC LIMIT 10";
	$result = mysqli_query($conn, $sql);
	$i=1;
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr><td>".$i."</td><td>".$row['NAME']."</td><td>{$row['TOTALSCORE']}</td></tr>";
		$i+=1;
	}
	?>	
	</tbody>
</table>
  
</body>

</html>
