<?php
header('Content-type: text/html; charset=utf-8');
      $account=$_COOKIE['account'];
      setcookie("account",$account,time()-1);
      echo "<script>window.alert(\"退出成功！\"),location.href=\"../huangzeqin/login/login.html\";</script>";
?>