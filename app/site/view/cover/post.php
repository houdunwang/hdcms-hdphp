<extend file="resource/view/site"/>
<block name="content">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#">{{$field['name']}}</a></li>
    </ul>
    <form class="form-horizontal" role="form" onsubmit="post(event)">
        <include file="app/site/view/rule/keyword"/>
        <if value="$field['url']">
            <div class="panel panel-default">
                <div class="panel-heading">链接地址</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">URL地址</label>
                        <div class="col-sm-7 col-md-8">
                            <input type="text" class="form-control" readonly="readonly"
                                   value="{!! __ROOT__!!}{!! $field['url'] !!}">
                            <span class="help-block">您可以在微信自定义菜单或其他任何位置直接使用这个链接地址</span>
                        </div>
                    </div>
                </div>
            </div>
        </if>
        <div class="panel panel-default">
            <div class="panel-heading">功能封面 {{$module['title']}}</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">封面参数</label>
                    <div class="col-sm-8">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">标题</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title"
                                               value="{{$field['title']}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">描述</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control" rows="3">{{$field['description']}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">封面</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="thumb"
                                                   readonly="" value="{{$field['thumb']}}">
                                            <div class="input-group-btn">
                                                <button onclick="upImage(this)"
                                                        class="btn btn-default" type="button"
                                                        onclick="upImage(this)">选择图片
                                                </button>
                                            </div>
                                        </div>
                                        <div class="input-group" style="margin-top:5px;">
                                            <img src="{!! pic($field['thumb']) !!}"
                                                 class="img-responsive img-thumbnail"
                                                 width="150">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! $moduleForm !!}
        <button class="btn btn-primary">保存</button>
    </form>
</block>
<script>
    //上传封面图
    function upImage(obj) {
        require(['hdjs'], function (hdjs) {
            hdjs.image(function (images) {
                $("[name='thumb']").val(images[0]);
                $(".img-thumbnail").attr('src', images[0]);
            })
        })
    }

    //提交表单
    function post(event) {
        event.preventDefault();
        require(['hdjs'], function (hdjs) {
            hdjs.submit({
                successUrl: 'refresh',
            });
        })
    }
</script>

