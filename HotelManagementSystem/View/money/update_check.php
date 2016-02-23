<?php
header("Content-type: text/html; charset=utf-8");

$id = $_POST['id'];
$type = $_POST['type'];
$dep = $_POST['dep'];
$sum = $_POST['sum'];

if(!get_magic_quotes_gpc()){
$id = addslashes($id);
$type = addslashes($type);
}

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");
//获取修改状态
if($type=='未审批')
$now = 0;
if($type=='不通过')
$now = 1;
if($type=='已发放')
$now = 2;
if($type=='未发放')
$now = 3;
//修改财务审批信息
$query = "update application set Sq_sp = '".$now."' where Sq_id = '".$id."'";
$result = $db->query($query);
//已发放，财务数据库添加支出信息
if($type=='已发放'){
	$Time = date('Y-m-d',time());
	$sum=-$sum;
	$insert = "insert into payments values(null,'".$Time."', '".$dep."', '".$sum."')";
    $result1 = $db->query($insert);
}
	

if($result){
	echo "<script>window.alert(\"成功进行财务审批修改！\"),location.href=\"money_check.html\";</script>";
}else{
	echo "<script>window.alert(\"财务审批修改失败，请重试！\"),location.href=\"money_check.html\";</script>";
}

$db->close();
?>
