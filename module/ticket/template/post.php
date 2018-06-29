<extend file="resource/view/site"/>
<block name="content">
    <ul class="nav nav-tabs">
        <li>
            <a href="{!! url('site/lists') !!}&type={{$_GET['type'] !!}">
                管理{{$msg['module']['title']}}
            </a>
        </li>
        <if value="Request::get('tid')">
            <li>
                <a href="{!! url('site/post') !!}&type={{$_GET['type'] !!}">
                    <i class="fa fa-plus"></i> 添加{{$msg['module']['title']}}
                </a>
            </li>
            <li class="active">
                <a href="#">
                    <i class="fa fa-plus"></i> 编辑{{$msg['module']['title']}}
                </a>
            </li>
            <else/>
            <li class="active">
                <a href="javascript:;">
                    <i class="fa fa-plus"></i> 添加{{$msg['module']['title']}}</a>
            </li>
        </if>
    </ul>
    <form method="post" class="form-horizontal" onsubmit="post(event)">
        <input type="hidden" name="tid" value="{{$field['tid']}}">
        <input type="hidden" name="type" value="{{q('get.type')}}">
        <div class="panel panel-default">
            <div class="panel-heading">折扣券</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">可用模块</label>
                    <div class="col-sm-10 ">
                        <button type="button" class="btn btn-default" onclick="selectModule(this)">
                            选择模块
                        </button>
                        <div class="modules">
                            <if value="$modules">
                                <foreach from="$modules" value="$m">
                                    <span class="label label-info"
                                          style="margin:5px;display:inline-block;">{{$m['title']}}</span>
                                    <input type="hidden" mid="{{$m['mid']}}" name="module[]"
                                           value="{{$m['name']}}">
                                </foreach>
                            </if>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label star">{{$msg['title']['title']}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" required
                               value="{{old('title',$field['title'])}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label star">
                        {{$msg['condition']['title']}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="condition" required
                               value="{{old('title',$field['condition'])}}">
                        <span class="help-block">{{$msg['condition']['help']}}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label star">
                        {{$msg['discount']['title']}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="discount" required
                               value="{{old('title',$field['discount'])}}">
                        <span class="help-block">{{$msg['discount']['help']}}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label star"> 可使用的会员组</label>
                    <div class="col-sm-10">
                        <select name="groups[]" class="js-example-basic-single form-control"
                                multiple>
                            <foreach from="$groups" value="$g">
                                <if value="in_array($g['id'],$groupsIds)">
                                    <option value="{{$g['id']}}" selected>{{$g['title']}}</option>
                                    <else/>
                                    <option value="{{$g['id']}}">{{$g['title']}}</option>
                                </if>

                            </foreach>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label star"> 封面</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" readonly="" required
                                   name="thumb" value="{{$field['thumb']}}">
                            <div class="input-group-btn">
                                <button onclick="upImage(this)" class="btn btn-default"
                                        type="button">选择图片
                                </button>
                            </div>
                        </div>
                        <div class="input-group" style="margin-top:5px;">
                            <img src="{{$field['thumb']?:'resource/images/nopic.jpg'}}"
                                 class="img-responsive img-thumbnail" width="150">
                            <em class="close" style="position:absolute; top: 0px; right: -14px;"
                                title="删除这张图片">×</em>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label star">
                        {{$msg['description']['title']}}</label>
                    <div class="col-sm-10">
                        <textarea id="container" name="description"
                                  style="height:300px;width:100%;">{{$field['description']}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                兑换方式
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label star">积分类型</label>
                    <div class="col-sm-10">
                        <select name="credittype" class="form-control">
                            <foreach from="v('site.setting.creditnames')" key="$name" value="$v">
                                <if value="$v['title']">
                                    <option value="{{$name}}">{{$v['title']}}</option>
                                </if>
                            </foreach>
                        </select>
                        <span class="help-block">
                            此设置项设置当前礼品兑换需要消耗的积分类型,如:金币、积分、贡献等。
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label star">积分数量</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="credit" required
                               value="{{$field['credit']}}">
                        <span class="help-block">
                            此设置项设置当前礼品兑换需要消耗的积分数量。
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label star">使用期限</label>
                    <div class="col-sm-10">
                        <div class="input-group date-range">
                            <if value="$field['starttime']">
                                <input readonly class="form-control dateinput" name="times" required
                                       value="{{date('Y-m-d',$field['starttime'])}} 至 {{date('Y-m-d',$field['endtime'])}}">
                                <else/>
                                <input readonly class="form-control dateinput" name="times"
                                       required>
                            </if>
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label star">{{$msg['limit']['title']}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="limit" required
                               value="{{$field['limit']}}">
                        <span class="help-block">
                            {{$msg['limit']['help']}}
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label star">{{$msg['module']['title']}}总数量</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="amount" required
                               value="{{$field['amount']}}">
                        <span class="help-block">
                            此设置项设置折扣券的总发行数量。
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
    <script>
        //提交表单
        function post(event) {
            event.preventDefault();
            require(['hdjs'], function (hdjs) {
                hdjs.submit({successUrl:"{!! url('site.lists',['type'=>$_GET['type']]) !!}"});
            })
        }

        require(['hdjs'], function (hdjs) {
            //编辑器
            hdjs.ueditor('container');
            //使用期限
            hdjs.daterangepicker({
                element: '.date-range',
                options: {},
                callback: function (start, end) {
                    var str = start.format('YYYY-MM-DD') + ' 至 ' + end.format('YYYY-MM-DD');
                    $('.dateinput').val(str);
                }
            });
        });

        /**
         * 封面图上传
         * @param obj
         */
        function upImage(obj) {
            require(['hdjs'], function (hdjs) {
                hdjs.image(function (images) {
                    //上传成功的图片，数组类型
                    if (images.length > 0) {
                        $(obj).parent().prev().val(images[0]);
                        $(obj).parent().parent().next().find('img').eq(0).attr('src', images[0]);
                    }
                })
            })
        }

        /**
         * 选择模块
         * @param obj
         */
        function selectModule(obj) {
            //获取已经使用的模块编号
            var useMids = [];
            $(".modules input").each(function (i) {
                useMids.push($(this).attr('mid'));
            })
            require(['resource/js/hdcms.js'], function (hdcms) {
                hdcms.moduleBrowser(function (modules) {
                    $('.modules').html('');
                    if (modules.length > 0) {
                        html = '';
                        $.each(modules, function (i) {
                            html += '<span class="label label-info" style="margin:5px;display:inline-block;">' + modules[i].title + '</span>' +
                                '<input type="hidden" mid="' + modules[i].mid + '" name="module[]" value="' + modules[i].name + '"/>';
                        });
                        $('.modules').html(html);
                    }
                }, useMids.join(','));
            });
        }
    </script>
</block>