<?php
namespace Leo;

/**
 * 地理位置相关类
 * User: leo
 * Date: 2016/7/2
 * Time: 14:52
 */
class Net
{
    /*
     * 解析url中的参数
     *
     * @author leo<leo19920823@gmail.com>
     * @params $url string url字符串
     *
     * @return $params array 参数名和参数值组成的关联数组
     */
    static function parse_url_params($url)
    {
        try {
            $parse = parse_url($url);
            $query = '';
            if (isset($parse['query'])) {
                $query .= $parse['query'];
            }
            if (isset($parse['fragment'])) {
                if (empty($query)) {
                    $query = $parse['fragment'];
                } else {
                    $query .= '&' . $parse['fragment'];
                }
            }
            $queryParts = explode('&', $query);
            $params = array();
            foreach ($queryParts as $param) {
                $item = explode('=', $param);
                $params[$item[0]] = $item[1];
            }
            return $params;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /*
     *curl请求
     *
     */
    static function curl_post($url,$fields)
    {
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.648; .NET CLR 3.5.21022)");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID=' . C('CURL_SESSION_ID'));
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /*
     * curl请求
     *
     */
    static function curl_get($url, $gzip = false, $ua = true)
    {
        $ch = curl_init($url);
        $uas = [
            'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:2.0.1) Gecko/20100101 Firefox/4.0.1',
            'Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1',
            'Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; en) Presto/2.8.131 Version/11.11',
            'Opera/9.80 (Windows NT 6.1; U; en) Presto/2.8.131 Version/11.11',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_0) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11',
            'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Maxthon 2.0)',
            'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; TencentTraveler 4.0)',
            'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; The World)',
            'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Trident/4.0; SE 2.X MetaSr 1.0; SE 2.X MetaSr 1.0; .NET CLR 2.0.50727; SE 2.X MetaSr 1.0)',
            'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; 360SE)'
        ];
        $c_ua = count($uas);
        if ($ua) {
            curl_setopt($ch,CURLOPT_USERAGENT,$uas[rand(0, $c_ua - 1)]);
        }
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        if($gzip) curl_setopt($ch, CURLOPT_ENCODING, "gzip"); // 关键在这里
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}