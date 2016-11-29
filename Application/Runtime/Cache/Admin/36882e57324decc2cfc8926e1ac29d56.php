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
                        价格参数列表
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
	<div class="row">
		<form method="post" action="<?php echo U('Parameter/index');?>">
			<div class="col-md-3">
				<div class="form-group">
					参数名称:
					<input style="width:70%;display:inline;" class="form-control" type="text" name="caption" id="caption" value="<?php echo isset($_GET['caption'])?$_GET['caption']:'';;?>"></div>
			</div>
			<div class="col-md-3 col-md-offset-6" >
				<div class="form-group">
					<button type="submit" class="btn btn-primary" style="margin-right:30px;"> <i class="fa fa-search"></i>
						查询
					</button>
					<button type="reset" class="btn btn-primary"> <i class="fa fa-repeat"></i>
						重置
					</button>

				</div>
			</div>
		</form>
	</div>
	<div class="row">
		<!-- /.panel-heading -->
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">参数列表</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>编号</th>
									<th>参数</th>
									<th>名称</th>
									<th>参数值</th>
									<th>参数单位</th>
									<th>描述</th>
									<th>修改时间</th>
									<th class="text-center">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
										<td><?php echo ($vo['id']); ?></td>
										<td><?php echo ($vo['var_name']); ?></td>
										<td><?php echo ($vo['caption']); ?></td>
										<td><?php echo ($vo['var_value']); ?></td>
										<td><?php echo ($vo['unit']); ?></td>
										<td><?php echo ($vo['description']); ?></td>
										<td><?php echo date('Y-m-d H:i:s',$vo['add_time']);?></td>
										<td align="center">
											<a href="#" data-toggle="modal" data-target="#ParameterEditModal" 
								data-id="<?php echo ($vo['id']); ?>"
								data-variable="<?php echo ($vo['var_name']); ?>"
								data-value="<?php echo ($vo['var_value']); ?>" 
								data-desc="<?php echo ($vo['description']); ?>"
								data-unit="<?php echo ($vo['unit']); ?>"
								data-name="<?php echo ($vo['caption']); ?>">修改</a>
										</td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							</tbody>
						</table>
						<?php if(empty($lists)): ?><div style="text-align:center;">抱歉，暂时没有您要找的内容</div><?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 分页内容 -->
	<div class="col-md-12"><?php echo ($show); ?></div>
	</div>
	<!-- 模态框（Modal） 编辑系统参数-->
	<div class="modal fade" id="ParameterEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<form method="post" action="<?php echo U('Parameter/edit');?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="txtCaption"></h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>参数：</label>
							<label id="lbVar"></label>
						</div>
						<div class="form-group">
							<label>名称：</label>
							<label id="lbName"></label>
						</div>						
						<div class="form-group">
							<label>数值：</label>
							<input type="text" size="10" id="txtValue" name="txtValue">
							<label id="lbUnit"></label>
						</div>
                        <div class="form-group" >
                            <label>简介：</label>
                            <textarea  rows="3" cols="45" style="vertical-align:top;resize: none;" name="txtDesc" id="txtDesc"></textarea>
                        </div>
						                       						
						<div class="modal-footer">
							<input  type="hidden" name="id" id="id">
							<input  type="hidden" name="vars" id="vars">
							
							<button type="submit" class="btn btn-primary">确定</button>
							<button type="button" class="btn btn-default" data-dismiss="modal" >取消</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
			</form>
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