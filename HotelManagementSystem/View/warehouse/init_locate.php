<?php
header("Content-type: text/html; charset=utf-8");

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");

//查询物品位置，填充下拉框
$query = "select distinct Item_place from item";
$result = $db->query($query);
if($result->num_rows > 0){
	$list = array();
for($i = 0;$i<$result->num_rows;$i++){
$a = $result->fetch_assoc();
$Item_place_get = stripslashes($a['Item_place']);
$num = $i;
$list[$num] = $Item_place_get;
}
$lists = array("op"=>$list);
echo json_encode($lists);
}

$db->close();
?>