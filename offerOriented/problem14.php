<?php
function reorderOddEven($array,$func) {
    $length     = count($array);
    $startIndex = 0;
    $endIndex   = $length - 1;

    while ($startIndex < $endIndex) {
        while ($startIndex < $endIndex && !$func($array[$startIndex])) {
            $startIndex++;
        }

        while ($startIndex < $endIndex && $func($array[$endIndex])) {
            $endIndex--;
        }

        if ($startIndex < $endIndex && $array[$startIndex] != null && $array[$endIndex] != null) {
            $temp               = $array[$startIndex];
            $array[$startIndex] = $array[$endIndex];
            $array[$endIndex]   = $temp;
        }
    }
    return $array;
}

function checkEven($data){
    if($data % 2 == 0){
        return true;
    }
    return false;
}

$array = [
    20,
    45,
    93,
    67,
    10,
    97,
    52,
    88,
    33,
    92
];
print_r(reorderOddEven($array,'checkEven'));