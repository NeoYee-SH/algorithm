<?php
/**
 * Created by PhpStorm.
 * User: yihuaiyuan
 * Date: 2018/8/16
 * Time: 下午5:04
 */

/**
 * 二分查找算法
 * 从有序的序列中查找一个特定元素
 * @param array $arr 有序的数组
 * @param $search
 * @param int $start
 * @param int $end
 * @return int|null
 */
function binary_search(array $arr, $search, int $start, int $end)
{

    $mid = (int)floor(($start + $end) / 2);

    if(!isset($arr[$mid]) || $start > $end)
    {
        return null;
    }

    if($arr[$mid] === $search)
    {
        return $mid;
    }
    elseif ($arr[$mid] < $search)
    {
        $start = $mid + 1;
    }
    else
    {
        $end = $mid - 1;
    }

    return binary_search($arr, $search, $start, $end);
}

$max = 495;
$arr = range(1, $max);
$ret = binary_search(array_values($arr), 11, 1, $max);
var_dump($ret);