<?php
include "conn.php";
session_start();

if(!isset($_SESSION['roll']))
{
	session_destroy();
	header("location:login.php");
	exit();
}	

		$r=$_SESSION['roll'];
		$answer=$_POST["answer"];

		$sql="select * from detail where ROLL=$r";
		$result=mysqli_query($conn,$sql);
		$row= mysqli_fetch_array($result);
		$n=$row['SCORE'];
		$totalscore=$row['TOTALSCORE'];
		$totalhit=$row['TOTALHIT'];
		$hit=$row['HIT'];
		$qname="select * from image where SCORE='$n'";
		$imgrslt=mysqli_query($conn,$qname);
		$rowtwo=mysqli_fetch_array($imgrslt);
		$imgpoint=$rowtwo['IMGPOINT'];
		$link="media/".$rowtwo['IMGNAME'].".jpg";
		$_SESSION['link']=$link;
		if(($answer==$rowtwo['IMGNAME'])&&isset($_POST['answer'])&&isset($_POST['check']))
		{

			switch($hit){
				case $hit>=0&&$hit<=5:
				 $totalscore=$totalscore+($imgpoint-(0*$imgpoint)/10);
				 break;
				case $hit>5&&$hit<=10:
				 $totalscore=$totalscore+($imgpoint-(1*$imgpoint)/10);
				 break;
				case $hit>10&&$hit<=20:
				 $totalscore=$totalscore+($imgpoint-(2*$imgpoint)/10);
				 break;
				case $hit>20&&$hit<=30:
				 $totalscore=$totalscore+($imgpoint-(3*$imgpoint)/10);
				 break;
				case $hit>30&&$hit<=40:
				 $totalscore=$totalscore+($imgpoint-(4*$imgpoint)/10);
				 break;
				case $hit>40&&$hit<=50:
				 $totalscore=$totalscore+($imgpoint-(5*$imgpoint)/10);
				 break;
				case $hit>50&&$hit<=60:
				 $totalscore=$totalscore+($imgpoint-(6*$imgpoint)/10);
				 break;
				case $hit>60&&$hit<=70:
				 $totalscore=$totalscore+($imgpoint-(7*$imgpoint)/10);
				 break;
				case $hit>70&&$hit<=80:
				 $totalscore=$totalscore+($imgpoint-(8*$imgpoint)/10);
				 break;
				case $hit>80&&$hit<=90:
				 $totalscore=$totalscore+($imgpoint-(9*$imgpoint)/10);
				 break;
				 default:
				 $totalscore=$totalscore;
			}

			$hit=0;

			$n=$n+1;
			$sql3="update detail set SCORE='$n',TOTALSCORE='$totalscore',HIT='$hit' where ROLL='$r'";
			mysqli_query($conn,$sql3);
		$qname="select * from image where SCORE='$n'";
		$imgrslt=mysqli_query($conn,$qname);
		$rowtwo=mysqli_fetch_array($imgrslt);
		$link="media/".$rowtwo['IMGNAME'].".jpg";
		$_SESSION['link']=$link;
		$hint=$rowtwo['HINT'];
		$hint2=$rowtwo['HINT2'];
		}
		else
		{
			$hit+=1;
			$totalhit+=1;
			$sql4="update detail set TOTALHIT=$totalhit,HIT=$hit where ROLL=$r";
			mysqli_query($conn,$sql4);
		    $sql5="select HINT,HINT2 from image where SCORE=$n";
		    $myhints=mysqli_query($conn,$sql5);
		    $hints=mysqli_fetch_array($myhints);
		    $hint=$hints['HINT'];
		    $hint2=$hints['HINT2'];
			if($hit>=40)
			{
				echo nl2br("Your First Hint is : $hint\n");
			}
			if($hit>=80)
			{
				echo nl2br("Your Second Hint is : $hint2\n");
			}
		}
	
	echo "score is : $totalscore";
	//session_destroy();
if($totalhit<$n||$totalhit>3000)
{
	$dissql="update detail set DISQ=1 where ROLL='$r'";
	mysqli_query($conn,$dissql);
	unset($_SESSION['roll']);
	unset($_SESSION['link']);
	session_destroy();
	header("location:disql.html");

}

if(isset($_POST['logout']))
{
	unset($_SESSION['roll']);
	unset($_SESSION['link']);
	session_destroy();
	header("location:login.php");
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Start Playing</title>
</head>
<body ><!onunload="destroysession()">
<h1>Find one word answer for the given picture :</h1><br><br>
<form method=post action="container2.php">
<! image code was here >

 <img src="<?php 
    if(isset($_SESSION['link'])||isset($_POST['check']))  
      echo $_SESSION['link'];
	  unset($_SESSION['link']);
	  ?> ">

<br/><br/>
<label for="answer">ANSWER : </label>
<input type="text" name="answer" id="answer"value="">
<br/><br/>
<input type="submit" name="check" value="check" > 
<input type="submit" name="logout" value="Logout" > 
</form>
</body>
</html>

