<?php

$mysql_server_name = "localhost";
$mysql_username = "root";
$mysql_password = "";
$mysql_database = "design";

   $account=$_COOKIE['account'];
   
   $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
   $sql="select  `dep` from `design`.`employee` where  `account`='$account'";
   mysqli_query ($conn,"set names 'utf8'");
   mysqli_select_db($conn,$mysql_database);
   $result1=mysqli_query($conn,$sql);
   
   if($result1!=""){
	    $row1=mysqli_fetch_assoc($result1);
		$dep1=$row1['dep'];
		//echo $dep1;
		if($dep1=="餐饮部")//餐饮
		{
			echo "<script>location.href=\"../View/food/food.html\";</script>";
		}
		else if($dep1=="客房部"){
			echo "<script>location.href=\"../huangzeqin/room/room.html\";</script>";
		}
		else if($dep1=="财务部"){
			echo "<script>location.href=\"../View/money/money_check.html\";</script>";
		}
		else if($dep1=="后勤部"){
			echo "<script>location.href=\"../View/warehouse/warehouse_io.html\";</script>";
		}
   }
   
?>