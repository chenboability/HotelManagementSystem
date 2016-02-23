
<?php

header('Content-type: text/html; charset=utf-8');

$mysql_server_name = "localhost";
$mysql_username = "root";
$mysql_password = "";
$mysql_database = "design";

$account=$_REQUEST['a'];


$conn=mysqli_connect($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
$sql="select `name`,`sex`,`birth`,`date`,`dep`,`job`,`card` from `design`.`employee` where `account`='$account'";
mysqli_query ($conn,"set names 'utf8'");
mysqli_select_db($conn,$mysql_database);
$result=mysqli_query($conn,$sql);

if($result->num_rows>0){
        $row=mysqli_fetch_assoc($result);
        $list=array("name"=>$row['name'],"sex"=>$row['sex'],"birth"=>$row['birth'],
            "date"=>$row['date'],"dep"=>$row['dep'],"job"=>$row['job'],"card"=>$row['card']);
        $lists2 = array("op"=>$list);
        echo json_encode($lists2);
}else{
        echo "<script>window.alert(\"查不到您的信息！联系一下老板！一定是他干的！\"),location.href=\"../huangzeqin/user/user_center.html\";</script>";
}
?>
