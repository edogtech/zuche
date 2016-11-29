<?php
namespace Admin\Controller;
use Think\Controller;
require_once 'Public/PHPExcel_1.8.0/Classes/PHPExcel.php';

class ExcelExportController extends Controller {
	public function index(){
		$data= M('e_zc_cars')->field('id,plate,picture')->select();   //查出数据
		$name='Excelfile';    //生成的Excel文件文件名
		excel($data,$name);
	}

	
}
