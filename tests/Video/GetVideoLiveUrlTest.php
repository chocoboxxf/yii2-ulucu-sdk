<?php
/**
 * 获取设备观看实时视频地址测试
 * User: chocoboxxf
 * Date: 2017/8/31
 */
namespace chocoboxxf\Ulucu\Tests\Video;

use chocoboxxf\Ulucu\Tests\BaseTest;
use chocoboxxf\Ulucu\Ulucu;

/**
 * 获取设备观看实时视频地址测试
 * @package chocoboxxf\Ulucu\Tests\Video
 */
class GetVideoLiveUrlTest extends BaseTest
{
    public function testGet()
    {
        $deviceSn = 'Abcdefg1234567';
        $channelId = Ulucu::DEFAULT_CHANNEL_ID;
        $rate = Ulucu::DEFAULT_RATE;
        $ret = $this->client->getVideoLiveUrl($deviceSn, $channelId, $rate);
        var_dump($ret);
    }
}