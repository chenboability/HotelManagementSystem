<?php
header("Content-type: text/html; charset=utf-8");

$department = $_REQUEST['department'];

if(!get_magic_quotes_gpc()){
$department = addslashes($department);
}
		
$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");

if($department=="全部")//默认全部部门
	$query = "select * from employee";
else//选择某个部门
	$query = "select * from employee where dep = '".$department."'";	
   $result = $db->query($query);
 	
	if($result->num_rows > 0){
	for($i = 0;$i<$result->num_rows;$i++){
		$a = $result->fetch_assoc();
		$id = stripslashes($a['account']);
		$name = stripslashes($a['name']);
		$bm = stripslashes($a['dep']);
		$gz = stripslashes($a['salary']);
				
		$l=array("id"=>$id,"name"=>$name,"bm"=>$bm,"gz"=>$gz); 
        $list[$i] = $l;
	}
	
		$lists = array("op"=>$list);
        echo json_encode($lists);
	}
$db->close();
?>

