<?php
  
   include "conn.php";
   if(isset($_POST["signup"]))
   {
		$name=$_POST["name"];
		$roll=$_POST["roll"];
		$password=$_POST["pass"];
		$cpassword=$_POST["cpass"];
		
		if($password==$cpassword)
		{
			$sql="INSERT INTO detail (NAME,ROLL,PASS) values('$name','$roll','$password')";
		        $result=mysqli_query($conn,$sql);
			header("Location: login.html");
		}
		else
			echo "password mismatch";
   }
   else{
   
      echo "fdgdg";   
   }
	
  ?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>

</head>
<body>
<h1>Signup</h1>
<form method="post" action="connect.php">
  <label for="name">NAME : </label>
  <input type="text" name="name" id="name" value=""><br><br/>
  <label for="roll">Roll No : </label>
  <input type="text" name="roll" id="roll" value=""><br><br/>
  <label for="pass">Password : </label>
  <input type="text" name="pass" id="pass" value=""><br><br>
    <label for="cpass">Confirm Password : </label>
  <input type="text" name="cpass" id="cpass" value=""><br><br><br/>
  <input type="submit" value="signup" name="signup">
</form>


</body>
</html>
  