<?php
//图片url路径 变成 数据库路径
function url2Path($image){
	return preg_replace('/(^.*\/Uploads)/isU','./Uploads',$image);
}

//转换图片路径
function img2Path($image){//图片转换成完整的 url路径
    $content=str_replace(
			array(
				'../',
				'src="/',
				'href="/',
				'./Uploads',
				'/Public',
				'.http://',
			),
			array(
				WEBURL.'/',//有 “/”
				'src="'.WEBURL.'/',
				'href="'.WEBURL.'/',
				WEBURL.'/'.'Uploads',
				WEBURL.'/'.'Public',
				'http://',
			),
			$image
		);
	return $content;
}

function url_encode($str) {
	if(is_array($str)) {
		foreach($str as $key=>$value) {
			$str[urlencode($key)] = url_encode($value);
		}
	} else {
		$str = urlencode($str);
	}

	return $str;
}

/*
*时间戳转换为天-时-分-秒,此处返回字符串
*/
function second_to_date($startdate,$enddate){
	$time['day']=floor(($enddate-$startdate)/86400);
	$time['hour']=floor(($enddate-$startdate)%86400/3600);
	$time['minute']=floor(($enddate-$startdate)%86400%3600/60);
	$time['second']=floor(($enddate-$startdate)%86400%60);
	$result=$time['day'].'天'.$time['hour'].'小时'.$time['minute'].'分'.$time['second'].'秒';
	return $result;
}
/*
*时间戳转换为天-时-分-秒数组
*/
function timestap_to_array($startdate,$enddate){
	$time['day']=floor(($enddate-$startdate)/86400);
	$time['hour']=floor(($enddate-$startdate)%86400/3600);
	$time['minute']=floor(($enddate-$startdate)%86400%3600/60);
	$time['second']=floor(($enddate-$startdate)%86400%60);
	return $time;
}

//记录ali支付自定义日志
function logger($word='') {
	date_default_timezone_set("PRC");
	$fp = fopen("AliPay/alipay_seldefined_log.txt","a");
	flock($fp, LOCK_EX) ;
	fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\r\n".$word."\r\n");
	flock($fp, LOCK_UN);
	fclose($fp);
}

function get_current_microtimestamp(){
	$time = explode ( " ", microtime () );
	$time = $time [1] . ($time [0] * 1000);
	$time2 = explode ( ".", $time );
	$TimeStamp = $time2 [0];
	return $TimeStamp;
}
