<?php namespace app\component\controller;

use houdunwang\config\Config;

/**
 * 阿里云OSS
 * Class Oss
 *
 * @package app\component\controller
 */
class Oss extends Common
{
    /**
     * 生成供前台使用的签名
     *
     * @return mixed
     */
    public function sign()
    {
        Config::set('aliyun', v('site.setting.aliyun.aliyun'));
        Config::set('oss', v('site.setting.aliyun.oss'));
        Config::set('oss.host','http://houdunren.oss-cn-hangzhou.aliyuncs.com');
        return \houdunwang\oss\Oss::sign();
    }
}