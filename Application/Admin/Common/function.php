<?php

/**
 * 判断变量是否为空
 * @param mixed $var 变量
 * @return true/false
 */
function is_empty($var, $allow_false = false, $allow_ws = false) {
	if (!isset($var) || is_null($var) || ($allow_ws == false && trim($var) == "" && !is_bool($var)) || ($allow_false === false && is_bool($var) && $var === false) || (is_array($var) && empty($var))) {  
		return true;
	} else {
		return false;
	}
}

//时间戳转换为天-时-分-秒
function second_to_date($startdate,$enddate){
	$time['day']=floor(($enddate-$startdate)/86400);
	$time['hour']=floor(($enddate-$startdate)%86400/3600);
	$time['minute']=floor(($enddate-$startdate)%86400%3600/60);
	$time['second']=floor(($enddate-$startdate)%86400%60);
	return $time;
}



/* 导出excel函数*/
 function exportExcel($data,$name='export'){
 	require_once 'Public/PHPExcel_1.8.0/Classes/PHPExcel.php';
	error_reporting(E_ALL);
	$head="ABCDEFGHIJKLMNOPQRSTUVWXYZ";

	$objPHPExcel = new \PHPExcel();

	// set attribute
	$objPHPExcel->getProperties()->setCreator("EDog")
	->setLastModifiedBy("EDog")
	->setTitle("EDog")
	->setSubject("EDog")
	->setDescription("This is file export by EDog")
	->setKeywords("excel")
	->setCategory("result file");

	// set width
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);

	//设置excel列名
	//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1','编号');
	//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1','车牌');
	//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1','车辆图片');

	foreach(array_keys($data[0]) as $k=>$v){
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($head[$k].'1',$v);
	}

	for ($i = 0, $len = count($data); $i < $len; $i++) {
		// $objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 2), $data[$i]['id']);
		// $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 2), $data[$i]['plate']);
		// $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 2), $data[$i]['picture']);
		foreach(array_keys($data[0]) as $k=>$v){
			$objPHPExcel->getActiveSheet(0)->setCellValue($head[$k].($i + 2), $data[$i][$v]);
		}

	}

	// Set active sheet index to the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	// 输出
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$name.'.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
}