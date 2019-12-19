<?php
// 应用公共文件
if (!function_exists('replacePrefab')) {
    /**
     * 替换redisKey中的预留值位置
     *
     * @param       $line
     * @param array $replace
     *
     * @return mixed
     */
    function replacePrefab($line, array $replace = [])
    {
        if (empty($replace)) {
            return $line;
        }

        foreach ($replace as $key => $value) {
            $line = str_replace(
                [':' . $key, ':' . \think\helper\Str::upper($key), ':' . ucfirst($key)],
                [$value, \think\helper\Str::upper($value), ucfirst($value)],
                $line
            );
        }

        return $line;
    }
}

if (!function_exists('getRedis')) {
    /**
     * 获取redis连接以及key名
     *
     * @param string $key
     * @param array  $replace
     *
     * @return array|null|string
     */
    function getRedis(string $key, array $replace = [])
    {
        // 如果 redisKey 文件中不存在这个 key
        // 则返回 $key 作为 redisKey
        if (!config("?redisKey.{$key}")) {
            return $key;
        }

        // 如果 redisKey 文件中的这个 key 的值为字符串
        // 则返回对应的值作为 redisKey 可以设置替换值
        // 并且使用默认redis链接
        if (is_string(config("redisKey.{$key}"))) {
            return replacePrefab(config("redisKey.{$key}"), $replace);
        }

        return [
            'connect' => config("redisKey.{$key}.connect"),
            'key'     => replacePrefab(config("redisKey.{$key}.key"), $replace)
        ];
    }
}

if (!function_exists('curl')) {
    /**
     * 获取一个curl实例
     *
     * @return \app\common\Curl|null
     */
    function curl()
    {
        return \app\common\Curl::instance();
    }
}

/**
 * 获取语言变量值
 *
 * @param string|int $name 语言变量名
 * @param array      $vars 动态变量值
 * @param string     $lang 语言
 *
 * @return mixed
 */
function lang($name, array $vars = [], string $lang = '')
{
    return \think\facade\Lang::get(strval($name), $vars, $lang);
}

/**
 * Session管理
 *
 * @param string $name  session名称
 * @param mixed  $value session值
 *
 * @return mixed
 */
function session($name = '', $value = '')
{
    if (is_null($name)) {
        // 清除
        session_destroy();
    } elseif ('' === $name) {
        return $_SESSION;
    } elseif (is_null($value)) {
        // 删除
        unset($_SESSION[$name]);
    } elseif ('' === $value) {
        // 判断或获取
        return 0 === strpos($name, '?') ? !empty($_SESSION[substr($name, 1)]) : (empty($_SESSION[$name]) ? '' : $_SESSION[$name]);
    } else {
        // 设置
        $_SESSION[$name] = $value;
    }
}