<?php
/**
*微信公众号充电接口
*/
namespace APIes\Controller;
use Think\Controller;
class WxController extends Controller {
    public function index(){
    	$this->display();
    }
    
    public function getStationsInCity(){
    	$AreaNo=I('get.AreaNo','','trim');//区号
    	$PostNo=I('get.PostNo','','trim');//邮编
    	$Name=I('get.Name','','trim');//电站名或拼音
    	
    	$ob=M('e_electricities');
    	$field='No,name,address,lng,lat,operation_state';
    	
    	if(empty($AreaNo) && empty($PostNo)){
    		$return['code']=10103;
    		$return['message']='区号或邮政编码必须至少有一个不能为空';
    		echo json_encode($return,JSON_UNESCAPED_UNICODE);
    	}else{
    		if (!empty($AreaNo)) {
    			$map['area_code']=$AreaNo;
    		}else{
    			$map['post_code']=$PostNo;
    		}

    		$list=$ob->field($field)->where($map)->select();
    		$count=$ob->where($map)->count();
    		
    		if(empty($list)){
    			if (!empty($AreaNo)) {
    				$return['code']=10101;
    				$return['message']='无效的区号';
    			}else{
    				$return['code']=10102;
    				$return['message']='无效的邮政编码';
    			}
    			echo json_encode($return,JSON_UNESCAPED_UNICODE);
    		}else{
    			if($count>500) {
    				$return['code']=10104;
    				$return['message']='结果数量超过500';
    				echo json_encode($return,JSON_UNESCAPED_UNICODE);
    			}else{
    				foreach ($list as $k=>$v ){
    					$re[$k]['No']=$v['No'];
    					$re[$k]['Name']=$v['name'];
    					$re[$k]['Address']=$v['address'];
    					$re[$k]['Lng']=$v['lng'];
    					$re[$k]['Lat']=$v['lat'];
    					$re[$k]['OperationState']=$v['operation_state'];
    				}
    				$return['Stations']=$re;
    				echo json_encode($return,JSON_UNESCAPED_UNICODE);
    			}
    		}
    	}
    }
    
	public function getNearByStations(){
    	$Lng=I('get.Lng','','trim');
    	$Lat=I('get.Lat','','trim');
    	
    	//$map['id']=array('lt',20);
    	$ob=M('e_electricities');
    	$field='No,name,address,lng,lat,operation_state';

    	$list=$ob->field($field)->select();
    	if(empty($list)){
    		$return['code']=10201;
    		$return['message']='无效的GPS位置';
    		echo json_encode($return,JSON_UNESCAPED_UNICODE);
    	}else{
    		foreach($list as $k=>$v){
    			$distance=getDistance($v['lat'],$v['lng'],$Lat,$Lng);
    			$re[$k]['distance']=$distance/1000; //单位千米
    			$re[$k]['No']=$v['No'];
    			$re[$k]['Name']=$v['name'];
    			$re[$k]['Address']=$v['address'];
    			$re[$k]['Lng']=$v['lng'];
    			$re[$k]['Lat']=$v['lat'];
    			$re[$k]['OperationState']=$v['operation_state'];
    		}
			
			sort($re);//对所有充电站的距离排序
			
 			$return['Distance']=$re[19]['distance'];//获取20个充电站中的最大距离(第19个元素最大)

 			//截取前20条记录
 			for ($i = 0; $i < 20; $i++) {
 				$records[$i]=$re[$i];
 			}
 
 			$return['Stations']=$records;
    		echo json_encode($return,JSON_UNESCAPED_UNICODE);
    	}
    }
    
    public function getStationDetails() {

    	$No=$_GET['No'];//电站编号
    	
		//电站详情
    	$ob=M('e_electricities');
    	$map['No']=$No;
    	$field=('id,No,name,address,lng,lat,image,area_code,post_code,operation_state,service_category,pchong,kchong,idle,price,fee,tels,station_star');
    	$station_info=$ob->where($map)->field($field)->select();
    	

    	if(empty($station_info)){
    		$return['code']=10301;
    		$return['message']='无效的电站编号';
    		echo json_encode($return,JSON_UNESCAPED_UNICODE);
    	}else{
    		$where['e_id']=$station_info[0]['id'];
    		
    		//电桩详情
	    	$ob2=M('e_electric_pile');
	    	$field='charging_no,charging_grade,charging_mode,charging_state,price';
	    	$pile_info=$ob2->where($where)->field($field)->select();
			
	    	//unset($station_info[0]['id']);
	    	$list['No']=$station_info[0]['No'];
	    	$list['Name']=$station_info[0]['name'];
	    	$list['Address']=$station_info[0]['address'];
	    	$list['Lng']=$station_info[0]['lng'];
	    	$list['Lat']=$station_info[0]['lat'];
	    	$list['AreaCode']=$station_info[0]['area_code'];
	    	$list['PostCode']=$station_info[0]['post_code'];
	    	$list['OperationSate']=$station_info[0]['operation_state'];
	    	$list['ServiceCategory']=$station_info[0]['service_category'];
	    	$list['TotalNumOfCharging']=$station_info[0]['pchong']+$station_info[0]['kchong'];
	    	$list['NumOfFreeCharging']=$station_info[0]['pchong']+$station_info[0]['kchong']; //空闲数量由站控推送，暂时未取到 $station_info[0]['idle'];
	    	$list['ElectricityPrice']=$station_info[0]['price'];
	    	$list['ParkingFee']=$station_info[0]['fee'];
	    	$list['ServicePhone']=$station_info[0]['tels'];
	    	
	    	$list['ChargingDetails']=$pile_info;
	    	
	    	//电站星级
	    	$list['StationStar']=$station_info[0]['station_star'];
	    	
	    	//电站评价
	    	$ob3=M('e_comment');
	    	$field='No,userid,add_time,content,ServiceStar,FacilitiesStar,TrafficStar,ImageUrl';
	    	$comment_info=$ob3->where($where)->field($field)->select();

	    	unset($map);
	    	$ob=M('e_members');
	    	$field='name,user_id'; 

	    	foreach($comment_info as $k=>$v){
 	    		$map['id']=$v['userid'];
 	    		$re=$ob->where($map)->field($field)->select();
 	    		//电站评价
	    		$StationEvaluations[$k]['EvaluationNo']=$v['No'];
	    		$StationEvaluations[$k]['UserName']=$re[0]['name'];
	    		$StationEvaluations[$k]['UserId']=$re[0]['user_id'];
	    		$StationEvaluations[$k]['Time']=$v['add_time'];
	    		$StationEvaluations[$k]['Content']=$v['content'];
	    		//星级评价
	    		$EvaluationStars[$k]['ServiceStar']=$v['ServiceStar'];
	    		$EvaluationStars[$k]['FacilitiesStar']=$v['FacilitiesStar'];
	    		$EvaluationStars[$k]['TrafficStar']=$v['TrafficStar'];
	    		$StationEvaluations[$k]['EvaluationStars']=$EvaluationStars[$k];
	    		
	    		//评价图片
	    		$EvaluationImages[$k]['ImageUrl']=explode(',',$v['ImageUrl']);
	    		$StationEvaluations[$k]['EvaluationImages']=$EvaluationImages[$k];

	    	}

	    	$list['StationEvaluations']=$StationEvaluations;
	    	
	    	$Images['ImageUrl']=explode(',',$station_info[0]['image']);
	    	$list['Images']=$Images;

	    	echo urldecode(json_encode(url_encode($list)));
    	}
    	
    }
    
   public function getStationEvaluations() {
    	$No=I('get.No','','trim');//电站编号
    	$EvaluationNo=I('get.EvaluationNo','','trim');//评论编号
    	$NumberOfEvaluation=I('get.NumberOfEvaluation','','trim');//评论条数
    	
    	$ob=M('e_electricities');
    	$map['No']=$No;
    	$re=$ob->field('id')->where($map)->select();
    	if(empty($re)){
    		$return['code']=10401;
    		$return['message']='无效的电站编号';
    		echo json_encode($return,JSON_UNESCAPED_UNICODE);
    	}else{
    		unset($map);
			$map['e.No']=$No;
    		$map['c.No']=array('lt',"$EvaluationNo");//指定评论编号之前的记录
    		$list=$ob->join('as e left join e_comment as c on e.id=c.e_id left join e_members as m on m.id=c.userid')
    			 ->field('e.id,c.No,c.userid,c.add_time,c.content,c.ServiceStar,c.FacilitiesStar,c.TrafficStar,c.ImageUrl,m.user_id,m.name')
    			 ->where($map)
    			 ->select();
 		
    		if(empty($list)){
    		 	$return['code']=10402;
    		 	$return['message']='无效的评论编号';
    		 	echo json_encode($return,JSON_UNESCAPED_UNICODE);
    		 }else{
    		 	foreach ($list as $k=>$v){
    		 		$base_comment[$k]['EvaluationNo']=$v['No'];//评价序号
    		 		$base_comment[$k]['UserName']=$v['name'];//评价人姓名
    		 		$base_comment[$k]['UserNo']=$v['user_id'];//评价人编号
    		 		$base_comment[$k]['Time']=$v['add_time'];//评价时间
    		 		$base_comment[$k]['Content']=$v['content'];//评价内容  		 		
    		 		
    		 		$EvaluationStars[$k]['ServiceStar']=$v['ServiceStar'];
    		 		$EvaluationStars[$k]['FacilitiesStar']=$v['FacilitiesStar'];
    		 		$EvaluationStars[$k]['TrafficStar']=$v['TrafficStar'];
    		 		
    		 		$EvaluationImages[$k]['ImageUrl']=explode(',',$v['ImageUrl']);
    		 		
    		 		$return[$k]=$base_comment[$k];
    		 		$return[$k]['EvaluationStars']=$EvaluationStars[$k];
    		 		$return[$k]['EvaluationImages']=$EvaluationImages[$k];
    		 	}
    		 	
    		 	echo urldecode(json_encode(url_encode($return)));
    		 }
    	}
    }
    
}