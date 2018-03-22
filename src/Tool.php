<?php

namespace TechOne\WechatApi;

/**
 * 辅助工具类
 *
 * Class Tool
 * @package TechOne\WechatApi
 * @author TechLee <techlee@qq.com>
 */
class Tool
{
    /**
     * 数组转json，不使用 UNICODE
     *
     * @param array $data
     * @return string
     */
    public static function json(array $data)
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
    }
}
