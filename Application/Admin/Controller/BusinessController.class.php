<?php
namespace Admin\Controller;
use Think\Controller;
class BusinessController extends Controller {
    public function index(){
    	$where=[];
    	if(!empty($_GET['name'])){
    		$_GET['name']=trim($_GET['name']);
    		$where['name']=array('like',"%{$_GET['name']}%");
    	}

    	if(!empty($_GET['phone'])){
    		$_GET['phone']=trim($_GET['phone']);
    		$where['phone']=array('like',"%{$_GET['phone']}%");
    	}

    	$where['verified']=array('eq','2');

    	$user=M("e_members");
    	$count=$user->field("id,name,phone,id_card_image,driving_image,verified")->where($where)->count();// 查询满足要求的总记录数
    	$page=new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
    	$show=$page->show();// 分页显示输出

    	$userinfo=$user->field("id,name,phone,id_card_image,driving_image,verified")->where($where)->limit($page->firstRow,$page->listRows)->select();
    	$this->assign("userinfo",$userinfo);
    	$this->assign("page",$show);
    	$this->display();
    }

    public function business(){
    	$user=M('e_members');
    	$name=$user->field('name,phone')->where("id={$_GET['uid']}")->find();

    	$province=M('e_zc_station');
        $data=$province->field('province')->select();
        $res=[];
        foreach($data as $k=>$v){
            if(!in_array($v,$res)){
                $res[]=$v;
            }
        }

    	$this->assign('data',$res);
    	$this->assign('userinfo',$name);
    	$this->display();
    }

    public function citylist(){

    	$province=trim($_POST['province']);
    	$city=M('e_zc_station');
    	$data=$city->field('city,province')->where("province='{$province}'")->select();
    	$res=[];
    	foreach($data as $k=>$v){
            if(!in_array($v,$res)){
                $res[]=$v;
            }
        }
    	echo json_encode($res,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    }

    public function countylist(){

    	$city=trim($_POST['city']);
    	$province=trim($_POST['province']);
    	$county=M('e_zc_station');
    	$data=$county->field('county')->where("city='{$city}' and province='{$province}'")->select();

    	$res=[];
    	foreach($data as $k=>$v){
            if(!in_array($v,$res)){
                $res[]=$v;
            }
        }
    	echo json_encode($res,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    }

    public function stationlist(){
		$province=trim($_POST['province']);
    	$county=trim($_POST['county']);
    	$station=M('e_zc_station');
    	$data=$station->field('name,id')->where("county='{$county}' and province='{$province}'")->select();

		echo json_encode($data,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    }

    public function carlist(){
    	$id=trim($_POST['id']);
    	$car=M('');
    	$data=$car->table("e_zc_cars car,e_zc_cars_brand brand,e_zc_cars_model model")->field("car.plate,car.id,brand.name brand,model.name model")->where("car.station_id={$id} and model.id=car.model_id and brand.id=car.brand_id")->select();

    	echo json_encode($data,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    }

    public function car_rent(){
        $id=trim($_POST['id']);
        $rent=M('e_zc_info');

        $data=$rent->field('start_time,end_time')->where("car_id={$id} and status!=1")->select();
        if($data){
            foreach($data as $k=>$v){
                $data[$k]['start_time']=date('Y-m-d H:i:s',$v['start_time']);
                $data[$k]['end_time']=date('Y-m-d H:i:s',$v['end_time']);
            }
        }

        echo json_encode($data,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function long_rent(){
        if(empty($_POST['province'])){
            $this->error('请选择省份');
            die;
        }
        if(empty($_POST['city'])){
            $this->error('请选择城市');
            die;
        }
        if(empty($_POST['county'])){
            $this->error('请选择地区');
            die;
        }

        if(empty($_POST['station'])){
            $this->error('请选择站点');
            die;
        }else{
            $station_info=M('e_zc_station')->field('name')->where("id={$_POST['station']}")->find();
            $station=$station_info['name'];
        }

        if(empty($_POST['car_id'])){
            $this->error('请选择车辆');
            die;
        }else{
            $car_id=trim($_POST['car_id']);
            $car_info=M('')->table('e_zc_cars car,e_zc_cars_model model,e_zc_cars_brand brand')->field('model.name model,brand.name brand')->where("car.id={$car_id} and car.brand_id=brand.id and car.model_id=model.id")->find();
            $model=$car_info['model'];
            $brand=$car_info['brand'];
        }

        if(empty($_POST['plate'])){
            $this->error('请选择车辆');
            die;
        }else{
            $plate=trim($_POST['plate']);
        }

        if(empty($_POST['start_time']) || empty($_POST['end_time'])){
            $this->error('请选择完整的起始时间');
            die;
        }else{
            $start_time=strtotime($_POST['start_time']);
            $end_time=strtotime($_POST['end_time']);
			if($start_time >=$end_time){
				$this->error('开始时间必须小于结束时间');
				die;
			}
			$now_time=strtotime(date('Y-m-d',time()));
			
			if($start_time<$now_time){
				$this->error('开始时间必须大于今天');
			}
        }
        if(empty($_POST['price'])){
            $this->error('请填写价格');
            die;
        }else{
            $rent_time=strtotime($_POST['end_time'])-strtotime($_POST['start_time']);
            $rent_day=$rent_time/(3600*24);  
            $price_info=M('e_zc_sysparameter')->where("var_name='long_rent_price'")->find();
            $price=$rent_day*$price_info['var_value'];
        }



        $data=[];
        $data['user_id']=trim($_POST['user_id']);
        $data['order_number']= 'EZC'.get_micro_time(3).mt_rand(1000,9999);
        $data['station']=$station;
        $data['car_id']=$car_id;
        $data['plate']=$plate;
        $data['model']=$model;
        $data['brand']=$brand;
        $data['start_time']=$start_time;
        $data['end_time']=$end_time;
        $data['add_time']=time();
        $data['fixed_use_time']=$end_time-$start_time;
        $data['fixed_total_fee']=$price;
        $data['upd_time']=$data['start_time'];
        $data['long_price']=$price;
        $data['pay_type']=3;
        $data['price']=$price_info['var_value'];
        $data['payment']=$price;
		$data['fashion']='线下支付';


        //添加订单
        $order=M('e_zc_orders');
        $order_create=$order->create($data);
        if($order_create){
            $order_res=$order->add();
            if($order_res){
                $order_id=$order_res;
            }else{
                $this->error('订单添加失败');
            }

            //添加租车
            $data_info=[];
            $data_info['car_id']=$car_id;
            $data_info['user_id']=$data['user_id'];
            $data_info['order_id']=$order_id;
            $data_info['start_time']=$start_time;
            $data_info['end_time']=$end_time;
            $data_info['add_time']=$data['add_time'];
            $data_info['long_rent']=1;
			$data_info['station']=$station;

            $info=M('e_zc_info');
            $info_create=$info->create($data_info);
            $info_res=$info->add();
            if($info_res){
                $this->success('长租信息已经成功写入');
            }else{
                $this->error('租车信息写入失败');
            }

            
        }else{
            $this->error($order_create->getError());
        }



    }

    public function reckon_price(){
        if(!$_POST['start_time']){
            echo '请选择开始日期';
            die;
        }

        if(!$_POST['end_time']){
            echo '请选择结束日期';
            die;
        }
		$start_time=strtotime($_POST['start_time']);
        $end_time=strtotime($_POST['end_time']);
		if($start_time >= $end_time){
			echo '开始时间不能小于结束时间';
			die;
		}
		
        $rent_time=strtotime($_POST['end_time'])-strtotime($_POST['start_time']);
        $rent_day=$rent_time/(3600*24);
        
        $price_info=M('e_zc_sysparameter')->where("var_name='long_rent_price'")->find();

        echo $rent_day*$price_info['var_value'];
    }


    public function return_car(){

        //长租还车页面的数据展示
        $where=[];
        if(!empty($_GET['name'])){
            $_GET['name']=trim($_GET['name']);
            $where['member.name']=array('like',"%{$_GET['name']}%");
        }

        if(!empty($_GET['phone'])){
            $_GET['phone']=trim($_GET['phone']);
            $where['member.phone']=array('like',"%{$_GET['phone']}%");
        }

        if(!empty($_GET['plate'])){
            $_GET['plate']=trim($_GET['plate']);
            $where['car.plate']=array('like',"%{$_GET['plate']}%");
        }


        $zc_info=M('');
        $count=$zc_info->table('e_zc_info info,e_zc_cars car,e_members member')->field('info.station,info.start_time,info.end_time,info.borrow_time,car.plate,member.phone,member.name')->where('info.car_id=car.id and info.user_id=member.id and info.status!=1 and info.long_rent=1')->where($where)->count();
        $page=new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数
        $show=$page->show();// 分页显示输出
        $data=$zc_info->table('e_zc_info info,e_zc_cars car,e_members member')->field('info.car_id,info.id,info.station,info.start_time,info.end_time,info.borrow_time,car.plate,member.phone,member.name')->where('info.car_id=car.id and info.user_id=member.id and info.status!=1 and info.long_rent=1')->where($where)->limit($page->firstRow,$page->listRows)->select();
        $this->assign('data',$data);
        $this->assign("page",$show);
        $this->display();
    }


    public function do_return_car(){
  
        $info_id=trim($_GET['info_id']);
        $data_info['status']=1;

        $info=M('e_zc_info');
        $info_status=$info->where("id={$info_id}")->save($data_info);
        if($info_status){
            //租车信息修改后吧对应的车辆状态也修改
            $car=M('e_zc_cars');
            $car_id=trim($_GET['car_id']);
            $data_car['occupation']=0;
            $car->where("id={$car_id}")->save($data_car);


            $this->success('还车成功',U('Business/return_car'));
        }else{
            $this->error('还车失败');
        }
   


    }



}