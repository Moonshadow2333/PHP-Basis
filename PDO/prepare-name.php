<?php
include('./config.php');
// 预处理-命名参数
$servername = SERVERNAME;
$dbname = DBNAME;
$username = USERNAME;
$pwd = PASSWORD;

try{
	$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$pwd);
	// 将PDO的错误模式设置为抛出异常
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	// 预处理SQL并绑定参数
	$stmt = $conn->prepare("INSERT INTO user(`name`,`age`) VALUES(:name,:age)");
	$stmt->bindParam(':name',$name);
	$stmt->bindParam(':age',$age);
	// 插入行
	$name = "Moon";
	$age  = 18;
	$stmt->execute();
	// 插入其他行
	$name = "Shadow";
	$age  = 18;
	$stmt->execute();
	// 插入其他行
	$name = "Mary";
	$age  = 18;
	$stmt->execute();
	echo "添加数据成功！";
}catch(PDOException $e){
	echo "ERROR:".$e->getMessage();
}
$conn = null;