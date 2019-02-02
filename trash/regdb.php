<?php
  
   include "conn.php";
   if(isset($_POST['signup']))
   {
		$name=$_POST["name"];
		$roll=$_POST["roll"];
		$password=$_POST["pass"];
		$cpassword=$_POST["cpass"];
		
		if($password==$cpassword)
		{
			$sql="INSERT INTO detail (`NAME`,`ROLL`,`PASS`) values('$name','$roll','$password')";
		    $result=mysqli_query($conn,$sql);
			header("Location: login.html");
		}
		else
			echo "password mismatch";
		
	}
  ?>