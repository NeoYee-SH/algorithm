<?php
/**
 * Created by PhpStorm.
 * User: yihuaiyuan
 * Date: 2018/12/5
 * Time: 1:38 PM
 */


ini_set('memory_limit', '2048M');

/**
 * 快递排序
 *
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

/**
 * TopK
 *
 * @param array $arr
 * @param int $k
 * @return int
 */
function bfprt(array $arr, int $k):int
{
    $len = \count($arr);

    if($len <= 1)
    {
        return $arr[0];
    }

    //求中位数的中位数
    $mid_val = get_m_median($arr);
    $mid_key = array_search($mid_val, $arr);

    //分成大小分化的两堆
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

    $lenLeft = \count($left);
    if($lenLeft === $k-1)//一次命中
    {
        $ret = $mid_val;
    }
    elseif($lenLeft >= $k)//左边的多于K，右边不需要递归
    {
        $ret = bfprt($left, $k);
    }
    else//左边的不够K，左边不需要递归
    {
        $newK = ($k - $lenLeft) -1;
        $ret = bfprt($right, $newK);
    }
    return $ret;
}

/**
 * 中位数的中位数
 *
 * @param array $arr
 * @return mixed
 */
function get_m_median(array $arr)
{
    $size = 5;
    $len = \count($arr);
    if($len <= $size)//数组不足5个的情况下，直接求中位数
    {
        $ret = get_median($arr);
    }
    else
    {
        //5个一组，先求每一组的中位数，得到一个中位数数组
        $tmpArr = array_chunk($arr, $size);
        $tmpData = [];
        foreach ($tmpArr as $tmp)
        {
            $tmpData[] = get_median($tmp);
        }

        //然后求中位数的中位数
        $ret = get_m_median($tmpData);
    }

    return $ret;
}

/**
 * 求中位数
 *
 * @param array $arr
 * @return mixed
 */
function get_median(array $arr)
{
    $len = \count($arr);
    $arr = quick_sort($arr);
    $mid_key = ceil($len / 2) -1;
    return $arr[$mid_key];
}


//test
$sum = $argv[1] ?? 1000000;
$arr =range(1,$sum);
shuffle($arr);
$k = $argv[2] ?? 10000;

$time = microtime(true);

$ret = bfprt($arr, $k);

$time1 = microtime(true);

$arr = quick_sort($arr);
$ret = $arr[$k-1];

$time2 = microtime(true);

$bfprt_time = $time1 - $time;
$sort_time = $time2 - $time1;

echo "bfprt use time {$bfprt_time} and result is {$ret}/{$sum}" . PHP_EOL;
echo "quick_sort use time {$sort_time} and result is {$ret}/{$sum}" . PHP_EOL;



/*
 [root@skyland html]# php TopK.php 100000 8888
bfprt use time 0.11682486534119 and result is 8888/100000
quick_sort use time 0.1537721157074 and result is 8888/100000
[root@skyland html]# php TopK.php 100000 8888
bfprt use time 0.11237096786499 and result is 8888/100000
quick_sort use time 0.14947390556335 and result is 8888/100000
[root@skyland html]# php TopK.php 100000 8888
bfprt use time 0.11310601234436 and result is 8888/100000
quick_sort use time 0.16168689727783 and result is 8888/100000
 */

