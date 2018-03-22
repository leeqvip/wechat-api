<?php

namespace TechOne\WechatApi\Handlers;

use TechOne\WechatApi\Wechat;

/**
 *
 * Class AbstractHandler
 * @package TechOne\WechatApi\Handlers
 * @author TechLee <techlee@qq.com>
 */
abstract class AbstractHandler
{
    public static $instance = null;

    protected $wechat;

    protected $baseUrl = 'https://api.weixin.qq.com/cgi-bin';

    public function __construct(Wechat $wechat)
    {
        $this->wechat = $wechat;
    }

    public static function init(Wechat $wechat)
    {
        if (static::$instance == null) {
            static::$instance = new static($wechat);
        }
        return static::$instance;
    }

    /**
     *
     * @param $uri
     * @param array $query
     * @return array|object|string
     * @throws \Exception
     */
    public function getJson($uri, array $query = [])
    {
        $query['access_token'] = $this->getToken();
        return $this->wechat->getJson($this->baseUrl . $uri . '?' . http_build_query($query));
    }

    /**
     *
     * @param $uri
     * @param array $data
     * @return array|object|string
     * @throws \Exception
     */
    public function postJson($uri, array $data = [])
    {
        $query['access_token'] = $this->getToken();
        return $this->wechat->postJson($this->baseUrl . $uri . '?' . http_build_query($query), $data);
    }

    /**
     *
     * @return mixed
     */
    public function getToken()
    {
        return $this->wechat->getToken();
    }
}
