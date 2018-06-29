<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com  www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * |     Weibo: http://weibo.com/houdunwangxj
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace module\quickmenu\widget;

use houdunwang\request\Request;
use module\HdWidget;

/**
 * 微站底部快捷导航管理
 * Class Component
 *
 * @package module\quickmenu\widget
 */
class Component extends HdWidget
{
    /**
     * 显示底部导航菜单的widget组件
     *
     * @return string
     */
    public function show()
    {
        $res = \Db::table('page')->where('siteid', SITEID)->where('type', 'quickmenu')->first();
        if ($res && $res['status']) {
            $html   = '';
            $params = json_decode($res['params'], true);
            //会员中心
            if (v('module.name') == 'ucenter' && $params['has_ucenter'] == 1) {
                $html = $res['html'];
            }
            //文章模块网站首页
            if (v('module.name') == 'article' && empty(Request::get('cid'))
                && $params['has_home'] == 1) {
                $html = $res['html'];
            }
            //栏目或文章模板
            if (v('module.name') == 'article' && Request::get('cid')
                && $params['has_article'] == 1) {
                $html = $res['html'];
            }

            return $this->view('module/quickmenu/widget/template/show', compact('html'));
        }
    }
}