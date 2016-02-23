<!-- 1、此文件是订单生成当员工预定房间时使用
  2、房间的状态中，1代表真，即已入住、被预定、空闲；0代表假，即未入住、未预定、不是空闲
  3、添加订单操作是一定要进行的，但是支付不一定，支付要等到客户支付完总额的时候才进行  -->

<?php 
 header('Content-type: text/html; charset=utf-8');

$mysql_server_name = "localhost";
$mysql_username = "root";
$mysql_password = "";
$mysql_database = "design";

$roomid=$_POST['roomid'];   //房间号
$sum=$_POST['sum'];       //客户应付总额
$time = time();
$order_time=date("y-m-d",$time);//订单产生日期

//得到修改后的状态
     $choose=$_POST['choose'];
     //当修改按钮被点击时，将房间的状态修改为选定的状态
     if(isset($_POST['change'])){
       if ($choose=="取消预订"){
           $sql2="UPDATE `design`.`room` SET `isordered`=0,`islived`=0,`isfree`=1 where `room_id`='$roomid'";
           $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
           mysqli_query ($conn,"set names 'utf8'");
           mysqli_select_db($conn,$mysql_database);
           $res2=mysqli_query($conn,$sql2);
           if($res2=="")  //echo "取消预订失败！";
               echo "<script>window.alert(\"取消预订失败！请重新操作！\"),location.href=\"../huangzeqin/room/room_order.html\";</script>";
           else {
               //echo "取消预订成功！";
			   //往财务添加支出信息
			   $sum=-$sum;
              $insert3 = "insert into payments values(null,'".$order_time."', '客房部', '".$sum."')";
              mysqli_query ($conn,"set names 'utf8'");
                      mysqli_select_db($conn,$mysql_database);
                      $result=mysqli_query($conn,$insert3);
               echo "<script>window.alert(\"取消预订成功！\"),location.href=\"../huangzeqin/room/room_order.html\";</script>";
           }
       }
       else if($choose=="现场入住"){
           $sql3="UPDATE `design`.`room` SET `isordered`=1,`islived`=1,`isfree`=0 where `room_id`='$roomid'";
           $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
           mysqli_query ($conn,"set names 'utf8'");
           mysqli_select_db($conn,$mysql_database);
           $res3=mysqli_query($conn,$sql3);
           if($res3=="")  //echo "入住失败！，再尝试一次？";
               echo "<script>window.alert(\"入住失败！请重新操作！\"),location.href=\"../huangzeqin/room/room_order.html\";</script>";
           else {
//                echo "入住成功！";
       //往财务添加支出信息
$insert3 = "insert into payments values(null,'".$order_time."', '客房部', '".$money."')";
mysqli_query ($conn,"set names 'utf8'");
                      mysqli_select_db($conn,$mysql_database);
                      $result=mysqli_query($conn,$insert3);
               echo "<script>window.alert(\"恭喜你！入住成功！\"),location.href=\"../huangzeqin/room/room_order.html\";</script>";
           }
       }
       else if($choose=="退房"){
           $sql4="UPDATE `design`.`room` SET `isordered`=0,`islived`=0,`isfree`=1 where `room_id`='$roomid'";
           $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
           mysqli_query ($conn,"set names 'utf8'");
           mysqli_select_db($conn,$mysql_database);
           $res4=mysqli_query($conn,$sql4);
           if($res4=="")  //echo "退房失败！，再尝试一次？";
               echo "<script>window.alert(\"退房失败了！请重新操作！\"),location.href=\"../huangzeqin/room/room_order.html\";</script>";
           else {
//                echo "退房成功！";
//往财务添加支出信息
$sss=-($sum+$money);
$insert3 = "insert into payments values(null,'".$order_time."', '客房部', '".$sss."')";
mysqli_query ($conn,"set names 'utf8'");
                      mysqli_select_db($conn,$mysql_database);
                      $result=mysqli_query($conn,$insert3);
 
               echo "<script>window.alert(\"恭喜你！退房成功！\"),location.href=\"../huangzeqin/room/room_order.html\";</script>";
           }
       }

//          $t2=1;
//          $t3=0;
//          $sql2="UPDATE `hotel`.`room` SET `isordered`='$t3',`islived`='$t2' where `room_id`='$roomid'";
//          $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
//          mysqli_query ($conn,"set names 'utf8'");
//          mysqli_select_db($conn,$mysql_database);
//          $rest=mysqli_query($conn,$sql2);
//          if($rest == "") echo "出现错误,修改入住状态和预定状态失败";
//              else
//              {
//                  echo '修改入住状态和预定状态成功！';
//              }
     }

?>