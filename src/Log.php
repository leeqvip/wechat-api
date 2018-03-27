<?php

namespace TechOne\WechatApi;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * 日志类
 *
 * Class Log
 * @package TechOne\WechatApi
 * @author TechLee <techlee@qq.com>
 */
class Log
{
    /**
     * @var Logger|null
     */
    protected $log = null;

    /**
     * @var Log
     */
    public static $instance = null;

    /**
     * Log constructor.
     * @param $logDir
     * @param $channel
     */
    public function __construct($logDir, $channel)
    {
        $logDir    = is_null($logDir) ? 'logs/wechat-api/' : $logDir;
        $this->log = new Logger($channel);
        $this->log::setTimezone(new \DateTimeZone($this->getTimezone()));
        $this->log->pushHandler(new StreamHandler($logDir . date('Y-m-d') . '.log'));
    }

    /**
     *
     * @param null $logDir
     * @param string $channel
     * @return Log
     */
    public static function init($logDir = null, $channel = 'wechat-api')
    {
        if (static::$instance == null) {
            static::$instance = new static($logDir, $channel);
        }
        return static::$instance;
    }

    /**
     * 时区
     *
     * @return string
     */
    protected function getTimezone()
    {
        if ($timezone = ini_get('date.timezone')) {
            return $timezone;
        }
        return date_default_timezone_get() ?: 'UTC';
    }

    /**
     * Format the parameters for the logger.
     *
     * @param  mixed $message
     * @return mixed
     */
    protected function formatMessage($message)
    {
        return var_export($message, true);
    }

    /**
     *
     * @param $name
     * @param $arguments
     */
    public static function __callStatic($name, $arguments)
    {
        $log = self::init();
        $log->__call($name, $arguments);
    }

    /**
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $arguments[0] = $this->formatMessage($arguments[0]);
        return call_user_func_array(array($this->log, $name), $arguments);
    }
}
