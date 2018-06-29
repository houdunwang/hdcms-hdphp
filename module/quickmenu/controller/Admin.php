<?php namespace module\quickmenu\controller;

use module\HdController;
use system\model\Page;
use houdunwang\arr\Arr;
use houdunwang\request\Request;

/**
 * 微站底部快捷导航
 * Class Admin
 *
 * @package module\quickmenu\controller
 */
class Admin extends HdController
{
    /**
     * 运行构造方法
     * Entry constructor.
     */
    public function __construct()
    {
        auth();//后台权限验证
        parent::__construct();//执行父级构造方法
    }

    /**
     * 移动端页面快捷导航
     *
     * @return mixed|string
     * @throws \Exception
     */
    public function post()
    {
        $model = Page::where('siteid', siteid())->where('type', 'quickmenu')->first();
        if (IS_POST) {
            $data  = json_decode(Request::post('data'), true);
            $model = $model ?: new Page();
            $model->save($data);

            return message('保存快捷菜单成功');
        }
        if ($model) {
            $model['params'] = json_decode($model['params'], true);
            $model           = $model->toArray();
        }
        $field = Arr::merge(
            [
                'siteid'      => siteid(),
                'web_id'      => 0,
                'title'       => '类型:快捷导航',
                'description' => '页面底部快捷导航',
                'type'        => 'quickmenu',
                'status'      => 1,
                'html'        => '',
                'params'      =>
                    [
                        'style'           => 'quickmenu_normal',
                        'menus'           =>
                            [
                            ],
                        'modules'         =>
                            [
                            ],
                        'has_home_button' => 1,
                        'has_ucenter'     => 0,
                        'has_home'        => 0,
                        'has_special'     => 0,
                        'has_article'     => 0,
                    ],
            ],
            $model
        );

        return $this->view($this->template.'/post', ['field' => json_encode($field)]);
    }
}