<?php
header('Content-type: text/html; charset=utf-8');
   $account=$_COOKIE['account'];
   if($account!=""){
       $list=array("op"=>$account);
       echo json_encode($list);
   }else{
       echo "<script>window.alert(\"您还没有注册过喔。请先去注册吧！\"),location.href=\"../huangzeqin/login/login.html\";</script>";
   }
?>
