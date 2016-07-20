<?php
namespace Leo;

/**
 * 地理位置相关类
 * User: leo
 * Date: 2016/7/2
 * Time: 14:52
 */
class Geo
{
    // 高德的类型对应关系
    private $_gaode_catelog_mapping = [
        10102 => '加油站',
        50000 => '蛋糕店',
        60200 => '便利店',
        50111 => '北京菜',
        50100 => '中餐',
        60404 => '综合超市',
        70000 => '生活服务',
        71300 => '快照冲印',
        80000 => '休闲娱乐',
        90000 => '医疗',
        90100 => '一甲医院',
        90102 => '社区医院',
        90300 => '诊所',
        90400 => '急救中心',
        190301 => '道路',
        991400 => '门',
        991401 => '门/南',
        100100 => '商务酒店',
        100103 => '四星级酒店',
        100200 => '旅馆招待所',
        110101 => '公园',
        120000 => '住宅区',
        120201 => '写字楼',
        120203 => '住宅区',
        120300 => '住宅区/1',
        120302 => '住宅区/2',
        120303 => '宿舍',
        141201 => '高校',
        141201 => '中学',
        141202 => '中学',
        141203 => '小学',
        141206 => '职业学校',
        150700 => '公交站',
        150904 => '路边停车场',
        150905 => '地下停车场',
        150907 => '停车场入口',
        150500 => '地铁站',
        190306 => '桥',
        190403 => '门牌地址',
        190700 => '商圈',

    ];

    private $_gaode_arr_borough = ['120000', '120201', '120203',
                                   '120300', '120302', '120303', '190403'];

    // 百度的城市对应关系
    private $_baidu_city_mapping = [
        'bj' => 131,
        'sh' => 289,
        'gz' => 257,
        'sz' => 340,
        'nj' => 315
    ];

    // 百度的城市分类对应关系
    private $_baidu_catelog_mapping = [
        24 => '商务大厦',
        25 => '地产小区',
        236 => '办公大厦',
        238 => '小区/楼盘'
    ];


    public function getGeo($word)
    {
        try {
            try {
                $list = $this->getGaodeList($word);
                $geo = $this->getGaodeMatchGeo($list, $this->_gaode_arr_borough);
                $geo = $this->_convertCoord($geo);
            } catch (\Exception $e) {
                $geo = $this->getBaiduGeo($word, '北京');
            }
            return $geo;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 获取高德匹配类型的坐标值
    private function getGaodeMatchGeo($list, $categorys = [])
    {
        try {foreach ($list as $v) {
                if(empty($categorys) || in_array($v['category'],$categorys)) {
                    return [
                        'lng' => $v['x'],
                        'lat' => $v['y']
                    ];
                }
            }
            throw new EmptyException('搜索结果中无匹配类型的数据');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 获取高德的搜索列表
    public function getGaodeList($word)
    {
        try {
            $url = 'http://ditu.amap.com/service/poiTipslite?&city=110000&words=' . urlencode($word);
            $str_res = curl_get($url);
            $return = [];

            if (empty($str_res)) {
                E("url请求错误！【{$url}}】");
            }

            $arr_res = json_decode($str_res, true);

            if (1 != $arr_res['status']) {
                E($arr_res['data'], $arr_res['status']);
            }

            if (1 != $arr_res['data']['code'] || 0 == $arr_res['data']['total']) {
                E('查询失败');
            }

            $return  = array_column($arr_res['data']['tip_list'], 'tip');

            return $return;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 获取百度的经纬度
    public function getBaiduGeo($word, $city)
    {
        try {
            // 检测并获取城市id
            $word = urlencode($word);

            // 请求接口内容
            $url = "http://api.map.baidu.com/geocoder/v2/?ak=aqLgbABLabxT9csGOEhrjDFM&output=json&address={$word}&city={$city}";

            $res = json_decode(curl_get($url), true);

            if (0 != $res['status']) {
                E('查询百度经纬度接口失败');
            }

            $geo = $res['result']['location'];

            return $geo;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 百度坐标转换成经纬度
    private function _convertCoord($geo, $from = 3, $to = 5)
    {
        try {
            // 判空处理
            if (!isset($geo['lng'], $geo['lat'])) {
                E('参数为空');
            }

            $url = "http://api.map.baidu.com/geoconv/v1/?coords={$geo['lng']},{$geo['lat']}&from={$from}&to={$to}&ak=EF06cfb26173665ad80b8edf6a328192";
            $res = json_decode(file_get_contents($url), true);

            if (0 != $res['status']) {
                E("百度坐标转换接口请求失败，失败信息（{$res['message']}}）");
            }

            $geo['lng'] = $res['result'][0]['x'];
            $geo['lat'] = $res['result'][0]['y'];

            return $geo;
        } catch (\Exception $e) {
            throw $e;
        }
    }


    // 获取小区相关的分类id
    private function _getCatelogId()
    {
        try {
            return array_keys($this->_catelog_mapping);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    // 检查city参数是否合法
    private function _checkCityParam($city)
    {
        try {
            if (empty($this->_city_mapping[$city])) {
                E('city参数不合法');
            } else {
                return $this->_city_mapping[$city];
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}