<extend file="resource/view/site"/>
<block name="content">
	<div class="panel panel-default">
    	  <div class="panel-heading">
    			<h4 class="panel-title">模块配置</h4>
    	  </div>
    	  <div class="panel-body">
              <form action="" method="post" class="form-horizontal" role="form">
                  <div class="form-group">
                      <label class="col-sm-2 control-label">标题</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="title" value="{{$field['title']}}">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-sm-10 col-sm-offset-2">
                          <button type="submit" class="btn btn-primary">保存配置项</button>
                      </div>
                  </div>
              </form>
    	  </div>
    </div>
</block>