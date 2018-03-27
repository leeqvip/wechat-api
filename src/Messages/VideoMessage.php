<?php

namespace TechOne\WechatApi\Messages;

/**
 * 视频消息
 *
 * Class VideoMessage
 * @package TechOne\WechatApi\Messages
 * @author TechLee <techlee@qq.com>
 */
class VideoMessage extends AbstractMessage
{
    /**
     * 消息类型
     *
     * @var string
     */
    public $msgType = 'video';

    /**
     * 视频消息媒体id，可以调用多媒体文件下载接口拉取数据。
     *
     * @var string
     */
    public $mediaId = '';

    /**
     * 视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
     *
     * @var string
     */
    public $thumbMediaId = '';

    /**
     * 视频消息的标题
     *
     * @var string
     */
    public $title = '瑟吉欧';

    /**
     * 视频消息的描述
     *
     * @var string
     */
    public $description = '视频';

    public function response()
    {
        $result = sprintf("<Video><MediaId><![CDATA[%s]]></MediaId><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description></Video>", $this->mediaId, $this->title, $this->description);
        $result = $this->responseFormat($result);
        echo $result;
    }
}
