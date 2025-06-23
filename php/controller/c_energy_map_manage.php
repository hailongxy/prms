<?php	
include '../config.php';
if($_GET['act'] == 'get_energy_data'){
	
	$result = mysqli_query($con,"SELECT * FROM senior_topic where topicid = 0 and userid = '".$_SESSION['userid']."' order by createtime asc");
	$get_data = array();
	$temp_array = array();
	$result_array = array();
	while($row = mysqli_fetch_array($result)){	
	
		$result_array[] = $row;
	}
	
	$min_time_value = strtotime($result_array[0]['createtime']);
	$min_time_formate = date("Y-m-d",$min_time_value);
	$min_time_value = strtotime($min_time_formate.' 00:00:00');
	
	$max_time_value = strtotime('now');
	$temp_array = array();
	for($i = $min_time_value;$i <= $max_time_value; $i = $i + 24*60*60){
		$temp_array[$i.'000'] = 0;
	}
	
	foreach($result_array as $result_value){
		
		$time_value = strtotime($result_value['createtime']);
		$time_formate = date("Y-m-d",$time_value);
		$temp_array[strtotime($time_formate.' 00:00:00').'000'] += $result_value['value'];
	}
	foreach($temp_array as $temp_key => $temp_value){
		$get_data[] = array($temp_key,$temp_value);
	}
		
	echo str_replace('"','',json_encode($get_data));
	
}

mysqli_close($con);
?>