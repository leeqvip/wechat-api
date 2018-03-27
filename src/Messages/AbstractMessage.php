<?php

namespace TechOne\WechatApi\Messages;

/**
 * 消息抽象类
 *
 * Class AbstractMessage
 * @package TechOne\WechatApi\Messages
 * @author TechLee <techlee@qq.com>
 */
abstract class AbstractMessage
{
    /**
     * 开发者微信号
     *
     * @var string
     */
    public $toUserName = '';

    /**
     * 发送方帐号（一个OpenID）
     *
     * @var string
     */
    public $fromUserName = '';

    /**
     * 消息创建时间 （整型）
     *
     * @var string
     */
    public $createTime = '';

    /**
     * 消息类型
     *
     * @var string
     */
    public $msgType = '';

    /**
     * 消息id，64位整型
     *
     * @var string
     */
    public $msgId = '';

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->attr($key, $value);
        }
    }

    protected function attr($name, $value)
    {
        $attr = lcfirst($name);
        if (property_exists($this, $attr)) {
            $this->{$attr} = $value;
        }
    }

    protected function responseFormat($item)
    {
        $xmlTpl = "<xml>";
        $xmlTpl .= "<ToUserName><![CDATA[%s]]></ToUserName>";
        $xmlTpl .= "<FromUserName><![CDATA[%s]]></FromUserName>";
        $xmlTpl .= "<CreateTime>%s</CreateTime>";
        $xmlTpl .= "<MsgType><![CDATA[%s]]></MsgType>";
        $xmlTpl .= "%s";
        $xmlTpl .= "</xml>";
        return sprintf($xmlTpl, $this->fromUserName, $this->toUserName, time(), $this->msgType, $item);
    }

    abstract public function response();
}
