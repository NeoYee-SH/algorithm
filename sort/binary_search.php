<?php
/**
 * Created by PhpStorm.
 * User: yihuaiyuan
 * Date: 2018/8/16
 * Time: 下午5:04
 */

/**
 * @param array $list
 * @param int $item
 * @return int|null
 */
function binary_search(array $list, int $item):?int {

    $start = 0;
    $end = count($list) - 1;
    while ($start <= $end) {
        $mid = (int)(($start + $end) / 2);
        if ($list[$mid] < $item) {
            $start = $mid + 1;
        } elseif ($list[$mid] > $item) {
            $end = $mid - 1;
        } else {
            return $mid;
        }
    }
    return null;
}

$max = 414345;
$arr = range(1, $max);
$ret = binary_search(array_values($arr), 213);
var_dump($ret);