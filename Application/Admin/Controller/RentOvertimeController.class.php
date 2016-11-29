<?php
namespace Admin\Controller;
use Think\Controller;

class RentOvertimeController extends Controller {
    public function index(){
    	
    	$map['r.alarm']=array('eq','1');//定义条件数组
    	
    	//车牌号
    	if(!empty($_GET['plate'])){
    		$_GET['plate']=trim($_GET['plate']);
    		$map['o.plate']=array('like',"%{$_GET['plate']}%");
    	}
    	//租车时间
    	if(!empty($_GET['dtpickerA'])){
    		$date=strtotime($_GET['dtpickerA']);
    		$map['o.add_time']=array('gt',$date);//o.add_time配合综合查询
    	}
    	if(!empty($_GET['dtpcikerB'])){
    		$date=strtotime($_GET['dtpcikerB']);
    		$map['o.add_time']=array('lt',$date);
    	}
    	if (!empty($_GET['dtpickerA'])&&!empty($_GET['dtpcikerB'])) {
    		$date1=strtotime($_GET['dtpickerA']);
    		$date2=strtotime($_GET['dtpcikerB']);
    		$map['o.add_time']=array(array('gt',$date1),array('lt',$date2),'and');
    	}
    	//用车状态
    	if(isset($_GET['status'])){
    		if ($_GET['status']!="" ){
    			$map['r.status']=array('eq',$_GET['status']);
    		}
    	}
    	
		$re = M('e_zc_info');
		
		//取得总条数
		$count = $re->join('as r left join e_zc_orders as o on r.order_id = o.id left join e_members as m on m.id = r.user_id left join e_zc_cars as c on c.id=r.car_id')
					->field('r.id,r.start_time,r.end_time,r.return_time,r.status,r.alarm,o.order_number,o.plate,o.brand,o.model,o.station,o.deposit,m.name,m.phone')
 					->where($map)
 					->count();
		
		//根据总条数实例化page类
		$page= new \Think\Page($count,5);
		
		//分页显示输出
		$show= $page->show();
		$list = $re->join('as r left join e_zc_orders as o on r.order_id = o.id left join e_members as m on m.id = r.user_id left join e_zc_cars as c on c.id=r.car_id')
				   ->field('r.id,r.start_time,r.end_time,r.status,r.return_time,r.alarm,o.order_number,o.plate,o.brand,o.model,o.station,o.deposit,m.name,m.phone')
 				   ->where($map)
				   ->limit($page->firstRow,$page->listRows)
				   ->order('id')
				   ->select();
		
		//echo M('e_zc_info')->getlastsql();
     	
     	foreach ($list as $key => $value) {
			switch ($value['status']) {
				case 1:
					$list[$key]['status']='已还车';
					break;
				case 2:
					$list[$key]['status']='租用中';
					break;
			}
			$list[$key]['return_time']=$list[$key]['return_time']?:'';//如果为空则赋值为空字符串
     	}
    	 
     	//dump($list);
    	//分配数据
    	$this->assign("lists",$list);
    	$this->assign("show",$show);
    	//展示
    	$this->display();
    	 
    }

}