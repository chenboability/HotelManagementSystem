<?php
header("Content-type: text/html; charset=utf-8");

$daymonth = $_POST['daymonth'];
$department = $_POST['department'];
$date = $_POST['date'];
$ssum = $_POST['ssum'];
$zsum = $_POST['zsum'];


if(!get_magic_quotes_gpc()){
$daymonth = addslashes($daymonth);
$department = addslashes($department);
$date = addslashes($date);
$ssum = addslashes($ssum);
$zsum = addslashes($zsum);
}

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");

if($daymonth == '日结算'){//日结算
//插入日结算信息
	$insert = "insert into daycount values('".$date."', '".$department."', '".$zsum."', '".$ssum."')";
	$result1 = $db->query($insert);
}else{//月结算
   //时间截取月份信息
    $date = substr($date,0,7);
	//插入月结算信息
	$insert = "insert into monthcount values('".$date."', '".$department."', '".$zsum."', '".$ssum."')";
	$result1 = $db->query($insert);
}

if($result1){
	echo "<script>window.alert(\"成功添加结算信息！\"),location.href=\"money_account.html\";</script>";	
}else{
	echo "<script>window.alert(\"添加结算信息失败，请重试！\"),location.href=\"money_account.html\";</script>";
}
$db->close();
?>
</body>
</html>