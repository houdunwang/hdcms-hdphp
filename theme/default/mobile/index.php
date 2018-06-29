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
        <div class="swiper-containera">
            <div class="swiper-wrapper">
                <div class="swiper-slide m">
                    <a href="/" class="current_category">首页</a>
                </div>
                <tag action="article.category_top">
                    <div class="swiper-slide m">
                        <a href="{{$field['url']}}">{{$field['catname']}}</a>
                    </div>
                </tag>
            </div>
        </div>
    </div>
</div>
<div class="content_wrap">
    <tag action="article.slide" height="200" color="#fff" autoplay="2000"></tag>
    <ul class="articleList">
        <tag action="article.lists" row="50">
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