<?php
/**
 * 签名工具类
 * User: chocoboxxf
 * Date: 2017/8/22
 */
namespace chocoboxxf\Ulucu\Util;

/**
 * 签名工具类
 * @package chocoboxxf\Ulucu\Util
 */
class Auth
{
    /**
     * 获取签名
     * @param string $appId 应用接入时申请的开发者ID
     * @param string $secret 应用接入时申请的开发者密钥
     * @param string $uri 请求接口路径
     * @param array $params GET参数
     * @return string
     */
    public static function getSignature($appId, $secret, $uri, $params = [])
    {
        $queryString = '';
        if (!empty($params)) {
            $queryStringList = [];
            foreach ($params as $key => $value) {
                $queryStringList[] = $key . '=' . $value;
            }
            $queryString = implode('&', $queryStringList);
        }
        return base64_encode($appId . ":" . md5($secret . $appId . $uri . $queryString));
    }
}