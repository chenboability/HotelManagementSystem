<?php
header('Content-type: text/html; charset=utf-8');

$mysql_server_name = "localhost";
$mysql_username = "root";
$mysql_password = "";
$mysql_database = "design";

$day=$_REQUEST['day'];
$roomtype=$_REQUEST['roomtype'];
$state=$_REQUEST['state'];   //查询的房间状态

/*
 * 房间的状态总共有三种：
 * 1、平时：isordered=0,islived=0,isfree=1
 * 2、当客户还了总额：isordered=1,islived=0,isfree=1
 * 3、当客户还了押金：isordered=1,islived=1,isfree=0(此时客户已经入住)
 * 4、当客户退房：回到平时状态
 */

      if($state==1){ //未入住。此时,isordered=0\islived=0\isfree=1或者isordered=1\islived=0\isfree=1。所以只需要查询房间状态是未入住的就行。
          if($roomtype=="全部"){
              $sql1="select * from `design`.`room` where `room`.`islived`=0";
          }else{
              $sql1="select * from `design`.`room` where `room`.`room_type`='$roomtype' and `room`.`islived`=0";
          }
          $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
          mysqli_query ($conn,"set names 'utf8'");
          mysqli_select_db($conn,$mysql_database);
          $res1=mysqli_query($conn,$sql1);
          if($res1->num_rows > 0){
              for($i=0;$i < $res1->num_rows;$i++){
                   $row=mysqli_fetch_assoc($res1);
                   if($row['islived']==0) $row['islived']="未入住";
                   else if($row['islived']==1) $row['islived']="已入住";
                   if($row['isordered']==0) $row['isordered']="未预订";
                   else if($row['isordered']==1) $row['isordered']="已预订";
                   if($row['isfree']==0) $row['isfree']="非空闲";
                   else if($row['isfree']==1) $row['isfree']="空闲";
                   $l1=array("room_id"=>$row['room_id'],"room_type"=>$row['room_type'],"islived"=>$row['islived'],
                            "isordered"=>$row['isordered'],"isfree"=>$row['isfree'],"price"=>$row['price']);
                    $list1[$i]=$l1;
                 }
                 $lists1 = array("op"=>$list1);
                 echo json_encode($lists1);
             }
			 else{
				     echo "<script>window.alert(\"这一天没有这种房间了！\"),location.href=\"../huangzeqin/room/room.html\";</script>";

			 }

         }
         else if($state==2){//已入住
             if($roomtype=="全部"){
                 $sql2="select * from `design`.`order`,`design`.`room` where `design`.`room`.`room_id`=`design`.`order`.`room_id`
                        and `room`.`islived`=1 and (`order`.`day1`<'$day' or `order`.`day2`>'$day')";
             }else{
                 $sql2="select * from `design`.`order`,`design`.`room` where `design`.`room`.`room_id`=`design`.`order`.`room_id`
                        and `room`.`room_type`='$roomtype' and `room`.`islived`=1 and (`order`.`day1`<'$day' or `order`.`day2`>'$day')";
             }
             $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
             mysqli_query ($conn,"set names 'utf8'");
             mysqli_select_db($conn,$mysql_database);
             $res2=mysqli_query($conn,$sql2);
             if($res2->num_rows>0){
                 for($i=0;$i<$res2->num_rows;$i++){
                     $row=mysqli_fetch_assoc($res2);
                     if($row['islived']==0) $row['islived']="未入住";
                     else if($row['islived']==1) $row['islived']="已入住";
                     if($row['isordered']==0) $row['isordered']="未预订";
                     else if($row['isordered']==1) $row['isordered']="已预订";
                     if($row['isfree']==0) $row['isfree']="非空闲";
                     else if($row['isfree']==1) $row['isfree']="空闲";
                     $l2=array("room_id"=>$row['room_id'],"room_type"=>$row['room_type'],"islived"=>$row['islived'],
                         "isordered"=>$row['isordered'],"isfree"=>$row['isfree'],"price"=>$row['price']);
                     $list2[$i]=$l2;
                 }
                 $lists2 = array("op"=>$list2);
                 echo json_encode($lists2);
             } else{
				     echo "<script>window.alert(\"这一天没有这种房间了！\"),location.href=\"../huangzeqin/room/room.html\";</script>";
			 }

         }
         else if($state==3||$state==5){//未预定也就是空闲状态
             if($roomtype=="全部"){
                 $sql3="select * from `design`.`room` where `isordered`=0 and `islived`=0 and `isfree`=1";
             }else{
                 $sql3="select * from `design`.`room` where `room`.`room_type`='$roomtype' and `isordered`=0 and `islived`=0 and `isfree`=1";
             }
             $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
             mysqli_query ($conn,"set names 'utf8'");
             mysqli_select_db($conn,$mysql_database);
             $res3=mysqli_query($conn,$sql3);
             if($res3->num_rows>0){
                 for($i=0;$i<$res3->num_rows;$i++){
                     $row=mysqli_fetch_assoc($res3);
                     if($row['islived']==0) $row['islived']="未入住";
                     else if($row['islived']==1) $row['islived']="已入住";
                     if($row['isordered']==0) $row['isordered']="未预订";
                     else if($row['isordered']==1) $row['isordered']="已预订";
                     if($row['isfree']==0) $row['isfree']="非空闲";
                     else if($row['isfree']==1) $row['isfree']="空闲";
                     $l3=array("room_id"=>$row['room_id'],"room_type"=>$row['room_type'],"islived"=>$row['islived'],
                         "isordered"=>$row['isordered'],"isfree"=>$row['isfree'],"price"=>$row['price']);
                     $list3[$i]=$l3;
                 }
                 $lists3 = array("op"=>$list3);
                 echo json_encode($lists3);
             } else{
				     echo "<script>window.alert(\"这一天没有这种房间了！\"),location.href=\"../huangzeqin/room/room.html\";</script>";

			 }

         }
         else if($state==4){ //已预订
             if($roomtype=="全部"){
                 $sql4="select * from   `design`.`room` where `isordered`=1";
             }else{
                $sql4="select * from   `design`.`room` where `room`.`room_type`='$roomtype' and `isordered`=1";
             }
             $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
             mysqli_query ($conn,"set names 'utf8'");
             mysqli_select_db($conn,$mysql_database);
             $res4=mysqli_query($conn,$sql4);
             if($res4->num_rows>0){

                 for($i=0;$i<$res4->num_rows;$i++){
                     $row=mysqli_fetch_assoc($res4);
                     if($row['islived']==0) $row['islived']="未入住";
                     else if($row['islived']==1) $row['islived']="已入住";
                     if($row['isordered']==0) $row['isordered']="未预订";
                     else if($row['isordered']==1) $row['isordered']="已预订";
                     if($row['isfree']==0) $row['isfree']="非空闲";
                     else if($row['isfree']==1) $row['isfree']="空闲";
                     $l4=array("room_id"=>$row['room_id'],"room_type"=>$row['room_type'],"islived"=>$row['islived'],
                         "isordered"=>$row['isordered'],"isfree"=>$row['isfree'],"price"=>$row['price']);
                     //                  print_r($l);
                     $list4[$i]=$l4;
                 }
                 $lists4 = array("op"=>$list4);
                 echo json_encode($lists4);
             } else{
				     echo "<script>window.alert(\"这一天没有这种房间了！\"),location.href=\"../huangzeqin/room/room.html\";</script>";

			 }

         }
         else if($state==6){//非空闲
             if($roomtype=="全部"){
                 $sql5="select * from `design`.`room` where  `isfree`=0";
             }else{
                $sql5="select * from `design`.`room` where `room`.`room_type`='$roomtype' and `isfree`=0";
             }

             $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
             mysqli_query ($conn,"set names 'utf8'");
             mysqli_select_db($conn,$mysql_database);
             $res5=mysqli_query($conn,$sql5);
                if($res5->num_rows>0){
                  for($i=0;$i<$res5->num_rows;$i++){
                     $row=mysqli_fetch_assoc($res5);
                     if($row['islived']==0) $row['islived']="未入住";
                     else if($row['islived']==1) $row['islived']="已入住";
                     if($row['isordered']==0) $row['isordered']="未预订";
                     else if($row['isordered']==1) $row['isordered']="已预订";
                     if($row['isfree']==0) $row['isfree']="非空闲";
                     else if($row['isfree']==1) $row['isfree']="空闲";
                     $l5=array("room_id"=>$row['room_id'],"room_type"=>$row['room_type'],"islived"=>$row['islived'],
                               "isordered"=>$row['isordered'],"isfree"=>$row['isfree'],"price"=>$row['price']);
                     $list5[$i]=$l5;
                 }
                 $lists5 = array("op"=>$list5);
                 echo json_encode($lists5);
             } else{
				     echo "<script>window.alert(\"这一天没有这种房间了！\"),location.href=\"../huangzeqin/room/room.html\";</script>";

			 }
         }
?>
