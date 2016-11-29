<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
    public function userlist(){
    	$where=[];
    	if(!empty($_GET['name'])){
    		$_GET['name']=trim($_GET['name']);
    		$where['name']=array('like',"%{$_GET['name']}%");
    	}

    	if(!empty($_GET['phone'])){
    		$_GET['phone']=trim($_GET['phone']);
    		$where['phone']=array('like',"%{$_GET['phone']}%");
    	}

    	if(isset($_GET['verified']) && $_GET['verified']!=0 ){
    		$where['verified']=array('eq',$_GET['verified']);
    	}else{
    		$where['verified']=array('gt','0');
    	}

    	$user=M("e_members");
    	$count=$user->field("id,name,phone,id_card_image,driving_image,verified")->where($where)->count();// 查询满足要求的总记录数
    	$page=new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
    	$show=$page->show();// 分页显示输出

    	$userinfo=$user->field("id,name,phone,id_card_image,driving_image,verified")->where($where)->limit($page->firstRow,$page->listRows)->select();
    	$this->assign("userinfo",$userinfo);
    	$this->assign("page",$show);
    	$this->display();
    }

    public function checkuser(){
		//发送短信
		switch ($_POST['verified']){
			case 2:
			  send_duanxin($_POST['phone'],'【电狗科技】尊敬的用户恭喜您，您的驾驶资格认证审核成功，可以进行租车体验了，e能租车祝您出行愉快');
			  break;
			case 3:
			  send_duanxin($_POST['phone'],'【电狗科技】尊敬的用户很抱歉的通知您，您的驾驶资格任重审核失败，为了不影响您的出行，请尽快登录平台，再次提交审核');
			  break;
		}
		
    	$user=M("e_members");
    	$pro=$user->create();
    	if($pro){
    		$res=$user->save();
    		if($res){
    			$this->success("状态修改成功");
    		}else{
    			$this->error("状态修改失败");
    		}
    	}else{
    		$this->error($pro->getError());
    	}

    }


    public function deposit_list(){
    	$where=[];
    	if(!empty($_GET['name'])){
    		$_GET['name']=trim($_GET['name']);
    		$where['name']=array('like',"%{$_GET['name']}%");
    	}

    	if(!empty($_GET['phone'])){
    		$_GET['phone']=trim($_GET['phone']);
    		$where['phone']=array('like',"%{$_GET['phone']}%");
    	}

    	if(isset($_GET['deposit']) && $_GET['deposit']!=0 ){
    		$where['deposit']=array('eq',$_GET['deposit']);
    	}else{
    		$where['deposit']=array('neq',0);
    	}


    	$user=M("e_members");
    	$count=$user->field("id,name,phone,deposit")->where($where)->count();// 查询满足要求的总记录数
    	$page=new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
    	$show=$page->show();// 分页显示输出

    	$userinfo=$user->field("id,name,phone,deposit")->where($where)->limit($page->firstRow,$page->listRows)->select();
    	$this->assign("userinfo",$userinfo);
    	$this->assign("page",$show);
    	$this->display();
    }
	
	public function checkdeposit(){
		//发送短信
		$money=_POST['money'];
		$msg = '【电狗科技】 尊敬的用户，租车保证金退款总计['.$money.']元，详尽事宜请联系运营商，祝您用车愉快。';
		switch ($_POST['deposit']){
			case 0:
			  send_duanxin($_POST['phone'],$msg);
			  break;
			case 1:
			  send_duanxin($_POST['phone'],$msg);
			  break;
		}
		
		$user=M("e_members");
	    	$pro=$user->create();
    		if($pro){
    			$res=$user->save();
    			if($res){
    				$this->success("状态修改成功");
    			}else{
    				$this->error("状态修改失败");
    			}
    		}else{
    			$this->error($pro->getError());
    		}
		
	}



}
