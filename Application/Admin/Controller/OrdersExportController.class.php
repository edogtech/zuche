<?php
namespace Admin\Controller;
use Think\Controller;

class OrdersExportController extends Controller {
	//订单列表
    public function index(){
      	$field='*';
    	$re=M("e_zc_orders");
    	    	
    	$map=[];//定义条件数组
    	if(!empty($_GET['ordernumber'])){
    		$_GET['ordernumber']=trim($_GET['ordernumber']);
    		$map['order_number']=array('like',"%{$_GET['ordernumber']}%");
    	}

    	if(isset($_GET['paytype'])){
    		if ($_GET['paytype']!="" ){
    			$map['pay_type']=$_GET['paytype'];
    		}
    	}	

    	//下单时间
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
    	$count=$re->where($map)->count();
    	//根据总条数实例化page类
    	$page= new \Think\Page($count,5);
    	//分页显示输出
    	$show= $page->show();
    	//分页查询
    	$list = $re->field($field)->where($map)->limit($page->firstRow,$page->listRows)->order('id')->select();
    	//echo M("e_zc_orders")->getlastsql();
    	$res=M('e_members');
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
			unset($list[$k]['pay_type']) ;
			
			$tmp['id']=$v['user_id'];
			$result=$res->where($tmp)->field('name')->select();
			$list[$k]['user_name']=$result[0]['name'];
			unset($list[$k]['car_id']);
			unset($list[$k]['id']);
			unset($list[$k]['user_id']);
    	}
    	
    	//dump($list);
    	//导出至excel
    	exportExcel($list);
    }

}