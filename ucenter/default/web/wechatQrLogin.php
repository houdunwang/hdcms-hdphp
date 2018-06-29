<!-- 桌面微信挚友登录 -->
<img src="{!! $qr['img'] !!}" style="width: 100%">
<script>
    require(['hdjs'], function (hdjs) {
        setInterval(function () {
            $.post("{!! url('entry.wechatQrLogin',[],'ucenter') !!}", function (response) {
                if (response.valid == 1) {
                    location.href = location.href;
                }
            }, 'json')
        }, 500);
    })
</script>