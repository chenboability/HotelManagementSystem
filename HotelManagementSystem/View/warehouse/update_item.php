<?php
header("Content-type: text/html; charset=utf-8");


$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$standard = $_POST['standard'];
$dw = $_POST['dw'];
$date = $_POST['date'];
$lnum = $_POST['lnum'];
$locate = $_POST['locate'];
$supply = $_POST['supply'];

if(!get_magic_quotes_gpc()){
$id = addslashes($id);
$name = addslashes($name);
$price = addslashes($price);
$standard = addslashes($standard);
$dw = addslashes($dw);
$date = addslashes($date);
$lnum = addslashes($lnum);
$locate = addslashes($locate);
$supply = addslashes($supply);
}

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");
//更新物品信息
$query = "update item set Item_price = '".$price."' , Item_size='".$standard."' , Item_validity = '".$date."' ,Item_unit = '".$dw."',Item_place = '".$locate."' , Item_min_count = '".$lnum."' where Item_id = '".$id."'";
	
$result = $db->query($query);

if($result){
	echo "<script>window.alert(\"成功修改物品记录！\"),location.href=\"warehouse_item.html\";</script>";
}else{
	echo "<script>window.alert(\"修改物品记录失败，请重试！\"),location.href=\"warehouse_item.html\";</script>";
}

$db->close();
?>
