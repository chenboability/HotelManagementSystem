<?php
header('Content-type: text/html;charset=utf8');
		require("database.php");
		
		  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
    }

		$type=$_POST["type"];
		if($type=='前菜/小吃')$type=1;
		else if($type=='主食')$type=2;
		else if($type=='汤/饮料')$type=3;
		else if($type=='沙拉/甜品')$type=4;
		else $type=0;
		$name=$_POST["name"];
		$price=$_POST["pay"];
		
		
		$pic= "upload/" . $_FILES["file"]["name"];
		echo $pic;
		$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
	    $db->query("set names 'utf8'");
		$sql = "insert into menu(Food_name, Food_price,Food_type,Food_pic)
		values('$name','$price','$type','$pic')";
		$result = $db->query($sql);
		echo $result;
		
		header("Location: http://127.0.0.1/6/View/food/food.html");
		
/*
		header('Content-type: text/html;charset=utf8');
		require("database.php");
		
		$type=$_REQUEST["type"];
		if($type=='前菜/小吃')$type=1;
		else if($type=='主食')$type=2;
		else if($type=='汤/饮料')$type=3;
		else if($type=='沙拉/甜品')$type=4;
		else $type=0;
		$name=$_REQUEST["name"];
		$price=$_REQUEST["pay"];
		
		$pic=$_REQUEST['pic'];
		//echo $pic;
		
		$db = new mysqli('localhost','root','','design')or die('好像数据库链接错误哦！');
	    $db->query("set names 'utf8'");
		$sql = "insert into menu(Food_name, Food_price,Food_type,Food_pic)
		values('$name','$price','$type','$pic')";
		$result = $db->query($sql);
		echo $result;
*/
	
?>