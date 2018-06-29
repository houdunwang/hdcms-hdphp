<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>hdcms演示站</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <extend file='resource/view/member'/>
    <link rel="stylesheet" href="/theme/default/mobile/css/index.css">
    <link rel="stylesheet" href="/theme/default/mobile/fonts/fonts.css">
</head>
<body>
<!--头部导航-->
<div id="index_header">
    <i class="icon-list"></i>
    <span>HDCMS移动端演示站</span>
</div>
<div class="nav">
    <div class="left">
        <a href="/">首页</a>
        <tag action="article.category_top">
            <a href="{{$field['url']}}" class="{{$field['current_category']}}">
                {{$field['catname']}}
            </a>
        </tag>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{$hdcms['title']}}</h3>
    </div>
    <ul class="list-group">
        <tag action="article.lists" row="10" cid="$_GET['cid']">
            <a class="list-group-item" href="{{$field['url']}}">{{$field['title']}}</a>
        </tag>
    </ul>
</div>
{!! widget('module.quickmenu.widget.component.show') !!}
</body>
</html>