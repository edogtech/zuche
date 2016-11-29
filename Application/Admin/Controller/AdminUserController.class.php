<?php
namespace admin\Controller;
use Think\Controller;
class AdminUserController extends Controller {
	//系统管理用户列表
	public function index(){		
		
		$ob=M('e_zc_sysuser');
		$field='*';

		$map=[];//定义条件数组
		
		if(!empty($_GET['nickname'])){
			$_GET['nickname']=trim($_GET['nickname']);
			$map['nickname']=array('like',"%{$_GET['nickname']}%");
		}
		if(!empty($_GET['phone'])){
			$_GET['phone']=trim($_GET['phone']);
			$map['phone']=array('like',"%{$_GET['phone']}%");
		}
		
		//取得总条数
		$count=$ob->where($map)->count();
		//根据总条数实例化page类
		$page= new \Think\Page($count,5);
		//分页显示输出
		$show= $page->show();
		//分页查询
		$list = $ob->field($field)->where($map)->limit($page->firstRow,$page->listRows)->order('id')->select();
		
		foreach($list as $key=>$value){
			switch($list[$key]['status']){
				case 0:
					$status='正常';
					break;
				case 1:
					$status='锁定';
					break;
			}
			$list[$key]['locked']=$status;
		}
		
    	//分配数据
    	$this->assign("lists",$list);
    	$this->assign("show",$show);
    	//展示
    	$this->display();
	}
	
	//增加系统管理用户
	public function add() {
		$ob=M('e_zc_sysuser');
		
		if(!$_POST['selRole'] || !$_POST['txtNickname']|| !$_POST['txtPwd']){
    		$this->error("角色/昵称/密码不能为空");
    	}
    	
    	if($_POST['txtPwd']!=$_POST['txtPwdConfirm']){
    		$this->error("密码不匹配，请重新输入");
    	}
    	//echo $_POST['selRole'];
    	
    	$data['role']=$_POST['selRole'];
    	$data['nickname']=$_POST['txtNickname'];
    	$data['password']=md5($_POST['txtPwd']);
    	$data['phone']=$_POST['txtPhone'];
    	$data['email']=$_POST['txtEmail'];
    	$data['status']=$_POST['selStatus'];
    	$data['memo']=$_POST['txtMemo'];
    	$data['add_time']=time();
		
		$re=$ob->data($data)->add();//生成系统用户记录
		//echo $ob->getlastsql();
		
		if($re){
			$this->success('系统用户添加成功！','index');
			//$this->redirect("Carousel/index");
		}else{
			$this->error("系统用户添加失败");
		}
	}
	
	//删除系统管理用户
	public function del() {
		$ob=M('e_zc_sysuser');
		
		$map['id']=$_POST['id'];
		$re=$ob->where($map)->delete();
		if($re){
			$this->success('用户删除成功！','index');
		}else{
			$this->error("用户删除失败");
		}
	}
	
	//编辑系统管理用户
	public function edit() {
		$ob=M('e_zc_sysuser');	
		
		$map['id']=$_POST['id'];
		if(!$_POST['selRole'] || !$_POST['txtNickname']|| !$_POST['txtPwd']){
    		$this->error("角色/昵称/密码不能为空");
    	}
    	if($_POST['txtPwd']!=$_POST['txtPwd2']){
    		$this->error("密码不匹配，请重新输入");
    	}	
    	$data['role']=$_POST['selRole'];
    	$data['nickname']=$_POST['txtNickname'];
    	$data['password']=md5($_POST['txtPwd']);
    	$data['phone']=$_POST['txtPhone'];
    	$data['email']=$_POST['txtEmail'];
    	$data['status']=$_POST['selStatus'];
    	$data['memo']=$_POST['txtMemo'];
    	$data['update_time']=time();
	
		$re=$ob->data($data)->where($map)->save();//更新轮播图记录
		//echo M('e_zc_sysuser')->getlastsql();die;
		if($re===false){
			$this->error('系统用户更新失败');
		}else{
			$this->success('系统用户更新成功！','index');
		}
	}
	
	//更改密码
	public function modifyPwdForm(){
		$this->assign("nickname",$nickname);
		$this->display(modifyPwd);

	}
	//更改密码
	public function modifyPwd(){
		
		$oldPwd=$_POST['txtOldPwd'];
		$pwd=$_POST['txtPwd'];
		$pwdConfirm=$_POST['txtPwdConfirm'];
		
		$password=session('admininfo.password');
		$id=session('admininfo.id');
		$nickname=session('admininfo.nickname');
		

		//echo $password;die;
		
		if(empty($oldPwd)){
			$this->error('请输入原密码');
		}else{
			if (empty($pwd)) {
				$this->error('新密码不能为空');
			}else {
				if($pwd!=$pwdConfirm){
					$this->error('两次输入密码不匹配');
				}else{
					if (md5($oldPwd)!=$password) {
						$this->error('原密码错误');
					}else {
						$ob=M('e_zc_sysuser');
						$map['id']=$id;
						$data['password']=md5($pwd);
						$re=$ob->data($data)->where($map)->save();
						if($re===false){
							$this->error('密码修改失败');
						}else {
							$this->success('密码修改成功！',U('Admin/Index/index'));
						}
					}

				}
			}
		}
		
	}

	//数据库导出界面
	public function save(){
		$save=M('');
		//查询库内所有表
		$res=$save->query("show tables");

		//过滤掉和租车无关的表
		foreach($res as $k=>$v){
			if(!strstr($v["Tables_in_yineng"],"e_zc")){
				unset($res[$k]);
			}
		}

		//展示内容供选择
		$this->assign('table',$res);
		
		$this->display();
	}


	public function do_save(){
		set_time_limit(0); //页面最大超时时间 0为max
		$table=$_GET['table'];
		if($_GET['table']=='all'){
			exec("mysqldump -uroot -pedog yineng>/www/web/default/zuche/sql/{$table}.sql",$a,$i);
		}else{
			exec("mysqldump -uroot -pedog yineng {$table} > /www/web/default/zuche/sql/{$table}.sql",$a,$i);
		}

		if($i===0){
			$this->success("备份成功",U("AdminUser/save"));
		}else{
			$this->error('备份失败');
		}
	}

	public function download(){
		//先在服务器备份
		$table=$_GET['table'];

		if($_GET['table']=='all'){
			exec("mysqldump -uroot -pedog yineng>/sql/{$table}.sql",$a,$i);
		}else{
			exec("mysqldump -uroot -pedog yineng {$table} > /sql/{$table}.sql",$a,$i);
		}



		$filename = "d:/{$table}.sql";
		$filesize=filesize($filename);
		set_time_limit(0); //页面最大超时时间 0为max
		ini_set('memory_limit', '512M'); //内存容量 因为文件下载是在服务器端先服务到内存中
		header('Content-Type: application/octet-stream'); //通过这句代码客户端浏览器就能知道服务端返回的文件形式
		header('Content-Disposition: attachment; filename='."{$table}.sql");  //告知浏览器这是个文件下载 并且告知文件名 
		Header("Content-Length:".$filesize); //告诉浏览器返回的文件大小
		header('Content-Transfer-Encoding:binary'); //对当前文档禁用缓存
		ob_end_clean(); //处理清空缓存区内容  tp框架中验证码输出之前有时也需要用到
		readfile($filename);
	}


}