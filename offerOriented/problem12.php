<?php
/**
 * Desc: 打印从1到n的最大n位数
 * User: jiefuyang
 * Date: 2019-06-12
 * Time: 10:51
 */

function printToMax($length) {
    if ($length <= 0) {
        return false;
    }

    $str = '';
    for ($i = 0; $i < $length; $i++) {
        $str[$i] = '0';
    }

    printNumber($str, 3, 0);
}

function printNumber(
    $str,
    $length,
    $index
) {
    if ($index == $length) {
        doPrint($str,$length);
        return false;
    }

    for ($i = 0; $i < 10; $i++) {
        $str[$index] = $i;
        printNumber($str, $length, $index+1);
    }
}

function doPrint($str,$length) {
    $trueStr = '';
    $startFlag = false;

    for ($i=0;$i<$length;$i++){
        if($str[$i] != '0'){
            $startFlag = true;
        }
        if($startFlag == true){
            $trueStr[$i] = $str[$i];
        }
    }

    echo $trueStr . PHP_EOL;
}

printToMax(3);