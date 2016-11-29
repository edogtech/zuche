<?php
namespace APIes\Controller;
use Think\Controller;
class StationController extends Controller {

    public function index(){
        $this->display();
    }


    public function station(){
        
        @$station_id=isset($_POST['station_id'])?intval($_POST['station_id']):false;
        @$data=[];

        if(!$station_id){
            //失败返回值
            $data["result"]=1;
            $data["status"]=1;
            $data["message"]="传参不完整";
            $data=json_encode($data,JSON_UNESCAPED_UNICODE);
            echo $data;
            die; 
        }

        $station=M("");
        //查询折扣信息
        $discount_info=$station->table('e_zc_sysparameter')->field('var_value')->where('id=14')->find();
        $discount=$discount_info['var_value'];

        //查询站点信息
        $res=$station->table("e_zc_station station")->field("station.name,station.address,station.phone,station.comment,station.lng,station.lat")->where("id={$station_id}")->find();

        //若有结果集 再查站点的车辆
        if($res){
        	$res1=$station->table("e_zc_cars car,e_zc_cars_model model,e_zc_cars_brand brand")->field("model.img_url,car.plate,car.id car_id,car.capacity,car.occupation,model.name model,brand.name brand,car.sn,car.code")->where("car.station_id={$station_id} and car.model_id=model.id and car.brand_id=brand.id")->select();
        	if($res1){
        		//失败成功值
	            $res["result"]=0;
	            $res["status"]=0;
                $res["message"]="查询成功";
	            $res["discount"]= $discount;
	            $res['car_info']=$res1;
                $res['infocount']=count($res1);
	            $res=json_encode($res,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	            echo $res;
	            die; 
        	}else{
        		//失败返回值
	            $res["result"]=0;
	            $res["status"]=0;
	            $res["message"]="查询成功";
                $res["discount"]= $discount;
	            $res['car_info']=null;
                $res['infocount']=0;
	            $res=json_encode($res,JSON_UNESCAPED_UNICODE);
	            echo $res;
	            die; 
        	}

        }else{
        	//失败返回值
            $data["result"]=1;
            $data["status"]=1;
            $data["message"]="没有此站点的信息";
            $data=json_encode($data,JSON_UNESCAPED_UNICODE);
            echo $data;
            die; 
        }

    }

}