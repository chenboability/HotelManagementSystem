<?php
header("Content-type: text/html; charset=utf-8");

$jstype = $_REQUEST['jstype'];
$dep = $_REQUEST['dep'];
$ftime = $_REQUEST['ftime'];
$ttime = $_REQUEST['ttime'];

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");

if($jstype == '日结算'){//日结算
if($dep=="全部"){//默认全部部门
	if($ftime==""){//默认开始时间
		if($ttime==""){//默认结束时间
			$query = "select * from daycount";
		}else{//选择结束时间
			$query = "select * from daycount where Rjs_rq < '".$ttime."'";
		}	
	}else{//选择开始时间
		if($ttime==""){
			$query = "select * from daycount where Rjs_rq > '".$ftime."'";
		}else{
			$query = "select * from daycount where Rjs_rq > '".$ftime."' and Rjs_rq < '".$ttime."'";
		}	
	}	
}else{//选择某一个部门
	if($ftime==""){
		if($ttime==""){
			$query = "select * from daycount where Rjs_bm = '".$dep."'";
		}else{
			$query = "select * from daycount where Rjs_bm = '".$dep."' and Rjs_rq < '".$ttime."'";
		}	
	}else{
		if($ttime==""){
			$query = "select * from daycount where Rjs_bm = '".$dep."' and Rjs_rq > '".$ftime."'";
		}else{
			$query = "select * from daycount where Rjs_bm = '".$dep."' and Rjs_rq > '".$ftime."' and Rjs_rq < '".$ttime."'";
		}	
	}	
}

	$result = $db->query($query);
	if($result->num_rows > 0){
	for($i = 0;$i<$result->num_rows;$i++){
		$a = $result->fetch_assoc();
		$Rjs_rq = stripslashes($a['Rjs_rq']);
		$Rjs_bm = stripslashes($a['Rjs_bm']);
		$Rjs_zc = stripslashes($a['Rjs_zc']);
		$Rjs_sr = stripslashes($a['Rjs_sr']);
				
		$l=array("Rjs_t"=>"日结算","Rjs_bm"=>$Rjs_bm,"Rjs_rq"=>$Rjs_rq,"Rjs_sr"=>$Rjs_sr,"Rjs_zc"=>$Rjs_zc,"Rjs_zong"=>$Rjs_sr-$Rjs_zc); 
        $list[$i] = $l;
	}
	}

	
}else{//月结算
$ftime = substr($ftime,0,7);
$ttime = substr($ttime,0,7);

if($dep=="全部"){
	if($ftime==""){
		if($ttime==""){
			$query = "select * from monthcount";
		}else{
			$query = "select * from monthcount where Yjs_ny < '".$ttime."'";
		}	
	}else{
		if($ttime==""){
			$query = "select * from monthcount where Yjs_ny > '".$ftime."'";
		}else{
			$query = "select * from monthcount where Yjs_ny > '".$ftime."' and Yjs_ny < '".$ttime."'";
		}	
	}	
}else{
	if($ftime==""){
		if($ttime==""){
			$query = "select * from monthcount where Yjs_bm = '".$dep."'";
		}else{
			$query = "select * from monthcount where Yjs_bm = '".$dep."' and Yjs_ny < '".$ttime."'";
		}	
	}else{
		if($ttime==""){
			$query = "select * from monthcount where Yjs_bm = '".$dep."' and Yjs_ny > '".$ftime."'";
		}else{
			$query = "select * from monthcount where Yjs_bm = '".$dep."' and Yjs_ny > '".$ftime."' and Yjs_ny < '".$ttime."'";
		}	
	}	
}

$result = $db->query($query);
	if($result->num_rows > 0){
	for($i = 0;$i<$result->num_rows;$i++){
		$a = $result->fetch_assoc();
		$Yjs_ny = stripslashes($a['Yjs_ny']);
		$Yjs_bm = stripslashes($a['Yjs_bm']);
		$Yjs_zc = stripslashes($a['Yjs_zc']);
		$Yjs_sr = stripslashes($a['Yjs_sr']);
				
		$l=array("Rjs_t"=>"月结算","Rjs_bm"=>$Yjs_bm,"Rjs_rq"=>$Yjs_ny,"Rjs_sr"=>$Yjs_sr,"Rjs_zc"=>$Yjs_zc,"Rjs_zong"=>$Yjs_sr-$Yjs_zc); 
        $list[$i] = $l;
	}
	}
}
		$lists = array("op"=>$list);
        echo json_encode($lists);

$db->close();
?>

