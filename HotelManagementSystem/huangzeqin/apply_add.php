<?php
header('Content-type: text/html; charset=utf-8');

$mysql_server_name = "localhost";
$mysql_username = "root";
$mysql_password = "";
$mysql_database = "design";

$money=$_POST['money'];
$reason=$_POST['reason'];
$time = time();
$apply_time=date("Y-m-d",$time);//申请日期
$state=0;

$account=$_COOKIE['account'];

//$conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);

//$conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);

if(isset($_POST['apply_btn'])){
    $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
	 $sql1="select  `dep`  from `design`.`employee` where  `account`='$account'";


   mysqli_query ($conn,"set names 'utf8'");

   mysqli_select_db($conn,$mysql_database);
   $result1=mysqli_query($conn,$sql1);
   if($result1!=""){
	   $row1=mysqli_fetch_assoc($result1);
		$dep=$row1['dep'];
	   
    //$sql = "INSERT INTO `design`.`apply` (`time`,`account`,`money`,`reason`,`state`) VALUES ('$apply_time','$account','$money','$reason','$state')";
	$sql = "INSERT INTO `design`.`application` (`Sq_bm`,`Sq_user`,`Sq_rq`,`Sq_ly`,`Sq_je`,`Sq_sp`) 
	                       VALUES ('$dep','$account','$apply_time','$reason','$money','$state')";
						   
    mysqli_query ($conn,"set names 'utf8'");
    mysqli_select_db($conn,$mysql_database);
    $result=mysqli_query($conn,$sql);
    if($result==""){
        echo "<script>window.alert(\"提交失败！请重新尝试\"),location.href=\"../huangzeqin/user/user_money.html\";</script>";
    }else{
        echo "<script>window.alert(\"提交成功！\"),location.href=\"../huangzeqin/user/user_money.html\";</script>";
    }
}}
?>