<?php
namespace Admin\Controller;
use Think\Controller;
/*
 * 长租信息管理
 * 用于管理正在租用、下单未提车、已还车，租期超过一个月（配置参数）的车辆信息(目前未启用，通过管理系统下长租订单)
 * 只有长租可分阶段付款，存在消费流水
 */
class RentLongController extends Controller {
    //长租信息列表
    public function index(){

    	//$where['var_name']='long_rent_time';
    	//$res=M('e_zc_sysparameter')->field('var_value')->where($where)->select();
    	//$long_rent_time=$res[0]['var_value']*31*24*3600;//长租时间单位秒，模糊计算以每月31天为准
    	
		$map=[];//声明where条件数组
    	//$map['r.end_time-r.start_time']=array('egt',"$long_rent_time");
		$map['long_rent']=1;
		
    	//车牌号
    	if(!empty($_GET['order_number'])){
    		$_GET['order_number']=trim($_GET['order_number']);
    		$map['o.order_number']=array('like',"%{$_GET['order_number']}%");
    	}
		//订单号
    	if(!empty($_GET['plate'])){
    		$_GET['plate']=trim($_GET['plate']);
    		$map['o.plate']=array('like',"%{$_GET['plate']}%");
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
					->field('r.id,r.start_time,r.end_time,r.status,o.order_number,o.plate,o.brand,o.model,o.station,o.deposit,m.name,m.phone')
 					->where($map)
 					->count();
		
		//根据总条数实例化page类
		$page= new \Think\Page($count,5);
		//分页显示输出
		$show= $page->show();

		$list = $re->join('as r left join e_zc_orders as o on r.order_id = o.id left join e_members as m on m.id = r.user_id left join e_zc_cars as c on c.id=r.car_id')
				   ->field('r.id,r.start_time,r.end_time,r.status,r.order_id,o.order_number,o.plate,o.brand,o.model,o.station,o.deposit,m.name,m.phone')
				   ->where($map)
				   ->limit($page->firstRow,$page->listRows)
				   ->order('id')
				   ->select();
		
// 		echo M('e_zc_info')->getlastsql();

		$account=[];//定义流水账单数组
		$ob=M('e_zc_transaction');
		$field=('id,orderid,date,type,payment,credit,total');
		$time=time();
     	foreach ($list as $key => $value) {
     		
     		$where['orderid']=$list[$key]['order_id'];
     		$account=$ob->field($field)->where($where)->select();
     		
			switch ($value['status']) {
				case 0:
					$list[$key]['status']='未提车';
					break;
				case 1:
					$list[$key]['status']='已还车';
					break;
				case 2:
					$list[$key]['status']='租用中';
					break;
			}
			
			$subscribe=second_to_date($list[$key]['start_time'],$list[$key]['end_time']);//租车预约时长
			$list[$key]['subscribe']=$subscribe['day'].'天'.$subscribe['hour'].'小时';
			
			//剩余时长
			if($list[$key]['start_time']>$time){
				$list[$key]['balance']='时间未到';
			}else{
				if ($list[$key]['end_time']>$time){
					//在预约时间范围
					$balance=second_to_date($time,$list[$key]['end_time']);
				}else{
					//超出预约时间范围
					$balance=second_to_date(0,0);
				}
				$list[$key]['balance']=$balance['day'].'天'.$balance['hour'].'小时';
			}
			
     	}

     	
    	//分配数据
    	$this->assign("lists",$list);
    	$this->assign("show",$show);
    	//展示
    	$this->display();
    	 
    }
    
    public function detail(){
    	$map['orderid']=$_GET['order_id'];
    	$ob=M('e_zc_transaction');
    	$field=('id,orderid,date,type,payment,credit,total');
    	$list=$ob->field($field)->where($map)->select();
    	
    	$ob2=M('e_zc_orders');
    	foreach($list as $key=>$value){
    		$map2['id']=$value['orderid'];
    		$re=$ob2->field('order_number')->where($map2)->select();
    		$list[$key]['number']=$re[0]['order_number'];
    	}
    	$this->assign("lists",$list);
    	$this->display();
    	
    	
    }

}