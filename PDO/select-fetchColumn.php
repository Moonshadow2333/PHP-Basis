<?php
include('./config.php');
// 使用PDO获取查询结果
$servername = SERVERNAME;
$dbname     = DBNAME;
$username   = USERNAME;
$pwd        = PASSWORD;

try{
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$pwd);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM user";
	$re  = $conn->query($sql);
	while($data = $re->fetchColumn(1)){
		echo $data."\n";
	}
}catch(PDOException $e){
	echo "ERROR: ".$e->getMessage();
}
