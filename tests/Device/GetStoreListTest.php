<?php
/**
 * 获取用户有权限的所有店铺列表和店铺详情测试
 * User: chocoboxxf
 * Date: 2017/8/23
 */
namespace chocoboxxf\Ulucu\Tests\Device;

use chocoboxxf\Ulucu\Tests\BaseTest;

/**
 * 获取用户有权限的所有店铺列表和店铺详情测试
 * @package chocoboxxf\Ulucu\Tests\Device
 */
class GetStoreListTest extends BaseTest
{
    public function testGet()
    {
        $ret = $this->client->getStoreList();
        var_dump($ret);
    }
}