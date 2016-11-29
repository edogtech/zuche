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
                        订单列表
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
	<div class="row">
		<form method="get" action="<?php echo U('Orders/index');?>">
		<div class="col-md-3">
			<div class="form-group">
				订单号:
				<input class="form-control" style="display:inline;width:70%;" type="text" name="order_number" id="orderno" value="<?php echo isset($_GET['order_number'])?$_GET['order_number']:'';;?>"></div>
		</div>
		<div class="col-md-6">
			下单时间：<input style="display:inline;width:35%;height:34px;" placeholder="请选择日期" class="laydate-icon form-control" name="dtpickerA" value="<?php echo isset($_GET['dtpickerA'])?$_GET['dtpickerA']:'';;?>" onclick="laydate()"> 至 <input placeholder="请选择日期" class="laydate-icon form-control" name="dtpickerB" value="<?php echo isset($_GET['dtpickerB'])?$_GET['dtpickerB']:'';;?>" onclick="laydate()" style="display:inline;width:35%;height:34px;">
		</div> 
		<div  class="col-md-3">
			支付状态:
			<select style="display:inline;width:70%;" class="form-control" name="paytype" id="paytype">
				<option value="" <?php echo empty($_GET['paytype'])?"selected":'';;?> >全部</option>
				<option value="0" <?php echo $_GET['paytype']=='0'?"selected":'';;?> >未支付</option>
				<option value="1" <?php echo $_GET['paytype']=='1'?"selected":'';;?> >已付定金</option>
				<option value="2" <?php echo $_GET['paytype']=='2'?"selected":'';;?> >待结算</option>
				<option value="3" <?php echo $_GET['paytype']=='2'?"selected":'';;?> >已结算</option>
				<option value="4" <?php echo $_GET['paytype']=='2'?"selected":'';;?> >待退款</option>
				<option value="5" <?php echo $_GET['paytype']=='2'?"selected":'';;?> >已退款</option>
			</select>
		</div>

		<div class="col-md-3 col-md-offset-9" style="float:right;">
			<div class="form-group">
				<button type="submit" class="btn btn-primary" style="margin-right:30px;"> <i class="fa fa-search"></i>
					查询
				</button>
				<!-- <button type="button" class="btn btn-primary btn-sm" id="order_exp"> <i class="glyphicon glyphicon-export"></i>
					导出
				</button> -->
				<button type="reset" class="btn btn-primary"> <i class="fa fa-repeat"> </i> 重置</button>
			</div>
		</div>
		</form>
	</div>
	<div class="row">	
		<!-- /.panel-heading -->
		<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">订单列表</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>编号</th>
							<th>订单号</th>
							<th>用户</th>
							<th>车牌号</th>
							<th>站点</th>									
							<th>租车单价</th>									
							<th>金额</th>
							<th>支付状态</th>
							<th>长租</th>
							<th>下单时间</th>									
							<th>明细</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
							<td><?php echo ($vo['id']); ?></td>
							<td><?php echo ($vo['order_number']); ?></td>
							<td><?php echo ($vo["user_name"]); ?></td>
							<td><?php echo ($vo['plate']); ?></td>
							<td><?php echo ($vo['station']); ?></td>
							<td><?php echo ($vo['price']); ?></td>									
							<td><?php echo ($vo['payment']); ?></td>
							<td><?php echo ($vo['types']); ?></td>
							<td><?php echo ($vo['long']); ?></td>
							<td><?php echo (date('Y-m-d H:i:s',$vo['add_time'])); ?></td>								
							<td align="center">
								<!-- <a href="#" data-toggle="modal"  data-target="#myModal" 
								 data-id="<?php echo ($vo['id']); ?>" data-number="<?php echo ($vo['order_number']); ?>" data-uname="<?php echo ($vo['user_name']); ?>"  
								data-plate="<?php echo ($vo['plate']); ?>"  data-station="<?php echo ($vo['station']); ?>" 
								 data-price="<?php echo ($vo['price']); ?>"  data-payment="<?php echo ($vo['payment']); ?>" 
								  data-types="<?php echo ($vo['types']); ?>"  data-ordertime="<?php echo ($vo['add_time']); ?>">
								查看</a> -->
								<a href="#" data-toggle="modal"  data-target="#myModal" 
								data-id="<?php echo ($vo['id']); ?>"
								data-number="<?php echo ($vo['order_number']); ?>"	
								data-uname="<?php echo ($vo['user_name']); ?>"
								data-start_time="<?php echo (date('Y-m-d H:i:s',$vo['start_time'])); ?>"
								data-end_time="<?php echo (date('Y-m-d H:i:s',$vo['end_time'])); ?>"
								data-borrow_time="<?php echo ($vo['borrow_time']); ?>"
								data-deposit="<?php echo ($vo['deposit']); ?>"
								data-return_time="<?php echo ($vo['return_time']); ?>"						
								data-fixed_use_time="<?php echo ($vo['fixed_use_time']); ?>"
								data-actual_use_time="<?php echo ($vo['actual_use_time']); ?>"
								data-excess_use_time="<?php echo floor($vo['excess_use_time']/3600);?>"  
								data-price="<?php echo ($vo['price']); ?>"
								data-excess="<?php echo ($vo['excess']); ?>" 
								data-excess_fee="<?php echo ($vo['excess_fee']); ?>"								
								data-actual_total_fee="<?php echo ($vo['actual_total_fee']); ?>"
								data-payment="<?php echo ($vo['payment']); ?>">
								查看</a>
							</td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
				<?php if(empty($lists)): ?><div style="text-align:center;">抱歉，暂时没有您要找的内容</div><?php endif; ?>
			</div>
		</div>
	</div>
	</div>
	<!-- 分页内容 -->
	<div class="col-md-12"><?php echo ($show); ?></div>
	</div>

<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">订单详情</h4>
			</div>
			<div class="modal-body">
			<!-- 在这里添加内容 -->
<!-- 				<div style="align:center;">
				<p class="text-left"><strong>用户名：</strong><small id="uname"></small></p>
				<p class="text-left"><strong>预约取车时间：</strong><small id="start_time"></small></p>
				<p class="text-left"><strong>预约还车时间：</strong><small id="end_time"></small></p>
				<p class="text-left"><strong>预付定金：</strong><small id="deposit"></small>元</p>
				<p class="text-left"><strong>实际还车时间：</strong><small id="return_time"></small></p>
				<p class="text-left"><strong>预约用车时长：</strong><small id="fixed_use_time"></small>小时</p>
				<p class="text-left"><strong>实际用车时长：</strong><small id="actual_use_time"></small>小时</p>
				<p class="text-left"><strong>超额用车时长：</strong><small id="excess_use_time"></small>小时</p>
				<p class="text-left"><strong>额定总价：</strong><small id="fixed_total_fee"></small>元</p>
				<p class="text-left"><strong>超时单价：</strong><small id="excess"></small>元</p>
				<p class="text-left"><strong>超时费用：</strong><small id="excess_fee"></small>元</p>
				<p class="text-left"><strong>应付金额：</strong><small id="actual_total_fee"></small>元</p>
				<p class="text-warning"><strong>实付金额：</strong><small id="payment"></small>元</p>
				</div> -->
			<ul class="">
				<li><p class="text-left"><strong>用户名：</strong><small id="uname"></small></p></li>
				<li><p class="text-left"><strong>预约取车时间：</strong><small id="start_time"></small></p></li>
				<li><p class="text-left"><strong>预约还车时间：</strong><small id="end_time"></small></p></li>
				<li><p class="text-left"><strong>实际取车时间：</strong><small id="borrow_time"></small></p></li>
				<li><p class="text-left"><strong>实际还车时间：</strong><small id="return_time"></small></p></li>							
				<li><p class="text-left"><strong>预约用车计时：</strong><small id="fixed_use_time"></small></p></li>
				<li><p class="text-left"><strong>实际用车计时：</strong><small id="actual_use_time"></small></p></li>
				<li><p class="text-left"><strong>应付金额：</strong><small id="actual_total_fee"></small>元</p></li>
				<li><p class="text-left"><strong>预付定金：</strong><small id="deposit"></small>元</p></li>
				<li><p class="text-warning"><strong>实付金额：</strong><small id="payment"></small>元</p></li>
			</ul>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
</div>
	<!-- /.modal -->

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