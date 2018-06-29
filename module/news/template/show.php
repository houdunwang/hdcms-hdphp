<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$hdcms['title']}}</title>
</head>
<body>
<div class="news-top">
    <div class="title">
        {{$hdcms['title']}}
    </div>
    <div class="text-info">
        <span class="times">发表时间: {{date('Y-m-d',$hdcms['createtime'])}}</span>
        <span class="author">作者: {{$hdcms['author']}}</span>
    </div>
</div>
<div class="content">
    {!! $hdcms['content'] !!}
</div>
<style>
    body {
        padding: 0px;
        margin: 0px;
    }

    div.news-top {
        background: #fff;
        clear: both;
        padding: 0px;
        padding: 2vw;
        border-bottom: solid 1px #ddd;
        padding-bottom: 15px;
    }

    div.news-top .title {
        font-size: 5vw;
        font-weight: bold;
        margin-bottom: 10px;
    }

    div.content {
        padding: 2vw;
        font-size: 16px;
        line-height: 1.5em;
        color: #333;
    }

    div.content img {
        max-width: 100%;
    }
</style>
</body>
</html>
