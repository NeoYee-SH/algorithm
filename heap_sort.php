<?php
/**
 * Created by PhpStorm.
 * User: yihuaiyuan
 * Date: 2018/8/16
 * Time: 下午5:00
 */

/**
 * 交换
 * @param $x
 * @param $y
 */
function swap(&$x, &$y) {
    $t = $x;
    $x = $y;
    $y = $t;
}

/**
 * 堆排序
 * 完全二叉树，父节点和子节点的下标可以通过公式算出来
 * 递归的找到堆顶，并依次换到堆尾从堆尾向堆顶排列。
 * @param array $arr
 * @return array
 */
function heap_sort(array $arr):array
{
    $len = \count($arr);
    if($len <= 1)
    {
        return $arr;
    }

    /**
     * 将最大值放到堆顶，并保证父节点的值不比子节点小
     */
    $dad = ceil($len/2)-1;//最后一个子节点的父节点
    for($i=$dad; $i>=0; $i--)
    {
        max_heap($arr, $i, $len);//依次对所有父节点进行max_heap操作
    }

    for($j=$len-1; $j>0; $j--)
    {
        swap($arr[0], $arr[$j]);//将最大的节点转移到最后
        max_heap($arr, 0, $j);//再将余下里面最大的转移到最上面
    }

    return $arr;

}

/**
 * @param array $arr
 * @param int $start
 * @param int $end
 */
function max_heap(array &$arr, int $start, int $end):void
{
    $dad = $start;//父节点
    $son = $dad * 2 +1;//左子节点

    if($son >= $end)//子节点超过比较范围
    {
        return;
    }

    if($son+1 < $end && isset($arr[$son+1]) && isset($arr[$son]) && $arr[$son] < $arr[$son+1])
    {
        $son++;//存在右子节点，且右子节点较大，取右子节点
    }

    if(isset($arr[$dad]) && isset($arr[$son]) && $arr[$dad] <= $arr[$son])//交换父子节点
    {
        swap($arr[$dad], $arr[$son]);
        max_heap($arr, $son, $end);//交换影响到的子节点对应的父子节点
    }
}
