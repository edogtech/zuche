<?php
namespace admin\Controller;
use Think\Controller;
class ParameterController extends Controller {
	//系统参数列表
	public function index(){
		$ob=M('e_zc_sysparameter');
		$field='*';
		//$map['flag']='price';//仅显示租车参数
		$map['flag']=array('EXP','is not null');
		
		if(!empty($_POST['caption'])){
			$caption=trim($_POST['caption']);
			$map['caption']=array('like',"%{$caption}%");
		}
		
		//取得总条数
		$count=$ob->where($map)->count();
		//根据总条数实例化page类
		$page= new \Think\Page($count,10);
		//分页显示输出
		$show= $page->show();
		//分页查询
		$list = $ob->field($field)->where($map)->limit($page->firstRow,$page->listRows)->order('id')->select();
		//echo $ob->getlastsql();
		$this->assign("lists",$list);
		$this->assign("show",$show);
    	$this->display();
	}
	
	//编辑系统参数存入数据库
	public function edit() {
		$ob=M('e_zc_sysparameter');

		$map['id']=$_POST['id'];
		$varValue=I('post.txtValue','','float');
		$desc=I('post.txtDesc','','trim');
		$varName=I('post.vars');
		
		if(empty($varValue)){
    		$this->error("请输入数字");
    	}else {
    		if ($varName=="price") {
    			$info['price']=$varValue;
    			M('e_zc_cars')->where('1=1')->save($info);
    			//echo M('e_zc_cars')->getlastsql();die;
    		}
    		$data['var_value']=$varValue;
    		$data['description']=$desc;
    		$data['add_time']=time();
    		$re=$ob->data($data)->where($map)->save();//更新系统参数
    		
    		if($re===false){
    			$this->error('系统参数更新失败');
    		}else{
    			$this->success('系统参数更新成功！','index');
    		}
    	}
	}

	/*编辑动态配置系统参数
	 * 现在可实现的方式：采用表单方式，列出所有参数；一个参数一个处理函数
	 * 待探讨方式：以列表方式，列出所有参数，html中无法取出指定参数值
	 */
// 	public function edit(){

		
// 		$deposit=I('post.txtValue','','float');

// 		if(empty($deposit)){
//     		$this->error("请输入数字");
//     	}else{
//     		$file_name=CONF_PATH."/setting.config.php";
    		
//     		$arr=C('SYS_PARAMETER');
//     		$arr_new=array('DEPOSIT'=>$deposit);
    		
//     		$c=array_merge($arr,$arr_new);
    		
//     		$settingstr="<?php \n return array(\n\t'SYS_PARAMETER' =>array(\n";
//     		foreach($c as $key=>$v){
//     			$settingstr.= "\t\t'".$key."'=>'".$v."',\n";
//     		}
//     		$settingstr.="\t),\n);\n";
    		
//     		file_put_contents($file_name,$settingstr); //通过file_put_contents保存setting.config.php文件；
    		
//     		//RUNTIME_FILE常量是入口文件中配置的runtimefile的路径及文件名；
//     		if(file_exists(RUNTIME_FILE)){
//     			unlink(RUNTIME_FILE); //删除RUNTIME_FILE;
//     		}
//     		//光删除runtime_file还不够，要清空一下Cache文件夹中的文件；代码如下：
//     		$cachedir=RUNTIME_PATH."/Cache/";   //Cache文件的路径；
//     		if ($dh = opendir($cachedir)) {     //打开Cache文件夹；
//     			while (($file = readdir($dh)) !== false) {    //遍历Cache目录，
//     				unlink($cachedir.$file);                //删除遍历到的每一个文件；
//     			}
//     			closedir($dh);
//     		}
//     	}
// 	}

	
	
}
