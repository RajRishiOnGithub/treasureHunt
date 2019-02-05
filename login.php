<?php
include "conn.php";

session_start();

if(isset($_SESSION['roll']))
{
	header("location:container2.php");
}
if(isset($_POST["login"]))
{
	$r=$_POST['roll'];
	$p=$_POST['pass'];
	$sql="select * from detail where ROLL='$r'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	if($row['DISQ']==0)
	{
	   
		if($p!=$row['PASS'])
		{
			echo "invalid credentials";
		}
		else
		{
			$_SESSION['roll']=$r;
			header("location:container2.php");
			echo "password matched";
		}
	}
	else
	{
		unset($_SESSION['ROLL']);
		session_destroy();
		header("location:disql.html");
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h1>Login</h1><br/><br/>
<form  method="post" action="">
  <label for="roll">Roll No :</label>
  <input type="number" name="roll" id="roll" pattern=".{9}" title="Enter ur valid 9 digit roll number"><br>
  <label for="pass">Password : </label>
  <input type="password" name="pass" id="female" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"><br>

  <input type="submit" name="login" value="login">
</form>





</body>
</html>


