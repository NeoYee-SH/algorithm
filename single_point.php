<?php
/**
 * Created by PhpStorm.
 * User: yihuaiyuan
 * Date: 2018/11/22
 * Time: 4:23 PM
 */

/**
 * 判断同一平面上point是否在triangle内
 *
 * @param array $x
 * @param array $y
 * @param array $z
 * @param array $p
 * @return bool
 */
function point_in_triangle(array $x, array $y, array $z, array $p):bool
{
    //三角形面积计算
    $dealFunc = function(array $x, array $y, array $z)
    {
        return abs(($x[0] * $y[1] + $y[0] * $z[1] + $z[0] * $x[1] - $x[0] * $z[1] - $y[0] * $x[1] - $z[0] * $y[1])) / 2;
    };

    $s1 = $dealFunc($x, $y, $p) + $dealFunc($y, $z, $p) + $dealFunc($z, $x, $p);
    $s2 = $dealFunc($x, $y, $z);

    //判断分割之后的3个三角形面积是否正好等于原三角形面积
    return round($s1, 4) == round($s2, 4);
}

$x = [3, 5];
$y = [17, 1.5];
$z = [9, 13.7];

$p1 = [18.5, 11.6];
$p2 = [8.821, 8.602];
$p3 = [9, 13.7];

var_dump(point_in_triangle($x, $y, $z, $p1));
echo PHP_EOL;
var_dump(point_in_triangle($x, $y, $z, $p2));
echo PHP_EOL;
var_dump(point_in_triangle($x, $y, $z, $p3));

exit;




