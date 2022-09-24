<?php

function init(string $arrayStr, callable $print) {
    $token = strtok($arrayStr, ',');
    $arr = [];
    while ($token !== false) {
        array_push($arr, $token);
        $token = strtok(',');
    }
    $arr = quickSort($arr);
    $print($arr);
}

function quickSort($array)
    {
        $count = count($array);
        if($count<=1) return $array;
        $baseValue = $array[0];
        $leftArr = $rightArr = array();
        for ($i=1;$i<$count;$i++) {
            if($baseValue > $array[$i]) {
                $leftArr[] = $array[$i];
            } else {
                $rightArr[] = $array[$i];
            }
        }
        $leftArr = quickSort($leftArr);
        $rightArr = quickSort($rightArr);
     
        return array_merge($leftArr,array($baseValue),$rightArr);
    }
?>