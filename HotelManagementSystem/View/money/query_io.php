<?php
header("Content-type: text/html; charset=utf-8");

$date = $_REQUEST['date'];
$department = $_REQUEST['department'];

if(!get_magic_quotes_gpc()){
$date = addslashes($date);
$department = addslashes($department);
}

		
$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");

if($date == ""){//默认日期
if($department=="全部")//默认全部部门
	$query = "select * from payments";
else//选择部门
	$query = "select * from payments where Sz_bm = '".$department."'";
}else{//选择日期
	if($department=="全部")
	$query = "select * from payments where Sz_rq = '".$date."'";
else
	$query = "select * from payments where Sz_bm = '".$department."' and Sz_rq = '".$date."'";
}

   $result = $db->query($query);
 	
	if($result->num_rows > 0){
	for($i = 0;$i<$result->num_rows;$i++){
		$a = $result->fetch_assoc();
		$Sz_id = stripslashes($a['Sz_id']);
		$Sz_rq = stripslashes($a['Sz_rq']);
		$Sz_bm = stripslashes($a['Sz_bm']);
		$Sz_je = stripslashes($a['Sz_je']);
				
		$l=array("Sz_id"=>$Sz_id,"Sz_rq"=>$Sz_rq,"Sz_bm"=>$Sz_bm,"Sz_je"=>$Sz_je); 
        $list[$i] = $l;
	}
	
		$lists = array("op"=>$list);
        echo json_encode($lists);
	}
$db->close();
?>

