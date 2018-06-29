<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>会员中心</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <include file="resource/view/member"/>
    <link rel="stylesheet" href="{!! UCENTER_TEMPLATE_URL !!}/css/common.css">
</head>
<body>
<div>
    <widget name="header">
        <div class="hd-mobile-header-container">
            <div class="hd-mobile-header">
                <div class="left-fa">
                    <a href="{!! url('member.index') !!}"><i class="fa fa-angle-left"></i></a>
                </div>
                <div class="hd-mobile-header-title">{{title}}</div>
            </div>
        </div>
        <div style="height:45px;"></div>
    </widget>
    <widget name="copyright">
        <div style="height: 20px;"></div>
        <div class="text-center">
            <a href="http://www.hdcms.com" class="text-muted">移动/桌面/微信三网通全能系统</a>
            <br>
            <a href="http://www.hdcms.com" class="text-muted">www.hdcms.com</a>
            <br>
        </div>
    </widget>
    <widget name="hdcmsCopyright">
        <p class="remind" style="margin-bottom: 50px;">
            <a href="{!! web_url() !!}">返回首页</a>
        </p>
    </widget>
    <blade name="content"/>
    {!! widget('module.quickmenu.widget.component.show') !!}
</div>
</body>
</html>