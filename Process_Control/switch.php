<?php

$score = 0;
if ($score > 100 || $score < 0) {
    die('您输入的分数不正确，正确的分数为 0~99');
}
switch (floor($score/10)) {
    case 10:
        echo '满分！';
        break;
    case 9:
        echo '非常优秀';
        break;
    case 8:
        echo '优秀';
        break;
    case 7:
        echo '良好';
        break;
    case 6:
        echo '及格';
        break;
    case 5:
    case 4:
    case 3:
    case 2:
    case 1:
    case 0:
        echo '不及格';
        break;
    default:
        echo '您输入的分数不正确，正确的分数为(0~100)。';
        break;
}
