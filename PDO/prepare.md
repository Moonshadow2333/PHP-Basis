### 预处理
#### 一、什么是预处理？
>用于执行多个相同的SQL语句。

#### 二、使用预处理的好处
1. 可以有效地防止SQL注入。
2. 执行效率更高。

#### 三、PDO中的预处理语句
##### （一）连接 PDO
```
$conn = new PDO("mysql:host=localhost;dbname=$dbname",$username,$pwd);
```
##### （二）将 PDO的错误模式设置为抛出异常
```
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
```
##### （三）预处理 SQL及绑定参数
1. 预处理 SQL。
当某个 SQL 语句需要重复执行，且每次执行仅仅是使用的参数不同时，使用预处理语句的运行效率最高。使用预处理语句，首先需要在数据库服务器中先准备好一个 SQL 语句，但并不需要马上执行它。

SQL 语句中，对于在执行时需要变化的一些值，可以使用占位符号来取代，然后将这个编辑好的 SQL 语句放到数据库服务器的缓存区等待处理，然后再去单独赋予占位符号具体的值，再通知这个准备好的预处理语句执行即可。（占位符取代变化值；赋予占位符具体值；执行预处理SQL语句。）

在 PDO 中有两种使用占位符的语法，分别是“命名参数”和“问号参数”，具体使用哪一种语法根据看个人的喜好随意选择即可。
（1）命名参数
命名参数法就是自定义一个字符串作为参数的名称，这个名称需要使用冒号（:）开始，参数的命名要有一定意义，最好和对应的字段名称相同。使用命名参数作为占位符的 INSERT 查询语句如下所示：
```
$stmt = $conn->prepare("INSERT INTO user(`name`,`age`) VALUES(:name,:age)");
```
（2） 问号参数
顾名思义就是使用问号（?）作为占位符，另外问号出现的位置一定要和字段的位置顺序对应。使用问号参数作为占位符的 INSERT 查询语句如下所示：
```
$stmt->prepare("INSERT INTO user(name, age) VALUES(?, ?)");
```
2. 绑定参数。
（1）命名参数的绑定：
```
$stmt->bindParam(':name',$name);
$stmt->bindParam(':age',$age);

```
（2）问号参数的绑定：
```
$stmt->bindParam('1',$name);
$stmt->bindParam('2',$age);
```
##### （四）执行预处理
（1）命名参数
```
// 插入行
$name = "Moon";
$age  = 18;
$stmt->execute();

// 插入其他行
$name = "Shadow";
$age  = 18;
$stmt->execute();
```
（2）问号参数
```
$name = 'John';
$age  = 18;
$stmt->execute();

$name = 'Grace';
$age  = 19;
$stmt->execute();
```
##### （五）完整的代码
（1）命名参数
```
<?php
include('./config.php');
// 预处理
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
```
（2）问号参数
```
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
```
#### 参考
1. [PHP PDO预处理语句详解](http://c.biancheng.net/view/8121.html)