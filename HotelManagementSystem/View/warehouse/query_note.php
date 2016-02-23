<?php
header("Content-type: text/html; charset=utf-8");

$type = $_REQUEST['type'];
$name = $_REQUEST['name'];
$day = $_REQUEST['day'];

if(!get_magic_quotes_gpc()){
$type = addslashes($type);
$name = addslashes($name);
$day = addslashes($day);
}


$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");

if($type == 1){//入库
	if($name=="全部"){//默认全部
		if($day==""){//默认时间
			$query = "select * from note_in";
		}else{//选择时间
			$query = "select * from note_in where Time_in = '".$day."'";
		}	
	}else{//选择物品
		if($day==""){
			$query = "select * from note_in where Item_name = '".$name."'";
		}else{
			$query = "select * from note_in where Item_name = '".$name."' and Time_in = '".$day."'";
		}
	}
	
	
	$result = $db->query($query);
	if($result->num_rows > 0){
	for($i = 0;$i<$result->num_rows;$i++){
		$a = $result->fetch_assoc();
		$Note_in_id_get = stripslashes($a['Note_in_id']);
		$Note_type = "入库";
		$Item_name_get = stripslashes($a['Item_name']);
		$Item_num_get = stripslashes($a['Item_num']);
		$Item_price_get = stripslashes($a['Item_price']);
		$Rental_get = stripslashes($a['Rental']);
		$Time_in_get = stripslashes($a['Time_in']);
		$Person_id_get = stripslashes($a['Person_id']);
	
    	$l=array("id"=>$Note_in_id_get,"type"=>$Note_type,"name"=>$Item_name_get,"num"=>$Item_num_get,"price"=>$Item_price_get,"rental"=>$Rental_get,"time"=>$Time_in_get,"person"=>$Person_id_get); 
        $list[$i] = $l;
	}
	 $lists = array("op"=>$list);
     echo json_encode($lists);
	}
	
}else{//出库

	if($name=="全部"){//默认全部
		if($day==""){//默认时间
			$query = "select * from note_out";
		}else{//选择时间
			$query = "select * from note_out where Time_out = '".$day."'";
		}	
	}else{//选择物品
		if($day==""){
			$query = "select * from note_out where Item_name = '".$name."'";
		}else{
			$query = "select * from note_out where Item_name = '".$name."' and Time_out = '".$day."'";
		}
	}
	
	$result = $db->query($query);
	if($result->num_rows > 0){
	for($i = 0;$i<$result->num_rows;$i++){
		$a = $result->fetch_assoc();
		$Note_out_id_get = stripslashes($a['Note_out_id']);
		$Note_type = "出库";
		$Item_name_get = stripslashes($a['Item_name']);
		$Item_num_get = stripslashes($a['Item_num']);
		$Item_price_get = stripslashes($a['Item_price']);
		$Rental_get = stripslashes($a['Rental']);
		$Time_out_get = stripslashes($a['Time_out']);
		$Person_id_get = stripslashes($a['Person_id']);
	
	    $l=array("id"=>$Note_out_id_get,"type"=>$Note_type,"name"=>$Item_name_get,"num"=>$Item_num_get,"price"=>$Item_price_get,"rental"=>$Rental_get,"time"=>$Time_out_get,"person"=>$Person_id_get); 
        $list[$i] = $l;
	}
	$lists = array("op"=>$list);
        echo json_encode($lists);
	}
}

$db->close();
?>
