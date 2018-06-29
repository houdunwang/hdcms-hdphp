<?php namespace addons\comments\controller;

use addons\comments\model\Comments;
use addons\comments\model\Response;
use module\HdController;

class Home extends HdController {

	//评论列表
	public function index() {

		return view ($this->template . '/home/index.html');
	}

	/**
	 * 提交评论
	 * @param Comments $comments
	 *
	 * @return array
	 */
	public function post(Comments $comments){
		if(IS_AJAX){
			return $comments->post(Request::post());
		}
	}

	/**
	 * 提交回复
	 * @param Comments $comments
	 *
	 * @return mixed
	 */
	public function response(Response $response){
		if(IS_AJAX){
			return $response->post(Request::post());
		}
	}
}