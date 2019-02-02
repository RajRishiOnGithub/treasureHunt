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
 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>

</head>
<body>
<h1>Signup</h1>
<form method="post" action="">
  <label for="name">NAME : </label>
  <input type="text" name="name" id="name" required><br><br/>
  <label for="roll">Roll No : </label>
  <input type="text" name="roll" id="roll" pattern=".{9}" title="Enter ur valid 9 digit roll number"><br><br/>
  <label for="pass">Password : </label>
  <input type="password" name="pass" id="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"><br><br>
    <label for="cpass">Confirm Password : </label>
  <input type="password" name="cpass" id="cpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 5 or more characters"><br><br><br/>
  <input type="submit" value="signup" name="signup">
</form>


</body>
</html>
  