<?php namespace system\database\migrations;

use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;

class hd180303014524_member_wechat_qr extends Migration
{
    //执行
    public function up()
    {
        Schema::create(
            'member_wechat_qr',
            function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->integer('siteid')->index()->comment('站点编号');
                $table->string('scene_id', 20)->index()->defaults(0)->comment('微信二维码scene_id');
                $table->string('scene_str', 20)->index()->defaults('')->comment('微信二维码scene_str');
                $table->integer('uid')->index()->defaults(0)->comment('会员编号');
                $table->string('action')->defaults('')->comment('扫码后执行的动作');
            }
        );
    }

    //回滚
    public function down()
    {
        Schema::drop('member_wechat_qr');
    }
}