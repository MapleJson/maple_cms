<?php

declare (strict_types = 1);

namespace app;

use app\admin\validate\Message;
use app\admin\validate\Rule;
use app\common\Code;
use think\exception\ValidateException;
use think\Response;

class Controller extends BaseController
{
    /**
     * 本类实例 单例
     * @var null
     */
    protected static $_instances = null;

    /**
     * 返回数据
     * @var array
     */
    protected static $response = [
        'code'  => Code::SUCCESS,
        'count' => Code::ZERO,
        'msg'   => '',
        'data'  => [],
    ];

    /**
     * post参数验证
     *
     * @param string $name
     *
     * @return array
     */
    protected static function post(string $name)
    {
        return self::validateRequest(request()->post(), $name);
    }

    /**
     * get参数验证
     *
     * @param string $name
     *
     * @return array
     */
    protected static function get(string $name)
    {
        return self::validateRequest(request()->get(), $name);
    }

    /**
     * 参数验证器
     *
     * @param array  $data
     * @param string $name
     *
     * @return array
     */
    private static function validateRequest(array $data, string $name)
    {
        if (empty(Rule::$$name)) {
            return $data;
        }
        $validator = validate(Rule::$$name, Message::$$name);
        try {
            if ($validator->check($data)) {
                return $data;
            }
            return self::getInstance()->responsePopup($validator->getError());
        } catch (ValidateException $e) {
            return self::getInstance()->responsePopup($e->getError());
        }
    }

    /**
     * 返回提示信息并跳转页面
     *
     * @param        $content
     * @param bool   $proper
     * @param string $redirect
     */
    public function responsePopup($content, $proper = true, $redirect = 'back')
    {
        if (is_int($content)) $content = lang($content);

        $redirect = ($redirect == 'back') ? 'window.history.back()' : 'window.location="' . $redirect . '"';
        $waits    = $proper ? 2500 : 1500;
        $color    = $proper ? '#009900' : '#FF0000';

        $html = <<<EOL
            <!DOCTYPE html>
            <html>
            <head>
            <title>提示信息</title>
            <meta http-equiv='Content-Type' content='text/html;charset=utf-8'/>
            <style>
            body,h5,p,a{font:12px Verdana,Tahoma;text-align:center;text-decoration:none;margin:0;padding:0;}
            h5{color:#555;font-size:14px;height:28px;text-align:center;line-height:28px;font-weight:bold;background:#EEE;margin:1px;padding:0 10px;}
            .box{width:480px;border:1px solid #DDD;margin:120px auto;-moz-box-shadow:3px 4px 5px #EEE;-webkit-box-shadow:3px 4px 5px #EEE;}
            .content{color:{$color};font-size:14px;font-weight:bold;line-height:24px;padding:30px 10px;}
            .clickUrl{color:#888;margin-bottom:15px;padding:0 10px;}
            </style>
            <script type='text/javascript'>
            setTimeout(function (){
                $redirect
            }, {$waits})
            $waits
            </script>
            </head>
            <body>
            <div class='box'>
            <h5>提示信息</h5>
            <p class='content'>{$content}</p>
            </div>
            </body>
            </html>
EOL;

        exit($html);
    }

    /**
     * 统一数据返回
     *
     * @param $args
     *
     * @return Response
     */
    protected function responseJson(...$args)
    {
        foreach ($args as $arg) {
            if (is_int($arg)) {
                self::$response['code'] = $arg;
            } elseif (is_string($arg)) {
                self::$response['msg'] = $arg;
            } else {
                self::$response['data'] = (array)$arg;
            }
        }

        if (empty(self::$response['msg'])) {
            self::$response['msg'] = lang(self::$response['code']);
        }

        return json(self::$response);
    }

    /**
     * 设置返回json数据中的总条数
     *
     * @param int $count
     */
    protected static function setCount(int $count)
    {
        self::$response['count'] = $count;
    }

    /**
     * 获取此类单例
     *
     * @return Controller|null
     */
    protected static function getInstance()
    {
        if (!empty(self::$_instances)) {
            return self::$_instances;
        }

        return self::$_instances = new static(app());
    }
}
