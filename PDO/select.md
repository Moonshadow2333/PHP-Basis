### 使用PDO获取查询结果
#### 一、SELECT 查询
##### （一）执行查询语句
PDO::query: PDO::query — 执行 SQL 语句，返回PDOStatement对象,可以理解为结果集。
```
$sql = "SELECT * FROM user";
$conn->query($sql);
```
##### （二）返回结果
PDO 的数据获取方法与其他数据库扩展都非常类似，只要成功执行 SELECT 查询，都会有结果集对象生成。不管是使用 PDO 对象中的 query() 方法，还是使用 prepare() 和 execute() 等方法结合的预处理语句，执行 SELECT 查询都会得到结果集对象 PDOStatement。

#### 二、常见的获取结果集数据的方法
##### （一）fetch
fetch() 方法可以从一个 PDOStatement 对象的结果集中获取当前行的内容，并将结果集指针移至下一行，当到达结果集末尾时返回 FALSE。

总结：
1. 获取当前行的内容。
2. 将结果集指针下移。
3. 至结果集尾返回假。

语法：
```
PDOStatement::fetch([int $fetch_style[, int $cursor_orientation = PDO::FETCH_ORI_NEXT[, int $cursor_offset = 0]]])
// 常用参数：$fetch_style（可选参数），一般为 PDO::FETCH_ASSOC，用于返回关联数组。
```
例子：
```
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
	$re = $conn->query($sql);
	while ($row = $re->fetch(PDO::FETCH_ASSOC)) {
		echo $row['name'].'-'.$row['age']."\n";
	}
}catch(PDOException $e){
	echo "ERROR: ".$e->getMessage();
}
```
##### （二）fetchAll
fetchAll() 方法与上面介绍的 fetch() 方法类似，但是该方法只需要调用一次就可以获取结果集中的所有行，并赋给返回的数组。该方法的语法格式如下。

总结：
fetch() 方法获取当前行，fentchAll() 方法则一次性获取所有行。

语法：
```
PDOStatement::fetchAll([int $fetch_style[, mixed $fetch_argument[, array $ctor_args = array()]]])
常用参数：$fetch_style（可选参数），一般为 PDO::FETCH_ASSOC，用于返回关联数组。
```

例子：
```
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
	$data = $re->fetchAll(PDO::FETCH_ASSOC);
	var_dump($data);
}catch(PDOException $e){
	echo "ERROR: ".$e->getMessage();
}

```
##### （三）fetchColumn
fetchColumn() 方法可以获取结果集中当前行指定字段的值，其语法格式如下：
```
PDOStatement::fetchColumn([int $column_number = 0])
// 参数说明：参数 $column_number 为想从行里取回的列的索引数字（以 0 开始）。如果没有提供值，则获取第一列。
```

例子：
```
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
```
注意：fetchColumn()方法只会获取结果集中某列的一条记录。
user表如下：
|id|name|age|
|:----:|:----:|:----:|
|1|Moon|18|
|2|Shadow|18|
|3|Mary|19|
|4|Grace|20|
```
$re = $stmt->fetchColumn('1');
echo $re; // 输出：Moon
```
假如要获取 name 列的所有记录，则需要循环读取。
```
while($data = $stmt->fetchColumn(1)){
	echo $data."\n";
}
```
##### （四）总结
1. fetch() 和 fetchColumn() 方法返回结果集对象当前行（一条记录），到达结果集末尾返回 false，想要获取所有记录，需要搭配 while。
- 返回当前行。
- 将指针下移。
- 至尾返回假。 
2. fetchAll() 方法一次获取结果集中所有行。
#### 参考资料
[PHP使用PDO获取查询结果](http://c.biancheng.net/view/7742.html)