<?php
	   require("database.php");
	   //$state = $_POST[];
	   $day1 = $_REQUEST['day1'];
	   $day2 = $_REQUEST['day2'];
	   $money = $_REQUEST['sum'];
	   $state = $_REQUEST['food_order_state2'];
	   $i4 = $_REQUEST['i4'];
	   
	   /*
	   $mysql=new Mysql();
	   $db="design";
	   $mysql->selectdb($db);
	   */
	  // if($moneytype==0)$lagerorless='>';
	  // else $lagerorless='<';
	   
	   $db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
	   $db->query("set names 'utf8'");
	   $sql = "select * from pay where Order_time > '".$day1."' and Order_time < '".$day2."'";
	   if($i4=="大于")$lol1=">";
	   else $lol1="<";
	   $sql=$sql." and Order_money".$lol1.$money;
	   $lol2=3;
	   if($state==1)$lol2=1;
	   else if($state==2)$lol2=2;	 
		if($lol2!=3)
	   $sql=$sql." and Order_state ="."'".$lol2."'";
	   //.' and Order_money'
	  // .$largeorless.$money;
	  $result = $db->query($sql);
	   // $result = $mysql->query($sql);
 	
	if($result->num_rows > 0){
	for($i = 0;$i<$result->num_rows;$i++){
		$a = $result->fetch_assoc();
		$Order_id = stripslashes($a['Order_id']);
		$Order_money = stripslashes($a['Order_money']);
		$Order_time = stripslashes($a['Order_time']);
		$Order_times = stripslashes($a['Order_times']);
		$Order_state = stripslashes($a['Order_state']);
		$Order_people_id = stripslashes($a['people_id']);
		
					
		$l=array("Order_id"=>$Order_id,"Order_money"=>$Order_money,"Order_time"=>$Order_time,"Order_times"=>$Order_times,"Order_state"=>$Order_state,"Order_people_id"=>$Order_people_id); 
        $list[$i] = $l;
	}
	
		$lists = array("op"=>$list);
        echo json_encode($lists);
	}
	
	/*
	   $rel=$mysql->query($sql);
	   $arrlength=count($rel);
	   echo $arrlength;
	   
	   for($x=0;$x<$arrlength;$x++) {
		   $tmp=array("id"=>rel[$x]['Order_id'],"money"=>rel[$x]['Order_money'],"time"=>rel[$x]['Order_time'],"times"=>rel[$x]['Order_times'], "people"=>rel[$x]['people_id'],"state"=>rel[$x]['Order_state']);
		   $list[$x]=$tmp;
		 //echo $rel[$x]['Order_id'].' '.$rel[$x]['Order_money'].' '.$rel[$x]['Order_time'].' ';//.$list[$x]['Order_state'];
		 //echo "<br>";
	   } 
	   $lists=array("op"=>$list);
	   echo json_encode($lists);*/
	   
?>
		