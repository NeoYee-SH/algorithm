<?php
/**
 * Created by PhpStorm.
 * User: yihuaiyuan
 * Date: 2018/8/16
 * Time: 下午4:57
 */

/**
 * 快速排序
 * @param array $arr
 * @return array
 */
function quick_sort(array $arr):array
{
    $len = \count($arr);

    if($len <= 1)
    {
        return $arr;
    }
    $mid_key = mt_rand(0, $len-1);
    $mid_val = $arr[$mid_key];//随机取一个元素作为基准

    $left = $right = [];
    for($i=0; $i<$len; $i++)
    {
        if($i === $mid_key)//跳过基准元素本身
        {
            continue;
        }
        if($mid_val > $arr[$i])
        {
            $left[] = $arr[$i];
        }
        else
        {
            $right[] = $arr[$i];
        }
    }

    return array_merge(quick_sort($left), [$mid_val], quick_sort($right));
}

