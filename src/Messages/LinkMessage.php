<?php

namespace TechOne\WechatApi\Messages;

/**
 * 链接消息
 *
 * Class TextMessage
 * @package TechOne\WechatApi\Messages
 * @author TechLee <techlee@qq.com>
 */
class LinkMessage extends AbstractMessage
{
    /**
     * 消息类型
     *
     * @var string
     */
    public $msgType = 'link';

    /**
     * 消息标题
     *
     * @var string
     */
    public $title = '';

    /**
     * 消息描述
     *
     * @var string
     */
    public $description = '';

    /**
     * 消息链接
     *
     * @var string
     */
    public $url = '';

    public function response()
    {

    }
}
