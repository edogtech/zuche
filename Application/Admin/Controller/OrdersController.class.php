<?php
namespace Admin\Controller;
use Think\Controller;

class OrdersController extends Controller {
	//订单列表
    public function index(){
      	$field='*';
    	$re=M("e_zc_orders");

    	$where=[];//定义条件数组
		if(!empty($_GET['order_number'])){
    		$_GET['order_number']=trim($_GET['order_number']);
    		$where['order_number']=array('like',"%{$_GET['order_number']}%");
    	}

    	if(isset($_GET['paytype'])){
    		if ($_GET['paytype']!="" ){
    			$where['pay_type']=array('eq',$_GET['paytype']);
    		}
    	}

    	//下单时间
    	if(!empty($_GET['dtpickerA'])){
    		$date1=strtotime($_GET['dtpickerA']);
    		$where['add_time']=array('gt',$date1);
    	}
		if(!empty($_GET['dtpickerB'])){
    		$date2=strtotime($_GET['dtpickerB']);
    		$where['add_time']=array('lt',$date2);
    	}    	
		
     	if (!empty($_GET['dtpickerA'])&&!empty($_GET['dtpickerB'])) {
    		$date1=strtotime($_GET['dtpickerA']);
    		$date2=strtotime($_GET['dtpickerB']);
    		//$where['add_time']=array(array('gt',$date1),array('lt',$date2),'and');
			$where['add_time']=array('between',"{$date1},{$date2}");
    	}
    	
    	//取得总条数
    	$count=$re->where($where)->count();
    	//根据总条数实例化page类
    	$page= new \Think\Page($count,5);
    	//分页显示输出
    	$show= $page->show();
    	//分页查询
    	$list = $re->field($field)->where($where)->limit($page->firstRow,$page->listRows)->select();
	
		$res=M('e_members');
		$ob=M('e_zc_info');
		//dump($list);
    	foreach ($list as $k=>$v){		
			switch ($v['pay_type']) {
				case 0 :
					$type = '未支付';
					break;
				case 1 :
					$type = '已付定金';
					break;
				case 2 :
					$type = '待结算';
					break;
				case 3 :
					$type = '已结算';
					break;
				case 4 :
					$type = '待退款';
					break;
				case 5 :
					$type = '已退款';
					break;
				case 6 :
					$type = '支付失败';
					break;
			}
			$list[$k]['types']=$type;
			unset($list[$k]['pay_type']);
			
			$tmp['id']=$v['user_id'];
			$result=$res->where($tmp)->field('name')->select();
			$list[$k]['user_name']=$result[0]['name'];
			
			$map['user_id']=$v['user_id'];
			$map['order_id']=$v['id'];
			$reinfo=$ob->field('long_rent')->where($map)->select();
			$reinfo[0]['long_rent']==1?$list[$k]['long']='是':$list[$k]['long']='否';

			$array=second_to_date(0,$list[$k]['fixed_use_time']);//预约用车计时
			$list[$k]['fixed_use_time']=$array['day']."天".$array['hour']."小时".$array['minute']."分钟".$array['second']."秒";
			
			$array=second_to_date(0,$list[$k]['actual_use_time']);//实际用车计时
			$list[$k]['actual_use_time']=$array['day']."天".$array['hour']."小时".$array['minute']."分".$array['second']."秒";
			
			empty($list[$k]['excess'])?$list[$k]['excess']=0:$list[$k]['excess'];
			empty($list[$k]['excess_fee'])?$list[$k]['excess_fee']=0:$list[$k]['excess_fee'];
			empty($list[$k]['borrow_time'])?$list[$k]['borrow_time']='未登记':$list[$k]['borrow_time']=date('Y-m-d H:i:s',$list[$k]['borrow_time']);
			empty($list[$k]['return_time'])?$list[$k]['return_time']='未登记':$list[$k]['return_time']=date('Y-m-d H:i:s',$list[$k]['return_time']);
			empty($list[$k]['actual_total_fee'])?$list[$k]['actual_total_fee']=0:$list[$k]['actual_total_fee'];
			empty($list[$k]['deposit'])?$list[$k]['deposit']=0:$list[$k]['deposit'];
			empty($list[$k]['payment'])?$list[$k]['payment']=0:$list[$k]['payment'];
    	}
		
    	
    	//分配数据
    	$this->assign("lists",$list);
    	$this->assign("show",$show);
    	//展示
    	$this->display();
    	
    	//导出至excel
    	//exportExcel($list);
    }

}