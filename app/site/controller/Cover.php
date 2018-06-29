<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com  www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace app\site\controller;

use system\model\ReplyCover;
use system\model\SiteWeChat;
use houdunwang\db\Db;
use houdunwang\request\Request;
use houdunwang\view\View;

/**
 * 模块封面回复管理
 * Class Cover
 *
 * @package app\site\controller
 */
class Cover extends Admin
{
    /**
     * 扩展模块封面回复设置
     *
     * @param \system\model\ReplyCover $ReplyCover
     * @param \system\model\Rule       $Rule
     *
     * @return mixed|string
     * @throws \Exception
     */
    public function post(ReplyCover $ReplyCover, \system\model\Rule $Rule)
    {
        auth('system_cover');
        //获取模块封面回复动作信息
        $module = Db::table('modules_bindings')->where('bid', Request::get('bid'))->first();
        //回复的url会记录到reply_cover数据表中用于判断当前回复是否已经设置了
        if (IS_POST) {
            //微信关键词规则数据
            $rule = json_decode(Request::post('hdcms_wechat_keyword'), true);
            if (isset($rule['rid'])) {
                $data['rid'] = $rule['rid'];
            }
            $data['name']     = $rule['name'];
            $data['module']   = 'cover';
            $data['rank']     = $data['istop'] == 1 ? 255 : min(255, intval($data['rank']));
            $data['keywords'] = $rule['keyword'];
            $rid              = SiteWeChat::rule($data);
            //添加封面回复
            $model                = ReplyCover::findOrCreate($rid);
            $model['rid']         = $rid;
            $model['title']       = Request::post('title');
            $model['description'] = Request::post('description');
            $model['thumb']       = Request::post('thumb');
            $model['url']         = $ReplyCover->getModuleCoverUrl(v('module.name'), $module['do']);
            $model['module']      = v('module.name');
            $model->save();

            return message('功能封面更新成功', '', 'success');
        }
        //模块封面回复数据
        $field = $ReplyCover->getModuleCover(v('module.name'), $module['do']);
        //获取关键词回复
        if ($field) {
            $rule = $Rule->getRuleByRid($field['rid']);
            View::with('rule', $rule ? $rule->toArray() : []);
        }

        return view()->with('field', $field);
    }
}