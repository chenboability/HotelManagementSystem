<?php
header("Content-type: text/html; charset=utf-8");

$id = $_POST['detid'];

if(!get_magic_quotes_gpc()){
$id = addslashes($id);
}

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");
//从数据库中删除供应商记录
$query = "delete from supplier where Supplier_id = '".$id."'";	
$result = $db->query($query);
if($result){
	echo "<script>window.alert(\"成功删除供应商记录!!!\"),location.href=\"warehouse_supply.html\";</script>";
}else{
	echo "<script>window.alert(\"该供应商存在出入库记录，无法删除供应商记录，请重试！\"),location.href=\"warehouse_supply.html\";</script>";
}

$db->close();
?>
