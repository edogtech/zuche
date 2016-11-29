<?php
namespace admin\Controller;
use Think\Controller;
class CarouselController extends Controller {
	public function index(){		
		
		$ob=M('e_zc_carousel');
		$field='id,image,url,name,type,summary,content,add_time';

		$map=[];//定义条件数组
		
		if(!empty($_GET['caption'])){
			$_GET['caption']=trim($_GET['caption']);
			$map['name']=array('like',"%{$_GET['caption']}%");
		}
		
		//记录添加时间
		if(!empty($_GET['dtpickerA'])){
			$date=strtotime($_GET['dtpickerA']);
			$map['add_time']=array('gt',$date);
		}
		if(!empty($_GET['dtpcikerB'])){
			$date=strtotime($_GET['dtpcikerB']);
			$map['add_time']=array('lt',$date);
		}
		if (!empty($_GET['dtpickerA'])&&!empty($_GET['dtpcikerB'])) {
			$date1=strtotime($_GET['dtpickerA']);
			$date2=strtotime($_GET['dtpcikerB']);
			$map['add_time']=array(array('gt',$date1),array('lt',$date2),'and');
		}
		
		//取得总条数
		$count=$ob->where($map)->count();
		//根据总条数实例化page类
		$page= new \Think\Page($count,5);
		//分页显示输出
		$show= $page->show();
		//分页查询
		$list = $ob->field($field)->where($map)->limit($page->firstRow,$page->listRows)->order('id')->select();
		
    	//分配数据
    	$this->assign("lists",$list);
    	$this->assign("show",$show);
    	//展示
    	$this->display();
	}
	
	//增加轮播图
	public function add() {
		
		$ob=M('e_zc_carousel');
		
		if(!$_POST['txtCaption'] || !$_POST['txtUrl']){
    		$this->error("标题/URL地址不能为空");
    	}
		
    	//可switch判断4种状态给予提示
    	if($_FILES['imgUrl']["error"]==4){
    		$this->error("请选择图片上传");
    	}
    	
    	$upload = new \Think\Upload();// 实例化上传类
    	$upload->maxSize =10485760 ;// 设置附件上传大小  10M
    	$upload->exts =array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    	// 设置附件上传目录
    	$upload->rootPath  ='Public/';
    	$upload->savePath = 'carousel/';
    	$info  = $upload->upload();// 上传文件
    	if(!$info) {
    		// 上传错误提示错误信息
    		$this->error($upload->getError());
    	
    	}else{
    		// 上传成功后 把组装好的图片地址覆盖掉 $_POST['pic']
    		$_POST['imgUrl']="/Public/".$info['imgUrl']['savepath'].$info['imgUrl']['savename'];
    		$_POST["add_time"]=time();
    	}
    	
    	$data['name']=$_POST['txtCaption'];
    	$data['url']=$_POST['txtUrl'];
    	$data['summary']=$_POST['txtSummary'];
    	$data['image']=$_POST['imgUrl'];
    	$data['add_time']=time();
		
		$re=$ob->data($data)->add();//生成轮播图记录
		
		if($re){
			$this->success('轮播图添加成功！','index');
			//$this->redirect("Carousel/index");
		}else{
			$this->error("新增轮播图失败");
		}
	}
	
	//删除轮播图
	public function del() {
		
		$ob=M('e_zc_carousel');
		
		$map['id']=$_POST['id'];
		$re=$ob->where($map)->delete();
		//echo M('e_zc_carousel')->getlastsql();
		
		if($re){
			$this->success('轮播图删除成功！','index');
			//$this->redirect("Carousel/index");
		}else{
			$this->error("删除轮播图失败");
		}
	}
	
	//编辑轮播图
	public function edit() {
	
		$ob=M('e_zc_carousel');
		
		$map['id']=$_POST['id'];
		
		if(!$_POST['txtCaption'] || !$_POST['txtUrl']){
			$this->error("标题/URL地址/图片不能为空");
		}
			
		if(!$_FILES['imgUrl']["error"]==4){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize =10485760 ;// 设置附件上传大小  10M
			$upload->exts =array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			// 设置附件上传目录
			$upload->rootPath  ='Public/';
			$upload->savePath = 'carousel/';
			$info  = $upload->upload();// 上传文件
 			if($info) {
				// 上传成功后 把组装好的图片地址覆盖掉 $_POST['pic']
				$_POST['imgUrl']="/Public/".$info['imgUrl']['savepath'].$info['imgUrl']['savename'];
				$_POST["add_time"]=time();
				$data['image']=$_POST['imgUrl'];
			}else{
				$this->error('图片上传失败');
			}
		}
		$data['name']=$_POST['txtCaption'];
		$data['url']=$_POST['txtUrl'];
		$data['summary']=$_POST['txtSummary'];
	
		$re=$ob->data($data)->where($map)->save();//更新轮播图记录

		if($re===false){
			$this->error('轮播图更新失败');
		}else{
			$this->success('轮播图更新成功！','index');
		}
	}	
}