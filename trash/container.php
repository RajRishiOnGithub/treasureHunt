<?php

session_start();
$hit=0;
include "conn.php";


if(!isset($_SESSION['roll']))
{
	session_destroy();
	header("location:login.php");
	exit();
}


	
 //if(isset($_POST['answer']))
  //$ans=$_POST['answer'];
  $r=$_SESSION['roll'];
  //echo $r;
  
  
  //loading image 
function loadimage()
{  
		  $sql="select SCORE from detail where ROLL=$r";
		  $result=mysqli_query($conn,$sql);
		  $row= mysqli_fetch_array($result);
		  $n=$row['SCORE'];
		  
		  $qname="select IMGNAME from image where SCORE='$n'";
		  $imgrslt=mysqli_query($conn,$qname);


		  $rowtwo=mysqli_fetch_array($imgrslt);
		  
		  $link="media/".$rowtwo['IMGNAME'].".jpg";
		  $_SESSION['link']=$link;
		  //echo '<img src="$link"/>';

}
 //increase score if it is correct 
 
 function checkfn()
 {
	      $ans=$_POST['answer'];
		  if(isset($_POST['check'])&&$ans==$rowtwo['IMGNAME'])
		  {
			  
			 $n=$n+1;
			 $hit=0;
			//unset($_SESSION['link']);
			$sql3="update detail set SCORE=$n where ROLL='$r'";
			mysqli_query($conn,$sql3);
			loadimage();
		  }	 
		  else
		  {
			  if(isset($_POST['check']))
			  {
				  $hit=$hit+1;
				  echo "Hit is : $hit\n";
				  if($hit>5)
				  {
					  $dissql="update detail set DISQ=1 where ROLL='$r'";
					  mysqli_query($conn,$dissql);
					  header("location:disql.html");
				  }
				  echo "try again !"; 
			  }
		  }
	  
  }
//echo "score is $n";

function destroysession()
{
	
	//if(isset($_POST['logout'])||isset($_POST['back']))
	
		
		unset($_SESSION['roll']);
		unset($_SESSION['link']);
		session_destroy();
		header("location:login.php");
	
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Start Playing</title>
</head>
<body onunload="destroysession()">
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
<input type="text" name="answer" id="answer" required>
<br/><br/>
<input type="submit" name="check" value="check" onclick="checkfn()">
<input type="submit" name="logout" value="Logout" onclick="destroysession()">
<input type="submit" name="back" value="home" onclick="destroysession()">
</form>
</body>
</html>
