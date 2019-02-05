<?php
  
   include "conn.php";
   if(isset($_POST["signup"]))
   {
		$name=$_POST["name"];
		$roll=$_POST["roll"];
		$password=$_POST["pass"];
		$cpassword=$_POST["cpass"];
		
		$rollexist="select * from detail where ROLL='$roll'"; 
		$query=mysqli_query($conn,$rollexist);
		if(mysqli_num_rows($query)==0)
		{
		   if($password==$cpassword)
		   {
			  $sql="INSERT INTO detail (NAME,ROLL,PASS) values('$name','$roll','$password')";
		      $result=mysqli_query($conn,$sql);
			  header("Location: login.php");
		   }
		   else
		   echo "password mismatch";
		}
		else
		header("location:login.php");
   }
 ?>
 

<style>
.container{
	justify-content: center;
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





<html lang="en">
<head>
    <meta charset="UTF-8">
    <title >Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body background="bluetile.jpg">
<div class="container">
<h1 style="color: yellow">Signup</h1>
<form method="post" action="">
  <label for="name" style="color:#fff;font-weight:900;font-size:24px;">NAME : </label>
  <input type="text" name="name" class="a" id="name" required ><br><br/>
  <label for="roll" style="color:#fff;font-weight:900;font-size:24px;">Roll No : </label>
  <input type="number" name="roll" class="a" id="roll" pattern=".{9}" title="Enter ur valid 9 digit roll number"><br><br/>
  <label for="pass" style="color:#fff;font-weight:900;font-size:24px;">Password : </label>
  <input type="password" class="a" name="pass" id="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,15}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"><br><br>
    <label for="cpass" style="color:#fff;font-weight:900;font-size:24px;">Confirm Password : </label>
  <input type="password" class="a" name="cpass" id="cpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"><br><br><br/>
  <input type="submit" value="signup"style="height:50px;width:152px;" class="btn btn-success" name="signup">
</form>

</div>
</body>
</html>
  