<?php

namespace TechOne\WechatApi\Messages;

/**
 * 接收事件推送
 *
 * Class EventMessage
 * @package TechOne\WechatApi\Messages
 * @author TechLee <techlee@qq.com>
 */
class EventMessage extends AbstractMessage
{
    /**
     * 消息类型
     *
     * @var string
     */
    public $msgType = 'event';

    /**
     * 事件类型，subscribe(订阅)、unsubscribe(取消订阅)、SCAN（用户已关注时的事件推送）、LOCATION（上报地理位置事件）、CLICK、VIEW
     *
     * @var string
     */
    public $event = '';

    /**
     * 事件KEY值，qrscene_为前缀，后面为二维码的参数值
     *
     * @var string
     */
    public $eventKey = '';

    /**
     * 二维码的ticket，可用来换取二维码图片
     *
     * @var string
     */
    public $ticket = '';

    /**
     * 地理位置纬度
     *
     * @var string
     */
    public $latitude = '';

    /**
     * 地理位置经度
     *
     * @var string
     */
    public $longitude = '';

    /**
     * 地理位置精度
     *
     * @var string
     */
    public $precision = '';

    public function response()
    {

    }
}
