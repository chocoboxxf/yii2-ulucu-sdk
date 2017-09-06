<?php
/**
 * 悠络客开放平台 SDK
 * User: chocoboxxf
 * Date: 2017/8/22
 */
namespace chocoboxxf\Ulucu;

use chocoboxxf\Ulucu\Util\Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * 悠络客开放平台 SDK
 * @package chocoboxxf\Ulucu
 */
class Ulucu extends Component
{
    /**
     * 设备相关接口
     */
    const DEVICE_API_GET_STORE_LIST = '/h/LpGAe/auth/visible_stores'; // 获取用户有权限的所有店铺列表和店铺详情
    const DEVICE_API_GET_STORE_DEVICE_LIST = '/h/LpGAf/auth/store_device_list'; // 获取门店设备列表
    const DEVICE_API_GET_STORE_DEVICE_LIST_WITH_STATUS = '/h/LpGAg/auth/store_device_list_with_status'; // 获取门店设备列表(含上下线状态)
    const DEVICE_API_GET_DEVICE_STATUS = '/h/KjNmK/device/get_device_status'; // 获取设备状态
    /**
     * 视频相关接口
     */
    const VIDEO_API_GET_LIVE_URL = '/h/ldHnE/live/m3u8'; // 获取设备观看实时视频地址
    const VIDEO_API_GET_RECORD_URL = '/h/LpGcx/record/m3u8'; // 获取设备观看回放视频地址
    /**
     * 设备类型枚举项
     */
    const DEVICE_TYPE_UNKNOWN = 0; // 未知
    const DEVICE_TYPE_DVR = 1; // DVR
    const DEVICE_TYPE_NVR = 2; // NVR
    const DEVICE_TYPE_IPC = 3; // IPC
    const DEVICE_TYPE_SIMULATED_CAMERA = 4; // 模拟摄像头
    const DEVICE_TYPE_FLOW_STATISTICS = 5; // 客流统计设备
    /**
     * 视频码率枚举项
     */
    const RATE_HIGH = 1000; // 高清
    const RATE_LOW = 700; // 流畅
    /**
     * 默认值
     */
    const DEFAULT_VERSION = '1'; // 默认版本号
    const DEFAULT_CHANNEL_ID = 1; // 默认通道号
    const DEFAULT_RATE = 1000; // 默认码率
    const DEFAULT_DURATION = 3600; // 默认观看时长
    /**
     * API服务器地址
     * @var string
     */
    public $url;
    /**
     * 应用接入时申请的开发者ID
     * @var string
     */
    public $appId;
    /**
     * 应用接入时申请的开发者密钥
     * @var string
     */
    public $secret;
    /**
     * 当前API接口版本号
     * @var string
     */
    public $version;
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    public function init()
    {
        parent::init();
        if (!isset($this->url)) {
            throw new InvalidConfigException('请先配置API服务器地址');
        }
        if (!isset($this->appId)) {
            throw new InvalidConfigException('请先配置开发者ID');
        }
        if (!isset($this->secret)) {
            throw new InvalidConfigException('请先配置开发者密钥');
        }
        $this->client = new Client([
            'base_uri' => $this->url,
        ]);
    }

    /**
     * 获取用户有权限的所有店铺列表和店铺详情
     * @return array
     */
    public function getStoreList()
    {
        // 入参
        $params = [];

        // 请求
        return $this->get(static::DEVICE_API_GET_STORE_LIST, $params, $this->version);
    }

    /**
     * 获取门店设备列表
     * @param string $storeId 门店id。数字形式。例：10508
     * @param integer $type 设备类型，0-未知，1-DVR，2-NVR，3-IPC，4-模拟摄像头，5-客流统计设备
     * @return array
     */
    public function getStoreDeviceList($storeId, $type)
    {
        // 入参
        $params = [];
        $params['store_id'] = $storeId;
        $params['type'] = $type;

        // 请求
        return $this->get(static::DEVICE_API_GET_STORE_DEVICE_LIST, $params, $this->version);
    }

    /**
     * 获取门店设备列表(含上下线状态)
     * @param string $storeId 门店id。数字形式。例：10057
     * @return array
     */
    public function getStoreDeviceListWithStatus($storeId)
    {
        // 入参
        $params = [];
        $params['store_id'] = $storeId;

        // 请求
        return $this->get(static::DEVICE_API_GET_STORE_DEVICE_LIST_WITH_STATUS, $params, $this->version);
    }

    /**
     * 获取设备状态
     * @param string $deviceSn 设备sn。字母和数字。例：Ub0000000542866896QB
     * @return array
     */
    public function getDeviceStatus($deviceSn)
    {
        // 入参
        $params = [];
        $params['device_sn'] = $deviceSn;

        // 请求
        return $this->get(static::DEVICE_API_GET_DEVICE_STATUS, $params, $this->version);
    }

    /**
     * 获取设备观看实时视频地址
     * @param string $deviceSn 设备sn。例：Ub0000000542866896QB
     * @param integer $channelId 通道号。整型。默认为 1。
     * @param integer $rate 码率。例：1000。不传则默认为最小的码率。
     * @return array
     */
    public function getVideoLiveUrl($deviceSn, $channelId = self::DEFAULT_CHANNEL_ID, $rate = self::DEFAULT_RATE)
    {
        // 入参
        $params = [];
        $params['device_sn'] = $deviceSn;
        $params['channel_id'] = $channelId;
        $params['rate'] = $rate;

        // 请求
        return $this->get(static::VIDEO_API_GET_LIVE_URL, $params, $this->version);
    }

    /**
     * 获取设备观看回放视频地址
     * @param string $deviceSn 设备sn。例：Ub0000000542866896QB
     * @param string $time 视频开始时间。时间戳格式。例：1463591786。
     * @param integer $duration 观看时长。单位：秒。不传默认为3600秒。
     * @param integer $channelId 通道号。整型。默认为 1。
     * @return array
     */
    public function getVideoRecordUrl($deviceSn, $time, $duration = self::DEFAULT_DURATION, $channelId = self::DEFAULT_CHANNEL_ID)
    {
        // 入参
        $params = [];
        $params['device_sn'] = $deviceSn;
        $params['channel_id'] = $channelId;
        $params['time'] = $time;
        $params['duration'] = $duration;

        // 请求
        return $this->get(static::VIDEO_API_GET_RECORD_URL, $params, $this->version);
    }

    /**
     * get请求
     * @param string $uri 请求接口路径
     * @param array $params GET参数
     * @param string $version 接口版本号，默认1
     * @return array
     */
    protected function get($uri, $params = [], $version = self::DEFAULT_VERSION)
    {
        $params['av'] = $version;
        $signature = Auth::getSignature($this->appId, $this->secret, $uri, $params);
        $headers = [
            'Authorization' => 'Basic ' . $signature,
        ];
        $request = new Request('GET', $uri, $headers);
        try {
            $response = $this->client->send(
                $request,
                [
                    'query' => $params,
                ]
            );
        } catch (ClientException $ex) {
            // 没有返回错误信息response的继续抛出异常
            if (!$ex->hasResponse()) {
                throw $ex;
            }
            $response = $ex->getResponse();
        }
        $result = (string)$response->getBody();

        return json_decode($result, true);
    }

    /**
     * post请求
     * @param string $uri 请求接口路径
     * @param array $params POST参数
     * @param string $version 接口版本号，默认1
     * @return array
     */
    protected function post($uri, $params = [], $version = self::DEFAULT_VERSION)
    {
        $queryStringList = [];
        $queryStringList['av'] = $version;
        $signature = Auth::getSignature($this->appId, $this->secret, $uri, $queryStringList);
        $headers = [
            'Authorization' => 'Basic ' . $signature,
        ];
        $request = new Request('GET', $uri . '?av=' . $version, $headers);
        try {
            $response = $this->client->send(
                $request,
                [
                    'query' => $params,
                ]
            );
        } catch (ClientException $ex) {
            // 没有返回错误信息response的继续抛出异常
            if (!$ex->hasResponse()) {
                throw $ex;
            }
            $response = $ex->getResponse();
        }
        $result = (string)$response->getBody();

        return json_decode($result, true);
    }
}