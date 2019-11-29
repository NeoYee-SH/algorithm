<?php

function select_sort(array $list):array {
    $findSmallest = static function (array $list):int {
        $minIndex = 0;
        $min = $list[$minIndex];
        foreach ($list as $key => $value) {
            if ($value < $min) {
                $min = $value;
                $minIndex = $key;
            }
        }
        return $minIndex;
    };

    $ret = [];
    while (count($list) > 0) {
        $min = $findSmallest($list);
        $ret[] = $list[$min];
        unset($list[$min]);
        $list = array_values($list);
    }
    return $ret;
}



$list = [3,6,8,2,4,9,5,4];
$ret = select_sort($list);
print_r($ret);
exit;
