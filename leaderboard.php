<?php
include "conn.php";
if ( isset ( $_POST['submit'] ) )  {	
		header('Location: thunt.php');
}
?>
<html>
<head>
<title>MINING THE JEWELS</title>
<style>
.body
{
background-color:#ffffff;
}
.h1{
	text-align:center;
}
.table, .th, .td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
</head>
<body>
<form method="post" action="" enctype="multipart/form-data">
<h1 style="text-align: center;"><b>TREASURE HUNT</b></h1>
<div style="margin-left:20px">
<table border="1" style="width:100%">
<tr>
<td style="text-align:center">RANK</td>
<td style="text-align:center">NAME</td>
<td style="text-align:center;">SCORE</td>
</tr>
<?php 
	$sql = "SELECT * FROM detail ORDER BY SCORE DESC LIMIT 10";
	$result = mysqli_query($conn, $sql);
	$i=1;
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr><td>".$i."</td><td>".$row['NAME']."</td><td>{$row['TOTALSCORE']}</td></tr>";
		$i+=1;
	}
?>
</table>
</br>
<input class="submit" type="submit" name="submit" value="Back">
</tr>
</form>
</body>
</html>