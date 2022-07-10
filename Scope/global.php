<?php

$a = 1;
function test(){
    global $a;
    unset($a);
}
test();
echo $a."\n";

$a = 0;
function test1(){
    $a = &$GLOBALS['a'];
    $a = 1;
}
test1();
echo $a."\n";

$a = 1;
$b = 2;
function test3(){
    global $a,$b;
    $a = $b;
}
test3();
echo $a."\n";

$a = 1;
$b = 2;
function test4(){
    global $a,$b;
    $a = &$b;
}
test();
echo $a;