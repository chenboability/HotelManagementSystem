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
if($department!="全部")//默认全部部门
	$query = "select * from application where Sq_bm = '".$department."'";
else//选择部门
	$query = "select * from application";
}else{//选择日期
	if($department!="全部")
	$query = "select * from application where Sq_bm = '".$department."' and Sq_rq = '".$date."'";
else
	$query = "select * from application where Sq_rq = '".$date."'";
}



   $result = $db->query($query);

	if($result->num_rows > 0){
	for($i = 0;$i<$result->num_rows;$i++){
		$a = $result->fetch_assoc();
		$Sq_id = stripslashes($a['Sq_id']);
		$Sq_bm = stripslashes($a['Sq_bm']);
		$Sq_user = stripslashes($a['Sq_user']);
		$Sq_rq = stripslashes($a['Sq_rq']);
		$Sq_ly = stripslashes($a['Sq_ly']);
		$Sq_je = stripslashes($a['Sq_je']);
		$Sq_sp = stripslashes($a['Sq_sp']);
switch ($Sq_sp){
case 0:
$z="未审批";
break;
case 1:
$z="不通过";
break;
case 2:
$z="已发放";
break;
case 3:
$z="未发放";
break;		
}			
		$l=array("Sq_id"=>$Sq_id,"Sq_bm"=>$Sq_bm,"Sq_user"=>$Sq_user,"Sq_rq"=>$Sq_rq,"Sq_je"=>$Sq_je,"Sq_ly"=>$Sq_ly,"Sq_sp"=>$z); 
        $list[$i] = $l;
	}
	
		$lists = array("op"=>$list);
        echo json_encode($lists);
	}
$db->close();
?>

