<head><meta http-equiv="refresh" content="3; url=http://localhost:8080/huangzeqin/user/user_center.html">
<?php
       header('Content-type: text/html; charset=utf-8');

       $mysql_server_name = "localhost";
       $mysql_username = "root";
       $mysql_password = "";
       $mysql_database = "design";

       $account=$_POST['register_id'];
       $password=$_POST['register_password'];
       $password2=$_POST['register_password2'];
       $name=$_POST['register_name'];
       $sex=$_POST['register_sex'];
       $birth=$_POST['register_bth'];
       $email=$_POST['register_email'];
       $phone=$_POST['register_phone'];
       $date=$_POST['register_date'];
       $dep=$_POST['register_department'];
       $job=$_POST['register_job'];
       $card=$_POST['register_card'];
	   
	   if($dep=="1"){
		   $dep="餐饮部";
	   }else if($dep=="2"){
		   $dep="客房部";
	   }else if($dep=="3"){
		   $dep="财务部";
	   }else if($dep=="4"){
		   $dep="后勤部";
	   }

       if(isset($_POST['register'])){
            if($password!=$password2){
                echo "<script>window.alert(\"密码输入不正确！请重新试一次！\"),location.href=\"../huangzeqin/login/register.html\";</script>";

            }
            else{
                $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
                $sql="INSERT INTO `design`.`employee` (`account`, `password`,`name`, `sex`,
                `birth`,`date`,`dep`,`job`,`card`,`email`,`phone`)
                VALUES ('$account','$password', '$name', '$sex',
                '$birth', '$date','$dep','$job', '$card', '$email','$phone')";
                mysqli_query ($conn,"set names 'utf8'");
                mysqli_select_db($conn,$mysql_database);
                $result=mysqli_query($conn,$sql);
                if($result==""){
                    echo "<script>window.alert(\"注册失败了！请重新试一次！\"),location.href=\"../huangzeqin/login/register.html\";</script>";
                }
                else{
                    echo "<script>window.alert(\"恭喜你！注册成功了！\"),location.href=\"../huangzeqin/login/login.html\";</script>";
                }
            }
       }
?>
