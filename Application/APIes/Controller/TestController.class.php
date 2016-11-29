<?php
namespace APIes\Controller;
use Think\Controller;
class TestController extends Controller {
	public function index(){
		$this->display();
	}
	//我的租车信息
	public function testpost() {
		
		$user=I('post.user');
		$name=I('post.name');
		
		$return['user']=$user;
		$return['name']=$name;
		
		$log_filename = "Test/log.txt";
		echo $name;
		
		$str = ob_get_contents();
		ob_end_clean();
		
		file_put_contents ( $log_filename, date ( 'H:i:s' ) . " " . $str . "\r\n", FILE_APPEND );
		echo urldecode(json_encode(url_encode($return)));
	}
	
}