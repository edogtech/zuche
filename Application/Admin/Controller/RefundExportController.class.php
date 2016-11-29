<?php
namespace Admin\Controller;
use Think\Controller;

class RefundExportController extends Controller {
    //订单退款列表
    public function index(){ 	
    	
    	$map=[];//定义条件数组
    	if(!empty($_GET['ordernumber'])){
    		$_GET['ordernumber']=trim($_GET['ordernumber']);
    		$map['order_number']=array('like',"%{$_GET['ordernumber']}%");
    	}
    	//下单时间
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
    	
    	
		$re1 = M('e_zc_orders');
		$re2 = M('e_zc_refund');
		$re3 = M('e_members');
		
		//取得总条数
		$count = $re2->join('as r left join e_zc_orders as o on r.orderid = o.id left join e_members as m on m.id = o.user_id')
		->field('r.id,r.orderid,r.refund,r.initiate_time,r.suggestion,o.id,o.order_number,o.user_id,o.plate,o.station,o.deposit,o.add_time,o.pay_type,o.status,m.name')
		->where($map)
		->count();
		
		//根据总条数实例化page类
		$page= new \Think\Page($count,5);
		//分页显示输出
		$show= $page->show();
		
		$list = $re2->join('as r left join e_zc_orders as o on r.orderid = o.id left join e_members as m on m.id = o.user_id')
					->field('r.id,r.orderid,r.refund,r.initiate_time,r.suggestion,o.id,o.order_number,o.user_id,o.plate,o.station,o.deposit,o.add_time,o.pay_type,o.status,m.name')
					->where($map)
					->limit($page->firstRow,$page->listRows)->order('r.initiate_time')
					->select();
		//echo M('e_zc_refund')->getlastsql();
     	foreach ($list as $key => $value) {
			if ($value['pay_type']==1) {
				$list[$key]['pay_type']='已付定金';
			}
			if ($value['status']==2) {
				$list[$key]['status']='申请退款';
			}
     	}
    	 
		//导出至excel
    	exportExcel($list);
    	 
    }

}