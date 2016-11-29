<?php
namespace Admin\Controller;
use Think\Controller;
class CarController extends Controller {

    public function brand(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

    	$brand=M("e_zc_cars_brand");
    	$data=$brand->select();
    	$this->assign("data",$data);
        $this->display();
    }

    public function add_brand(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

    	$_POST['name']=trim($_POST['brand_name']);

    	if(empty($_POST['name'])){
    		$this->error('品牌不能为空');
    	}

    	$_POST['add_time']=time();
    	$brand=M("e_zc_cars_brand");
    	$res=$brand->create();
    	if($res){
    		$r=$brand->add();
    		if($r){
    			$this->success("添加成功");
    		}else{
    			$this->error("添加失败");
    		}
    	}else{
    		$this->error($res->getError());
    	}

    }


    public function modify_brand(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

    	$_POST['name']=trim($_POST['name']);

    	if(empty($_POST['name'])){
    		$this->error('品牌不能为空');
    	}

    	$brand=M("e_zc_cars_brand");
    	$res=$brand->create();
    	if($res){
    		$r=$brand->save();
    		if($r){
    			$this->success("修改成功");
    		}else{
    			$this->error("修改失败,修改值可能与原值相同");
    		}
    	}else{
    		$this->error($res->getError());
    	}
    }

    public function del_brand(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

    	$_POST['id']=intval($_POST['id']);
    	$brand=M("e_zc_cars_brand");
    	$res=$brand->where("id={$_POST['id']}")->delete();
    	if($res){
    		$this->success("删除成功");
    	}else{
    		$this->error("删除失败");
    	}

    }


    public function model(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

    	$brand=M("");
    	$data=$brand->table("e_zc_cars_model model,e_zc_cars_brand brand")->field("brand.name brand_name,model.id,model.name,model.add_time,model.img_url")->where("brand.id=model.brand_id")->select();
    	$this->assign("data",$data);
        $this->display();
    }

    public function add_model(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

    	$brand=M("e_zc_cars_brand");
    	$data=$brand->select();
    	$this->assign("data",$data);
        $this->display();
    }


    public function do_add_model(){
    	$_POST['name']=trim($_POST['name']);

    	if($_FILES['img_url']["error"]==4){
    		$this->error("请选择图片上传");
    	}

    	if(empty($_POST['name'])){
    		$this->error("请输入名称");
    	}


    	$upload = new \Think\Upload();// 实例化上传类    
    	$upload->maxSize   =10485760 ;// 设置附件上传大小  10M  
    	$upload->exts      =array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
    	// 设置附件上传目录        
    	$upload->rootPath  ='Public/';
    	$upload->savePath = 'cars_pic/'; 
    	$info   =   $upload->upload();// 上传文件     
    	if(!$info) {
    		// 上传错误提示错误信息        
    		$this->error($upload->getError()); 

    	}else{
    		// 上传成功后 把组装好的图片地址覆盖掉 $_POST['pic']     
    		$_POST['img_url']="/Public/".$info['img_url']['savepath'].$info['img_url']['savename'];  
    		$_POST["add_time"]=time();    	
    	}

    	$model=M("e_zc_cars_model");
    	$res=$model->create($_POST);
    	if($res){
    		$data=$model->add();
    		if($data){
    			$this->success("增加成功",U("Car/model"));
    		}else{	
    			$this->error("增加失败");
    		}
    	}else{
    		$this->error($res->getError()); 
    	}

    }


    public function del_model(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

    	$_POST['id']=intval($_POST['id']);
    	$model=M("e_zc_cars_model");
    	$res=$model->where("id={$_POST['id']}")->delete();
    	if($res){
    		$this->success("删除成功");
    	}else{
    		$this->error("删除失败");
    	}

    }


    public function modify_model(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

    	$brand=M("e_zc_cars_brand");
    	$data=$brand->select();
    	$this->assign("data",$data);

    	$model=M("e_zc_cars_model");
    	$data1=$model->where("id={$_GET['id']}")->find();
    	$this->assign("data1",$data1);
        $this->display();
    }

    public function do_modify_model(){
    	$_POST['name']=trim($_POST['name']);
    	if(empty($_POST['name'])){
    		$this->error("型号名不能为空");
    	}

    	if(!$_FILES['img_url']["error"]==4){

    		$upload = new \Think\Upload();// 实例化上传类    
	    	$upload->maxSize   =10485760 ;// 设置附件上传大小  10M  
	    	$upload->exts      =array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
	    	// 设置附件上传目录        
	    	$upload->rootPath  ='Public/';
	    	$upload->savePath = 'cars_pic/'; 
	    	$info   =   $upload->upload();// 上传文件     
	    	if(!$info) {
	    		// 上传错误提示错误信息        
	    		$this->error($upload->getError()); 

	    	}else{
	    		// 上传成功后 把组装好的图片地址覆盖掉     
	    		$_POST['img_url']="/Public/".$info['img_url']['savepath'].$info['img_url']['savename'];    	
	    	}

    	}

    	
    	$model=M('e_zc_cars_model');
    	$res=$model->create($_POST);
    	if($res){
    		$data=$model->save();
    		if($data){
				$car=M('e_zc_cars');
				$brand_id['brand_id']=$_POST['brand_id'];
				$model_id=$_POST['id'];
				$res_car=$car->where("model_id={$model_id}")->save($brand_id);
				$this->success('修改成功',U('Car/model'));
    			
    		}else{
    			$this->error("修改失败,没有任何信息被修改");
    		}	
    	}else{
    		$this->error($res->getError()); 
    	}


    }


    public function car(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

        $where=[];
        if(!empty($_GET['plate'])){
            $_GET['plate']=trim($_GET['plate']);
            $where['plate']=array("like","%{$_GET['plate']}%");
        }

        if(!empty($_GET['brand'])){
            $where['car.brand_id']=array("eq",$_GET['brand']);
        }

        if(!empty($_GET['model'])){
            $where['car.model_id']=array("eq",$_GET['model']);
        }

        if(!empty($_GET['station'])){
            $where['car.station_id']=array("eq",$_GET['station']);
        }



        $car=M("");

        $count= $car->table("e_zc_cars car,e_zc_cars_model model,e_zc_cars_brand brand,e_zc_station station")->where("car.brand_id=brand.id and car.station_id=station.id and car.model_id=model.id")->where($where)->count();// 查询满足要求的总记录数
        $page=new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show=$page->show();// 分页显示输出

        $data=$car->table("e_zc_cars car,e_zc_cars_model model,e_zc_cars_brand brand,e_zc_station station")->field("car.plate,car.id,car.price,car.add_time,model.name model,station.name station,brand.name brand")->where("car.brand_id=brand.id and car.station_id=station.id and car.model_id=model.id")->where($where)->limit($page->firstRow,$page->listRows)->select();

        $brand=$car->table("e_zc_cars_brand")->field("id,name")->select();
        $model=$car->table("e_zc_cars_model")->field("id,name")->select();
        $station=$car->table("e_zc_station")->field("id,name")->select();

        $this->assign("data",$data);
        $this->assign("brand",$brand);
        $this->assign("model",$model);
        $this->assign("station",$station);
        $this->assign("page",$show);
        $this->display();
    }


    public function del_car(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

        $car=M("e_zc_cars");
        $res=$car->where("id={$_POST['id']}")->delete();
        if($res){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }

    }

    public function add_car(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

        $car=M("");
        $brand=$car->table("e_zc_cars_brand")->field("id,name")->select();
        
        $station=$car->table("e_zc_station")->field("id,name")->select();

        $this->assign("station",$station);
        $this->assign("brand",$brand);
        
        $this->display();
    }
	
	//ajax
	public function brand_model(){
		$car=M("");
		$model=$car->table("e_zc_cars_model")->field("id,name")->where("brand_id={$_POST['id']}")->select();
		//echo $_POST['id'];
		echo json_encode($model,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		
	}

    public function do_add_car(){
        if(empty($_POST['brand_id'])){
            $this->error("请选择品牌");
        }

        if(empty($_POST['model_id'])){
            $this->error("请选择型号");
        }

        if(empty($_POST['station_id'])){
            $this->error("请选择站点");
        }

        if(empty(trim($_POST['plate']))){
            $this->error("请填写车辆的车牌号");
        }else{
            $_POST['plate']=trim($_POST['plate']);
        }

        if(empty(trim($_POST['price']))){
            $this->error("请填写每小时单价");
        }else{
            $_POST['price']=trim($_POST['price']);
        }
		
		if(empty(trim($_POST['capacity']))){
            $this->error("请填写乘坐人数");
        }else{
            $_POST['capacity']=trim($_POST['capacity']);
        }


        $_POST['add_time']=time();

        $car=M('e_zc_cars');
        $res=$car->create($_POST);
        if($res){

            $data=$car->add();
            if($data){
                $this->success("添加成功",U("Car/car"));
            }else{
                $this->error("添加失败");
            }

        }else{ 
            $this->error($res->getError());
        }



    }


    public function modify_car(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

        $car=M("");
        $brand=$car->table("e_zc_cars_brand")->field("id,name")->select();
        $model=$car->table("e_zc_cars_model")->field("id,name")->select();
        $station=$car->table("e_zc_station")->field("id,name")->select();
        $info=$car->table("e_zc_cars")->where("id={$_GET['id']}")->find();
        
        $this->assign("station",$station);
        $this->assign("brand",$brand);
        $this->assign("model",$model);
        $this->assign("info",$info);
        $this->display();
    }


    public function do_modify_car(){

        if(empty($_POST['plate'])){
            $this->error("请填写车牌号");
        }else{
            $_POST['plate']=trim($_POST['plate']);
        }

        if(empty($_POST['price'])){
            $this->error("请填写价格");
        }else{
            $_POST['price']=trim($_POST['price']);
        }

        
        $car=M("e_zc_cars");
        $res=$car->create();
        if($res){
            $data=$car->save();
            if($data){
                $this->success("添加成功",U("Car/car"));
            }else{
                $this->error("添加失败,没有值被修改");
            }
        }else{
            $this->error($res->getError());
        }

    }


    public function station(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

        $where=[];

        if(!empty($_GET['name'])){
            $where['name']=array("like","%{$_GET['name']}%");
        }

        if(!empty($_GET['phone'])){
            $where['phone']=array("like","%{$_GET['phone']}%");
        }

        if(!empty($_GET['address'])){
            $where['address']=array("like","%{$_GET['address']}%");
        }

        $station=M("e_zc_station");

        $count= $station->where($where)->count();// 查询满足要求的总记录数
        $page=new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show=$page->show();// 分页显示输出

        $data=$station->where($where)->limit($page->firstRow,$page->listRows)->select();
        $this->assign("data",$data);
        $this->assign("page",$show);
        $this->display();
        
    }


    public function del_station(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

        $_POST['id']=intval($_POST['id']);       
        $station=M("e_zc_station");
        $res=$station->where("id={$_POST['id']}")->delete();

        if($res){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }

    }

    public function add_station(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕

        $province=M("e_city");
        $data=$province->field("id,name")->where("parent_id=0")->select();
        $this->assign("data",$data);
        $this->display();
    }

    //处理的确选择ajax请求
    public function city(){
        $city=M('e_city');
        $data=$city->field("id,name")->where("parent_id={$_POST['id']}")->select();
        if($data){
            $this->ajaxReturn($data);
        }
    }
    //处理的确选择ajax请求
    public function county(){
        $city=M('e_city');
        $data=$city->field("id,name,guid")->where("parent_id={$_POST['id']}")->select();
        if($data){
            $this->ajaxReturn($data);
        }
    }

    public function do_add_station(){

        if(empty($_POST['province'])||empty($_POST['city'])||empty($_POST['county'])){
            $this->error("请选择位置信息");
        }

        if(empty(trim($_POST['name']))){
            $this->error("请填写站点名称");
        }else{
            $_POST['name']=trim($_POST['name']);
        }

        if(empty(trim($_POST['address']))){
            $this->error("请填写站点地址");
        }else{
            $_POST['address']=trim($_POST['address']);
        }

        if(empty(trim($_POST['phone']))){
            $this->error("请填写站点电话");
        }else{
            $_POST['phone']=trim($_POST['phone']);
        }


        if(empty(trim($_POST['lng']))){
            $this->error("请填写站点经度");
        }else{
            $_POST['lng']=trim($_POST['lng']);
        }


        if(empty(trim($_POST['lat']))){
            $this->error("请填写站点纬度");
        }else{
            $_POST['lat']=trim($_POST['lat']);
        }

        if(empty(trim($_POST['lat_min']))){
            $this->error("请填写完整围栏信息");
        }else{
            $_POST['lat_min']=trim($_POST['lat_min']);
        }

        if(empty(trim($_POST['lat_max']))){
            $this->error("请填写完整围栏信息");
        }else{
            $_POST['lat_max']=trim($_POST['lat_max']);
        }

        if(empty(trim($_POST['lng_max']))){
            $this->error("请填写完整围栏信息");
        }else{
            $_POST['lng_max']=trim($_POST['lng_max']);
        }

        if(empty(trim($_POST['lng_min']))){
            $this->error("请填写完整围栏信息");
        }else{
            $_POST['lng_min']=trim($_POST['lng_min']);
        }



        $station=M("e_zc_station");
        $res=$station->create();
        if($res){
            $data=$station->add();
            if($data){
                $this->success("添加成功",U("Car/station"));
            }else{
                $this->error("添加失败");
            }
        }else{
            $this->error($res->getError());
        }

        
    }


    public function modify_station(){
        //当前访问的权限（控制器和方法）
        $rule = CONTROLLER_NAME.'/'.ACTION_NAME;
        //实例化权限控制类
        $auth = new \Think\Auth();
        //验证权限
        if (!$auth->check($rule,$_SESSION['admininfo']['id'])) {  
            $this->error('您的账号没有此权限');
        } 
        //权限完毕
        
        $station=M("e_zc_station");
        $info=$station->where("id={$_GET['id']}")->find();
        $province=M("e_city");
        $data=$province->field("id,name")->where("parent_id=0")->select();
        $this->assign("data",$data);
        $this->assign("info",$info);

        $this->display();
    }

    public function do_modify_station(){
        if(!$_POST['check_area']){
            unset($_POST['province']);
            unset($_POST['city']);
            unset($_POST['county']);
        }else{

            if(empty($_POST['province'])||empty($_POST['city'])||empty($_POST['county'])){
                $this->error("请选择位置信息");
            }

        }

        if(empty(trim($_POST['name']))){
            $this->error("请填写站点名称");
        }else{
            $_POST['name']=trim($_POST['name']);
        }

        if(empty(trim($_POST['address']))){
            $this->error("请填写站点地址");
        }else{
            $_POST['address']=trim($_POST['address']);
        }

        if(empty(trim($_POST['phone']))){
            $this->error("请填写站点电话");
        }else{
            $_POST['phone']=trim($_POST['phone']);
        }


        if(empty(trim($_POST['lng']))){
            $this->error("请填写站点经度");
        }else{
            $_POST['lng']=trim($_POST['lng']);
        }


        if(empty(trim($_POST['lat']))){
            $this->error("请填写站点纬度");
        }else{
            $_POST['lat']=trim($_POST['lat']);
        }

        if(empty(trim($_POST['lat_min']))){
            $this->error("请填写完整围栏信息");
        }else{
            $_POST['lat_min']=trim($_POST['lat_min']);
        }

        if(empty(trim($_POST['lat_max']))){
            $this->error("请填写完整围栏信息");
        }else{
            $_POST['lat_max']=trim($_POST['lat_max']);
        }

        if(empty(trim($_POST['lng_max']))){
            $this->error("请填写完整围栏信息");
        }else{
            $_POST['lng_max']=trim($_POST['lng_max']);
        }

        if(empty(trim($_POST['lng_min']))){
            $this->error("请填写完整围栏信息");
        }else{
            $_POST['lng_min']=trim($_POST['lng_min']);
        }


        $station=M("e_zc_station");
        $res=$station->create();
        if($res){
            $info=$station->save();
            if($info){
                $this->success("修改成功",U("Car/station"));
            }else{
                $this->error("修改失败，没有任何信息被修改，请检查您修改前后的内容是否有变动");
            }
        }else{
            $this->error($res->getError());
        }


    }





}