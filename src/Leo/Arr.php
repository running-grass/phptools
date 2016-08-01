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
                if (is_array($v)) {
                    self::filter_empty($v);
                } else {
                    if (empty($v)) {
                        unset($arr[$k]);
                    }
                }
            }

            return 0;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}