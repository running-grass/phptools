<?php
namespace Leo;


/*
 * ElasticsearchAPI
 * Elasticsearch的原生REST API
 */
class ElasticsearchAPI
{
    private $host = "";

    // 使用地址构造
    public function __construct($host)
    {
        if (is_array($host)) {
            $this->host = $host[0];
        } else {
            $this->host = $host;
        }
    }

    // 尝试是否畅通
    public function ping()
    {
        $res = $this->call('GET', '/');
        $arr = json_decode($res, true);

        if (isset($arr['status']) && 200 == $arr['status']) {
            return true;
        } else {
            if ($arr['error']) {
                throw new \Exception(json_encode($arr['error']), $arr['status']);
            }
            return false;
        }
    }

    // 插入一条数据,指定id
    public function set($index, $type, $id, $data)
    {
        $uri = "/$index/$type/$id";
        $method = 'PUT';

        $res = $this->call($method, $uri, $data);
        $arr = json_decode($res, true);

        if (isset($arr['_id']) && $id == $arr['_id']) {
            return true;
        } else {
            if ($arr['error']) {
                throw new \Exception(json_encode($arr['error']), $arr['status']);
            }
            return false;
        }
    }

    // 获取指定一条数据
    public function get($index, $type, $id)
    {
        $uri = "/$index/$type/$id";
        $method = 'GET';

        $res = $this->call($method, $uri);
        $arr = json_decode($res, true);

        if (isset($arr['found']) && $arr['found']) {
            return $arr['_source'];
        } else {
            if ($arr['error']) {
                throw new \Exception(json_encode($arr['error']), $arr['status']);
            }
            return false;
        }
    }

    // 统计某个type的文档数
    public function total($index, $type)
    {
        $uri = "/$index/$type/_count";
        $method = 'GET';

        $query = [
            'query' => [
                'match_all' => (object)[]
            ]
        ];

        $res = $this->call($method, $uri, $query);
        $arr = json_decode($res, true);

        if (isset($arr['count']) && $arr['count']) {
            return $arr['count'];
        } else {
            if ($arr['error']) {
                throw new \Exception(json_encode($arr['error']), $arr['status']);
            }
            return false;
        }
    }

    // 更新字段
    public function save($index, $type, $id, $data)
    {
        $uri = "/$index/$type/$id/_update";
        $method = 'POST';

        $res = $this->call($method, $uri, ['doc' => $data]);
        $arr = json_decode($res, true);

        if (isset($arr['_id']) && $id == $arr['_id']) {
            return true;
        } else {
            if ($arr['error']) {
                throw new \Exception(json_encode($arr['error']), $arr['status']);
            }
            return false;
        }
    }

    // 删除数据
    public function del($index, $type, $id)
    {
        if (!$id) {
            return false;
        }
        $uri = "/$index/$type/$id";
        $method = 'DELETE';

        $res = $this->call($method, $uri);
        $arr = json_decode($res, true);

        if (isset($arr['found']) && $arr['found']) {
            return true;
        } else {
            if ($arr['error']) {
                throw new \Exception(json_encode($arr['error']), $arr['status']);
            }
            return false;
        }
    }

    // 设置mapping
    public function setMapping($index, $type, $mapping)
    {
    }

    // 获取索引
    public function getMapping($index, $type)
    {
        $uri = "/$index/_mapping";
        $method = 'GET';

        return $this->call($method, $uri);
    }

    // 执行请求
    private function call($method, $uri, $data = [])
    {
        $ch = curl_init($this->getHost(). $uri);
        $data_string = json_encode($data);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        )
        );
        $result = curl_exec($ch);
        return $result;
    }

    // 获取host地址
    private function getHost()
    {
        return $this->host;
    }
}