<html>
<head>
<title> insert Supplier! </title>
</head>
<body>

<?php
header("Content-type: text/html; charset=utf-8");

$Supplier_name = $_POST['sup'];
$Supplier_pricipal = $_POST['name'];
$Supplier_address = $_POST['add'];
$Supplier_phone = $_POST['tel'];

if(!get_magic_quotes_gpc()){
$Supplier_name = addslashes($Supplier_name);
$Supplier_pricipal = addslashes($Supplier_pricipal);
$Supplier_address = addslashes($Supplier_address);
$Supplier_phone = addslashes($Supplier_phone);
}

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");
//往数据库插入供应商信息
$query = "insert into supplier values(null,'".$Supplier_name."', '".$Supplier_pricipal."', '".$Supplier_address."', '".$Supplier_phone."')";
$result = $db->query($query);

if($result){
	echo "<script>window.alert(\"成功添加供应商！\"),location.href=\"warehouse_supply.html\";</script>";
}else{
	echo "<script>window.alert(\"添加供应商失败，请重试！\"),location.href=\"warehouse_supply.html\";</script>";
}

$db->close();
?>

</body>
</html>