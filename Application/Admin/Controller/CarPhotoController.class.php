<?php
namespace Admin\Controller;
use Think\Controller;
class CarPhotoController extends Controller {
    public function photolist(){
    	$where=[];
    	$photo=M('e_zc_car_photo p,e_members m');
    	$count=$photo->where($where)->where('p.user_id=m.id')->count();// 查询满足要求的总记录数
    	$page=new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
    	$show=$page->show();// 分页显示输出

    	$photoinfo=$photo->where($where)->where('p.user_id=m.id')->field('m.name,m.phone,p.id,p.add_time,p.pic1,p.pic2,p.pic3,p.pic4,p.user_id')->limit($page->firstRow,$page->listRows)->select();

    	foreach ($photoinfo as $k => $v) {
    		if(!$v['pic2']){
    			$photoinfo[$k]['pic']=1; 			
    		}else{
    			$photoinfo[$k]['pic']=2;
    		}

    		if($v['pic3']){
    			$photoinfo[$k]['pic']=3; 			
    		}

    		if($v['pic4']){
    			$photoinfo[$k]['pic']=4; 			
    		}


    	}

    	$this->assign("photoinfo",$photoinfo);
    	$this->assign("page",$show);
		
        $this->display();
    }


    public function photoinfo(){
    	$id=$_GET['id'];
    	$photo=M('e_zc_car_photo');
    	$photoinfo=$photo->field('pic1,pic2,pic3,pic4')->where("id={$id}")->find();
    	
    	$this->assign('photoinfo',$photoinfo);
    	$this->display();
    }

}