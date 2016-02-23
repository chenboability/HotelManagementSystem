<html>
<head><meta http-equiv="refresh" content="3; url=http://localhost:8081/ccc/View/warehouse/warehouse_io.html">
<title> insert note! </title>
</head>
<body>

<?php
header("Content-type: text/html; charset=utf-8");

$Note_type = $_POST['type'];
$Item_name = $_POST['name'];
$Item_num = $_POST['num'];
$Item_price = $_POST['price'];
$Rental=$Item_num*$Item_price;
$Time = date('Y-m-d',time());
$Person_id ="陈渤";


if(!get_magic_quotes_gpc()){
$Note_type = addslashes($Note_type);
$Item_name = addslashes($Item_name);
$Item_num = addslashes($Item_num);
$Item_price = addslashes($Item_price);
$Rental = addslashes($Rental);
$Time = addslashes($Time);
$Person_id = addslashes($Person_id);
}

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");
//从数据库中查询物品id
$query = "select Item_id from item where Item_name = '".$Item_name."'";
$result = $db->query($query);
if($result->num_rows > 0){//物品存在，获取id
$a = $result->fetch_assoc();
$Item_id_get = stripslashes($a['Item_id']);
//判断类型
if($Note_type == "入库登记"){//入库
$query = "insert into note_in values(null,'".$Item_id_get."', '".$Item_name."', '".$Item_num."', '".$Item_price."', '".$Rental."', '".$Time."', '".$Person_id."')";
$result2 = $db->query($query);
//修改库存
$update = "update item set Item_count = Item_count + '".$Item_num."' where Item_id = '".$Item_id_get."'";
$result1 = $db->query($update);

//往财务添加支出信息
$Rental1=-$Rental;
$insert3 = "insert into payments values(null,'".$Time."', '后勤部', '".$Rental1."')";
 $result3 = $db->query($insert3);
	
	
if($result2&&$result1&&$result3){
	echo "<script>window.alert(\"成功入库！\"),location.href=\"warehouse_io.html\";</script>";
}else{
	echo "<script>window.alert(\"入库失败，请重试！\"),location.href=\"warehouse_io.html\";</script>";
}
}else{
//库存是否充足可以出库
$queryen = "select Item_count,Item_min_count from item where Item_name = '".$Item_name."'";
$resultq = $db->query($queryen);
$aq = $resultq->fetch_assoc();
$Item_count_get = stripslashes($aq['Item_count']);
$Item_min_count_get = stripslashes($aq['Item_min_count']);

if($Item_count_get>=$Item_num){//有余量
	if($Item_count_get - $Item_num <= $Item_min_count_get)
		echo "<script>window.alert(\"库存余量已在警戒线之下，请及时添加库存！\"),location.href=\"warehouse_io.html\";</script>";
	$query = "insert into note_out values(null,'".$Item_id_get."', '".$Item_name."', '".$Item_num."', '".$Item_price."', '".$Rental."', '".$Time."', '1')";
	$result2 = $db->query($query);
	//修改库存
	$update = "update item set Item_count = Item_count - '".$Item_num."' where Item_id = '".$Item_id_get."'";
	$result1 = $db->query($update);
	if($result2&&$result1){//成功出库
	echo "<script>window.alert(\"成功出库！\"),location.href=\"warehouse_io.html\";</script>";
	}else{
	echo "<script>window.alert(\"出库失败，请重试！\"),location.href=\"warehouse_io.html\";</script>";
	}
}else{//余量不足
	echo "<script>window.alert(\"库存不足，无法出库！\"),location.href=\"warehouse_io.html\";</script>";
}
}
}else{
	echo "<script>window.alert(\"物品不存在！\"),location.href=\"warehouse_io.html\";</script>";
}




$db->close();
?>

</body>
</html>