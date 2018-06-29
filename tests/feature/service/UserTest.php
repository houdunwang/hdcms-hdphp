<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com  www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace tests\feature\service;

use tests\Base;
use Session;

/**
 * 业务测试类
 * Class ExampleTest
 *
 * @package tests\feature
 */
class UserTest extends Base
{
    protected $host = "http://dev.hdcms.com?s=home/a/index";

    public function setUp()
    {
        parent::setUp();
        $this->withSession(['admin_uid' => 1]);
    }

    public function testOne()
    {
        $this->assertTrue(false);
    }
}