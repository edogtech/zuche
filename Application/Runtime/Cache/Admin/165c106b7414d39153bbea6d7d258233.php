<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>租车系统后台管理</title>

    <!-- Bootstrap Core CSS -->
    <link href="/zuche/Public/sb-admin-2/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	
    <!-- MetisMenu CSS -->
    <link href="/zuche/Public/sb-admin-2/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/zuche/Public/sb-admin-2/dist/css/timeline.css" rel="stylesheet">
	
	 <!-- laydate CSS -->
	<link href="/zuche/Public/laydate/need/laydate.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/zuche/Public/sb-admin-2/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/zuche/Public/sb-admin-2/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/zuche/Public/sb-admin-2/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<!--登录判断-->
	<?php if(!isset($_SESSION['admininfo'])): ?><script>
			window.location.href="<?php echo U('Login/login');?>";
		</script><?php endif; ?>
	<!--登录判断-->
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            ﻿<div class="navbar-header">
	<img src="/zuche/Public/pic/logo.jpg"  class="img-responsive" style='float:left' />
	<a class="navbar-brand" href="<?php echo U('index/index');?>"><b style='font-size:20px'>电狗科技租车后台管理系统</b></a>
</div>
<ul class="nav navbar-top-links navbar-right">
<!-- 	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu dropdown-messages">
			<li>
				<a href="#">
					<div> <strong>John Smith</strong>
						<span class="pull-right text-muted"> <em>Yesterday</em>
						</span>
					</div>
					<div>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...
					</div>
				</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="#">
					<div> <strong>John Smith</strong>
						<span class="pull-right text-muted"> <em>Yesterday</em>
						</span>
					</div>
					<div>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...
					</div>
				</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="#">
					<div>
						<strong>John Smith</strong>
						<span class="pull-right text-muted">
							<em>Yesterday</em>
						</span>
					</div>
					<div>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...
					</div>
				</a>
			</li>
			<li class="divider"></li>
			<li>
				<a class="text-center" href="#">
					<strong>Read All Messages</strong>
					<i class="fa fa-angle-right"></i>
				</a>
			</li>
		</ul>
		
	</li> -->
	<!-- /.dropdown -->
<!-- 	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="fa fa-tasks fa-fw"></i>
			<i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu dropdown-tasks">
			<li>
				<a href="#">
					<div>
						<p>
							<strong>Task 1</strong>
							<span class="pull-right text-muted">40% Complete</span>
						</p>
						<div class="progress progress-striped active">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
								<span class="sr-only">40% Complete (success)</span>
							</div>
						</div>
					</div>
				</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="#">
					<div>
						<p>
							<strong>Task 2</strong>
							<span class="pull-right text-muted">20% Complete</span>
						</p>
						<div class="progress progress-striped active">
							<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
								<span class="sr-only">20% Complete</span>
							</div>
						</div>
					</div>
				</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="#">
					<div>
						<p>
							<strong>Task 3</strong>
							<span class="pull-right text-muted">60% Complete</span>
						</p>
						<div class="progress progress-striped active">
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
								<span class="sr-only">60% Complete (warning)</span>
							</div>
						</div>
					</div>
				</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="#">
					<div>
						<p>
							<strong>Task 4</strong>
							<span class="pull-right text-muted">80% Complete</span>
						</p>
						<div class="progress progress-striped active">
							<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
								<span class="sr-only">80% Complete (danger)</span>
							</div>
						</div>
					</div>
				</a>
			</li>
			<li class="divider"></li>
			<li>
				<a class="text-center" href="#">
					<strong>See All Tasks</strong>
					<i class="fa fa-angle-right"></i>
				</a>
			</li>
		</ul>
		
	</li> -->
	<!-- /.dropdown -->
<!-- 	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="fa fa-bell fa-fw"></i>
			<i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu dropdown-alerts">
			<li>
				<a href="#">
					<div>
						<i class="fa fa-comment fa-fw"></i>
						New Comment
						<span class="pull-right text-muted small">4 minutes ago</span>
					</div>
				</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="#">
					<div>
						<i class="fa fa-twitter fa-fw"></i>
						3 New Followers
						<span class="pull-right text-muted small">12 minutes ago</span>
					</div>
				</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="#">
					<div>
						<i class="fa fa-envelope fa-fw"></i>
						Message Sent
						<span class="pull-right text-muted small">4 minutes ago</span>
					</div>
				</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="#">
					<div>
						<i class="fa fa-tasks fa-fw"></i>
						New Task
						<span class="pull-right text-muted small">4 minutes ago</span>
					</div>
				</a>
			</li>
			<li class="divider"></li>
			<li>
				<a href="#">
					<div>
						<i class="fa fa-upload fa-fw"></i>
						Server Rebooted
						<span class="pull-right text-muted small">4 minutes ago</span>
					</div>
				</a>
			</li>
			<li class="divider"></li>
			<li>
				<a class="text-center" href="#">
					<strong>See All Alerts</strong>
					<i class="fa fa-angle-right"></i>
				</a>
			</li>
		</ul>
		
	</li> -->
	<!-- /.dropdown -->
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			<i class="fa fa-user fa-fw"></i>
			<i class="fa fa-caret-down"></i>
		</a>
		<ul class="dropdown-menu dropdown-user">
			<!-- <li>
				<a href="#">
					<i class="fa fa-user fa-fw"></i>
					User Profile
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-gear fa-fw"></i>
					Settings
				</a>
			</li> -->
			
			<li>
				<a href="<?php echo U('Login/logout');?>">
					<i class="fa fa-sign-out fa-fw"></i>
					Logout
				</a>
			</li>
		</ul>
		<!-- /.dropdown-user -->
	</li>
	<!-- /.dropdown -->
</ul>
            ﻿<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
          
            <li>
                <a href="<?php echo U('Index/index');?>">
                    <i class="fa fa-home fa-fw"></i>
                    主页
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-group fa-fw"></i>
                    租车用户管理
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('User/userlist');?>">用户列表</a>
                    </li>
		    <li>
                        <a href="<?php echo U('User/deposit_list');?>">保证金状态</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-car fa-fw"></i>
                    车辆与站点
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('Car/station');?>">站点管理</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Car/brand');?>">车辆品牌管理</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Car/model');?>">车辆型号管理</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Car/car');?>">车辆管理</a>
                    </li>
                </ul>
            </li>
			<li>
				<a href="#"> 
					<i class="fa fa-tasks fa-fw"></i>
                    订单信息
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('Orders/index');?>">订单列表</a>
                    </li>
                    <!--<li>
                        <a href="<?php echo U('Refund/index');?>">退款审核</a>
                    </li>-->
                </ul>
			</li>
			<li>
				<a href="#"> 
					<i class="fa fa-th-list fa-fw"></i>
                    APP轮播图
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('Carousel/index');?>">轮播图维护</a>
                    </li>
                </ul>
			</li>
			<li>
				<a href="#"> 
					<i class="glyphicon glyphicon-wrench fa-fw"></i>
                    租车管理
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('RentInfo/index');?>">租车信息列表</a>
                    </li>
                    <li>
                        <a href="<?php echo U('RentOvertime/index');?>">超时用车记录</a>
                    </li>
                    <li>
                        <a href="<?php echo U('RentLong/index');?>">长租信息管理</a>
                    </li>
                    <li>
                        <a href="<?php echo U('CarPhoto/photolist');?>">车辆拍照记录</a>
                    </li>                     
                </ul>
			</li>
			<li>
				<a href="#"> 
					<i class="fa  fa-user fa-fw"></i>
                    账号管理
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                	<li>
                        <a href="<?php echo U('AdminUser/modifyPwdForm');?>">修改密码</a>
                    </li>
                </ul>
			</li>			
			
			<li>
				<a href="#"> 
					<i class="fa fa-desktop fa-fw"></i>
                    系统维护
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                	<li>
                        <a href="<?php echo U('AdminUser/index');?>">系统用户</a>
                    </li>
                    <!--<li>
                        <a href="#">权限管理</a>
                    </li> -->
                    <li>
                        <a href="<?php echo U('Parameter/index');?>">参数设置</a>
                    </li>
                    <li>
                        <a href="<?php echo U('AdminUser/save');?>">数据备份</a>
                    </li>                     
                </ul>
			</li>
			<li>
                <a href="#">
                    <i class="fa fa-plus-circle fa-fw"></i>
                    业务办理
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('Business/index');?>">长租办理</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Business/return_car');?>">长租还车</a>
                    </li>                     
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicon glyphicon-cog fa-fw"></i>
                    权限管理
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('Auth/admin_list');?>">管理员列表</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Auth/auth_list');?>">权限列表</a>
                    </li>
                    <li>
                        <a href="<?php echo U('Auth/group_list');?>">权限组列表</a>
                    </li>             
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
        </nav>

        <div id="page-wrapper" >
           
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        长租业务办理
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
	<div class="row">
		<form action="<?php echo U('Business/long_rent');?>" method="post">
			<div class="col-md-12">
				<div class="alert alert-info">
					办理者用户名:<?php echo ($userinfo['name']); ?>
	            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                办理者手机号码:<?php echo ($userinfo['phone']); ?>
	                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span style='color:red'>请仔细核对用户信息!</span>

				</div>
			</div>

			<div class="col-md-12">
				<div class="panel panel-primary">
					<div class="panel-heading">站点选择</div>
					<div class="panel-body">
						<div class="col-md-3">
							<div class="form-group">
								<label>省</label>
								<select class="form-control" name="province" id="prov">
									<option value="">--请选择--</option>
									<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['province']); ?>"><?php echo ($vo['province']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

								</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>市</label>
								<select class="form-control" name="city" id="cit">
									<option value="">--请选择--</option>
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>区/县</label>
								<select class="form-control" name="county" id='coun'>
									<option value="">--请选择--</option>
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>站点</label>
								<select class="form-control" name="station" id='station'>
									<option value="">--请选择--</option>
								</select>
							</div>
						</div>

					</div>
					<div class="panel-footer">
						请选择完整站点信息后再选择站点中的车辆
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="panel panel-green">
                    <div class="panel-heading">
                        车辆选择
                    </div>
                    <div class="panel-body">
                        <div class="col-md-4">
							<div class="form-group">
								<label>车辆信息</label>
								<select class="form-control" name="car_id" id='car_id'>
									<option value="">--请选择--</option>
								</select>
							</div>
						</div>

						<div class="col-md-8">
							<label>出租信息</label>
							<div class="col-md-12" id="car_rent">
							</div>
						</div>
                    </div>
                    <div class="panel-footer">
                        选择本站点的车辆
                    </div>
                </div>
			</div>

			<div class="col-md-12">
				<div class="panel panel-yellow">
                    <div class="panel-heading">
                        时间选择
                    </div>
                    <div class="panel-body">
                        <div class="col-md-10">
							租车时间：<input style="display:inline;width:35%;height:34px;" placeholder="请选择日期" class="laydate-icon form-control" name="start_time"  onclick="laydate()"> 至 <input placeholder="请选择日期" class="laydate-icon form-control" name="end_time"  onclick="laydate()" style="display:inline;width:35%;height:34px;">
						</div>
                    </div>
                    <div class="panel-footer">
                        选择出租的时间
                    </div>
                </div>

			</div>
			<div class="col-md-12">
				<div class="panel panel-red">
                    <div class="panel-heading">
                        长租价格价格
                    </div>
                    <div class="panel-body">
                        <div class="col-md-3">
                        	<div class="form-group">
                                <input class="form-control" name='price' type="text" >
                                <p class="help-block">单位:元</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                        	<div class="form-group">
                                <button id='reckon_price' type="button" class="btn btn-primary btn-block" style="width:50%">计算价格</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                       日期更改后请重新点击获取新价格
                    </div>
                </div>

			</div>

			<div class="col-md-6">
				<input type="hidden" name="user_id" value="<?php echo ($_GET['uid']); ?>">
				<input type="hidden" name="plate" value="" id="plate">
                <p class="help-block" style="color:orange;">请务必选择和输入完整信息，否则无法添加</p>
				<button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
				<button type="reset" class="btn btn-outline btn-primary btn-lg btn-block">重置</button>
			</div>

		</form>
	</div>

        </div>
    </div>

     <!-- jQuery -->
    <script src="/zuche/Public/sb-admin-2/bower_components/jquery/dist/jquery.min.js"></script>
	
    <!-- Bootstrap Core JavaScript -->
    <script src="/zuche/Public/sb-admin-2/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/zuche/Public/sb-admin-2/bower_components/metisMenu/dist/metisMenu.min.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="/zuche/Public/sb-admin-2/dist/js/sb-admin-2.js"></script>

    <!-- 自定义JS -->
    <script src="/zuche/Public/js/zuche.js"></script>
	
    <script src="/zuche/Public/js/uploadPreview.js"></script>
	
	<script src="/zuche/Public/laydate/laydate.js"></script>

    <!-- Flot Charts JavaScript -->
    <script src="/zuche/Public/sb-admin-2/bower_components/flot/excanvas.min.js"></script>
    <script src="/zuche/Public/sb-admin-2/bower_components/flot/jquery.flot.js"></script>
    <script src="/zuche/Public/sb-admin-2/bower_components/flot/jquery.flot.pie.js"></script>
    <script src="/zuche/Public/sb-admin-2/bower_components/flot/jquery.flot.resize.js"></script>
    <script src="/zuche/Public/sb-admin-2/bower_components/flot/jquery.flot.time.js"></script>
    <script src="/zuche/Public/sb-admin-2/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="/zuche/Public/sb-admin-2/js/flot-data.js"></script>
</body>

</html>