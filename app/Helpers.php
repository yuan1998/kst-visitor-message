<?php

function inArrayOrNull($val , $arr , $null = '-') {
    return isset($arr[$val]) ? $arr[$val] : $null;
}

function keyValueReplace($arr) {
    $newArr = [];
    foreach ($arr as $key => $value) {
        $newArr[] = [$value => $key];
    }
    return $newArr;
}

function timeToString($second) {
    $result = '';

    if ($second%60 !== 0) {
        $result = ($second%60)."秒";
    }

    if ($second/60 >= 1) {
        $result = intval($second/60) . '分' . $result;
    }

    return $result;
}

function valueOfDefault($arr , $default)
{
    foreach ($arr as $key => $value) {
        if (!$value) {
            $arr[$key] = $default;
        }
    }
    return $arr;
}
