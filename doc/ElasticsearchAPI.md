# ElasticsearchAPI 概述

## 简介
本类采用es的官方REST API 

## 方法原型
```php
// 使用地址构造
ElasticsearchAPI __construct($host)

// 尝试是否畅通
bool ping()

// 插入一条数据,指定id
bool function set($index, $type, $id, $data)

// 获取指定一条数据
array get($index, $type, $id)

// 统计某个type的文档数
int total($index, $type)

// 更新字段
bool save($index, $type, $id, $data)

// 删除数据
bool del($index, $type, $id)

```

# 使用

## 实例化 
1. 首先拿到es集群中某一节点的链接
2. 在实例化的时候传入es链接
```php
$es = new \Leo\ElasticsearchAPI("http://127.0.0.1:9200");
```

## 设置数据
```php 
$index = 'test_index';
$type = 'test_type';
$id = 1;
$data = [
    "name" => "leo",
    "age" => 18,
    "addr" => '北京'
];
$es->set($index, $type, $id, $data);
```

## 获取数据
```php 
$index = 'test_index';
$type = 'test_type';
$id = 1;
$es->get($index, $type, $id);
```

## 更新数据
```php 
$index = 'test_index';
$type = 'test_type';
$id = 1;
$data = [
    "addr" => '上海',
    "email" => "leo19920823@gmail.com"
];
$es->save($index, $type, $id, $data);
```

## 删除数据
```php 
$index = 'test_index';
$type = 'test_type';
$id = 1;
$es->del($index, $type, $id);
```

## 统计总数
```php 
$index = 'test_index';
$type = 'test_type';
$es->total($index, $type);
```

