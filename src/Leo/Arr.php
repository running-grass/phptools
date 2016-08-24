<?php
namespace Leo;

// 数组相关类
class Arr
{
    // 过滤多维数组中的空值
    public static function filter_empty(&$arr)
    {
        try {
            if (!is_array($arr)) {
                throw new Exception('参数类型不对');
            }

            foreach ($arr as $k => &$v) {
                if (empty($v)) {
                    unset($arr[$k]);
                } else {
                    if (is_array($v)) {
                        $arr2 = self::filter_empty($v);

                        if (empty($arr2)) {
                            unset($arr[$k]);
                        } else {
                            $v = $arr2;
                        }
                    }
                }
            }

            return $arr;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 补充合并两个数组
    public static function merge_supplement($arr, $arr1)
    {
        try {
            if (empty($arr) || empty($arr1)) {
                throw new Exception('参数为空');
            }

            foreach ($arr1 as $k => $v) {
                // 如果是索引数组的话，是追加合并, 否则是补充合并
                if ('integer'  == getType($k)) {
                    if (is_array($v)) {
                        return self::array_vm($arr, $arr1);
                    } else {
                        return self::array_vum($arr, $arr1);
                    }
                } else {
                    if (empty($arr[$k])) {
                        if (is_array($v)) {
                            $arr[$k] = self::merge_supplement($arr[$k], $arr1[$k]);
                        } elseif ('' === $arr[$k]) {
                            $arr[$k] = $arr1[$k];
                        }
                    } else {
                        $arr[$k] = $v;
                    }
                }
            }
            return $arr;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 值得合并且去重
    public static function array_vum($arr, $arr1)
    {
        try {
            if (empty($arr)) $arr = [];
            if (empty($arr1)) $arr1 = [];

            if (!is_array($arr)) {
                $arr = [$arr];
            }
            if (!is_array($arr1)) {
                $arr1 = [$arr1];
            }
            return array_values(array_unique(array_filter(array_merge($arr, $arr1))));
        } catch (\Exception $e) {
            throw $e;
        }
    }


    // 值的合并
    public static function array_vm($arr, $arr1)
    {
        try {
            if (empty($arr)) $arr = [];
            if (empty($arr1)) $arr1 = [];

            if (!is_array($arr)) {
                $arr = [$arr];
            }
            if (!is_array($arr1)) {
                $arr1 = [$arr1];
            }
            return array_values(array_filter(array_merge($arr, $arr1)));
        } catch (\Exception $e) {
            throw $e;
        }
    }


    // 值的去重并重建索引
    public static function array_vu($arr)
    {
        try {
            if (!is_array($arr)) {
                $arr = (array)$arr;
            }
            return array_values(array_filter(array_unique($arr)));
        } catch (\Exception $e) {
            throw $e;
        }
    }
}