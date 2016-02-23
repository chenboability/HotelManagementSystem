
<?php
      header('Content-type: text/html; charset=utf-8');

      $mysql_server_name = "localhost";
      $mysql_username = "root";
      $mysql_password = "";
      $mysql_database = "design";

      $account=$_POST['login_id'];
      $password=$_POST['login_password'];

      $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
      $sql="select `account`,`password` from `design`.`employee` where `account`='$account'";
      mysqli_query ($conn,"set names 'utf8'");
      mysqli_select_db($conn,$mysql_database);
      $result=mysqli_query($conn,$sql);
      if($result->num_rows<=0){
          echo "<script>window.alert(\"您还没有注册过喔。请先去注册吧！\"),location.href=\"../huangzeqin/login/register.html\";</script>";
      }else{
          $row=mysqli_fetch_assoc($result);
          if($account==$row['account']&&$password==$row['password']){
              setcookie("account",$account,time()+7200);
              echo "<script>window.alert(\"登陆成功！\")</script>";

          }else{
              echo "<script>window.alert(\"账号或者密码输入错误！\"),location.href=\"../huangzeqin/login/login.html\";</script>";
          }
		  
   $sql1="select  `dep` from `design`.`employee` where  `account`='$account'";
   mysqli_query ($conn,"set names 'utf8'");
   mysqli_select_db($conn,$mysql_database);
   $result1=mysqli_query($conn,$sql1);
   
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
      }
?>