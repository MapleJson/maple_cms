<?php

use think\facade\Env;

// +----------------------------------------------------------------------
// | 缓存设置
// +----------------------------------------------------------------------

return [
    // 默认缓存驱动
    'default' => Env::get('cache.driver', 'redis'),

    // 缓存连接方式配置
    'stores'  => [
        'redis'   => [
            // 驱动方式
            'type'       => 'redis',
            // 服务器地址
            'host'       => Env::get('redis.redis_cache_host', '127.0.0.1'),
            'port'       => (int)Env::get('redis.redis_cache_port', 6379),
            'password'   => Env::get('redis.redis_cache_password', null),
            'select'     => (int)Env::get('redis.redis_cache_database', 0),
            'timeout'    => 0,
            'expire'     => 0,
            'persistent' => false,
            'prefix'     => 'cache_',
            'tag_prefix' => 'tag:',
            'serialize'  => [],
        ],
        // session缓存
        'session' => [
            // 驱动方式
            'type'       => 'redis',
            // 服务器地址
            'host'       => Env::get('redis.redis_session_host', '127.0.0.1'),
            'port'       => (int)Env::get('redis.redis_session_port', 6379),
            'password'   => Env::get('redis.redis_session_password', null),
            'select'     => (int)Env::get('redis.redis_session_database', 0),
            'timeout'    => 0,
            'expire'     => 0,
            'persistent' => false,
            'prefix'     => 'session_',
            'tag_prefix' => 'tag:',
            'serialize'  => [],
        ],
        // 常规缓存连接方式配置
        'default' => [
            // 驱动方式
            'type'       => 'redis',
            // 服务器地址
            'host'       => Env::get('redis.redis_default_host', '127.0.0.1'),
            'port'       => (int)Env::get('redis.redis_default_port', 6379),
            'password'   => Env::get('redis.redis_default_password', null),
            'select'     => (int)Env::get('redis.redis_default_database', 0),
            'timeout'    => 0,
            'expire'     => 0,
            'persistent' => false,
            'prefix'     => '',
            'tag_prefix' => 'tag:',
            'serialize'  => [],
        ],
        // 视讯缓存连接方式配置
        'video'   => [
            // 驱动方式
            'type'       => 'redis',
            // 服务器地址
            'host'       => Env::get('redis.redis_video_host', '127.0.0.1'),
            'port'       => (int)Env::get('redis.redis_video_port', 6379),
            'password'   => Env::get('redis.redis_video_password', null),
            'select'     => (int)Env::get('redis.redis_video_database', 0),
            'timeout'    => 0,
            'expire'     => 0,
            'persistent' => false,
            'prefix'     => '',
            'tag_prefix' => 'tag:',
            'serialize'  => [],
        ],
        // 聊天室连接方式配置
        'chat'    => [
            // 驱动方式
            'type'       => 'redis',
            // 服务器地址
            'host'       => Env::get('redis.redis_chat_host', '127.0.0.1'),
            'port'       => (int)Env::get('redis.redis_chat_port', 6379),
            'password'   => Env::get('redis.redis_chat_password', null),
            'select'     => (int)Env::get('redis.redis_chat_database', 0),
            'timeout'    => 0,
            'expire'     => 0,
            'persistent' => false,
            'prefix'     => '',
            'tag_prefix' => 'tag:',
            'serialize'  => [],
        ],
        // 更多的缓存连接
        //        'file'    => [
        //            // 驱动方式
        //            'type'       => 'File',
        //            // 缓存保存目录
        //            'path'       => '',
        //            // 缓存前缀
        //            'prefix'     => '',
        //            // 缓存有效期 0表示永久缓存
        //            'expire'     => 0,
        //            // 缓存标签前缀
        //            'tag_prefix' => 'tag:',
        //            // 序列化机制 例如 ['serialize', 'unserialize']
        //            'serialize'  => [],
        //        ],

        // redis缓存
    ],
];
