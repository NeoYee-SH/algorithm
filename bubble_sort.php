<?php
/**
 * Created by PhpStorm.
 * User: yihuaiyuan
 * Date: 2018/8/16
 * Time: 下午4:59
 */


/**
 * 最坏情况下的时间复杂度都是 O(n^2)，最好情况下都是 O(n)，空间复杂度是 O(1)
 */
/**
 * 冒泡排序
 * @param array $arr
 * @return array
 */
function bubble_sort(array $arr):array
{
    $len = \count($arr);
    if($len <= 1)
    {
        return $arr;
    }

    for($i=0; $i<$len-1; $i++)
    {
        for($j=0; $j<$len-$i-1; $j++)
        {
            if($arr[$j] > $arr[$j+1])
            {
                swap($arr[$j], $arr[$j+1]);
            }

        }
    }

    return $arr;
}

/**
 * 交换
 * @param $x
 * @param $y
 */
function swap(&$x, &$y)
{
    $t = $x;
    $x = $y;
    $y = $t;
}
