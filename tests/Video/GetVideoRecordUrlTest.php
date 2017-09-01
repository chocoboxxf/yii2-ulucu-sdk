<?php
/**
 * 获取设备观看回放视频地址测试
 * User: chocoboxxf
 * Date: 2017/8/31
 */
namespace chocoboxxf\Ulucu\Tests\Video;

use chocoboxxf\Ulucu\Tests\BaseTest;
use chocoboxxf\Ulucu\Ulucu;

/**
 * 获取设备观看回放视频地址测试
 * @package chocoboxxf\Ulucu\Tests\Video
 */
class GetVideoRecordUrlTest extends BaseTest
{
    public function testGet()
    {
        $deviceSn = 'Abcdefg1234567';
        $time = time() - 3600;
        $duration = Ulucu::DEFAULT_DURATION;
        $channelId = Ulucu::DEFAULT_CHANNEL_ID;
        $ret = $this->client->getVideoRecordUrl($deviceSn, $time, $duration, $channelId);
        var_dump($ret);
    }
}