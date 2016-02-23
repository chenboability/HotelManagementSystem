<?php
   require("create.php");
	$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
	   $db->query("set names 'utf8'");
	$sql="select * from menu";
	$result= $db->query($sql);
	if($result->num_rows > 0){
	 for($i = 0;$i<$result->num_rows;$i++){
		$a = $result->fetch_assoc();
		$Food_id = stripslashes($a['Food_id']);
		$Food_name = stripslashes($a['Food_name']);
		$Food_price = stripslashes($a['Food_price']);
		$Food_pic = stripslashes($a['Food_pic']);
	
		$l=array("Food_id"=>$Food_id,"Food_name"=>$Food_name,"Food_price"=>$Food_price,"Food_pic"=>$Food_pic);
        $list[$i] = $l;
	 }
	}
	$lists = array("op"=>$list);
        echo json_encode($lists);
?>