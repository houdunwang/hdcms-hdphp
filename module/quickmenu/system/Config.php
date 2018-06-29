<?php namespace addons\quickmenu\system;

/**
 * 模块配置管理
 * 用于管理当前模块的配置项
 * 每个模块配置是独立管理的互不影响
 * @author 向军大叔
 * @url http://www.hdcms.com
 */
use module\HdConfig;
use View;
use Request;
class Config extends HdConfig {
	public function settingsDisplay() {
		if ( IS_POST ) {
			//将新配置数据保存
			$this->saveConfig( Request::post() );
			return message( '配置项保存成功', 'refresh', 'success' );
		}
		//分配
		View::with('field', $this->config);

		return view( $this->template . '/config' );
	}
}