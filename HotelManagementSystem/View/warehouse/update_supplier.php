<?php
header("Content-type: text/html; charset=utf-8");


$id = $_POST['id'];
$name = $_POST['name'];
$people = $_POST['people'];
$tel = $_POST['tel'];
$add = $_POST['add'];


if(!get_magic_quotes_gpc()){
$id = addslashes($id);
$name = addslashes($name);
$people = addslashes($people);
$tel = addslashes($tel);
$add = addslashes($add);
}

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");

//更新供应商信息
$query = "update supplier set Supplier_name = '".$name."',Supplier_pricipal = '".$people."' ,Supplier_address = '".$add."' , Supplier_phone='".$tel."' where Supplier_id = '".$id."'";	
$result = $db->query($query);

if($result){
	echo "<script>window.alert(\"成功修改供应商记录！\"),location.href=\"warehouse_supply.html\";</script>";
}else{
	echo "<script>window.alert(\"修改供应商记录失败，请重试！\"),location.href=\"warehouse_supply.html\";</script>";
}

$db->close();
?>
