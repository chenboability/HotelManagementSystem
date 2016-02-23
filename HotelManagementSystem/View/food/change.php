<?php
		$id =$_REQUEST['food_order_id'];
		$state = $_REQUEST['food_order_state'];
		$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
	    $db->query("set names 'utf8'");
		$lol2=0;
	    if($state==1)$lol2=1;
	    else if($state==2)$lol2=2;	
		if($lol2!=0){
			$sql = "update pay set Order_state = ".$state." where Order_id = ".$id;
			$result = $db->query($sql);
			//echo $result;
		}
		
?>