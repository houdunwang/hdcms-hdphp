<?php namespace module\cover\system;

use module\HdProcessor;
use houdunwang\db\Db;

/**
 * 封面消息处理
 * Class processor
 *
 * @package module\basic
 */
class processor extends HdProcessor
{
    //规则编号
    public function handle($rid = 0)
    {
        $where = [
            ['rid', $rid],
            ['siteid', SITEID],
        ];
        $res   = Db::table('reply_cover')->where($where)->orderBy('id', 'DESC')->first();
        if ($res) {
            $data[] = [
                'title'       => $res['title'],
                'discription' => $res['description'],
                'picurl'      => pic($res['thumb']),
                'url'         => preg_match('/^http/i', $res['url']) ? $res['url']
                    : __ROOT__.'/'.$res['url'],
            ];
            $this->news($data);
        }
    }
}
