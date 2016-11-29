<?php
namespace Admin\Controller;
use Think\Controller;
// 除登录控制器之外的所有控制器继承总控制器
class CommonController extends Controller {
    
	/*
		总控制器：权限验证，验证用户是否具有此次访问的权限
	*/
	// 当子控制器被调用的时候，会自动执行此方法，在调用方法之前，做权限验证
	public function _initialize()	// tp中的__construct()  以免和自带的冲突
	{
		// 权限验证
		// 获取用户访问的控制器和方法名
		// echo CONTROLLER_NAME.'<br>';
		// echo ACTION_NAME;

		// 1.查询当前登录用户的所属组，所属组的权限
		// 模拟用户登录的id

		// 当前访问的权限（控制器和方法）
		$rule = CONTROLLER_NAME.'/'.ACTION_NAME;


		// 2.实例化权限控制类
		$auth = new \Think\Auth();

		// 3.判断用户是否登录
		// if (!session('?admin')) {
		// 	$this->error('请登录',U('Login/login'));
		// }

		// 4.判断当前用户是否具有该权限
		if ($auth->check($rule,$_SESSION['admininfo']['id'])) {
			
		}else{
			$this->error('您的账号没有此权限');
		}	

	}

}