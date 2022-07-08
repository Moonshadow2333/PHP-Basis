<?php

include './config.php';
// echo '<pre/>';
// 使用PDO获取查询结果
$servername = SERVERNAME;
$dbname     = DBNAME;
$username   = USERNAME;
$pwd        = PASSWORD;
die(USERNAME);
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql  = "SELECT * FROM user";
    $re   = $conn->query($sql);
    $data = $re->fetchAll(PDO::FETCH_ASSOC);
    var_dump($data);
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
