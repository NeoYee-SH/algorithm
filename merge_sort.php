<?php
/**
 * Created by PhpStorm.
 * User: yihuaiyuan
 * Date: 2018/8/16
 * Time: 下午5:04
 */

/**
 * 归并排序
 * 递归的对两个已经排序的序列进行合并
 * @param array $arr
 * @return array
 */
function merge_sort(array $arr):array
{
    $len = \count($arr);
    if($len <= 1)
    {
        return $arr;
    }

    //分为两个序列
    $tmpArr = array_chunk($arr, ceil($len / 2));

    //对两个序列递归的进行排序
    $left = merge_sort($tmpArr[0]);
    $right = merge_sort($tmpArr[1]);

    //对已经排序的两个序列进行归并
    $minArr = [];
    while($left && $right)
    {
        if($left[0] < $right[0])
        {
            $minArr[] = array_shift($left);
        }
        else
        {
            $minArr[] = array_shift($right);
        }
    }

    return array_merge($minArr, $left, $right);
}
