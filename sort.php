<?php
function bubbleSort($array) {
    if (empty($array)) {
        return -1;
    }

    $length = count($array);
    $flag   = false;
    for ($i = 0; $i < $length; $i++) {
        for ($j = 0; $j < $length - 1 - $i; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                list($array[$j], $array[$j + 1]) = [
                    $array[$j + 1],
                    $array[$j]
                ];
                $flag = true;
            }
        }
        if (!$flag) {
            break;
        }
    }
    return $array;
}

function selectSort($array) {
    if (empty($array)) {
        return -1;
    }

    $length   = count($array);
    $minIndex = 0;
    for ($i = 0; $i < $length - 1; $i++) {
        $min = $array[$i];
        for ($j = $i + 1; $j < $length; $j++) {
            if ($min > $array[$j]) {
                $min      = $array[$j];
                $minIndex = $j;
            }
        }

        if ($min != $array[$i]) {
            list($array[$i], $array[$minIndex]) = [
                $min,
                $array[$i]
            ];
        }
    }
    return $array;
}

function insertSort($array) {
    if (empty($array)) {
        return -1;
    }

    $length = count($array);
    for ($i = 1; $i < $length; $i++) {
        $value = $array[$i];
        $j     = $i - 1;

        while ($array[$j] > $value && $j >= 0) {
            $array[$j + 1] = $array[$j];
            $j--;
        }
        $array[$j + 1] = $value;
    }
    return $array;
}

function mergeSort($array) {
    if (!is_array($array)) {
        return false;
    }

    $length = count($array);
    if ($length == 1) {
        return $array;
    }

    $mid       = intval($length / 2);
    $leftPart  = array_slice($array, 0, $mid);
    $rightPart = array_slice($array, $mid);
    $left      = mergeSort($leftPart);
    $right     = mergeSort($rightPart);

    $combined    = array();
    $leftIndex   = 0;
    $rightIndex  = 0;
    $leftLength  = count($left);
    $rightLength = count($right);

    while ($leftIndex < $leftLength && $rightIndex < $rightLength) {
        if ($left[$leftIndex] <= $right[$rightIndex]) {
            $combined[] = $left[$leftIndex];
            $leftIndex++;
        }

        if ($right[$rightIndex] < $left[$leftIndex]) {
            $combined[] = $right[$rightIndex];
            $rightIndex++;
        }
    }

    if ($leftIndex < $leftLength) {
        while ($leftIndex < $leftLength) {
            $combined[] = $left[$leftIndex];
            $leftIndex++;
        }
    }

    if ($rightIndex < $rightLength) {
        while ($rightIndex < $rightLength) {
            $combined[] = $right[$rightIndex];
            $rightIndex++;
        }
    }

    return $combined;
}

function quickSort($array) {
    if (!is_array($array) || empty($array)) {
        return false;
    }

    $length = count($array);
    if ($length == 1) {
        return $array;
    }

    $pivot = $array[0];
    $left  = array();
    $right = array();
    for ($i = 1; $i < $length; $i++) {
        if ($array[$i] <= $pivot) {
            $left[] = $array[$i];
        } else {
            $right[] = $array[$i];
        }
    }

    $left  = quickSort($left);
    $right = quickSort($right);

    $left[] = $pivot;
    if (is_array($right)) {
        return array_merge($left, $right);
    }
    return $left;
}

function bucketSort($array) {
    if (!is_array($array) || empty($array)) {
        return false;
    }

    $length = count($array);
    $bucket = array_fill(0, max($array) - min($array), []);

    for ($i = 0; $i < $length; $i++) {
        $bucket[$array[$i] - min($array)][] = $array[$i];
    }

    $bucket = array_filter($bucket);
    $result = array();
    foreach ($bucket as $value) {
        foreach ($value as $slot) {
            $result[] = $slot;
        }

    }
    return $result;
}

function LsdRadixSort($array) {
    if (!is_array($array) || empty($array)) {
        return false;
    }

    $max     = max($array);
    $maxBits = 1;

    while ($max >= 10) {
        $max = $max / 10;
        $maxBits++;
    }

    for ($i = 0; $i < $maxBits; $i++) {
        for ($j = 0; $j < 10; $j++) {
            $buckets[$j] = array();
        }

        foreach ($array as $value) {
            $bit             = ($value / pow(10, $i)) % 10;
            $buckets[$bit][] = $value;
        }
        unset($array);

        foreach ($buckets as $value) {
            foreach ($value as $v) {
                $array[] = $v;
            }
        }
    }

    return $array;
}

function MsdBuckets(
    $array,
    $maxBits
) {
    if (!is_array($array) || empty($array)) {
        return false;
    }

    if ($maxBits == 0) {
        return $array[0];
    }

    if (empty($buckets)) {
        for ($j = 0; $j < 10; $j++) {
            $buckets[$j] = array();
        }
    }

    foreach ($array as $value) {
        $bit             = ($value / pow(10, $maxBits - 1)) % 10;
        $buckets[$bit][] = $value;
    }
    $buckets = array_filter($buckets);

    foreach ($buckets as $key => $value) {
        $temp          = $value;
        $buckets[$key] = MsdBuckets($temp, $maxBits - 1);
    }

    return implode(',', $buckets);
}

function MsdRadixSort($array) {
    $max     = max($array);
    $maxBits = 1;
    while ($max >= 10) {
        $max = $max / 10;
        $maxBits++;
    }
    return explode(',', MsdBuckets($array, $maxBits));
}

function shellSort($array) {
    $length = count($array);
    for ($inc = intval($length / 2); $inc > 0; $inc = intval($inc / 2)) {
        for ($i = $inc; $i < $length; $i++) {
            $k = $i - $inc;
            if ($array[$i] < $array[$k]) {
                $temp = $array[$i];
                while ($k >= 0 && $temp < $array[$k]) {
                    $array[$k + $inc] = $array[$k];
                    $k                -= $inc;
                }
                $array[$k + $inc] = $temp;
            }
        }
    }
    return $array;
}

function heapSort($array) {
    $result = [];

    $length = count($array);
    for ($i = 1; $i < $length; $i++) {
        $array = buildHeap($array, $i);
    }

    while (count($array) >= 1) {
        $item = $array[0];
        array_push($result, $item);

        $array[0] = $array[count($array) - 1];
        unset($array[count($array) - 1]);
        $array = heapify($array, 0);
    }

    return $result;
}

function buildHeap(
    $array,
    $currentIndex
) {
    $fatherIndex = intval(($currentIndex - 1) / 2);
    while ($array[$currentIndex] < $array[$fatherIndex] && $fatherIndex >= 0) {
        $temp                 = $array[$currentIndex];
        $array[$currentIndex] = $array[$fatherIndex];
        $array[$fatherIndex]  = $temp;

        $currentIndex = $fatherIndex;
        $fatherIndex  = intval(($currentIndex - 1) / 2);

    }
    return $array;
}

function heapify(
    $array,
    $index
) {
    $length = count($array);
    $left   = ($index * 2) + 1;
    $right  = ($index * 2) + 2;

    while ($left < $length) {
        if ($array[$left] < $array[$right] && $right < $length) {
            $minIndex = $left;
        }
        if ($array[$right] < $array[$left] && $right < $length) {
            $minIndex = $right;
        }

        if ($array[$index] < $array[$minIndex]) {
            $minIndex = $index;
        }

        if ($index == $minIndex) {
            break;
        }

        $temp             = $array[$index];
        $array[$index]    = $array[$minIndex];
        $array[$minIndex] = $temp;

        $index = $minIndex;
        $left  = ($index * 2) + 1;
        $right = ($index * 2) + 2;
    }
    return $array;
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
//$bubbleSort = bubbleSort($array);
//print_r($bubbleSort);
//echo '<br/>';
//
//$selectSort = selectSort($array);
//print_r($selectSort);
//echo '<br/>';
//
//$insertSort = insertSort($array);
//print_r($insertSort);
//echo '<br/>';
//
//$mergeSort = mergeSort($array);
//print_r($mergeSort);
//echo '<br/>';
//
//$quickSort = quickSort($array);
//print_r($quickSort);
//echo '<br/>';
//
//$bucketSort = bucketSort($array);
//print_r($bucketSort);
//echo '<br/>';
//
//$LsdRadixSort = LsdRadixSort($array);
//print_r($LsdRadixSort);
//echo '<br/>';
//
//$MsdRadixSort = MsdRadixSort($array);
//print_r($MsdRadixSort);
//echo '<br/>';

//$shellSort = shellSort($array);
//print_r($shellSort);
//echo '<br/>';

$heapSort = heapSort($array);
print_r($heapSort);
echo '<br/>';