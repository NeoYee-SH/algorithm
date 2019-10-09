<?php
/**
 * Created by PhpStorm.
 * User: yihuaiyuan
 * Date: 2018/8/16
 * Time: 下午4:40
 */

/**
 * 插入排序
 * 将新元素插入到一个已经排序的序列中
 * 最坏情况下的时间复杂度都是 O(n^2)，最好情况下都是 O(n)，空间复杂度是 O(1)
 *
 * @param array $arr
 * @return array
 */
function insertion_sort(array $arr):array
{
    $len = \count($arr);
    for($i=1; $i<$len; $i++)//$arr[0]已排序
    {
        if($arr[$i-1] > $arr[$i])
        {
            $tmp = $arr[$i];
            for($j=$i-1; isset($arr[$j]) && $arr[$j]>$tmp; $j--)
            {
                $arr[$j+1] = $arr[$j];
            }
            $arr[$j+1] = $tmp;
        }

    }
    return $arr;
}
