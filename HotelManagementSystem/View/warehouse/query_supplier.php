<?php
header("Content-type: text/html; charset=utf-8");

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");
//查询供应商记录
	$query = "select * from supplier";

	$result = $db->query($query);
 	
	if($result->num_rows > 0){
	for($i = 0;$i<$result->num_rows;$i++){
		$a = $result->fetch_assoc();
		$Supplier_id = stripslashes($a['Supplier_id']);
		$Supplier_name = stripslashes($a['Supplier_name']);
		$Supplier_pricipal = stripslashes($a['Supplier_pricipal']);
		$Supplier_address = stripslashes($a['Supplier_address']);
		$Supplier_phone = stripslashes($a['Supplier_phone']);
					
		$l=array("id"=>$Supplier_id,"name"=>$Supplier_name,"pricipal"=>$Supplier_pricipal,"adderss"=>$Supplier_address,"phone"=>$Supplier_phone); 
        $list[$i] = $l;
	}
	
		$lists = array("op"=>$list);
        echo json_encode($lists);
	}
$db->close();
?>

