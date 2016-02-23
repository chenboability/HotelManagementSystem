<?php
header("Content-type: text/html; charset=utf-8");


$id = $_POST['detid'];

if(!get_magic_quotes_gpc()){
$id = addslashes($id);
}

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");
//从数据库中删除物品信息
$query = "delete from item where Item_id = '".$id."'";	
$result = $db->query($query);
if($result){
	echo "<script>window.alert(\"成功删除物品记录!!!\"),location.href=\"warehouse_item.html\";</script>";
}else{
	echo "<script>window.alert(\"该物品存在出入库记录，无法删除物品记录，请重试！\"),location.href=\"warehouse_item.html\";</script>";
}

$db->close();
?>
