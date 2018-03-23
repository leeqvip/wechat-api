<?php

namespace TechOne\WechatApi;

use Httpful\Request;
use Httpful\Response;
use TechOne\WechatApi\Handlers\Menu;
use TechOne\WechatApi\Handlers\Tags;
use TechOne\WechatApi\Handlers\User;
use TechOne\WechatApi\Handlers\Oauth2;

/**
 * 微信公众平台Api
 *
 * Class Wechat
 * @package TechOne\WechatApi
 * @author TechLee <techlee@qq.com>
 */
class Wechat
{
    /**
     * @var Wechat
     */
    public static $instance = null;

    /**
     * appID
     * @var string
     */
    protected $appId = '';

    /**
     * appsecret
     * @var string
     */
    protected $secret = '';

    /**
     * Token
     * @var string
     */
    protected $token = '';

    /**
     * 授权后重定向的回调链接地址， 请使用 urlEncode 对链接进行处理
     *
     * @var string
     */
    protected $redirectUri = '';


    public function __construct(array $config = [])
    {
        $this->configure($config);
    }

    /**
     * 初始化实例
     *
     * @param array $config
     * @return Wechat
     */
    public static function init(array $config = [])
    {
        if (static::$instance == null) {
            static::$instance = new static($config);
        }
        return static::$instance;
    }

    /**
     *
     * @param array $config
     */
    public function configure(array $config = [])
    {
        $this->appId = isset($config['app_id']) ? $config['app_id'] : '';
        $this->secret = isset($config['secret']) ? $config['secret'] : '';
        $this->token = isset($config['token']) ? $config['token'] : '';
        $this->setRedirectUri($this->getCurrentUrl());
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * 授权后重定向的回调链接地址， 请使用 urlEncode 对链接进行处理
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * 授权后重定向的回调链接地址， 请使用 urlEncode 对链接进行处理
     * @param string $redirectUri
     */
    public function setRedirectUri(string $redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }

    /**
     * 菜单管理
     *
     * @return null
     */
    public function menu()
    {
        return Menu::init($this);
    }

    /**
     * 用户管理
     * @return null
     */
    public function user()
    {
        return User::init($this);
    }

    /**
     * 标签管理
     * @return null
     */
    public function tags()
    {
        return Tags::init($this);
    }

    /**
     * 网页授权
     * @return null
     */
    public function oauth2()
    {
        return Oauth2::init($this);
    }


    /**
     * 获取token
     *
     * @return mixed
     * @throws \Exception
     */
    public function getToken()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->appId . "&secret=" . $this->secret;
        $token = $this->getJson($url);
        return $token->access_token;
    }


    /**
     *
     * @param $url
     * @return array|object|string
     * @throws \Exception
     */
    public function getJson($url)
    {
        return $this->response(
            Request::get($url)->expectsJson()->send()
        );
    }

    /**
     *
     * @param $url
     * @param array $data
     * @return array|object|string
     * @throws \Exception
     */
    public function postJson($url, array $data)
    {
        $data = Tool::json($data);
        return $this->response(
            Request::post($url)
                ->sendsJson()
                ->body($data)
                ->send()
        );
    }

    /**
     *
     * @param Response $response
     * @return array|object|string
     * @throws \Exception
     */
    public function response(Response $response)
    {
        if ($response->code != 200) {
            throw new \Exception("Response Error", $response->code);
        }
        $body = $response->body;
        if (isset($body->errcode) && $body->errcode != 0) {
            throw new \Exception($body->errmsg, $body->errcode);
        }
        return $body;
    }

    /**
     * 当前url
     *
     * @return string
     */
    public function getCurrentUrl()
    {
        return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }


    /**
     * 响应微信发送的Token验证
     */
    public function checkSignature()
    {
        $timestamp = isset($_GET['timestamp']) ? $_GET['timestamp'] : '';
        $nonce = isset($_GET['nonce']) ? $_GET['nonce'] : '';
        $signature = isset($_GET['signature']) ? $_GET['signature'] : '';
        $echostr = isset($_GET['echostr']) ? $_GET['echostr'] : '';
        $tmpArr = [$this->token, $timestamp, $nonce];
        sort($tmpArr, SORT_STRING);
        $tmpStr = sha1(implode($tmpArr));
        $echostr = $signature == $tmpStr ? $echostr : '';
        exit($echostr);
    }
}
