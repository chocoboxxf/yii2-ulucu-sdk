<?php
/**
 * 获取门店设备列表(含上下线状态)测试
 * User: chocoboxxf
 * Date: 2017/8/31
 */
namespace chocoboxxf\Ulucu\Tests\Device;

use chocoboxxf\Ulucu\Tests\BaseTest;

/**
 * 获取门店设备列表(含上下线状态)测试
 * @package chocoboxxf\Ulucu\Tests\Device
 */
class GetStoreDeviceListWithStatusTest extends BaseTest
{
    public function testGet()
    {
        $storeId = '12345';
        $ret = $this->client->getStoreDeviceListWithStatus($storeId);
        var_dump($ret);
    }
}