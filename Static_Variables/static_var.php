<?php

function test(){
    $a = 1;
    static $static = 1;
    echo $a++.'|'.$static++."\n";
}
test();
test();
test();