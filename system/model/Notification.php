<?php namespace system\model;

use houdunwang\db\Db;
use houdunwang\model\Model;

class Notification extends Model
{
    //数据表
    protected $table = "notification";

    //允许填充字段
    protected $allowFill = ['*'];

    //禁止填充字段
    protected $denyFill = [];

    //自动验证
    protected $validate
        = [
            //['字段名','验证方法','提示信息',验证条件,验证时间]
        ];

    //自动完成
    protected $auto
        = [
            //['字段名','处理方法','方法类型',验证条件,验证时机]
            ['siteid', 'siteid', 'function', self::EMPTY_AUTO, self::MODEL_BOTH],
            ['status', 0, 'string', self::MUST_AUTO, self::MODEL_INSERT],
        ];

    //自动过滤
    protected $filter
        = [
            //[表单字段名,过滤条件,处理时间]
        ];

    //时间操作,需要表中存在created_at,updated_at字段
    protected $timestamps = true;

    /**
     * 获取分页数据
     *
     * @param int $row    每页显示条数
     * @param int $status 状态
     *
     * @return mixed
     */
    public static function getPageLists($row = 30, $status = 0)
    {
        $uid = v('member.info.uid');
        //只保留100条信息
        $sql = "DELETE FROM ".tablename('notification')." WHERE id IN(
SELECT id FROM (SELECT id FROM ".tablename('notification')." WHERE uid={$uid} ORDER BY id DESC limit 3,99999) AS c
)";
        Db::execute($sql);
        $where = [
            ['siteid', siteid()],
            ['status', $status],
            ['uid', $uid],
        ];
        return self::where($where)->orderBy('id', 'DESC')->paginate($row);
    }

    /**
     * 未读数量
     *
     * @param int $uid 会员编号
     *
     * @return mixed
     */
    public static function unReadCount($uid = 0)
    {
        $uid   = $uid ?: v('member.info.uid');
        $where = [
            ['siteid', siteid()],
            ['uid', $uid],
            ['status', 0],
        ];

        return self::where($where)->count();
    }
}