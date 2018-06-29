<extend file="resource/view/system"/>
<block name="content">
	<ol class="breadcrumb">
		<li><i class="fa fa-home"></i></li>
		<li><a href="?s=system/manage/menu">系统</a></li>
		<li class="active">已经安装模块</li>
	</ol>
	<ul class="nav nav-tabs">
		<li role="presentation"><a href="{!! u('installed') !!}">已经安装模块</a></li>
		<li role="presentation" class="active"><a href="?s=system/module/prepared">安装模块</a></li>
		<li role="presentation"><a href="?s=system/module/design">设计新模块</a></li>
        <li role="presentation"><a href="{!! u('shop.buy',['type'=>'template']) !!}">已购模板</a></li>
	</ul>
	<div class="clearfix">
		<h5 class="page-header">下载软件包...</h5>
		<div class="alert alert-info" role="alert">正在下载软件包...</div>
	</div>
</block>
<script>
	$.post('{{__URL__}}', function (res) {
		require(['hdjs'], function (hdjs) {
			if (res.valid == 1) {
				location.href='?s=system/template/install&name={{$_GET["name"]}}';
			} else {
				hdjs.message(res.message, '', 'error');
			}
		})
	}, 'json')
</script>
