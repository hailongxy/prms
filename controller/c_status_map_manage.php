<?php	include '../config.php';
if($_GET['act'] == 'get_status_data'){
	
	$result = mysqli_query($con,"SELECT * FROM time_and_energe where userid = '".$_SESSION['userid']."'");
	$status_data = array();
	while($row = mysqli_fetch_array($result)){	
	
		$status_data[] = array(strtotime($row['createtime']).'000',$row['point']);
	
	}
		
	echo str_replace('"','',json_encode($status_data));
	
}

mysqli_close($con);
?>