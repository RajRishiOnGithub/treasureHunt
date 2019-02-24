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
		$answer='';
		if(isset($_POST['answer']))
		$answer=mysqli_real_escape_string($conn,$_POST['answer']);

		$sql="select * from detail where ROLL=$r";
		$result=mysqli_query($conn,$sql);
		$row= mysqli_fetch_array($result);
		$n=$row['SCORE'];
		$totalscore=$row['TOTALSCORE'];
?>


<style type="text/css">
	.font1{
		font-style: italic;
		color: #00ff00;
	}
	.font2{
		font-style: italic;
		color: #ffff00;
	}
	.font3{
		font-style: italic;
		color: #ff0000;
	}
	.scorefont{
		font-family: 'Allerta Stencil';
	}

</style>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Start Playing</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Allerta Stencil' rel='stylesheet'>
</head>
 <body background="bluetile.jpg" ><!onunload="destroysession()">

<form method=post action="">
<! image code was here >
<br><br>
<div >
 <div style="float: right; color: white; margin-right: 5%;"> 
 <h3 class="scorefont">SCORE  :<?php echo $totalscore; ?></h3>
 <?php
 if($n<=20)
 {
 ?>
 	<p><h3 class="scorefont">LEVEL :</h3><h5 class="font1" >EASY</h5></p>
<?php
 }
if($n>20&&$n<=50)
 {
 ?>
 	<h3 class="scorefont">LEVEL :<h5 class="font2" >MEDIUM</h5></h3>
<?php
 }
 if($n>50&&$n<=100)
 {
 ?>
 	<h3 class="scorefont">LEVEL :<h5 class="font3" >HARD</h5></h3>
<?php
 }
	?></div>
 

<?php


		$totalhit=$row['TOTALHIT'];
		$hit=$row['HIT'];
		$qname="select * from image where SCORE='$n'";
		$imgrslt=mysqli_query($conn,$qname);
		$rowtwo=mysqli_fetch_array($imgrslt);
		$imgpoint=$rowtwo['IMGPOINT'];
		$flagset=$rowtwo['FLAG'];
		$link=$rowtwo['IMGNAME'];
		//$link="media/".$rowtwo['IMGNAME'].".jpg";
		//$_SESSION['link']=$link;

?>

<img style="border: 5px solid white; margin-left: 22%;height: 422px;width:728px;"  
 src="<?php
      echo $link;
   ?>
      ">
	  
</div>
<br/><br/>
<div style="margin-left: 350px;">
<label style="height: 30px;width: 100px;color: white" for="answer">ANSWER : </label>
<input type="text" name="answer" id="answer"value="" style="height: 30px;width:400px ;"></div>
<br/>
<div style="margin-left: 500px;">
<input class="btn btn-success" type="submit" style="height:40px;width:100px;"name="check" value="check">
<input class="btn btn-danger" type="submit" style="height: 40px;width: 100px;" name="logout" value="Logout" > 
</div>
</form>
</body>
</html>

<?php
		if(($answer==$rowtwo['ANSWER'])&&isset($_POST['answer'])&&isset($_POST['check']))
		{

			if($flagset<5)
			{
				$totalscore=$totalscore+$imgpoint+1;
				$flagset+=1;
				$imgpoint-=1;
				$sql6="update image set IMGPOINT='$imgpoint',FLAG='$flagset' where SCORE='$n'";
				mysqli_query($conn,$sql6);
			}
			else
			{
				switch($hit){
					case $hit>=0&&$hit<=10:
					 $totalscore=$totalscore+($imgpoint-(0*$imgpoint)/10);
					 break;
					case $hit>10&&$hit<=20:
					 $totalscore=$totalscore+($imgpoint-(1*$imgpoint)/10);
					 break;
					case $hit>20&&$hit<=40:
					 $totalscore=$totalscore+($imgpoint-(2*$imgpoint)/10);
					 break;
					case $hit>40&&$hit<=60:
					 $totalscore=$totalscore+($imgpoint-(3*$imgpoint)/10);
					 break;
					case $hit>60&&$hit<=80:
					 $totalscore=$totalscore+($imgpoint-(4*$imgpoint)/10);
					 break;
					case $hit>80&&$hit<=100:
					 $totalscore=$totalscore+($imgpoint-(5*$imgpoint)/10);
					 break;
					case $hit>100&&$hit<=120:
					 $totalscore=$totalscore+($imgpoint-(6*$imgpoint)/10);
					 break;
					case $hit>120&&$hit<=140:
					 $totalscore=$totalscore+($imgpoint-(7*$imgpoint)/10);
					 break;
					case $hit>140&&$hit<=160:
					 $totalscore=$totalscore+($imgpoint-(8*$imgpoint)/10);
					 break;
					case $hit>160&&$hit<=180:
					 $totalscore=$totalscore+($imgpoint-(9*$imgpoint)/10);
					 break;
					 default:
					 $totalscore=$totalscore;
				}
			}

			$hit=0;

			$n=$n+1;
			$sql3="update detail set SCORE='$n',TOTALSCORE='$totalscore',HIT='$hit',UT=now() where ROLL='$r'";
			mysqli_query($conn,$sql3);
			$qname="select * from image where SCORE='$n'";
			$imgrslt=mysqli_query($conn,$qname);
			$rowtwo=mysqli_fetch_array($imgrslt);
			$link=$rowtwo['IMGNAME'];
			//$link="media/".$rowtwo['IMGNAME'].".jpg";
			//$_SESSION['link']=$link;
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
		   
	//session_destroy();
			if($totalhit>4000)
			{
				 ?><h1 style="color: red;">Danger Zone u only have 2000 hits left</h1> <?php 
			}
			if($hit>=100)
			{
				 ?><div style="background-color: white;  font-size: 40px; text-align: center;" >First Hint: <?php  echo $hint;  ?> </div> <?php
			}
			if($hit>=200)
			{
				?><div style="background-color: white; font-size: 40px; text-align: center;" > Second Hint : <?php  echo  
				$hint2;  ?> </div> <?php
			}
		}
	
	


if($totalhit<$n||$totalhit>8000)
{
	$dissql="update detail set DISQ=1 where ROLL='$r'";
	mysqli_query($conn,$dissql);
	unset($_SESSION['roll']);
	//unset($_SESSION['link']);
	session_destroy();
	header("location:disql.html");

}

if(isset($_POST['logout']))
{
	unset($_SESSION['roll']);
	//unset($_SESSION['link']);
	session_destroy();
	header("location:login.php");
}
if(isset($_POST['check']))
header("location:container2.php");
?>

