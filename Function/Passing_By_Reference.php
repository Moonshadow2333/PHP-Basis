<?php

// 引用传递

function passByReference(&$age){
    $age++;
    return $age;
}
$age = 10;
$re = passByReference($age);
echo $re."\n";      // 11
echo $age;          // 11

// 引用传递无效的例子：
function foo(&$var){
    echo ++$var;
}

function bar(){
    $a = 5;
    return $a;
}
foo(bar());
// foo($a=5);
// foo(5);