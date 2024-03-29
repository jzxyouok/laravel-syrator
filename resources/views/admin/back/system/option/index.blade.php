@extends('_layout._common')

@section('head_css')
@parent
<link rel="stylesheet" type="text/css" href="{{ _asset('assets/metronic/css/bootstrap-fileupload.css') }}" />
@stop

@section('body_attr') class="page-header-fixed" @stop

@section('content-header')
@parent
@include('admin._widgets._main-header')
@stop

@section('content-footer')
@parent
@include('admin._widgets._main-footer')
@stop

@section('content')
<div class="page-container row-fluid">
	@include('admin._widgets._main-sidebar')
	<div class="page-content">
		<div id="portlet-config" class="modal hide">
			<div class="modal-header">
				<button data-dismiss="modal" class="close" type="button"></button>
				<h3>Widget Settings</h3>
			</div>
			<div class="modal-body">
				Widget settings form goes here
			</div>
		</div>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<h3 class="page-title">参数配置  <small> 系统相关参数的配置</small></h3>
					<ul class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="{{ site_url('home', 'admin') }}">首页</a> 
							<i class="icon-angle-right"></i>
						</li>
						<li><a href="#">参数配置</a></li>
						<li class="pull-right no-text-shadow">
							<div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">
								<i class="icon-calendar"></i>
								<span></span>
								<i class="icon-angle-down"></i>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
    				@if(session()->has('fail'))
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <h4>  <i class="icon icon fa fa-warning"></i> 提示！</h4>
                        {{ session('fail') }}
                    </div>
                    @endif
                    
                    @if(session()->has('message'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
                        {{ session('message') }}
                    </div>
                    @endif  
					<div class="portlet box blue tabbable">
						<div class="portlet-title">
							<div class="caption">
								<span class="hidden-480">参数配置</span>
							</div>
						</div>
						<div class="portlet-body form">
							<div class="tabbable portlet-tabs">
								<ul class="nav nav-tabs">
									<li><a href="#portlet_tab2" data-toggle="tab">系统参数</a></li>
									<li class="active"><a href="#portlet_tab1" data-toggle="tab">网站参数</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="portlet_tab1">
										<form method="post" action="{{ _route('admin:system.option') }}" class="form-horizontal" accept-charset="utf-8" id="formTab1">
											{!! method_field('put') !!} 
                                            {!! csrf_field() !!}
											<div class="control-group">
												<label class="control-label">网站标题</label>
												<div class="controls">
													<input type="text" class="m-wrap large" name="data[website_title]" autocomplete="off" value="{{ $data['website_title'] }}" placeholder="网站标题">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">网站关键词</label>
												<div class="controls">
													<input type="text" class="m-wrap large"" name="data[website_keywords]" autocomplete="off" value="{{ $data['website_keywords'] }}" placeholder="网站关键词，多个词请以英文逗号分隔">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">公司全称</label>
												<div class="controls">
													<input type="text" class="m-wrap large" name="data[company_full_name]" autocomplete="off" value="{{ $data['company_full_name'] }}" placeholder="公司全称">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">公司简称</label>
												<div class="controls">
													<input type="text" class="m-wrap large" name="data[company_short_name]" autocomplete="off" value="{{ $data['company_short_name'] }}" placeholder="公司简称">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">公司电话</label>
												<div class="controls">   
													<input type="text" class="m-wrap large" name="data[company_telephone]" autocomplete="off" value="{{ $data['company_telephone'] }}" placeholder="公司电话">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">网站备案号</label>
												<div class="controls">   
													<input type="text" class="m-wrap large" name="data[website_icp]" autocomplete="off" value="{{ $data['website_icp'] }}" placeholder="网站备案号">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">后台分页大小</label>
												<div class="controls">
													<select class="small m-wrap" tabindex="1" data-placeholder="后台分页大小" name="data[page_size]">		
                                                        <option value="10" {{ ($data['page_size'] === "10") ? 'selected':'' }}>10</option>
                                                        <option value="15" {{ ($data['page_size'] === "15") ? 'selected':'' }}>15</option>
                                                        <option value="20" {{ ($data['page_size'] === "50") ? 'selected':'' }}>20</option>
                                                        <option value="25" {{ ($data['page_size'] === "25") ? 'selected':'' }}>25</option>
													</select>
												</div>
											</div>
        									<div class="control-group">
        										<label class="control-label">图片水印 </label>
        										<div class="controls">
        											<div class="fileupload fileupload-new" data-provides="fileupload">
        												<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
        													<img src="{{ $data['picture_watermark'] }}" alt="" />
        												</div>
        												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
        												<div>
        													<span class="btn btn-file"><span class="fileupload-new">选择图片</span>
        													<span class="fileupload-exists">修改</span>
        													<input type="file" class="default" name="file_picture_watermark" id="file_picture_watermark" accept=".jpg,.png,.gif,.bmp" /></span>
        													<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">移除</a>
        													<a id="uploadSubmit_picture_watermark" class="btn fileupload-exists">上传</a>
        												</div>
        												<input type="hidden" id="picture_watermark" name="data[picture_watermark]" value="{{ $data['picture_watermark'] }}">
        											</div>                                                	
        										</div>
        									</div>
											<div class="control-group">
												<label class="control-label">上传图片是否添加水印</label>
												<div class="controls">
													<label class="radio"><input type="radio" name="data[is_watermark]" value="0" {{($data['is_watermark'] === '0')?'checked':''}}/>否</label>
													<label class="radio"><input type="radio" name="data[is_watermark]" value="1" {{($data['is_watermark'] === '1')?'checked':''}}/>是</label>   
												</div>
											</div>
											<div class="form-actions">
												<button type="submit" class="btn blue" id="updateOptions1"><i class="icon-ok"></i> 更新配置</button>
											</div>
										</form>										
									</div>
									<div class="tab-pane " id="portlet_tab2">
										<form method="post" action="{{ _route('admin:system.option') }}" class="form-horizontal" accept-charset="utf-8" id="formTab2">
        									{!! method_field('put') !!} 
                                            {!! csrf_field() !!}
        									<div class="control-group">
        										<label class="control-label">系统Logo</label>
        										<div class="controls">
        											<div class="fileupload fileupload-new" data-provides="fileupload">
        												<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
        													<img src="{{ $data['system_logo'] }}" alt="" />
        												</div>
        												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
        												<div>
        													<span class="btn btn-file"><span class="fileupload-new">选择图片</span>
        													<span class="fileupload-exists">修改</span>
        													<input type="file" class="default" name="file_system_logo" id="file_system_logo" accept=".jpg,.png,.gif,.bmp" /></span>
        													<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">移除</a>
        													<a id="uploadSubmit_system_logo" class="btn fileupload-exists">上传</a>
        												</div>
        												<input type="hidden" id="system_logo" name="data[system_logo]" value="{{ $data['system_logo'] }}">
        											</div>
        										</div>
        									</div>
											<div class="control-group">
												<label class="control-label">系统版本号</label>
												<div class="controls">
													<input type="text" class="m-wrap large" name="data[system_version]" autocomplete="off" value="{{ $data['system_version'] }}" placeholder="系统版本号">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">系统开发者</label>
												<div class="controls">
													<input type="text" class="m-wrap large" name="data[system_author]" autocomplete="off" value="{{ $data['system_author'] }}" placeholder="系统开发者">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">系统开发者网站</label>
												<div class="controls">
													<input type="text" class="m-wrap large" name="data[system_author_website]" autocomplete="off" value="{{ $data['system_author_website'] }}" placeholder="系统开发者网站">
												</div>
											</div>
											<div class="form-actions">
												<button type="submit" class="btn blue" id="updateOptions2"><i class="icon-ok"></i> 更新配置</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('extraPlugin')
@parent
<script type="text/javascript" src="{{ _asset('assets/metronic/js/bootstrap-fileupload.js') }}"></script>
<script type="text/javascript" src="{{ _asset('assets/metronic/js/form-components.js') }}"></script>
@stop

@section('filledScript')
<script>
jQuery(document).ready(function() {    
    App.init();
    FormComponents.init();

    //ajax
    $('#uploadSubmit_picture_watermark').click(function(){
        var resultFile = $("#file_picture_watermark").get(0).files[0];    	  	
    	var formData = new FormData();
    	formData.append("_token",$('meta[name="_token"]').attr('content'));
    	formData.append("picture",resultFile,resultFile.name);
    	var options = {
            type: 'post', 
            url: "{{ _route('admin:upload.picture.store') }}", 
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formData,
            timeout: 3000,
            success: function (data) {
                alert('上传成功');
                $("#picture_watermark")[0].value = data.info;
            },
            error: function(){
                alert('上传失败');
            }
        };
        $.ajax(options);
    });

    //ajax
    $('#uploadSubmit_system_logo').click(function(){
        var resultFile = $("#file_system_logo").get(0).files[0];    	  	
    	var formData = new FormData();
    	formData.append("_token",$('meta[name="_token"]').attr('content'));
    	formData.append("picture",resultFile,resultFile.name);
    	var options = {
            type: 'post', 
            url: "{{ _route('admin:upload.picture.store') }}", 
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formData,
            timeout: 3000,
            success: function (data) {
                alert('上传成功');
                $("#system_logo")[0].value = data.info;
            },
            error: function(){
                alert('上传失败');
            }
        };
        $.ajax(options);
    });
});
</script>
@stop
