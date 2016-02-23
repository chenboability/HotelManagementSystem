<?php
header("Content-type: text/html; charset=utf-8");

$jstype = $_POST['jstype'];
$dep = $_POST['dep'];
$date = $_POST['date'];
$ssum = $_POST['ssum'];
$zsum = $_POST['zsum'];

if(!get_magic_quotes_gpc()){
$jstype = addslashes($jstype);
$dep = addslashes($dep);
$date = addslashes($date);
$ssum = addslashes($ssum);
$zsum = addslashes($zsum);
}

$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
$db->query("set names 'utf8'");
if($jstype== '日结算')//修改日结算
$query = "update daycount set Rjs_zc = '".$zsum."' , Rjs_sr='".$ssum."' where Rjs_rq = '".$date."' and Rjs_bm = '".$dep."'";
else//修改月结算
$query = "update monthcount set Yjs_zc = '".$zsum."' , Yjs_sr='".$ssum."' where Yjs_ny = '".$date."' and Yjs_bm = '".$dep."'";	
$result = $db->query($query);

if($result){
	echo "<script>window.alert(\"成功修改结算记录！\"),location.href=\"money_account.html\";</script>";
}else{
	echo "<script>window.alert(\"修改结算记录失败，请重试！\"),location.href=\"money_account.html\";</script>";
}

$db->close();
?>
