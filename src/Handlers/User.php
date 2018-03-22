<?php

namespace TechOne\WechatApi\Handlers;

/**
 * 用户管理
 *
 * Class User
 * @package TechOne\WechatApi\Handlers
 * @author TechLee <techlee@qq.com>
 */
class User extends AbstractHandler
{
    /**
     * 获取用户列表
     * 公众号可通过本接口来获取帐号的关注者列表，关注者列表由一串OpenID（加密后的微信号，每个用户对每个公众号的OpenID是唯一的）组成。
     * 一次拉取调用最多拉取10000个关注者的OpenID，可以通过多次拉取的方式来满足需求。
     *
     * @param null $nextOpenid
     * @return mixed
     * @throws \Exception
     */
    public function get($nextOpenid = null)
    {
        $data = [
            'access_token' => $this->getToken(),
        ];
        if ($nextOpenid != null) {
            $data['next_openid'] = $nextOpenid;
        }
        return $this->getJson('/user/get', $data);
    }

    /**
     * 获取用户基本信息(UnionID机制)
     * 在关注者与公众号产生消息交互后，公众号可获得关注者的OpenID（加密后的微信号，
     * 每个用户对每个公众号的OpenID是唯一的。对于不同公众号，同一用户的openid不同）。
     * 公众号可通过本接口来根据OpenID获取用户基本信息，包括昵称、头像、性别、所在城市、语言和关注时间。
     *
     * @param $openid
     * @param string $lang
     * @return mixed
     * @throws \Exception
     */
    public function info($openid, $lang = 'zh_CN')
    {
        $data = [
            'access_token' => $this->getToken(),
            'openid' => $openid,
            'lang' => $lang,
        ];
        return $this->getJson('/user/info', $data);
    }

    /**
     * 批量获取用户基本信息
     * 开发者可通过该接口来批量获取用户基本信息。最多支持一次拉取100条。
     *
     * @param array $openids
     * @param string $lang
     * @return mixed
     * @throws \Exception
     */
    public function infoBatchget(array $openids, $lang = 'zh_CN')
    {
        $data = [
            'user_list' => array_map(function ($item) use ($lang) {
                return array_merge($item, [
                    'lang' => isset($item['lang']) ? $item['lang'] : $lang,
                ]);
            }, $openids),
        ];
        return $this->postJson('/user/info/batchget', $data);
    }

    /**
     * 设置用户备注名
     * 开发者可以通过该接口对指定用户设置备注名，该接口暂时开放给微信认证的服务号。
     *
     * @param $openid
     * @param $remark
     * @return mixed
     * @throws \Exception
     */
    public function updateremark($openid, $remark)
    {
        return $this->postJson('/user/info/updateremark', [
            "openid" => $openid,
            "remark" => $remark,
        ]);
    }
}
