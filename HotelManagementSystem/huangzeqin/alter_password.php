<?php
header('Content-type: text/html; charset=utf-8');

$mysql_server_name = "localhost";
$mysql_username = "root";
$mysql_password = "";
$mysql_database = "design";

$password_old=$_POST['oldpw'];
$password_new=$_POST['new1pw'];
$password_new2=$_POST['new2pw'];

$account=$_COOKIE['account'];

$conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
$sql="select `password` from `design`.`employee` where `account`='$account'";

mysqli_query ($conn,"set names 'utf8'");
mysqli_select_db($conn,$mysql_database);
$result=mysqli_query($conn,$sql);

if($result->num_rows>0){
    $row=mysqli_fetch_assoc($result);
    $password=$row['password'];
    if($password_old!=$password){
        echo "<script>window.alert(\"你输入的原密码错啦！".$account."请确认后再输入！\"),location.href=\"../huangzeqin/user/user_password.html\";</script>";
    }else{
        if($password_new!=$password_new2){
            echo "<script>window.alert(\"你输入的新密码不一致错啦！".$account."请确认后再输入！\"),location.href=\"../huangzeqin/user/user_password.html\";</script>";
        }else{
           $sql1="UPDATE `design`.`employee` SET `password`='$password_new' where `account`='$account'";
           mysqli_query ($conn,"set names 'utf8'");
           mysqli_select_db($conn,$mysql_database);
           $res=mysqli_query($conn,$sql1);
           if($res==""){
               echo "<script>window.alert(\"更改密码发生意外错误！".$account."请再试一次！\"),location.href=\"../huangzeqin/user/user_password.html\";</script>";
           }else{
			   //setcookie("account",$account,time()-1); //注销cookie
               echo "<script>window.alert(\"恭喜你".$account."更改密码成功了！\"),location.href=\"../huangzeqin/user/user_password.html\";</script>";

           }
        }
    }
}else{
    echo "<script>window.alert(\"查不到您".$account."的信息！联系一下老板！一定是他干的！\"),location.href=\"../huangzeqin/user/user_password.html\";</script>";
}
?>