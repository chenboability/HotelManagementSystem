<?php
header("Content-type: text/html; charset=utf-8");

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");

//查询物品供应商，填充下拉框
$query = "select distinct Supplier_name from supplier";
$result = $db->query($query);
if($result->num_rows > 0){
	$list = array();
for($i = 0;$i<$result->num_rows;$i++){
$a = $result->fetch_assoc();
$Supplier_name_get = stripslashes($a['Supplier_name']);
$num = $i;
$list[$num] = $Supplier_name_get;
}
$lists = array("op"=>$list);
echo json_encode($lists);
}
$db->close();
?>