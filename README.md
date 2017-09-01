# yii2-ulucu-sdk
基于Yii2实现的悠络客开放平台 API SDK（目前开发中）

环境条件
--------
- >= PHP 5.4
- >= Yii 2.0
- >= GuzzleHttp 6.0

安装
----

添加下列代码在``composer.json``文件中并执行``composer update --no-dev``操作

```json
{
    "require": {
       "chocoboxxf/yii2-ulucu-sdk": "dev-master"
    }
}
```

设置方法
--------

```php
// 全局使用
// 在config/main.php配置文件中定义component配置信息
'components' => [
  .....
  'ulucu' => [
    'class' => 'chocoboxxf\Ulucu\Ulucu',
    'url' => 'http://open.umtrix.com', // 悠络客开放平台API域名
    'appId' => '10000', // 开发者ID
    'secret' => 'abcdefghijklmn1234567', // 开发者秘钥
    'version' => '1', 接口版本
  ]
  ....
]
// 代码中调用（调用获取设备状态接口示例）
$deviceSn = 'Abcdefg1234567'; // 设备sn
$result = Yii::$app->ulucu->getDeviceStatus($deviceSn); // 调用获取设备状态接口
....
```

```php
// 局部调用
$ulucu = Yii::createObject([
    'class' => 'chocoboxxf\Ulucu\Ulucu',
    'url' => 'http://open.umtrix.com', // 悠络客开放平台API域名
    'appId' => '10000', // 开发者ID
    'secret' => 'abcdefghijklmn1234567', // 开发者秘钥
    'version' => '1', 接口版本
]);
// 调用获取设备状态接口示例
$deviceSn = 'Abcdefg1234567'; // 设备sn
$result = $ulucu->getDeviceStatus($deviceSn); // 调用获取设备状态接口
....
```

使用示例
--------

获取用户有权限的所有店铺列表和店铺详情接口

```php
$result = Yii::$app->ulucu->getStoreList(); // 调用获取用户有权限的所有店铺列表和店铺详情接口

if ($result['code'] === 0) {
    // 调用成功
    // 返回数据格式
    // {
    //     "code": 0,
    //     "data": [
    //         {
    //             "store_id": "12345",
    //             "store": "测试商铺",
    //             "store_code": "",
    //             "prov": "0",
    //             "city": "1000",
    //             "area": "100000",
    //             "branch_code": "1000000000",
    //             "store_image": "",
    //             "shopowner": "",
    //             "shopowner_phone": "",
    //             "user_id": "0",
    //             "user_name": "",
    //             "measure": "0",
    //             "addr": "测试地址",
    //             "store_phone": "13000000000",
    //             "store_remarks": "",
    //             "store_status": "2",
    //             "last_uptime": "2017-09-01 00:00:00",
    //             "create_time": "2017-09-01 00:00:00",
    //             "lng": "0.00000000000",
    //             "lat": "0.00000000000",
    //             "latlng_flag": "0",
    //             "sort": "0",
    //             "more_phone": []
    //         }
    //     ],
    //     "msg": "请求成功",
    //     "data_md5": "f99a0404360d0c348fa30792e31a7eed"
    // }
    ....
} else {
    // 调用失败
    // 返回数据格式
    // {
    //     "msg": "check authorization failed GET method",
    //     "code": 100,
    //     "data": []
    // }
    ....
}
....
```

获取门店设备列表接口

```php
$storeId = '12345'; // 门店id
$type = Ulucu::DEVICE_TYPE_NVR; // 设备类型

$result = Yii::$app->ulucu->getStoreDeviceList($storeId, $type); // 调用获取门店设备列表接口

if ($result['code'] === 0) {
    // 调用成功
    // 返回数据格式
    // {
    //     "code": 0,
    //     "data": [
    //         {
    //             "device_id": "12345",
    //             "sn": "Abcdefg1234567",
    //             "type_id": "2",
    //             "create_time": "2017-09-01 00:00:00",
    //             "alias": "",
    //             "upload_rate": "",
    //             "is_bind": 0
    //         }
    //     ],
    //     "msg": "请求成功",
    //     "data_md5": "1abbb5dc5092e9d281162844c0a6cf26"
    // }
    ....
} else {
    // 调用失败
    // 返回数据格式
    // {
    //     "msg": "check authorization failed GET method",
    //     "code": 100,
    //     "data": []
    // }
    ....
}
....
```

获取门店设备列表(含上下线状态)接口

```php
$storeId = '12345'; // 门店id

$result = Yii::$app->ulucu->getStoreDeviceListWithStatus($storeId); // 调用获取门店设备列表(含上下线状态)接口

if ($result['code'] === 0) {
    // 调用成功
    // 返回数据格式
    // {
    //     "code": 0,
    //     "data": [
    //         {
    //             "device_id": 12345,
    //             "sn": "Abcdefg1234567",
    //             "type_id": 2,
    //             "create_time": "2017-09-01 00:00:00",
    //             "store_id": "12345",
    //             "status": 1,
    //             "name": "测试摄像头",
    //             "off_time": "2017-09-01 00:00:00"
    //         }
    //     ],
    //     "msg": "请求成功",
    //     "data_md5": "0acca0b9b2dbb10f6687ee2e0e42e885"
    // }
    ....
} else {
    // 调用失败
    // 返回数据格式
    // {
    //     "code": 302018,
    //     "msg": "store_id is not store id"
    // }
    ....
}
....
```

获取设备状态接口

```php
$deviceSn = 'Abcdefg1234567'; // 设备sn

$result = Yii::$app->ulucu->getDeviceStatus($deviceSn); // 调用获取设备状态接口

if ($result['code'] === 0) {
    // 调用成功
    // 返回数据格式
    // {
    //     "code": 0,
    //     "data": {
    //         "status": 1,
    //         "device_sn": "Abcdefg1234567"
    //     },
    //     "msg": "请求成功"
    // }
    ....
} else {
    // 调用失败
    // 返回数据格式
    // {
    //     "code": 305017,
    //     "msg": "device not exist"
    // }
    ....
}
....
```

获取设备观看实时视频地址接口

```php
$deviceSn = 'Abcdefg1234567'; // 设备sn
$channelId = Ulucu::DEFAULT_CHANNEL_ID; // 通道号
$rate = Ulucu::DEFAULT_RATE; // 码率

$result = Yii::$app->ulucu->getVideoLiveUrl($deviceSn, $channelId, $rate); // 调用获取设备观看实时视频地址接口

if ($result['code'] === 0) {
    // 调用成功
    // 返回数据格式
    // {
    //     "code": 0,
    //     "data": {
    //         "m3u8": "http://hls.kan1.live.anyan.com/live_12345_123456/m3u8?sign=1234567-abcdefg&device_sn=Abcdefg1234567&video_rate=1000&channel_id=1"
    //     },
    //     "msg": "请求成功"
    // }
    ....
} else {
    // 调用失败
    // 返回数据格式
    // {
    //     "code": 305017,
    //     "msg": "device not exist"
    // }
    ....
}
....
```

获取设备观看回放视频地址接口

```php
$deviceSn = 'Abcdefg1234567'; // 设备sn
$time = time() - 3600; // 视频开始时间，时间戳
$duration = Ulucu::DEFAULT_DURATION; // 观看时长
$channelId = Ulucu::DEFAULT_CHANNEL_ID; // 通道号

$result = Yii::$app->ulucu->getVideoLiveUrl($deviceSn); // 调用获取设备观看回放视频地址接口

if ($result['code'] === 0) {
    // 调用成功
    // 返回数据格式
    // {
    //     "code": 0,
    //     "data": {
    //         "m3u8": "http://101.201.56.185:9110/record.m3u8?channel_idx=1&device_id=Abcdefg1234567&duration=3600&from_ip=127.0.0.1&is_shared=1&rate=1000&session=abcdefg1234567&time=1500000000&token_expire=3600&user_name=1000&ver=&token=abcdefg1234567-ABCDEFG1234567&v_width=0&v_height=0&valid_time=1500000000"
    //     },
    //     "msg": "请求成功"
    // }
    ....
} else {
    // 调用失败
    // 返回数据格式
    // {
    //     "code": 305017,
    //     "msg": "device not exist"
    // }
    ....
}
....
```

