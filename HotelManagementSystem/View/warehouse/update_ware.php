<?php
header("Content-type: text/html; charset=utf-8");

$id = $_POST['id'];
$type = $_POST['type'];
$name = $_POST['name'];
$num = $_POST['num'];
$price = $_POST['price'];
$sum = $num*$price;
$date = $_POST['date'];
$person = $_POST['person'];


if(!get_magic_quotes_gpc()){
$id = addslashes($id);
$type = addslashes($type);
$name = addslashes($name);
$num = addslashes($num);
$price = addslashes($price);
$sum = addslashes($sum);
$date = addslashes($date);
$person = addslashes($person);
}

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");
//入库信息
if($type=='入库'){
	//查找原来的记录的入库数量
	$c = "select Item_num from note_in where Note_in_id = '".$id."'";
	$r = $db->query($c);
	if($r->num_rows > 0){
		$a = $r->fetch_assoc();
		$passNum = stripslashes($a['Item_num']);
	}
	if($passNum!=$num){//原来的记录的入库数量和修改的不一致
		$cha = $num -$passNum;//数量差
		$que = "select Item_id from item where Item_name = '".$name."'";
	$res = $db->query($que);
	if($res->num_rows > 0){//货物存在，获取id
	$a1 = $res->fetch_assoc();
	$Item_id_get = stripslashes($a1['Item_id']);}
	//修改库存，在原来库存加上数量差
    $update = "update item set Item_count = Item_count + '".$cha."' where Item_id = '".$Item_id_get."'";
    $result1 = $db->query($update);
	}
//更新入库记录
$query = "update note_in set Item_name = '".$name."',Item_num = '".$num."' ,Item_price = '".$price."' , Rental='".$sum."' , Time_in = '".$date."' , Person_id = '".$person."' where Note_in_id = '".$id."'";
}else{//出库信息
//查找原来的记录的出库数量
	$c = "select Item_num from note_out where Note_out_id = '".$id."'";
	$r = $db->query($c);
	if($r->num_rows > 0){
		$a = $r->fetch_assoc();
		$passNum = stripslashes($a['Item_num']);
	}
	if($passNum!=$num){//原来的记录的出库数量和修改的不一致
		$cha = $passNum-$num ;//数量差
		$que = "select Item_id from item where Item_name = '".$name."'";
	$res = $db->query($que);
	if($res->num_rows > 0){//货物存在，获取id
	$a1 = $res->fetch_assoc();
	$Item_id_get = stripslashes($a1['Item_id']);}

	$ifs = "select Item_count from item where Item_name = '".$name."'";
	//修改库存，在原来库存加上数量差
    $update = "update item set Item_count = Item_count + '".$cha."' where Item_id = '".$Item_id_get."'";
    $result1 = $db->query($update);
	}
	//更新出库记录
$query = "update note_out set Item_name = '".$name."',Item_num = '".$num."' ,Item_price = '".$price."' , Rental='".$sum."' , Time_out = '".$date."' , Person_id = '".$person."' where Note_out_id = '".$id."'";
}	
$result = $db->query($query);

if($result){
	echo "<script>window.alert(\"成功修改记录！\"),location.href=\"warehouse_io.html\";</script>";
}else{
	echo "<script>window.alert(\"修改记录失败，请重试！\"),location.href=\"warehouse_io.html\";</script>";
}

$db->close();
?>
