<?php
     header('Content-type: text/html; charset=utf-8');

     $mysql_server_name = "localhost";
     $mysql_username = "root";
     $mysql_password = "";
     $mysql_database = "design";

      $account=$_REQUEST['a'];

             $conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
             $sql2="select * from `design`.`application` where `Sq_user`='$account'";
             mysqli_query ($conn,"set names 'utf8'");
             mysqli_select_db($conn,$mysql_database);
             $result2=mysqli_query($conn,$sql2);
             if($result2->num_rows > 0){
               for($i=0;$i<$result2->num_rows;$i++){
                  $row=mysqli_fetch_assoc($result2);
                  $l=array("id"=>$row['Sq_id'],"time"=>$row['Sq_rq'],"money"=>$row['Sq_je'],"reason"=>$row['Sq_ly'],"state"=>$row['Sq_sp']);
                 $list[$i] = $l;
              }
              $lists = array("op"=>$list);
              echo json_encode($lists);
          }
?>