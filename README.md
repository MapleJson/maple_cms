ThinkPHP 6.0
===============

> 运行环境要求PHP7.1+。

## 主要新特性

* 采用`PHP7`强类型（严格模式）
* 支持更多的`PSR`规范
* 原生多应用支持
* 更强大和易用的查询
* 全新的事件系统
* 模型事件和数据库事件统一纳入事件系统
* 模板引擎分离出核心
* 内部功能中间件化
* SESSION/Cookie机制改进
* 对Swoole以及协程支持改进
* 对IDE更加友好
* 统一和精简大量用法

## 安装

~~~
composer install
~~~

如果需要更新框架使用
~~~
composer update topthink/framework
~~~

## 项目目录
~~~
├── app                     应用目录
│   ├── BaseController.php  基础控制器
│   ├── Controller.php      继承基础控制器，各业务控制器的父级
│   ├── ExceptionHandle.php
│   ├── Request.php
│   ├── admin               客户后台应用
│   ├── agent               代理后台应用
│   ├── common              应用公共类
│   ├── common.php          公共函数
│   ├── event.php           事件定义文件
│   ├── front               前台应用
│   ├── lang                应用公共语言包
│   ├── manage              总后台应用
│   ├── middleware          应用中间件
│   ├── middleware.php      全局中间件定义
│   ├── model               应用公共模型
│   │   ├── README.md
│   │   ├── im                    --聊天室库
│   │   │   └── Group.php         ----chat_group表模型
│   │   ├── manage                --manage库
│   │   │   ├── AgSiteRole.php    ----ag_site_role表模型
│   │   │   ├── AllRoleRecord.php ----all_role_record表模型
│   │   │   ├── ChatImSwitch.php  ----chat_im_switch表模型
│   │   │   └── SiteInfo.php      ----site_info表模型
│   │   ├── pri                   --private库
│   │   │   ├── SiteNotice.php    ----site_notice表模型
│   │   │   ├── SpMoney.php       ----sp_money表模型
│   │   │   ├── VideoMoney.php    ----video_money表模型
│   │   │   └── WebConfig.php     ----web_config表模型
│   │   ├── pub                   --public库
│   │   │   └── BetMatch.php      ----bet_match表模型
│   │   └── video                 --视讯库
│   │       └── VideoNote.php     ----注单表模型，一模型多表公用(仅限结构相同)
│   └── provider.php
├── composer.json
├── composer.lock
├── config                  配置目录
│   ├── app.php             应用基础配置
│   ├── cache.php           缓存配置，包含redis
│   ├── captcha.php         验证码全局配置
│   ├── console.php
│   ├── cookie.php          cookie配置
│   ├── database.php        数据库配置
│   ├── filesystem.php      文件系统配置（我们使用go的上传，此文件不用配置）
│   ├── lang.php            多语言配置
│   ├── log.php             日志配置
│   ├── middleware.php      中间件配置、映射
│   ├── redisKey.php        定义各应用redis-key
│   ├── route.php           路由配置
│   ├── session.php         session配置
│   ├── trace.php
│   └── view.php            视图配置
├── extend
├── public
│   ├── admin.php           客户后台应用入口
│   ├── agent.php           代理后台应用入口
│   ├── favicon.ico
│   ├── index.php           前台(默认)应用入口
│   ├── manage.php          总后台应用入口
│   ├── robots.txt
│   ├── router.php
│   └── static              静态资源文件目录
├── runtime
│   ├── admin
│   ├── agent
│   ├── front
│   ├── manage
│   ├── schema
│   └── session
├── think
~~~

## 应用目录(以admin为例)
~~~
├── config                   应用私有配置目录，会覆盖全局配置
│   └── captcha.php
├── controller               业务控制器
│   ├── account              --子账号管理模块
│   │   └── Index.php        ----子账号列表控制器
│   ├── agent                --代理管理模块
│   │   └── Index.php        ----代理列表控制器
│   ├── cash                 --现金系统模块
│   ├── index                --主页及登录(默认)模块
│   │   ├── Index.php        ----主页控制器
│   │   └── Login.php        ----登录控制器
│   ├── note                 --注单管理模块
│   ├── report               --报表管理模块
│   └── user                 --会员管理模块
├── lang                     应用私有语言包，会与公共语言包合并
│   └── zh-cn.php            --应用私有语言包文件
├── model                    应用私有模型
│   ├── README.md
│   └── SysAdmin.php         --sys_admin表模型
├── route                    应用路由
│   └── admin.php            --应用路由文件
├── validate                 应用验证规则
│   ├── Message.php          --验证器提示语文件
│   └── Rule.php             --验证器规则文件
└── view                     视图目录，对应控制器模块
    ├── README.md
    ├── index                --主页模块
    │   └── index.html       ----客户后台模板外框架
    └── login                --登录模块
        ├── changePwd.html   ----修改密码页面
        └── login.html       ----登陆页面
~~~

## 文档

[完全开发手册](https://www.kancloud.cn/manual/thinkphp6_0/content)

[Think模板引擎开发手册](https://www.kancloud.cn/manual/think-template/content)

## 参与开发

请参阅 [ThinkPHP 核心框架包](https://github.com/top-think/framework)。

