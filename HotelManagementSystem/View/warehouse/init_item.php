<?php
header("Content-type: text/html; charset=utf-8");

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");

//查询物品名称
$query = "select distinct Item_name from item";
$result = $db->query($query);
if($result->num_rows > 0){
for($i = 0;$i<$result->num_rows;$i++){
$a = $result->fetch_assoc();
$Item_name_get = stripslashes($a['Item_name']);
echo $Item_name_get."</br>	";
}
}
echo "</br>	";

//查询物品位置
$query = "select distinct Item_place from item";
$result = $db->query($query);
if($result->num_rows > 0){
for($i = 0;$i<$result->num_rows;$i++){
$a = $result->fetch_assoc();
$Item_place_get = stripslashes($a['Item_place']);
echo $Item_place_get."</br>	";
}
}
echo "</br>	";

//查询物品供应商
$query = "select distinct Supplier_name from supplier";
$result = $db->query($query);
if($result->num_rows > 0){
for($i = 0;$i<$result->num_rows;$i++){
$a = $result->fetch_assoc();
$Supplier_name_get = stripslashes($a['Supplier_name']);
echo $Supplier_name_get."</br>	";
}
}
echo "</br>	";
$db->close();
?>

