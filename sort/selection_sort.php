<?php
/**
 * Created by PhpStorm.
 * User: yihuaiyuan
 * Date: 2018/8/17
 * Time: 下午2:56
 */

function selection_sort(array $arr):array
{
    $len = \count($arr);
    if($len <= 1)
    {
        return $arr;
    }

    for($i=0; $i<$len-1; $i++)
    {
        for($j=$i; $j<$len; $j++)
        {
            if($arr[$i] > $arr[$j])
            {
                swap($arr[$i], $arr[$j]);
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
