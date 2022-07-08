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
	// 预处理SQL
	$stmt = $conn->prepare("INSERT INTO user(`name`,`age`) VALUES(?,?)");
	// 绑定参数
	$stmt->bindParam('1',$name);
	$stmt->bindParam('2',$age);
	$name = 'John';
	$age  = 18;
	$stmt->execute();

	$name = 'Grace';
	$age  = 19;
	$stmt->execute();

	$name = 'Angela';
	$age  = 20;
	$stmt->execute();
	echo '添加数据成功！';
}catch(PDOException $e){
	echo 'Error '.$e->getMessage();
}