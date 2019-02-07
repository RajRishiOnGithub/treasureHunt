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
	if(!is_numeric($r))
	{
		header("location:login.php");
		echo "! Enter roll number correctly !";
		exit();
	}
	$sql="select * from detail where ROLL=$r";
	//$sql->bind_param("s",$p);
	$p=mysqli_real_escape_string($conn,$_POST['pass']);
	//$p=$_POST['pass'];
	//$sql->execute();
	//$result=$sql->get_result();
	//$row=$sql->fetch_assoc();
	//echo $row['NAME'];
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

<style>
.container{
text-align:center;
margin-top:50px;
margin-bottom:auto;

}
.a {
  width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}
</style>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body background="bluetile.jpg">
<div class="container">
<h1 style="color: yellow">Login</h1><br/><br/>
<form  method="post" action="">
  <label for="roll" style="color:#fff;font-weight:900;font-size:24px;">Roll No : &nbsp;&nbsp;&nbsp;</label>
  <input type="number" name="roll" id="roll" class="a" pattern=".{9}" title="Enter ur valid 9 digit roll number"><br>
  <label for="pass" style="color:#fff;font-weight:900;font-size:24px;">Password : </label>
  <input type="password" name="pass" id="pass"class="a" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,15}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"><br>
  <br><br>
  <input class="btn btn-success" type="submit" style="height:50px;width:152px;"name="login" value="login">
</form>

</div>

</body>
</html>


