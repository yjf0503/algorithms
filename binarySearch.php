<?php
function binarySearch($value,$array) {
    $left = 0;
    $right = count($array) - 1;

    while($left <= $right){
         $middle = intval(($left + $right) / 2);
        if ($array[$middle] > $value) {
            $right = $middle - 1;
        } elseif ($array[$middle] < $value) {
            $left = $middle + 1;
        } else {
            return $middle;
        }
    }
}

function binarySearchRecursive($value,$array,$left,$right) {
    if($right > (count($array)-1)){
        $right = count($array)-1;
    }

    if ($left > $right) {
        return -1;
    }

    $middle = intval(($left + $right) / 2);
    if ($array[$middle] > $value) {
        return binarySearchRecursive($value, $array, $left, $middle - 1);
    } elseif ($array[$middle] < $value) {
        return binarySearchRecursive($value, $array, $middle + 1, $right);
    } else {
        return $middle;
    }
}

function repetitiveBinarySearch($value,$array) {
    $left = 0;
    $right = count($array) - 1;
    $place = -1;

    while($left <= $right){
        $middle = intval(($left + $right) / 2);
        if ($array[$middle] > $value) {
            $right = $middle - 1;
        } elseif ($array[$middle] < $value) {
            $left = $middle + 1;
        } else {
            $place = $middle;
//            //查找第一次出现的位置
//            $right = $middle - 1;

            //查找最后一次出现的位置
            $left = $middle + 1;
        }
    }
    return $place;
}

function repetitiveBinarySearchRecursive($value,$array,$left,$right) {
    if($right > (count($array)-1)){
        $right = count($array)-1;
    }

    if ($left > $right) {
        return -1;
    }

    $middle = intval(($left + $right) / 2);
    if ($array[$middle] > $value) {
        return repetitiveBinarySearchRecursive($value, $array, $left, $middle - 1);
    } elseif ($array[$middle] < $value) {
        return repetitiveBinarySearchRecursive($value, $array, $middle + 1, $right);
    } else {
//        //查找第一次出现的位置
//        if($array[$middle-1] == $value){
//            return repetitiveBinarySearchRecursive($value, $array, $left, $middle - 1);
//        }else{
//            return $middle;
//        }

        //查找最后一次出现的位置
        if($array[$middle+1] == $value){
            return repetitiveBinarySearchRecursive($value, $array, $middle + 1, $right);
        }else{
            return $middle;
        }
    }
}

function interpolationSearch($value,$array) {
    $left = 0;
    $right = count($array) - 1;

    while($left <= $right){
        $length = $right - $left;
        $gap = $array[$right] - $array[$left];
        $middle = intval($left + ($value - $array[$left]) / $gap * $length);

        if ($array[$middle] > $value) {
            $right = $middle - 1;
        } elseif ($array[$middle] < $value) {
            $left = $middle + 1;
        } else {
            return $middle;
        }
    }
}

function exponentialSearch($value,$array){
    $left = 0;
    $right = 0;

    if($array[0] == $value){
        return 0;
    }
    $index = 1;
    while($array[$index] < $value && !empty($array[$index])){
        $left = $index;
        $index *= 2;
        $right = $index;

    }

    return binarySearchRecursive($value,$array,$left,$right);
}

$array = [1,1,2,2,2,2,2,3,5,7];
$value = 7;
var_dump(binarySearch($value,$array));
var_dump(binarySearchRecursive($value,$array,0,count($array)-1));
var_dump(repetitiveBinarySearch($value,$array));
var_dump(repetitiveBinarySearchRecursive($value,$array,0,count($array)-1));
var_dump(interpolationSearch($value,$array));
var_dump(exponentialSearch($value,$array));