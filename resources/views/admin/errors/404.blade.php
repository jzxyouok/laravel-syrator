@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            异常
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('home', 'admin') }}"><i class="fa fa-home"></i> 主页</a></li>
            <li class="active">异常</li>
          </ol>
@stop

@section('content')
        <div class="callout callout-danger">
          <h4><i class="icon fa fa-ban"></i> 404错误 未找到该页面</h4>
          <p>404错误，未找到该页面，请访问其它页面节点！</p>
        </div>
@stop
