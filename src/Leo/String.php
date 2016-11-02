<?php
namespace Leo;

// 数组相关类
class String
{
    // guplv mult string
    public static function altrim($str, $arr)
    {
        try {
            foreach ($arr as &$item) {
                if (is_string($item)) {
                    $str= preg_replace("/^{$item}/", '', $str);
                }
            }

            return $str;
        } catch (\Exception $e) {}
    }

    // guplv mult string
    public static function artrim($str, $arr)
    {
        try {
            foreach ($arr as &$item) {
                if (is_string($item)) {
                    $str= preg_replace("/{$item}\$/", '', $str);
                }
            }

            return $str;
        } catch (\Exception $e) {}
    }
}