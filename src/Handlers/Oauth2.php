<?php

namespace TechOne\WechatApi\Handlers;

/**
 * 网页授权
 * Class Oauth2
 * @package TechOne\WechatApi\Handlers
 * @author TechLee <techlee@qq.com>
 */
class Oauth2 extends AbstractHandler
{
    /**
     *
     * @return array|object|string
     * @throws \Exception
     */
    public function userinfo()
    {
        $token = $this->getToauth2Token();
        $query = http_build_query([
            'access_token' => $token->access_token,
            'openid' => $token->openid,
            'lang' => 'zh_CN',
        ]);
        $url = "https://api.weixin.qq.com/sns/userinfo?" . $query;
        $body = $this->wechat->getJson($url);
        return $body;
    }

    /**
     *
     * @return array|object|string
     * @throws \Exception
     */
    public function getToauth2Token()
    {
        if (!isset($_GET['code'])) {
            $this->geToauth2Code();
        }
        $query = http_build_query([
            'appid' => $this->wechat->getAppId(),
            'secret' => $this->wechat->getSecret(),
            'code' => $_GET['code'],
            'grant_type' => 'authorization_code',
        ]);
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?" . $query;
        return $this->wechat->getJson($url);
    }

    /**
     *
     * @param string $scope
     */
    public function geToauth2Code($scope = 'snsapi_userinfo')
    {
        $query = http_build_query([
            'appid' => $this->wechat->getAppId(),
            'redirect_uri' => $this->wechat->getRedirectUri(),
            'response_type' => 'code',
            'scope' => $scope,
            'status' => 'STATE',
        ]);
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?" . $query . "#wechat_redirect";
        header('Location: ' . $url);
        exit();
    }
}