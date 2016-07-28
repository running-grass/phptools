<?php
namespace Leo;

// 基类
class Base
{
    function __toString()
    {
        try {
            $str = '';
            foreach ($this as $k => $v) {
                if (is_array($v)) {
                    $v = implode(',', $v);
                }
                $str .= "{$k} => " . $v . "\n";
            }
            return $str;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}