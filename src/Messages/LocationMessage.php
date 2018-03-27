<?php

namespace TechOne\WechatApi\Messages;

/**
 * 地理位置消息
 *
 * Class TextMessage
 * @package TechOne\WechatApi\Messages
 * @author TechLee <techlee@qq.com>
 */
class LocationMessage extends AbstractMessage
{
    /**
     * 消息类型
     *
     * @var string
     */
    public $msgType = 'location';

    /**
     * 地理位置维度
     *
     * @var string
     */
    public $location_X = '';

    /**
     * 地理位置经度
     *
     * @var string
     */
    public $location_Y = '';

    /**
     * 地图缩放大小
     *
     * @var string
     */
    public $scale = '';

    /**
     * 地理位置信息
     *
     * @var string
     */
    public $label = '';

    public function response()
    {

    }
}
