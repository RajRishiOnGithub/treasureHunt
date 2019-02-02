<?php
include "conn.php";
session_start();
if(isset($_POST['check'])
{
	if(!isset($_SESSION['roll']))
    {
		session_destroy();
		header("location:login.php");
		exit();
    }
	
	$r=$_SESSION['roll'];
	if(isset($_POST['answer']))
	{
		$ans=$_POST['answer'];
		$sql="select SCORE from detail where ROLL=$r";
		$result=mysqli_query($conn,$sql);
		$row= mysqli_fetch_array($result);
		$n=$row['SCORE'];
		$qname="select IMGNAME from image where SCORE='$n'";
		$imgrslt=mysqli_query($conn,$qname);
		$rowtwo=mysqli_fetch_array($imgrslt);
		$link="media/".$rowtwo['IMGNAME'].".jpg";
		$_SESSION['link']=$link;
		if($ans==$rowtwo['IMGNAME'])
		{
			$hit=0;
			$n=$n+1;
			$sql3="update detail set SCORE=$n where ROLL='$r'";
			mysqli_query($conn,$sql3);
		}
		else
		{
			$hit+=1;
			if($hit>5)
			{
				$dissql="update detail set DISQ=1 where ROLL='$r'";
			    mysqli_query($conn,$dissql);
			    header("location:disql.html");
		    }
			echo "try again";
	}
	echo "score is $n";
	
	
	session_destroy();
}
?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Start Playing</title>
</head>
<body ><!onunload="destroysession()">
<h1>Find one word answer for the given picture :</h1><br><br>
<form method=post action="container.php">
<! image code was here >

 <img src="<?php 
    if(isset($_SESSION['link'])||isset($_POST['check']))  
      echo $_SESSION['link'];
	  unset($_SESSION['link']);
	  ?> ">

<br/><br/>
<label for="answer">ANSWER : </label>
<input type="text" name="answer" id="answer">
<br/><br/>
<input type="submit" name="check" value="check" > 
<input type="submit" name="logout" value="Logout" > 
<input type="submit" name="back" value="home" > 
</form>
</body>
</html>

