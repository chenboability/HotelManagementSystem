<?php
header("Content-type: text/html; charset=utf-8");

$name = $_REQUEST['name'];
$day = $_REQUEST['day'];
$type = $_REQUEST['type'];
$position = $_REQUEST['position'];


if(!get_magic_quotes_gpc()){
$type = addslashes($type);
$name = addslashes($name);
$day = addslashes($day);
$position = addslashes($position);
}

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");
if($type == 1){//某时间之前
if($name=="全部"){//默认全部
	if($position=="全部"){//默认位置全部
		if($day==""){//默认有效期时间
			$query = "select * from item ";
		}else{//选择有效期时间
			$query = "select * from item where Item_validity < '".$day."'";
		}		
	}else{//选择位置
		if($day==""){
			$query = "select * from item where Item_place = '".$position."'";
		}else{
			$query = "select * from item where Item_place = '".$position."' and Item_validity < '".$day."'";
		}	
	}
}else{//选择物品名称
	if($position=="全部"){
		if($day==""){
			$query = "select * from item where Item_name = '".$name."'";
		}else{
			$query = "select * from item where Item_name = '".$name."' and Item_validity < '".$day."'";
		}		
	}else{
		if($day==""){
			$query = "select * from item where Item_name = '".$name."' and Item_place = '".$position."'";
		}else{
			$query = "select * from item where Item_name = '".$name."' and Item_place = '".$position."' and Item_validity < '".$day."'";
		}	
	}
}


}else{//某时间之后
if($name=="全部"){
	if($position=="全部"){
		if($day==""){
			$query = "select * from item ";
		}else{
			$query = "select * from item where Item_validity > '".$day."'";
		}		
	}else{
		if($day==""){
			$query = "select * from item where Item_place = '".$position."'";
		}else{
			$query = "select * from item where Item_place = '".$position."' and Item_validity > '".$day."'";
		}	
	}
}else{
	if($position=="全部"){
		if($day==""){
			$query = "select * from item where Item_name = '".$name."'";
		}else{
			$query = "select * from item where Item_name = '".$name."' and Item_validity > '".$day."'";
		}		
	}else{
		if($day==""){
			$query = "select * from item where Item_name = '".$name."' and Item_place = '".$position."'";
		}else{
			$query = "select * from item where Item_name = '".$name."' and Item_place = '".$position."' and Item_validity > '".$day."'";
		}	
	}
}

}
$result = $db->query($query);
 	
	if($result->num_rows > 0){
	for($i = 0;$i<$result->num_rows;$i++){
		$a = $result->fetch_assoc();
		$Item_id_get = stripslashes($a['Item_id']);
		$Item_name_get = stripslashes($a['Item_name']);
		$Item_price_get = stripslashes($a['Item_price']);
		$Item_size_get = stripslashes($a['Item_size']);
		$Item_validity_get = stripslashes($a['Item_validity']);
		$Item_count_get = stripslashes($a['Item_count']);
		$Item_min_count_get = stripslashes($a['Item_min_count']);
		$Item_count_get = stripslashes($a['Item_count']);
		$Item_unit_get = stripslashes($a['Item_unit']);
		$Item_place_get = stripslashes($a['Item_place']);
		$Supplier_id_get = stripslashes($a['Supplier_id']);
		$query1 = "select Supplier_name from supplier where Supplier_id = '".$Supplier_id_get."'";
		$result1 = $db->query($query1);
		$a1 = $result1->fetch_assoc();
		$Supplier_name_get = stripslashes($a1['Supplier_name']);
		
				
		$l=array("id"=>$Item_id_get,"name"=>$Item_name_get,"price"=>$Item_price_get,"size"=>$Item_size_get,"unit"=>$Item_unit_get,"validity"=>$Item_validity_get,"min"=>$Item_min_count_get,"count"=>$Item_count_get,"place"=>$Item_place_get,"supplier"=>$Supplier_name_get); 
        $list[$i] = $l;
	}
	
		$lists = array("op"=>$list);
        echo json_encode($lists);
	}
$db->close();
?>

