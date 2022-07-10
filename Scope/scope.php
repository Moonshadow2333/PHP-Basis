<?php
define('PI',3.14);
$global = 'global area!';
function local()
{
    $inner = 'local area!';
    // echo $global;
    echo PI;
    // var_dump($GLOBALS['global']);
}
// echo $inner;
local();