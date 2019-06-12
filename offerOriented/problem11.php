<?php
/**
 * Desc: 数值的整数次方
 * User: jiefuyang
 * Date: 2019-06-12
 * Time: 10:51
 */

function power(
    $base,
    $exponent
) {
    if (!isset($base) || !isset($exponent)) {
        return false;
    }
    if ($exponent == 0) {
        return 1;
    }
    if ($base == 0) {
        if ($exponent < 0) {
            return false;
        } else {
            return 0;
        }
    }

    if ($exponent < 0) {
        $unsignedExponent = 0 - $exponent;
    } else {
        $unsignedExponent = $exponent;
    }

    $result = powerWithUnsignedExponent($base, $unsignedExponent);

    if ($exponent < 0) {
        $result = 1 / $result;
    }

    return $result;
}

function powerWithUnsignedExponent(
    $base,
    $exponent
) {
    if ($exponent == 1) {
        return $base;
    }

    $nextExponent = $exponent >> 1;
    $result       = powerWithUnsignedExponent($base, $nextExponent);
    $result       *= $result;

    if ($exponent % 2 == 1) {
        $result *= $base;
    }

    return $result;
}

var_dump(power(-2, 4));