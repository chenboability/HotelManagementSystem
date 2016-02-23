<?php
	header('Content-type: text/html;charset=utf8');
	class Mysql{
		var $con;     //数据库登陆
		var $db='design';		//选定数据库
		var $host='localhost';
		var $user='root';
		var $password='';
		public function __construct(){
			//$this->con = mysql_connect("localhost","root","");
			$this->con = mysql_connect($this->host,$this->user,$this->password);
			if(!$this->con){
				die('connect error'.mysql_error());
			}
			else {
				echo 'success'.'<br>';
			}
			if(mysql_query('set names utf8'));//告诉服务器编码
			{
				echo 'suc<br>';
			}
		}
		
		function selectdb($db){
			$this->db=$db;
			mysql_select_db($this->db,$this->con);
		}
		
		function excute($sql){
			$result = mysql_query($sql,$this->con);
			if (!$result) {
				die('Invalid query: ' . mysql_error());
			}
			return $result;
		}
		
		function query($sql){
			$result=$this->excute($sql);
			$arr=array();
			while($row=mysql_fetch_array($result)){
				$arr[]=$row;
			}
			return $arr;
		}
		
	}