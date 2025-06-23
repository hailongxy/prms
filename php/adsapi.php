<?php
if($_GET['act'] == 'get_ad_data'){
	
	$user_array = json_decode($_GET["user_json"],true);
	$mission_array = json_decode($_GET["mission_json"],true);
	
	$url = '{"filters":[{"name":"appkey","op":"eq","val":"'.$_GET["appkey"].'"},{"name":"eventid","op":"eq","val":"'.$_GET["eventid"].'"},{"name":"pname","op":"eq","val":"tfinfo"},{"name":"dt","op":"ge","val":"'.$_GET["start_time"].'"},{"name":"dt","op":"le","val":"'.$_GET["end_time"].'"}]}';
	//print_r($url);
	$url = urlencode($url);
	$url = 'http://123.56.101.223/api_v1/eventparams?q='.$url;
	$result = json_decode(file_get_contents($url),true);
	if(!empty($result['objects'])){
		foreach($result['objects'] as $result_key => $result_value){
			$days_array=explode('|',$result_value['pvalue']);
			if(in_array($days_array[1],$user_array)&&in_array($days_array[0],$mission_array)){
				$result['objects'][$result_key]['mission_id'] = $days_array[0];	//投放id
				$result['objects'][$result_key]['mission_user_id'] = $days_array[1];	//投放人id
			}else{
				unset($result['objects'][$result_key]);	
			}
		}
	}
	echo	json_encode($result);
}else if($_GET['act'] == 'get_yesterday_ad_data'){
	$url = '{"filters":[{"name":"appkey","op":"eq","val":"'.$_GET["appkey"].'"},{"name":"eventid","op":"eq","val":"'.$_GET["eventid"].'"},{"name":"dt","op":"eq","val":"'.$_GET["yesterday"].'"}]}';
	$url = urlencode($url);
	$url = 'http://123.56.101.223/api_v1/events?q='.$url;
	$result = json_decode(file_get_contents($url),true);
	echo	json_encode($result);
}

?>