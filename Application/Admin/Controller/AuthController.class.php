<?php
namespace Admin\Controller;
use Think\Controller;
class AuthController extends CommonController {
    public function admin_list(){
    	$where=[];
    	if(!empty($_GET['name'])){
    		$_GET['name']=trim($_GET['name']);
    		$where['user.nickname']=array('like',"%{$_GET['name']}%");
    	}

    	$admin=M('');
    	$count=$admin->table('e_zc_sysuser user,think_auth_group zu,think_auth_group_access access')->field('user.nickname name,zu.title,zu.id gid,user.id uid')->where('user.id=access.uid and access.group_id=zu.id')->where($where)->count();
    	$page=new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
    	$show=$page->show();// 分页显示输出


    	$data=$admin->table('e_zc_sysuser user,think_auth_group zu,think_auth_group_access access')->field('user.nickname name,zu.title,zu.id gid,user.id uid')->where('user.id=access.uid and access.group_id=zu.id')->where($where)->limit($page->firstRow,$page->listRows)->select();
    	//dump($data);
    	$this->assign('data',$data);
    	$this->assign('page',$show);
        $this->display();
    }

    public function auth_list(){
    	$where=[];
    	if(!empty($_GET['title'])){
    		$_GET['title']=trim($_GET['title']);
    		$where['title']=array('like',"%{$_GET['title']}%");
    	}

    	$rule=M('think_auth_rule');
    	$count=$rule->field('id,name,title')->where($where)->count();// 查询满足要求的总记录数
    	$page=new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
    	$show=$page->show();// 分页显示输出
    	$data=$rule->field('id,name,title')->where($where)->limit($page->firstRow,$page->listRows)->select();
    	$this->assign('data',$data);
    	$this->assign('page',$show);
        $this->display();
    }


    public function do_add_auth(){
        if(empty($_POST['name'])||empty($_POST['title'])){
            $this->error('请填写完整内容');
        }

    	$rule=M('think_auth_rule');
    	$res=$rule->create();
    	if($res){
    		$res2=$rule->add();

    		if($res2){
    			$this->success('添加成功');
    		}else{
    			$this->error('添加失败');
    		}

    	}else{
    		$this->error($res->getError());
    	}

    }


    public function do_delete_auth(){

    	$id=intval($_GET['id']);
    	$auth=M('think_auth_rule');
    	$res=$auth->where("id={$id}")->delete();

    	if($res){
    		$this->success("删除成功");
    	}else{
    		$this->error("删除失败");
    	}

    }


    public function modify_auth(){
   
    	$id=intval($_GET['id']);
    	$auth=M('think_auth_rule');
    	$data=$auth->where("id={$id}")->find();
    	$this->assign('data',$data);
    	$this->display();
    	dump($data);
    }


    public function do_modify_auth(){
        if(empty($_POST['name'])||empty($_POST['title'])){
            $this->error('请填写完整内容');
        }

    	$auth=M('think_auth_rule');
    	$res=$auth->create($_POST);
    	if($res){

    		$res2=$auth->save();

    		if($res2){
    			$this->success("修改成功",U("Auth/auth_list"));
    		}else{
    			$this->error("修改失败");
    		}

    	}else{
    		$this->error($res->getError());
    	}

    }


    public function group_list(){
    	$group=M('think_auth_group');
    	$count=$group->count();// 查询满足要求的总记录数
    	$page=new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
    	$show=$page->show();// 分页显示输出
    	$data=$group->limit($page->firstRow,$page->listRows)->select();
    	$this->assign('data',$data);
    	$this->assign('page',$show);
        $this->display();
    }


    public function add_group(){
    	$auth=M('think_auth_rule');
    	$data=$auth->select();

    	$this->assign('data',$data);
    	$this->display();
    }

    public function do_add_group(){
    	if(empty($_POST['title'])){
            $this->error('请填写组名');
        }
        if(empty($_POST['rule_id'])){
            $this->error('请至少给予一项权限');
        }

    	$_POST['rules']=implode(',',$_POST['rule_id']);
		
    	$group=M('think_auth_group');
    	$res=$group->create($_POST);
    	if($res){

    		$res2=$group->add();

    		if($res2){
    			$this->success('添加成功',U("Auth/group_list"));
    		}else{
    			$this->error('添加失败');
    		}	

    	}else{
    		$this->error($res->getError());
    	}

    }

    public function do_delete_group(){
    	$id=intval($_GET['id']);
    	$group=M('think_auth_group');
    	$res=$group->where("id={$id}")->delete();
    	if($res){
    		$this->success('删除成功');
    	}else{
    		$this->error('删除失败');
    	}
    }

    public function modify_group(){
    	$group_id=intval($_GET['id']);
    	$group=M('think_auth_group');
    	$title=$group->where("id={$group_id}")->find();
    	
    	$now_rule=explode(',',$title['rules']);

    	$rule=M('think_auth_rule')->select();
    	

    	$this->assign('title',$title);
    	$this->assign('rule',$rule);
    	$this->assign('now_rule',$now_rule);
    	$this->display();
    }


    public function do_modify_group(){
    	$_POST['rules']=implode(',',$_POST['rule_id']);
	
    	$group=M('think_auth_group');
    	$res=$group->create($_POST);
    	if($res){

    		$res2=$group->save();

    		if($res2){
    			$this->success('修改成功');
    		}else{
    			$this->error('修改失败,没有信息被修改');
    		}	

    	}else{
    		$this->error($res->getError());
    	}
    }


    public function modify_auth_group(){

    	$uid=trim($_GET['uid']);
    	$group_access=M('think_auth_group_access');
    	$data=$group_access->where("uid={$uid}")->find();
    	$group=M('think_auth_group');
    	$data_group=$group->select();

    	$this->assign('name',$_GET['name']);
    	$this->assign('data',$data);
    	$this->assign('data_group',$data_group);
    	$this->display();
    }

    public function do_modify_auth_group(){
    	$uid=intval($_POST['uid']);
    	$data['group_id']=intval($_POST['gid']);
    	$access=M('think_auth_group_access')->where("uid={$uid}")->save($data);
    	if($access){
    		$this->success('修改成功',U('Auth/admin_list'));
    	}else{
    		$this->error('修改失败');
    	}

    }




}