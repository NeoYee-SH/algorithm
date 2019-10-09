<?php
/**
 * User: yihuaiyuan
 * Date: 2019-08-22
 */

/**
 * 按照二位数组中的某个字段排序（堆排序）
 * @param array $arr
 * @param string $field
 * @param string $orderBy asc|desc
 * @return array
 */
function sort_by_field(array &$arr, string $field, string $orderBy = 'asc'):array
{
    $len = \count($arr);
    if($len <= 1)
    {
        return $arr;
    }

    $dad = ceil($len/2)-1;
    for($i=$dad; $i>=0; $i--)
    {
        max_heap($arr, $i, $len, $field, $orderBy);
    }

    for($j=$len-1; $j>0; $j--)
    {
        swap($arr[0], $arr[$j]);
        max_heap($arr, 0, $j, $field, $orderBy);
    }

    return $arr;
}
function max_heap(array &$arr, int $start, int $end, string $field, string $orderBy = 'asc'):void
{
    $dad = $start;//父节点
    $son = $dad * 2 +1;//左子节点

    if($son >= $end)
    {
        return;
    }

    if($orderBy === 'asc')
    {
        if($son+1 < $end && isset($arr[$son+1][$field]) && isset($arr[$son][$field]) && $arr[$son][$field] < $arr[$son+1][$field])
        {
            $son++;
        }

        if(isset($arr[$dad][$field]) && isset($arr[$son][$field]) && $arr[$dad][$field] <= $arr[$son][$field])
        {
            swap($arr[$dad], $arr[$son]);
            max_heap($arr, $son, $end, $field, $orderBy);
        }
    }
    else
    {
        if($son+1 < $end && isset($arr[$son+1][$field]) && isset($arr[$son][$field]) && $arr[$son][$field] > $arr[$son+1][$field])
        {
            $son++;
        }

        if(isset($arr[$dad][$field]) && isset($arr[$son][$field]) && $arr[$dad][$field] >= $arr[$son][$field])
        {
            swap($arr[$dad], $arr[$son]);
            max_heap($arr, $son, $end, $field, $orderBy);
        }
    }
}
function swap(&$x, &$y):void
{
    $t = $x;
    $x = $y;
    $y = $t;
}