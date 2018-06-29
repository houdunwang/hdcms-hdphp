<?php namespace module\ucenter\system;

use module\HdProcessor;
use system\model\Member;
use system\model\MemberAuth;
use houdunwang\wechat\WeChat;
use system\model\MemberGroup;
use system\model\MemberWeChatQr;

/**
 * 微信处理
 * Class Processor
 *
 * @package module\ucenter\system
 */
class Processor extends HdProcessor
{
    //规则编号
    public function handle($rid = 0)
    {
        $this->qrLogin();
        $this->subscribeEvent();
    }

    /**
     * 扫码登录
     *
     * @throws \Exception
     */
    protected function qrLogin()
    {
        $instance = $this->message;
        if ($instance->isSubscribeScanEvent() || $instance->isScanEvent()) {
            //获取消息内容
            $message = $instance->getMessage();
            //向用户回复消息
            $qr = MemberWeChatQr::find($message->EventKey);
            if ($qr['action'] == 'login') {
                //用户没有登录时，创建新微信登录用户
                $fans = WeChat::instance('user')->getUserInfo($instance->FromUserName);
                $auth = MemberAuth::where('wechat', $fans['openid'])->first();
                //帐号不存在时使用添加帐号
                if ($auth) {
                    $auth['wechat']         = $fans['openid'];
                    $auth['wechat_unionid'] = isset($fans['unionid']) ? $fans['unionid'] : '';
                    $auth->save();
                } else {
                    $member             = new Member();
                    $member['nickname'] = $fans['nickname'];
                    $member['icon']     = $fans['headimgurl'];
                    $member['group_id'] = MemberGroup::getDefaultGroup();
                    $member->save();
                    $auth                   = new MemberAuth();
                    $auth['uid']            = $member['uid'];
                    $auth['wechat']         = $fans['openid'];
                    $auth['wechat_unionid'] = isset($fans['unionid']) ? $fans['unionid'] : '';
                    $auth->save();
                }
                //更改二维码数据
                $qr['uid'] = $auth['uid'];
                $qr->save();
                $instance->text('登录成功');
            }
        }
    }

    /**
     * 关注公众号时添加用户
     *
     * @throws \Exception
     */
    protected function subscribeEvent()
    {
        if (WeChat::instance('message')->isSubscribeEvent()) {
            $content = WeChat::instance('message')->getMessage();
            $info    = WeChat::instance('user')->getUserInfo($content->FromUserName);
            $auth    = MemberAuth::where('wechat', $info['openid'])->first();
            if ($auth) {
                $auth['wechat']         = $info['openid'];
                $auth['wechat_unionid'] = isset($info['unionid']) ? $info['unionid'] : '';
                $auth->save();
            } else {
                $member             = new Member();
                $member['nickname'] = $info['nickname'];
                $member['icon']     = $info['headimgurl'];
                $member->save();
                $auth = new MemberAuth();
                $auth->save(
                    [
                        'uid'            => $member['uid'],
                        'siteid'         => siteid(),
                        'wechat'         => $info['openid'],
                        'wechat_unionid' => isset($info['unionid']) ? $info['unionid'] : '',
                    ]
                );
            }
        }
    }
}