<?php
header('Content-Type:text/html;charset=utf-8');

  $day1=$_REQUEST['day1'];
  $day2=$_REQUEST['day2'];
  $type=$_REQUEST['type'];


$mysql_server_name = "localhost";
$mysql_username = "root";
$mysql_password = "";
$mysql_database = "design";


         $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
          mysqli_query ($conn,"set names 'utf8'");
          if($type=="全部"){
              $sql = "select * from `design`.`order` where '$day1' <`day1` and '$day2'>`day2` ORDER BY order_id ASC";
          }
          else{
              $sql = "select * from `design`.`order`,`design`.`room` where `design`.`room`.`room_id`=`design`.`order`.`room_id`
              and '$day1' <`design`.`order`.`day1` and '$day2'>`design`.`order`.`day2` and `design`.`room`.`room_type`='$type' ORDER BY order_id ASC";
          }


          mysqli_select_db($conn,$mysql_database);
          $result=mysqli_query($conn,$sql);

          if($result->num_rows > 0){
              for($i = 0;$i<$result->num_rows;$i++){
                  $row=mysqli_fetch_assoc($result);
                  $l=array("order_id"=>$row['order_id'],"room_id"=>$row['room_id'],"day1"=>$row['day1'],
                      "day2"=>$row['day2'],"order_time"=>$row['order_time'],"sum"=>$row['sum'],
                      "customer_name"=>$row['customer_name'],"customer_type"=>$row['customer_type'],
                      "telphone"=>$row['telphone'],"money"=>$row['money'],"state"=>$row['state']);
                 $list[$i] = $l;
              }
              $lists = array("op"=>$list);
              echo json_encode($lists);
          }
?>

