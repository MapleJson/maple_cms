<?php
/**
 * 统一调用方式
 * 跟前台对应是否压缩或解压
 */
declare (strict_types = 1);

namespace app\common;

/**
 * Redis管理类
 * Class RedisConPool
 *
 * @method static get($redis)
 * @method static set($redis, $data)
 * @method static setEx($redis, $time, $data)
 * @method static del($redis)
 * @method static keys($redis)
 * @method static type($redis)
 * @method static ttl($redis)
 * @method static strLen($redis)
 * @method static iNcr($redis)
 *
 * @method static sMembers($redis)
 * @method static sCard($redis)
 *
 * @method static hSet($redis, $key, $value)
 * @method static hGetAll($redis)
 * @method static hGet($redis, $key)
 * @method static hLen($redis)
 * @method static hDel($redis, ...$args)
 *
 * @method static rPush($redis, $data)
 * @method static lTrim($redis, $start, $end)
 * @method static lLen($redis)
 * @method static lRange($redis, $start, $end)
 * @package app\common
 */
class Redis
{
    public static $redisKey;

    private static $instance;

    private static $callFunc = [
        // 常规操作
        'get', 'set', 'setEx', 'del', 'keys', 'type', 'ttl', 'iNcr',
        // 集合类型
        'sMembers', 'strLen', 'sCard',
        // hash类型
        'hSet', 'hGetAll', 'hGet', 'hLen', 'hDel',
        // 列表类型
        'rPush', 'lTrim', 'lLen', 'lRange',
        //'flushAll', // 危险操作！！！
    ];

    /**
     * 设置redis链接
     *
     * @param $redis
     */
    private static function setConnection($redis)
    {
        if (is_array($redis)) {
            self::$redisKey = (string)$redis['key'];
        } else {
            self::$redisKey = (string)$redis;
        }

        self::$instance = cache()->store(empty($redis['connect']) ? 'default' : $redis['connect']);
    }

    /**
     * @param string $method
     * @param array  $args
     *
     * @return bool|mixed|string
     */
    public static function __callStatic($method, $args)
    {
        if (in_array($method, self::$callFunc, true)) {

            return self::callFunc($method, ...$args);

        } else {

            return false;
        }
    }

    /**
     * Redis其他方法
     *
     * @param $method
     * @param $redis
     *
     * @return mixed
     */
    private static function callFunc($method, ...$redis)
    {
        self::setConnection($redis[0]);
        if (self::$redisKey) {
            $redis[0] = self::$redisKey;
            if (in_array($method, ['set', 'setEx'], true)) {
                $redis[1] = self::gzCompress($redis[1]);
            }
            if ($method === 'get') {
                return self::gzUnCompress(self::$instance->{$method}(...$redis));
            }
            return self::$instance->{$method}(...$redis);
        }
        return self::$instance->{$method}();
    }

    /**
     * 判断是否是base64字符串
     *
     * @param string $string
     *
     * @return bool
     */
    private static function isBase64(string $string)
    {
        return $string === base64_encode(base64_decode($string));
    }

    /**
     * 对长度大于50的字符串进行压缩
     *
     * @param string $string
     *
     * @return string
     */
    private static function gzCompress(string $string)
    {
        if (!self::isBase64($string) || strlen($string) > 50) {
            return base64_encode(gzcompress($string));
        }
        return $string;
    }

    /**
     * 解压字符串
     *
     * @param string $string
     *
     * @return string
     */
    private static function gzUnCompress(string $string)
    {
        if (self::isBase64($string)) {
            return gzuncompress(base64_decode($string));
        }
        return $string;
    }


}
