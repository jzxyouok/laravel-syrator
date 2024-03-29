@extends('mobile._layout._layer_nonav')

@section('html_attr') class="ui-page-login" @stop

@section('head_style')
@parent
<style>
.mui-input-group:first-child {
	margin-top: 20px;
}
.mui-input-group label {
	width: 30%;
}
.mui-input-row label~input,
.mui-input-row label~select,
.mui-input-row label~textarea {
	width: 70%;
	margin-top: 1px;
	-webkit-box-shadow: 0 0 0 1000px rgba(255, 255, 255, 1) inset !important;	
}
.mui-checkbox input[type=checkbox],
.mui-radio input[type=radio] {
	top: 6px;
}
.mui-content-padded {
	margin-top: 25px;
}
.mui-btn {
	padding: 10px;
}
</style>
@stop

@section('content')
<header class="mui-bar mui-bar-nav" style="background: #60D4AB;color:#ffffff;">
	<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
	<h1 class="mui-title" style="color:#ffffff;">注册</h1>
</header>
<div class="mui-content">
	<form class="mui-input-group">
		<div class="mui-input-row">
			<label>手&nbsp;&nbsp;机</label>
			<input id='phone' type="tel" class="mui-input-clear mui-input" placeholder="请输入手机号">
		</div>
		<div class="mui-input-row">
			<label>密&nbsp;&nbsp;码</label>
			<input id='password' type="password" class="mui-input-clear mui-input" placeholder="请输入密码">
		</div>
		<div class="mui-input-row">
			<label>确&nbsp;&nbsp;认</label>
			<input id='password_confirm' type="password" class="mui-input-clear mui-input" placeholder="请确认密码">
		</div>
		<div class="mui-input-row">
			<label>验证码</label>
			<input id='vcode' type="text" class="mui-input-clear mui-input" placeholder="请输入验证码" style="float:left; width: 45%;">
			<button type="button" class="mui-btn-danger" style="margin-top:4px; height: 30px;width: 23%;" onClick="doVerifyCode();">获取验证码</button>
			<span class="mui-icon mui-icon-clear mui-hidden" style="right: 25%"></span>
		</div>
	</form>
	<div class="mui-content-padded">
		<button id='reg' class="mui-btn mui-btn-block mui-btn-primary" style="background: #60D4AB; border: none;" onClick="doRegister();">注册</button>
	</div>
	<div class="mui-content-padded">
		<p>请使用您的手机注册成为会员，享受更多专享服务！</p>
	</div>
</div>
@stop

@section('afterBody') 
@parent
<script>
function doVerifyCode() {
	var phoneBox = document.getElementById('phone');
	if (!validateMobile(phoneBox.value)) {
		mui.alert("请输入正确的手机号");
		return;
	}

	$.ajax({
		type:'post',
		url:'/api/member/sendverifycode',
		data: {
			_token:$('meta[name="_token"]').attr('content'),
			phone:phoneBox.value,
			type:'register'
    	}, 
		dataType:'json',
		async:true,
		success:function(data) {
			var code = data['code'];
			if(code === "200") {
				mui.alert("验证码短信发送成功");
				return;
			} 

			if(code === "500") {
				mui.alert("系统错误");
				return;
			} else {
				mui.alert(data['description']);
				return;
			}
		}
	});
}

function doRegister() {
	var phoneBox = document.getElementById('phone');
	var passwordBox = document.getElementById('password');
	var passwordConfirmBox = document.getElementById('password_confirm');
	var vcodeBox = document.getElementById('vcode');
	if (!validateMobile(phoneBox.value)) {
		mui.alert("请输入正确的手机号");
		return;
	}

	if (isEmpty(passwordBox.value)) {
		mui.alert("密码不能为空");
		return;
	}
	
	if (passwordBox.value!==passwordConfirmBox.value) {
		mui.alert("两次输入的密码不相同");
		return;
	}

	if (isEmpty(vcodeBox.value)) {
		mui.alert("验证码不能为空");
		return;
	}

	$.ajax({
		type:'post',
		url:'/api/member/register',
		data: {
			_token:$('meta[name="_token"]').attr('content'),
			phone:phoneBox.value,
			password:passwordBox.value,
			vcode:vcodeBox.value
    	}, 
		dataType:'json',
		async:true,
		success:function(data) {
			var code = data['code'];
			if(code === "200") {
				var btnArray = ['确定'];
				mui.confirm('恭喜您注册成功', '蚂蚁帮帮', btnArray, function(e) {
					if (e.index == 0) {
						mui.openWindow({
			    			url: "{{ site_url('index', 'mobile') }}",
			    			id: "index",
			    		});
					} 
				});
	    		
				return;
			} 

			if(code === "500") {
				mui.alert("系统错误");
				return;
			} else {
				mui.alert(data['description']);
				return;
			}
		}
	});
}
</script>
@stop