<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会员登录</title>
    <include file="resource/view/member"/>
    <link rel="stylesheet" type="text/css"
          href="{!! UCENTER_TEMPLATE_URL !!}/static/css/login.css"/>
</head>
<body>
<div class="container">
    <h1 class="big-title">会员登录</h1>
    <form class="form-horizontal" role="form" onsubmit="post(event)">
        <div class="form-group">
            <div class="col-sm-12">
                <input type="text" class="form-control input-lg" name="username"
                       placeholder="{!! $placeholder !!}" required="required"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="input-group input-group-lg">
                    <input type="password" class="form-control" name="password" placeholder="请输入密码"
                           required="required"/>
                    <span class="input-group-btn">
                            <a class="btn btn-default"
                               href="{!! url('entry.forgetpwd') !!}">忘记密码？</a>
                        </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success btn-lg btn-block">登录</button>
            </div>
        </div>
        <if value="v('site.setting.login.wechat')">
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="button" onclick="wechatLogin()" class="btn btn-info btn-lg btn-block">微信登录</button>
                </div>
            </div>
        </if>
    </form>
    <p class="remind">还没有帐号？ <a href="{!! url('entry.register') !!}">注册新帐号</a></p>
    <script>
        function post(event) {
            event.preventDefault();
            require(['hdjs'], function (hdjs) {
                hdjs.submit({
                    callback: function (response) {
                        if (response.valid == 1) {
                            location.href = "{!! $url !!}";
                        } else {
                            hdjs.message(response.message, '', 'info');
                        }
                    }
                });
            })
        }

        function wechatLogin() {
            require(['hdjs'], function (hdjs) {
                hdjs.modal({
                    content: ['{!! url("entry.wechatQrLogin",[],"ucenter") !!}'],//加载的远程地址
                    title: '微信登录',
                    width: 350,
                    show: true,
                });
            });
        }
    </script>
    <p class="remind" style="margin-bottom: 50px;">
        <a href="{!! web_url() !!}">返回首页</a>
    </p>
</div>
</body>
</html>