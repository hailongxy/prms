<?php	
include '../config.php';
if($_GET['act'] == 'add_save'){
	
	$sql="INSERT INTO difficult (title,content,createtime,userid) VALUES ('".$_POST['add_title']."','".$_POST['add_content']."',NOW(),'".$_SESSION['userid']."')";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'pre_update'){
	
	$sql = mysqli_query($con,"SELECT * FROM difficult WHERE id ='".$_POST['id']."' and userid = '".$_SESSION['userid']."'");
	
	$row = mysqli_fetch_array($sql);
	
	echo json_encode($row);
}else if($_GET['act'] == 'update_save'){
	/*
	$param = $_POST;
	$param['userid'] = $_SESSION['userid'];

	$queueResult = shell_exec('php /opt/htdocs/php-resque/demo/prmsQueue.php Prms_Job '.urlencode(json_encode($param)).'');		//调用消息队列接口，入队
	
	$jobId = str_replace('Queued job ','',$queueResult);
	
	$resqueResult = shell_exec('QUEUE=default php /opt/htdocs/php-resque/demo/prmsResque.php  > /dev/null 2>&1 &');		//执行队列
	
	$statusResult = shell_exec('php /opt/htdocs/php-resque/demo/prms_check_status.php '.$jobId.' > /dev/null 2>&1 &');		//查看队列执行情况
	*/

	$sql="UPDATE difficult SET title = '".$_POST['update_title']."',content = '".$_POST['update_content']."' WHERE id = '".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}

	
	echo 1;
}else if($_GET['act'] == 'delete'){
	
	$sql="DELETE FROM difficult WHERE id='".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}
mysqli_close($con);
?>