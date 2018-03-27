<?php

namespace TechOne\WechatApi;

/**
 * 辅助工具类
 *
 * Class Helper
 * @package TechOne\WechatApi
 * @author TechLee <techlee@qq.com>
 */
class Helper
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

    /**
     * 将XML转为array
     *
     * @param $xml
     * @return array
     */
    public static function xmlToArray($xml)
    {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $values;
    }

    /**
     * 字符串转驼峰格式
     *
     * @param $str
     * @param bool $ucfirst
     * @return string
     */
    public static function studly_case($str, $ucfirst = true)
    {
        while (($pos = strpos($str, '_')) !== false) {
            $str = substr($str, 0, $pos) . ucfirst(substr($str, $pos + 1));
        }
        return $ucfirst ? ucfirst($str) : $str;
    }

}
