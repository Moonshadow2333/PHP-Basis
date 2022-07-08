<?php

// 循环控制
// 例子：输出 1~100 内 5 的倍数的值
$i = 1;
while ($i<=100) {
    if ($i % 5 != 0) {
        $i++;
        continue;
    }
    echo $i++."\n";
}


$i = 0;
while (++$i) {
    // echo $i."\n";
    switch ($i) {
        case 5:
            echo "At 5<br />\n";
            break 1;  /* 只退出 switch. */
        case 10:
            echo "At 10; quitting<br />\n";
            break 2;  /* 退出 switch 和 while 循环 */
        default:
            break;
    }
}
