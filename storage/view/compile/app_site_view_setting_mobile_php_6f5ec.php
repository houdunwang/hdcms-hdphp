<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title><?php echo htmlspecialchars(v('site.info.name'))?> - HDCMS开源免费内容管理系统</title>
    <meta http-equiv="Cache-Control" content="Public"/>
    <meta name="csrf-token" content="<?php echo htmlspecialchars( csrf_token() )?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css?version=<?php echo htmlspecialchars(HDCMS_VERSION)?>" rel="stylesheet">
    <link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css?version=<?php echo htmlspecialchars(HDCMS_VERSION)?>" rel="stylesheet">
    <link rel="stylesheet" href="/resource/css/hdcms.css?version=<?php echo htmlspecialchars(HDCMS_VERSION)?>">
    <link rel="stylesheet" href="/resource/hdjs/dist/static/css/hdjs.css?version=<?php echo htmlspecialchars(HDCMS_VERSION)?>">
    <script>
        //HDJS组件需要的配置
        window.hdjs = {
            'base': '<?php echo htmlspecialchars(root_url())?>/resource/hdjs/',
            'uploader': '<?php echo  u("component/upload/uploader",["m"=>Request::get("m"),"siteid"=>siteid()]) ?>',
            'filesLists': '<?php echo  u("component/upload/filesLists",["m"=>Request::get("m"),"siteid"=>siteid()]) ?>',
            'removeImage': '<?php echo  u("component/upload/removeImage",["m"=>Request::get("m"),"siteid"=>siteid()]) ?>',
            'ossSign': '<?php echo  u("component/oss/sign",["m"=>Request::get("m"),"siteid"=>siteid()]) ?>',
        };
        window.system = {
            attachment: "/attachment",
            root: "<?php echo __ROOT__?>",
            url: "<?php echo __URL__?>",
            siteid: "<?php echo siteid()?>",
            module: "<?php echo v('module.name')?>",
            //用于上传等组件使用标识当前是后台用户
            user_type: 'user'
        }
        if (navigator.appName == 'Microsoft Internet Explorer') {
            if (navigator.userAgent.indexOf("MSIE 5.0") > 0 || navigator.userAgent.indexOf("MSIE 6.0") > 0 || navigator.userAgent.indexOf("MSIE 7.0") > 0) {
                alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
            }
        }
    </script>
    <script src="<?php echo htmlspecialchars(root_url())?>/resource/hdjs/dist/static/requirejs/require.js?version=<?php echo htmlspecialchars(HDCMS_VERSION)?>"></script>
    <script src="<?php echo htmlspecialchars(root_url())?>/resource/hdjs/dist/static/requirejs/config.js?version=<?php echo htmlspecialchars(HDCMS_VERSION)?>"></script>
    <link href="<?php echo htmlspecialchars(root_url())?>/resource/css/site.css?version=<?php echo htmlspecialchars(HDCMS_VERSION)?>" rel="stylesheet">
    <script>
        require(['hdjs'], function () {
            //为异步请求设置CSRF令牌
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
</head>
<body class="site">
<div>
    <!--后台站点父级模板-->
    <?php $LINKS = model('menu')->getMenus(); ?>
    <div class="container-fluid admin-top">
        <!--导航-->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <ul class="nav navbar-nav">
                        <?php if(q('session.system.login')=='hdcms'){?>
                
                            <li>
                                <a href="?s=system/site/lists">
                                    <i class="fa fa-reply-all"></i> 返回系统
                                </a>
                            </li>
                        
               <?php }?>
                        <?php if(is_array($LINKS['menus']) || is_object($LINKS['menus'])){foreach ($LINKS['menus'] as $m){?>
                            <?php if($m['mark']==Request::get('mark')){?>
                
                                <li class="top_menu active">
                                    <?php }else{?>
                                <li class="top_menu">
                            
               <?php }?>
                            <a href="<?php echo htmlspecialchars($m['url'])?>&siteid=<?php echo htmlspecialchars(SITEID)?>&mark=<?php echo htmlspecialchars($m['mark'])?>" class="quickMenuLink">
                                <i class="'fa-w <?php echo htmlspecialchars($m['icon'])?>"></i> <?php echo htmlspecialchars($m['title'])?>
                            </a>
                            </li>
                        <?php }}?>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if(q('session.system.login')=='hdcms'){?>
                
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"
                                   style="display:block; max-width:150px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "
                                   aria-expanded="false">
                                    <i class="fa fa-group"></i> <?php echo htmlspecialchars(v('site.info.name'))?> <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="?s=system/site/edit&siteid=<?php echo htmlspecialchars(SITEID)?>"><i class="fa fa-weixin fa-fw"></i>
                                            编辑当前账号资料
                                        </a>
                                    </li>
                                    <li><a href="?s=system/site/lists"><i class="fa fa-cogs fa-fw"></i> 管理se其它公众号</a></li>
                                    <li><a href="javascript:;" onclick="updateSiteCache()"><i class="fa fa-sitemap"></i> 更新站点缓存</a></li>
                                </ul>
                                <script>
                                    function updateSiteCache() {
                                        require(['resource/js/hdcms.js'], function (hdcms) {
                                            hdcms.updateSiteCache();
                                        })
                                    }
                                </script>
                            </li>
                        
               <?php }?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                <i class="fa fa-w fa-user"></i>
                                <?php echo htmlspecialchars(v('user.info.username'))?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="?s=system/user/info">我的帐号</a></li>
                                <?php if(q('session.system.login')=='hdcms'){?>
                
                                    <li><a href="?s=system/manage/menu">系统选项</a></li>
                                
               <?php }?>
                                <li role="separator" class="divider"></li>
                                <li><a href="?s=system/entry/quit">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--导航end-->
    </div>
    <!--主体-->
    <div class="container-fluid admin_menu">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-lg-2 left-menu">
                <div class="search-menu">
                    <input class="form-control input-lg" id="searchMenu" type="text" placeholder="输入菜单名称可快速查找">
                </div>
                <script>
                    require(['hdjs', '/resource/js/site_menu.js'], function (hdjs, menu) {
                        //当前点击样式
                        menu.changeCurrentLinkStyle();
                        //菜单搜索
                        $('#searchMenu').blur(function () {
                            menu.search(this);
                        });
                    })
                    require(['hdjs', '/resource/js/site_footer_quickmenu.js'], function (hdjs, menu) {
                        //后台底部快捷导航
                        menu.quickmenu();
                    })
                </script>
                <!--扩展模块动作 start-->
                <?php if('package'==Request::get('mark') && Request::get('m')){?>
                
                    <div class="btn-group module_action_type">
                        <a class="btn <?php echo htmlspecialchars(Request::get('mt')=='default'?'btn-primary':'btn-default')?> default col-sm-4" href="<?php echo  url_del('mt') ?>&mt=default">
                            默认
                        </a>
                        <a class="btn <?php echo htmlspecialchars(Request::get('mt')=='system'?'btn-primary':'btn-default')?> system  col-sm-4" href="<?php echo  url_del('mt') ?>&mt=system">
                            系统
                        </a>
                        <a class="btn <?php echo htmlspecialchars(Request::get('mt')=='group'?'btn-primary':'btn-default')?> group  col-sm-4" href="<?php echo  url_del('mt') ?>&mt=group">
                            组合
                        </a>
                    </div>
                
               <?php }?>
                <div class="panel panel-default">
                    <!--系统菜单-->
                    <?php if(!in_array(Request::get('mt'),['default'])){?>
                
                        <?php if(is_array($LINKS['menus']) || is_object($LINKS['menus'])){foreach ($LINKS['menus'] as $m){?>
                            <?php if($m['mark']==Request::get('mark')){?>
                
                                <?php if(is_array($m['_data']) || is_object($m['_data'])){foreach ($m['_data'] as $d){?>
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><?php echo htmlspecialchars($d['title'])?></h4>
                                        <a class="panel-collapse" data-toggle="collapse" href="javascript:;">
                                            <i class="fa fa-chevron-circle-down"></i>
                                        </a>
                                    </div>
                                    <ul class="list-group menus">
                                        <?php if(is_array($d['_data']) || is_object($d['_data'])){foreach ($d['_data'] as $g){?>
                                            <li class="list-group-item" id="<?php echo htmlspecialchars($g['id'])?>">
                                                <?php if($g['append_url']){?>
                
                                                    <a class="pull-right append_url"
                                                       href="<?php echo htmlspecialchars($g['append_url'])?>&siteid=<?php echo htmlspecialchars(SITEID)?>&mark=<?php echo htmlspecialchars($g['mark'])?>&mi=<?php echo htmlspecialchars($g['id'])?>">
                                                        <i class="fa fa-plus-circle"></i>
                                                    </a>
                                                
               <?php }?>
                                                <a href="<?php echo htmlspecialchars($g['url'])?>&siteid=<?php echo htmlspecialchars(SITEID)?>&mark=<?php echo htmlspecialchars($g['mark'])?>&mi=<?php echo htmlspecialchars($g['id'])?>&mt=<?php echo htmlspecialchars(Request::get('mt'))?>"
                                                   class="quickMenuLink">
                                                    <?php echo htmlspecialchars($g['title'])?>
                                                </a>
                                            </li>
                                        <?php }}?>
                                    </ul>
                                <?php }}?>
                            
               <?php }?>
                        <?php }}?>
                    
               <?php }?>
                    <!----------返回模块列表 start------------>
                    <?php if($LINKS['module'] && Request::get('mark')=='package' && in_array(Request::get('mt'),['default'])){?>
                
                        <div class="panel-heading">
                            <h4 class="panel-title">系统功能</h4>
                            <a class="panel-collapse" data-toggle="collapse" aria-expanded="true">
                                <i class="fa fa-chevron-circle-down"></i>
                            </a>
                        </div>
                        <ul class="list-group" aria-expanded="true" mark="package">
                            <li class="list-group-item">
                                <a href="<?php echo  u('site.entry.home',['siteid'=>siteid(),'mark'=>'package']) ?>">
                                    <i class="fa fa-reply-all"></i> 返回模块列表
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo htmlspecialchars(site_url('site.entry.module'))?>&m=<?php echo htmlspecialchars($_GET['m'])?>">
                                    <i class="fa fa-desktop"></i> <?php echo htmlspecialchars($LINKS['module']['module']['title'])?>
                                </a>
                            </li>
                        </ul>
                    
               <?php }?>
                    <?php if(Request::get('mark')=='package' && in_array(Request::get('mt'),['group','default'])){?>
                
                        <?php if(is_array($LINKS['module']['access']) || is_object($LINKS['module']['access'])){foreach ($LINKS['module']['access'] as $title=>$t){?>
                            <?php if(!empty($t) && $title!='extPermissions'){?>
                
                                <div class="panel-heading module_back module_action">
                                    <h4 class="panel-title"><?php echo htmlspecialchars($title)?></h4>
                                    <a class="panel-collapse" data-toggle="collapse" aria-expanded="true">
                                        <i class="fa fa-chevron-circle-down"></i>
                                    </a>
                                </div>
                                <ul class="list-group " aria-expanded="true">
                                    <?php if(is_array($t) || is_object($t)){foreach ($t as $m){?>
                                        <li class="list-group-item" id="<?php echo htmlspecialchars($m['_hash'])?>">
                                            <a href="<?php echo htmlspecialchars($m['url'])?>&siteid=<?php echo htmlspecialchars(siteid())?>&mi=<?php echo htmlspecialchars($m['_hash'])?>&mt=<?php echo htmlspecialchars(Request::get('mt'))?>"
                                               class="quickMenuLink">
                                                <i class="<?php echo htmlspecialchars($m['ico'])?>"></i> <?php echo htmlspecialchars($m['title'])?>
                                            </a>
                                        </li>
                                    <?php }}?>
                                </ul>
                            
               <?php }?>
                        <?php }}?>
                    
               <?php }?>
                    <!--模块列表-->
                    <?php if(Request::get('mark')=='package' && in_array(Request::get('mt'),['group','system',''])){?>
                
                        <?php if(is_array($LINKS['moduleLists']) || is_object($LINKS['moduleLists'])){foreach ($LINKS['moduleLists'] as $t=>$d){?>
                            <div class="panel-heading">
                                <h4 class="panel-title"><?php echo htmlspecialchars($t)?></h4>
                                <a class="panel-collapse">
                                    <i class="fa fa-chevron-circle-down"></i>
                                </a>
                            </div>
                            <ul class="list-group menus">
                                <?php if(is_array($d) || is_object($d)){foreach ($d as $g){?>
                                    <li class="list-group-item">
                                        <a href="<?php echo htmlspecialchars(site_url('site.entry.module'))?>&m=<?php echo htmlspecialchars($g['name'])?>&mt=default">
                                            <?php echo htmlspecialchars($g['title'])?>
                                        </a>
                                    </li>
                                <?php }}?>
                            </ul>
                        <?php }}?>
                    
               <?php }?>
                    <!--模块列表 end-->
                </div>
            </div>
            <div class="col-xs-12 col-sm-9 col-lg-10">
                <!--有模块管理时显示的面包屑导航-->
                <?php if(v('module.title') && v('module.is_system')==0){?>
                
                    <ol class="breadcrumb" style="padding:8px 0;margin-bottom:10px;">
                        <li>
                            <a href="?s=site/entry/home&mark=package">
                                <i class="fa fa-cogs"></i> 扩展模块
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo htmlspecialchars(site_url('site.entry.module'))?>&m=<?php echo htmlspecialchars(v('module.name'))?>"><?php echo htmlspecialchars(v('module.title'))?></a>
                        </li>
                        <?php if($module_action_name){?>
                
                            <li class="active">
                                <?php echo htmlspecialchars($module_action_name)?>
                            </li>
                        
               <?php }?>
                    </ol>
                
               <?php }?>
                <div>
                        
    <ul class="nav nav-tabs">
        <li class="active"><a href="#">邮件通知</a></li>
    </ul>
    <form class="form-horizontal" id="app" v-cloak @submit.prevent="submit">
<?php echo csrf_field();?>
        <div class="alert alert-success">
            必须将 <a href="http://houdunren.hdcms.com/?s=site/setting/aliyun&siteid=18&mark=feature&mi=103&mt="> 阿里云基本设置</a> 配置正确才可以使用阿里云短信
        </div>
        <div class="panel panel-default" v-if="false">
            <div class="panel-heading">短信通知设置</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">短信服务商</label>
                    <div class="col-sm-10">
                        <label class="radio-inline">
                            <input type="radio" value="aliyun" v-model="field.provider"> 阿里云
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">endPoint</label>
                    <div class="col-sm-10">
                        <input class="form-control" v-model="field.aliyun.endPoint">
                        <span class="help-block">
                          访问MNS的接入地址，登陆MNS控制台 单击右上角 获取Endpoint 查看
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">topic</label>
                    <div class="col-sm-10">
                        <input class="form-control" v-model="field.aliyun.topic">
                        <span class="help-block">短信专用主题</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">短信验证码</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">短信签名</label>
                    <div class="col-sm-10">
                        <input class="form-control" v-model="field.aliyun.code.sign">
                        <span class="help-block">
                            请登录阿里云 "短信服务 > 签名管理" 查看
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">短信模板</label>
                    <div class="col-sm-10">
                        <input class="form-control" v-model="field.aliyun.code.template">
                        <span class="help-block">
                            验证码短信模板，模板中必须存在 code(验证码) 与 product(站点名称）变量。 <br>
                            使用阿里云默认的模板即可，请登录阿里云 "短信服务 > 模板管理" 查看模板  "身份验证验证码" 模板CODE为 "SMS_12840367" 。
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">发送验证码</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input class="form-control" placeholder="请填写手机号" v-model="field.aliyun.code.test_mobile">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" @click="aliyunCodeTest">发送</button>
                            </span>
                        </div>
                        <span class="help-block">测试当前阿里云是否配置正确</span>
                    </div>
                </div>
            </div>
        </div>
        <textarea name="data" v-html="field" hidden></textarea>
        <button class="col-lg-1 btn btn-default">保存</button>
    </form>

                    <div style="height: 100px;"></div>
                </div>
            </div>
        </div>
        <!--右键菜单添加到快捷导航-->
        <div id="context-menu">
            <ul class="dropdown-menu" role="menu">
                <li><a tabindex="-1" href="#">添加到快捷菜单</a></li>
            </ul>
        </div>
        <!--右键菜单删除快捷导航-->
        <div id="context-menu-del">
            <ul class="dropdown-menu" role="menu">
                <li><a tabindex="-1" href="#">删除菜单</a></li>
            </ul>
        </div>
        <!--底部快捷菜单导航-->
        <?php $QUICKMENU = model('menu')->getQuickMenu(); ?>
        <?php if($QUICKMENU['status']){?>
                
            <div class="quick_navigate">
                <div class="btn-group">
            <span class="btn btn-default btn-sm" id="delAllQuickMenu">
                删除所有菜单
            </span>
                    <?php if(is_array($QUICKMENU['system']) || is_object($QUICKMENU['system'])){foreach ($QUICKMENU['system'] as $v){?>
                        <a class="btn btn-default btn-sm" href="<?php echo htmlspecialchars($v['url'])?>">
                            <?php echo htmlspecialchars($v['title'])?>
                        </a>
                    <?php }}?>
                    <?php if(is_array($QUICKMENU['module']) || is_object($QUICKMENU['module'])){foreach ($QUICKMENU['module'] as $v){?>
                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                <?php echo htmlspecialchars($v['title'])?> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <?php if(is_array($v['action']) || is_object($v['action'])){foreach ($v['action'] as $a){?>
                                    <li><a href="<?php echo htmlspecialchars($a['url'])?>"><?php echo htmlspecialchars($a['title'])?></a></li>
                                <?php }}?>
                            </ul>
                        </div>
                    <?php }}?>
                </div>
                <i class="fa fa-times-circle-o pull-right fa-2x close_quick_menu"></i>
            </div>
        
               <?php }?>
        <?php if(!empty($errors)){?>
                
            <div class="modal fade in" id="myModalMessage" role="dialog" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width: 600px;">
                    <div class="modal-content  alert alert-info">
                        <div class="modal-header" style="padding: 5px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                            <h4 class="modal-title">系统提示</h4></div>
                        <div class="modal-body">
                            <i class="pull-left fa fa-4x fa-info-circle"></i>
                            <div class="pull-left">
                                <?php if(is_array($errors) || is_object($errors)){foreach ($errors as $v){?>
                                    <p><?php echo htmlspecialchars($v)?></p>
                                <?php }}?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>
            <script type="application/ecmascript">
                require(['hdjs'], function () {
                    $('#myModalMessage').modal('show');
                })
            </script>
        
               <?php }?>
    </div>
</div>
</body>
</html>


<script>
    require(['vue', 'hdjs'], function (Vue, hdjs) {
        new Vue({
            el: '#app',
            data: {
                field: <?php echo $sms?>
            },
            methods: {
                submit() {
                    hdjs.submit({successUrl: 'refresh'});
                },
                //发送测试验证码
                aliyunCodeTest() {
                    hdjs.submit({successUrl: '', url: '<?php echo htmlspecialchars(site_url("setting.aliyunCodeTest"))?>'});
                }
            }
        })
    })
</script>