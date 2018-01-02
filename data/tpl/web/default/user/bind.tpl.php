<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<ul class="we7-page-tab">
	<li <?php  if($do == 'base') { ?>class="active"<?php  } ?>><a href="<?php  echo url('user/profile')?>">我的账户</a></li>
	<li <?php  if($do == 'bind') { ?>class="active"<?php  } ?>><a href="<?php  echo url('user/profile/bind')?>">账号绑定</a></li>
</ul>

<!--账号绑定-->
<div class="bind-account" ng-controller="userBindCtrl" ng-cloak>
<table class="table we7-table table-hover table-form" >
	<col width="140px " />
	<col />
	<col width="160px" />
	<tr>
		<th class="text-left" colspan="3">账号绑定</th>
	</tr>
	<tr>
		<td class="table-label"><span class="wi wi-iphone color-default" style="font-size: 32px;"></span></td>
		<td>{{bindmobile.third_nickname}}</td>
		<td>
			<div class="link-group">
			<a href="javascript:;"  data-toggle="modal" data-target="#myModal" ng-if="bindmobile.third_type == 3">解绑手机号</a>
			<a href="javascript:;"  data-toggle="modal" data-target="#myModal" ng-if="bindmobile.third_type != 3">绑定手机号</a>
			</div>
		</td>
	</tr>
	<tr>
		<td class="table-label"><span class="wi wi-qq color-default" style="font-size: 32px;"></span></td>
		<td>{{bindqq.third_nickname}}</td>
		<td>
			<div class="link-group">
				<a href="javascript:;" ng-if="bindqq.third_type == 1" ng-click="unbind(bindqq.third_type)">解除绑定</a>
				<a href="{{login_urls.qq}}" ng-if="bindqq.third_type != 1 && thirdlogin.qq.authstate == 1">绑定QQ</a>
			</div>
		</td>
	</tr>
	<tr>
		<td class="table-label"><span class="wi wi-wechat" style="font-size: 32px; color: #00bb00;"></span></td>
		<td>{{bindwechat.third_nickname}}</td>
		<td>
			<div class="link-group">
				<a href="javascript:;" ng-if="bindwechat.third_type == 2" ng-click="unbind(bindwechat.third_type)">解除绑定</a>
				<a href="{{login_urls.wechat}}" ng-if="bindwechat.third_type != 2 && thirdlogin.wechat.authstate == 1">绑定微信</a>
			</div>
		</td>
	</tr>
	<div class="modal fade basic" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">绑定手机号</h4>
				</div>
				<div class="modal-body material-content clearfix">
					<div class="form-group input-group">
						<input type="text" class="form-control" placeholder="输入手机号" ng-model="mobile">
						<span class="input-group-btn">
							<button class="btn btn-primary send-code" ng-disabled="isDisable" ng-click="sendMessage(bindmobile.third_nickname)">{{text}}</button>
						</span>
					</div>
					<div class="form-group input-group">
						<input type="text" ng-model='imagecode' class="form-control" placeholder="输入图形验证码">
						<a href="javascript:;" class="input-group-btn imgverify" style="" ng-click="changeVerify()"><img ng-src="{{image}}" style="width: 127px; height: 32px;"/></a>
					</div>
					<div class="form-group">
						<input type="text" ng-model='smscode' class="form-control" placeholder="输入手机验证码">
					</div>
					<?php  if(empty($bind_mobile)) { ?>
					<div class="form-group">
						<input type="password" ng-model='password' class="form-control" placeholder="输入密码">
					</div>
					<div class="form-group">
						<input type="password" ng-model='repassword' class="form-control" placeholder="再次输入密码">
					</div>
					<?php  } ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" ng-click="mobileBind(bindmobile.third_nickname, 3)">确定</button>
					<button type="button" class="btn smscodebtn-default" data-dismiss="modal">取消</button>
				</div>
			</div>
		</div>
	</div>
	<!--end  账号绑定-->
</table>
</div>
<script>
	angular.module('userProfile').value('config',{
		'bindqq': <?php echo !empty($bind_qq) ? json_encode($bind_qq) : 'null'?>,
		'bindwechat': <?php echo !empty($bind_wechat) ? json_encode($bind_wechat) : 'null'?>,
		'bindmobile': <?php echo !empty($bind_mobile) ? json_encode($bind_mobile) : 'null'?>,
		'login_urls': <?php echo !empty($support_login_urls) ? json_encode($support_login_urls) : 'null'?>,
		'thirdlogin' : <?php echo !empty($_W['setting']['thirdlogin']) ? json_encode($_W['setting']['thirdlogin']) : 'null'?>,
		'image' : "<?php  echo url('utility/code')?>",
		'links':{
			'img_verify_link': "<?php  echo url('utility/code')?>",
			'send_code_link': "<?php  echo url('utility/verifycode')?>",
			'valid_mobile_link' : "<?php  echo url('user/profile/validate_mobile')?>",
			'bind_mobile_link' : "<?php  echo url('user/profile/bind_mobile')?>",
			'unbind_third_link' : "<?php  echo url('user/profile/unbind')?>",
		},
	});
	angular.bootstrap($('.bind-account'), ['userProfile']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>