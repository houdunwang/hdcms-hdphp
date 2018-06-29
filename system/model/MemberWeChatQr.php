<?php namespace system\model;

use Carbon\Carbon;
use houdunwang\model\Model;
use houdunwang\wechat\WeChat;

/**
 * 微信二维码
 * 比如可以用于扫码登录
 * Class MemberWeChatQr
 *
 * @package system\model
 */
class MemberWeChatQr extends Model
{
    //数据表
    protected $table = "member_wechat_qr";

    //允许填充字段
    protected $allowFill = ['*'];

    //自动验证
    protected $validate
        = [
            //['字段名','验证方法','提示信息',验证条件,验证时间]
        ];

    //自动完成
    protected $auto
        = [
            ['siteid', 'siteid', 'function', self::EMPTY_AUTO, self::MODEL_BOTH],
            ['scene_id', 0, 'string', self::NOT_EXIST_AUTO, self::MODEL_INSERT],
            ['scene_str', '', 'string', self::NOT_EXIST_AUTO, self::MODEL_INSERT],
            ['uid', 0, 'string', self::NOT_EXIST_AUTO, self::MODEL_INSERT],
        ];

    //自动过滤
    protected $filter
        = [
            //[表单字段名,过滤条件,处理时间]
        ];

    //时间操作,需要表中存在created_at,updated_at字段
    protected $timestamps = true;

    /**
     * 删除一天前的二维码
     *
     * @return mixed
     */
    public function removeYesterday()
    {
        $time = new Carbon('yesterday');

        return $this->where('created_at', '<', $time)->delete();
    }

    /**
     * 创建微信临时二维码
     *
     * @param int    $second 秒数
     * @param string $action 动作
     *
     * @return mixed
     * @throws \Exception
     */
    public function createQr($second = 100, $action = '')
    {
        //删除一天前的二维码
        $this->removeYesterday();
        //新增记录
        $this->save(['action' => $action, 'uid' => v('member.info.uid') ?: 0]);
        $param       = [
            //过期秒数
            'expire_seconds' => $second,
            //场景值ID
            'scene_id'       => $this['id'],
        ];
        $instance    = WeChat::instance('qrcode');
        $qr          = $instance->create($param);
        $this['img'] = $instance->getQrcode($qr['ticket']);

        return $this;
    }
}