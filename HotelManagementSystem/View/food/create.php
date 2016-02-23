<?php
	require("database.php");
	$tmp='inital';
	
	$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
	 $db->query("set names 'utf8'");
	 
	 /*
	 $mysql=new Mysql();
	  $db="design";
	  $mysql->selectdb($db);
	  */
	 //echo $tmp;
	$sql="CREATE TABLE IF NOT EXISTS `pay` (
 `Order_id` int(11) NOT NULL,
 `Order_times` time NOT NULL,
 `Order_money` int(11) NOT NULL,
 `Order_state` int(11) NOT NULL,
 `Order_time` date NOT NULL,
 `Order_address` varchar(30) DEFAULT NULL,
 `people_id` int(11) NOT NULL,
 PRIMARY KEY (`Order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ";
		//$db->query($sql);
	//$sql = "create table if not EXISTS a(
	//`Order_id` int not null)ENGINE=InnoDB DEFAULT CHARSET=utf8 ";
	$db->query($sql);
	// $result = $mysql->excute($sql);
	 //echo $result;
	$sql = "CREATE TABLE IF NOT EXISTS `menu` (
 `Food_id` int(11) NOT NULL AUTO_INCREMENT,
 `Food_name` varchar(30) DEFAULT NULL,
 `Food_price` int(11) DEFAULT NULL,
 `Food_type` int(11) DEFAULT NULL,
 `Food_pic` varchar(100) NOT NULL,
 PRIMARY KEY (`Food_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8";
	// $result = $mysql->excute($sql);
	$db->query($sql);
  $sql ="CREATE TABLE IF NOT EXISTS `buy` (
 `Buy_id` int(11) NOT NULL,
 `Buy_foodid` int(11) NOT NULL,
 ` Buy_sum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
$db->query($sql);
	 //$result = $mysql->excute($sql);
 //mysql_close();
?>