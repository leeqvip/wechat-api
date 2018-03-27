<?php

namespace TechOne\WechatApi;

use TechOne\WechatApi\Messages\EventMessage;
use TechOne\WechatApi\Messages\ImageMessage;
use TechOne\WechatApi\Messages\LinkMessage;
use TechOne\WechatApi\Messages\LocationMessage;
use TechOne\WechatApi\Messages\ShortVideoMessage;
use TechOne\WechatApi\Messages\TextMessage;
use TechOne\WechatApi\Messages\VideoMessage;
use TechOne\WechatApi\Messages\VoiceMessage;

/**
 * 消息解析类
 *
 * Class Message
 * @package TechOne\WechatApi
 * @author TechLee <techlee@qq.com>
 */
class Message
{

    /**
     * @var Message|null
     */
    public static $instance = null;

    /**
     *
     * @author TechLee <techlee@qq.com>
     * @return null|Message
     */
    public static function init()
    {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     *
     * @param $input array|string
     * @return ImageMessage|LinkMessage|LocationMessage|ShortVideoMessage|TextMessage|VideoMessage|VoiceMessage|EventMessage
     */
    public static function load($input)
    {
        $message = static::init();
        return $message->convert($input);
    }

    /**
     *
     * @param $input array|string
     * @return array
     */
    public function format($input)
    {
        return is_array($input) ? $input : Helper::xmlToArray($input);
    }

    /**
     *
     * @author TechLee <techlee@qq.com>
     * @param $handler
     * @param array $data
     * @return TextMessage|ImageMessage|LinkMessage|LocationMessage|ShortVideoMessage|VoiceMessage|VideoMessage|EventMessage
     */
    public function getMessage($handler, array $data = [])
    {
        $class = false !== strpos($handler, '\\') ? $handler : '\\TechOne\\WechatApi\\Messages\\' . Helper::studly_case($handler, true) . 'Message';
        return new $class($data);
    }

    /**
     *
     * @author TechLee <techlee@qq.com>
     * @param $input array|string
     * @return TextMessage|ImageMessage|LinkMessage|LocationMessage|ShortVideoMessage|VoiceMessage|VideoMessage|EventMessage
     */
    public function convert($input)
    {
        $input = $this->format($input);
        return $this->getMessage($input['MsgType'], $input);
    }
}
