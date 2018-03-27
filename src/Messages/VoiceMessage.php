<?php

namespace TechOne\WechatApi\Messages;

/**
 * 语音消息
 *
 * Class VoiceMessage
 * @package TechOne\WechatApi\Messages
 * @author TechLee <techlee@qq.com>
 */
class VoiceMessage extends AbstractMessage
{
    /**
     * 消息类型
     *
     * @var string
     */
    public $msgType = 'voice';

    /**
     * 语音消息媒体id，可以调用多媒体文件下载接口拉取数据。
     *
     * @var string
     */
    public $mediaId = '';

    /**
     * 语音格式，如amr，speex等
     *
     * @var string
     */
    public $format = '';

    /**
     * 语音识别结果，UTF8编码
     *
     * @var string
     */
    public $recognition = '';

    public function response()
    {
        $result = sprintf("<Voice><MediaId><![CDATA[%s]]></MediaId></Voice>", $this->mediaId);
        echo $this->responseFormat($result);
    }
}
