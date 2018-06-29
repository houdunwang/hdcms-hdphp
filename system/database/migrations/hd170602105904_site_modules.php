<?php namespace system\database\migrations;

use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
use houdunwang\db\Db;
class hd170602105904_site_modules extends Migration
{
    //执行
    public function up()
    {
        if ( ! Schema::tableExists('site_modules')) {
            $sql
                = <<<sql
CREATE TABLE `hd_site_modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` int(10) unsigned NOT NULL,
  `module` varchar(45) DEFAULT NULL COMMENT '模块名称',
  PRIMARY KEY (`id`),
  KEY `siteid` (`siteid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='站点扩展模块';
sql;
            Db::execute($sql);
        }
    }

    //回滚
    public function down()
    {
    }
}