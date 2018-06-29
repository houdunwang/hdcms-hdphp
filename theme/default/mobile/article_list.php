<!DOCTYPE html>
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
<div class="content_wrap">
    <ul class="articleList">
        <tag action="article.pagelist" row="20">
            <a href="{{$field['url']}}">
                <li>
                    <div class="artilce">
                        <div class="title">{{$field['title']}}</div>
                        <div class="info">点击量:{{$field['click']}}</div>
                    </div>
                    <div class="pic">
                        <img src="{{$field['thumb']}}" alt="">
                    </div>
                </li>
            </a>
        </tag>
    </ul>
</div>
{!! widget('module.quickmenu.widget.component.show') !!}
</body>
</html>