<?php
/**
 * 获取门店视频列表测试
 * User: chocoboxxf
 * Date: 2017/9/18
 */
namespace chocoboxxf\Ulucu\Tests\Device;

use chocoboxxf\Ulucu\Tests\BaseTest;

/**
 * 获取门店视频列表测试
 * @package chocoboxxf\Ulucu\Tests\Device
 */
class GetStoreDeviceChannelListTest extends BaseTest
{
    public function testGet()
    {
        $storeId = '12345';
        $lastUpTime = date('Y-m-d H:i:s', time());
        $ret = $this->client->getStoreDeviceChannelList($storeId, $lastUpTime);
        var_dump($ret);
    }
}