<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>电动汽车租赁信息管理系统</title>

    <!-- Bootstrap Core CSS -->
    <link href="/zuche/Public/sb-admin-2/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/zuche/Public/sb-admin-2/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/zuche/Public/sb-admin-2/dist/css/sb-admin-2.css" rel="stylesheet">

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
	<img src='/zuche/Public/pic/bg1.jpg' class="img-responsive"  style='height:100%;width:100%;opacity:0.5;position:absolute;' />
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default" >
                    <div class="panel-heading">
                        <h4 style='font-size:22px;'><img src="/zuche/Public/pic/logo.jpg"  />电狗科技电动汽车租赁系统</h4>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo U('Login/do_login');?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="用户名" name="username"  autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="密码" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="验证码" name="code" type="text" value="">
                                </div>
                                <div class="form-group">
                                    <img class="img-responsive" src="<?php echo U('login/code');?>" style="margin:0 auto;" onclick="this.src=this.src+'?id='+Math.random();">
                                    <p class="help-block" id="check_username" style="text-align:center;">看不清?点击图片刷新</p>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="登录"></fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- jQuery -->
    <script src="/zuche/Public/sb-admin-2/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/zuche/Public/js/bootstrap.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/zuche/Public/sb-admin-2/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/zuche/Public/sb-admin-2/bower_components/metisMenu/dist/metisMenu.min.js"></script>

</body>
</html>