<?php
/**
 * 获取门店设备列表测试
 * User: chocoboxxf
 * Date: 2017/8/31
 */
namespace chocoboxxf\Ulucu\Tests\Device;

use chocoboxxf\Ulucu\Tests\BaseTest;
use chocoboxxf\Ulucu\Ulucu;

/**
 * 获取门店设备列表测试
 * @package chocoboxxf\Ulucu\Tests\Device
 */
class GetStoreDeviceListTest extends BaseTest
{
    public function testGet()
    {
        $storeId = '12345';
        $type = Ulucu::DEVICE_TYPE_NVR;
        $ret = $this->client->getStoreDeviceList($storeId, $type);
        var_dump($ret);
    }
}