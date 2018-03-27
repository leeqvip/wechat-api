<?php

namespace TechOne\WechatApi\Messages;

/**
 * 文本消息
 *
 * Class TextMessage
 * @package TechOne\WechatApi\Messages
 * @author TechLee <techlee@qq.com>
 */
class TextMessage extends AbstractMessage
{
    /**
     * 消息类型
     *
     * @var string
     */
    public $msgType = 'text';

    /**
     * 文本消息内容
     *
     * @var string
     */
    public $content = '';

    public function response()
    {
        $result = sprintf("<Content><![CDATA[%s]]></Content>", $this->content);
        echo $this->responseFormat($result);
    }
}
