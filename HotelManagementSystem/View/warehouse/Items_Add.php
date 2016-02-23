<html>
<head><meta http-equiv="refresh" content="3; url=http://localhost:8081/ccc/View/warehouse/warehouse_item.html">
<title> insert Items </title>
</head>
<?php
header("Content-type: text/html; charset=utf-8");

$Item_name = $_POST['name'];
$Item_price = $_POST['price'];
$Item_size = $_POST['standard'];
$Item_validity = $_POST['date'];
$Item_min_count = $_POST['lnum'];
$Item_unit = $_POST['dw'];
$Item_place = $_POST['locate'];
$Supplier_name = $_POST['supply'];


if(!get_magic_quotes_gpc()){
$Item_name = addslashes($Item_name);
$Item_price = addslashes($Item_price);
$Item_size = addslashes($Item_size);
$Item_validity = addslashes($Item_validity);
$Item_min_count = addslashes($Item_min_count);
$Item_unit = addslashes($Item_unit);
$Item_place = addslashes($Item_place);
$Supplier_name = addslashes($Supplier_name);
}

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");
//从supplier查询供应商id
$query = "select Supplier_id from supplier where Supplier_name = '".$Supplier_name."'";
$result = $db->query($query);
$a = $result->fetch_assoc();
$Supplier_id = stripslashes($a['Supplier_id']);
//往item表中插入物品信息（Item_name有唯一约束，当Item_name名字一样时，无法插入）
$insert = "insert into item values(null,'".$Item_name."', '".$Item_price."', '".$Item_size."', '".$Item_validity."', 0 , '".$Item_min_count."', '".$Item_unit."', '".$Item_place."', '".$Supplier_id."')";
$result1 = $db->query($insert);

if($result1){
	echo "<script>window.alert(\"成功添加物品！\"),location.href=\"warehouse_item.html\";</script>";	
}else{
	echo "<script>window.alert(\"添加物品失败，该物品已存在，请重试！\"),location.href=\"warehouse_item.html\";</script>";
}

$db->close();
?>
</body>
</html>