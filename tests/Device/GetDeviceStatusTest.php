<?php
/**
 * 获取设备状态测试
 * User: chocoboxxf
 * Date: 2017/8/31
 */
namespace chocoboxxf\Ulucu\Tests\Device;

use chocoboxxf\Ulucu\Tests\BaseTest;

/**
 * 获取设备状态测试
 * @package chocoboxxf\Ulucu\Tests\Device
 */
class GetDeviceStatusTest extends BaseTest
{
    public function testGet()
    {
        $deviceSn = 'Abcdefg1234567';
        $ret = $this->client->getDeviceStatus($deviceSn);
        var_dump($ret);
    }
}