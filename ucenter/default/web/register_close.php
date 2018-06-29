<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会员注册</title>
    <include file="resource/view/member"/>
    <link rel="stylesheet" type="text/css"
          href="{!! UCENTER_TEMPLATE_URL !!}/static/css/register.css"/>
</head>
<body>
<div class="container">
    <if value="v('site.setting.register.type') eq 0">
        <h3 style="margin-top: 100px;" class="text-center">网站暂时关闭注册</h3>
    </if>
    <p class="remind" style="margin-bottom: 50px;">
        <a href="{!! web_url() !!}">返回首页</a>
    </p>
</div>
</body>
</html>