<?php

namespace TechOne\WechatApi\Messages;

/**
 * 图片消息
 *
 * Class ImageMessage
 * @package TechOne\WechatApi\Messages
 * @author TechLee <techlee@qq.com>
 */
class ImageMessage extends AbstractMessage
{
    /**
     * 消息类型
     *
     * @var string
     */
    public $msgType = 'image';

    /**
     * 图片链接（由系统生成）
     *
     * @var string
     */
    public $picUrl = '';

    /**
     * 图片消息媒体id，可以调用多媒体文件下载接口拉取数据。
     *
     * @var string
     */
    public $mediaId = '';

    public function response()
    {
        $result = sprintf("<Image><MediaId><![CDATA[%s]]></MediaId></Image>", $this->mediaId);
        echo $this->responseFormat($result);
    }
}
