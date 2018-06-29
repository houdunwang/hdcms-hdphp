<?php namespace system\database\seeds;

use houdunwang\database\build\Seeder;
use houdunwang\db\Db;

class hd180303031925_modules extends Seeder
{
    //执行
    public function up()
    {
        $data = [
            'processors' => '{"subscribe":true,"scan":true}',
        ];
        Db::table('modules')->where('mid', 12)->update($data);
    }

    //回滚
    public function down()
    {

    }
}