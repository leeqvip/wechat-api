<?php

namespace TechOne\WechatApi\Messages;

/**
 * 图文消息
 *
 * Class NewsMessage
 * @package TechOne\WechatApi\Messages
 * @author TechLee <techlee@qq.com>
 */
class NewsMessage extends AbstractMessage
{
    /**
     * 消息类型
     *
     * @var string
     */
    public $msgType = 'news';

    /**
     * 多条图文消息信息，默认第一个item为大图,注意，如果图文数超过8，则将会无响应
     *
     * @var array
     */
    public $articles = [];

    public function response()
    {
        $items = '';
        foreach ($this->articles as $item) {
            $xmlTpl = "<item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item>";
            $items .= sprintf($xmlTpl, $item['title'], $item['description'], $item['pic_url'], $item['url']);
        }
        $result = $this->responseFormat("<ArticleCount>" . count($this->articles) . "</ArticleCount><Articles>" . $items . "</Articles>");
        \TechOne\WechatApi\Log::info($result);
        echo $result;
    }
}
