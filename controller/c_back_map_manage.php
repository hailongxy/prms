<?php	include '../config.php';
	if($_GET['act'] == 'get_back_data'){
		
		
		$result = mysqli_query($con,"SELECT * FROM time_and_energe");
		
		//$row = mysqli_fetch_array($sql);
		//print_r($row);
		//foreach($row as $key =>$value){
			//print_r($value['point']);
		//}
		$status_data = array();
		while($row = mysqli_fetch_array($result)){	
		
			$status_data[] = array(strtotime($row['createtime']).'000',$row['back']);
		
		}
			
		echo str_replace('"','',json_encode($status_data));
		
	}
	
	
	
		mysqli_close($con);
?>