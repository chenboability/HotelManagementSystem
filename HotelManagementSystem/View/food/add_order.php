<?php
 require("database.php");
	
		$mysql=new Mysql();
	   $db="design";
	   $mysql->selectdb($db);
	   
	   $sql='select * from pay';
	   $result=$mysql->query($sql);
	   $arrlength=count($result);
	  
		$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
	    $db->query("set names 'utf8'");
		
		$mas = $result[ $arrlength-1]['Order_id'];
		
		$mas=$mas+1;
		$mon=0;
		
		$dep =$_REQUEST['food_dep'];
		$total = $_REQUEST['food_total'];
		$address=$_REQUEST['food_address'];
		for($i=1;$i<=$total;$i++){
			$a=$_REQUEST['food_id'.$i];
			$tmp=array();
			$tmp=explode(',',$a);
			$t1=intval($tmp[0]);
			$t2=intval($tmp[2]);
			$list[$i]=$tmp;
			$sql = "insert into buy values('$mas','$t1','$t2') ";
			$result = $db->query($sql);
			$mon=$mon+intval($list[$i][3])*intval($list[$i][2]);
		}
		
		$time=date("y-m-d");
		$times=date("h:m:s");
		$state=1;
		$people=1;
		$who="112";
		$sql = "insert into pay values('$mas','$times','$mon','$state','$time','$address','$people') ";
		$result = $db->query($sql);
		//插入到收支表
		//$sql = "insert into payments values(null,'$time','餐饮部','$mon')";
		
		$sql="INSERT INTO  `payments` (  `Sz_id` ,  `Sz_rq` ,  `Sz_bm` ,  `Sz_je` ) 
VALUES (
NULL , '$time',  '$dep', $mon)";
		$result = $db->query($sql);
		//echo "<script>window.alert(\"订单添加成功！\"),location.href=\"http://127.0.0.1/6/View/food/food.html\";</script>";
		
?>