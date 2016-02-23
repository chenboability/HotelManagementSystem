<!-- 1、此文件是订单生成当员工预定房间时使用
  2、房间的状态中，1代表真，即已入住、被预定、空闲；0代表假，即未入住、未预定、不是空闲
  3、添加订单操作是一定要进行的，但是支付不一定，支付要等到客户支付完总额的时候才进行  -->

<?php   header('Content-type: text/html; charset=utf-8');

$mysql_server_name = "localhost";
$mysql_username = "root";
$mysql_password = "";
$mysql_database = "design";

$day1=$_POST['day1'];   //入住时间
$day2=$_POST['day2'];   //离店时间
$roomid=$_POST['roomid'];   //房间号
$customer=$_POST['customer'];  //客户姓名
$type=$_POST['type'];       //客户类型
$cid=$_POST['cid'];       //客户身份证号码
$phone=$_POST['phone'];   //客户手机号码
$money=$_POST['money'];   //客户所交押金
$sum=$_POST['sum'];       //客户应付总额

$time = time();
$order_time=date("y-m-d",$time);//订单产生日期

     //订房的时候有可能是预定也有可能是现场入住
     $choose2=$_POST['choose2'];
     if(isset($_POST['order'])){
         if($choose2=="预订"){
             $state="预订";
             $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
             $sql = "INSERT INTO `design`.`order` (`room_id`, `day1`,`day2`, `order_time`,
                                                   `sum`,`customer_name`,`customer_type`,
                                                   `cid`,`telphone`,`money`,`state`)
                                                   VALUES ('$roomid','$day1', '$day2', '$order_time',
                                                            '$sum', '$customer','$type',
                                                            '$cid', '$phone', '$money','$state')";
                      mysqli_query ($conn,"set names 'utf8'");
                      mysqli_select_db($conn,$mysql_database);
                      $result=mysqli_query($conn,$sql);
                      if($result == "")
                          {
                              //echo "出现错误,添加订单失败\n";
                             echo "<script>window.alert(\"预定房间失败了！请重新试一次！\"),location.href=\"../huangzeqin/room/room.html\";</script>";
                          }
                          else
                              {
//                                   echo '添加订单成功\n';
                                 // alert();
                                  echo "<script>window.alert(\"成功预定房间！\")</script>";
                              }
                   //往财务添加支出信息
                      $insert3 = "insert into payments values(null,'".$order_time."', '客房部', '".$sum."')";
                      mysqli_query ($conn,"set names 'utf8'");
                      mysqli_select_db($conn,$mysql_database);
                      mysqli_query($conn,$insert3);

                          //同时要更改房间的状态
                          $sql1="UPDATE `design`.`room` SET `isordered`=1,`islived`=0,`isfree`=1 where `room_id`='$roomid'";
                          mysqli_query ($conn,"set names 'utf8'");
                          mysqli_select_db($conn,$mysql_database);
                          $res=mysqli_query($conn,$sql1);
                          if($res == "")
                           // echo "出现错误,修改预定状态失败";
                            echo "<script>window.alert(\"修改该房间的预订状态失败！\"),location.href=\"../huangzeqin/room/room.html\";</script>";
                            else{
                                         // echo '修改预定状态成功！';
                                  echo "<script>window.alert(\"成功修改了该房间的预订状态！\"),location.href=\"../huangzeqin/room/room.html\";</script>";
                               }
							   
							   
         }

         else if($choose2=="现场入住"){
             $state="现场入住";
             $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
             $sql = "INSERT INTO `design`.`order` (`room_id`, `day1`,`day2`, `order_time`,
                                                  `sum`,`customer_name`,`customer_type`,
                                                  `cid`,`telphone`,`money`,`state`)
                      VALUES ('$roomid','$day1', '$day2', '$order_time',
                                 '$sum', '$customer','$type',
                                 '$cid', '$phone', '$money','$state')";
             mysqli_query ($conn,"set names 'utf8'");
             mysqli_select_db($conn,$mysql_database);
             $result=mysqli_query($conn,$sql);
             if($result == "")
             {
                 //echo "出现错误,添加订单失败\n";
                 echo "<script>window.alert(\"入住失败了！请重新试一次！\")</script>";
             }
             else
             {
                // echo '添加订单成功\n';
                 // alert();
                 echo "<script>window.alert(\"成功入住！\")</script>";
             }
			 
			 //往财务添加支出信息
			 $ss=$sum+$money;
             $insert3 = "insert into payments values(null,'".$order_time."', '客房部', '".$ss."')";
              mysqli_query ($conn,"set names 'utf8'");
                      mysqli_select_db($conn,$mysql_database);
                      $result=mysqli_query($conn,$insert3);

             //同时要更改房间的状态
             $sql1="UPDATE `design`.`room` SET `isordered`=1,`islived`=1,`isfree`=0 where `room_id`='$roomid'";
             mysqli_query ($conn,"set names 'utf8'");
             mysqli_select_db($conn,$mysql_database);
             $res=mysqli_query($conn,$sql1);
             if($res == "")
                 // echo "出现错误,修改预定状态失败";
                 echo "<script>window.alert(\"修改该房间的入住状态失败！\"),location.href=\"../huangzeqin/room/room.html\";</script>";
                 else{
                     // echo '修改预定状态成功！';
                     echo "<script>window.alert(\"成功修改了该房间的入住状态！\"),location.href=\"../huangzeqin/room/room.html\";</script>";
                 }
         }
     }  
?>

