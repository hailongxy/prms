<?php	
include '../config.php';
if($_GET['act'] == 'add_save'){
	
	//mysqli_begin_transaction($con);            // 开始事务定义
	
	$sql="INSERT INTO special_topic (title,status,content,createtime,topicid,userid) VALUES ('".$_POST['add_title']."','".$_POST['add_status']."','".$_POST['add_content']."',NOW(),'".$_POST['topicid']."','".$_SESSION['userid']."')";
	
	if(!mysqli_query($con,$sql)){
		mysqli_query($con, "ROLLBACK");     // 判断当执行失败时回滚
	}
	//mysqli_commit($con);            //执行事务
	echo 1;
}else if($_GET['act'] == 'pre_update'){
	
	$sql = mysqli_query($con,"SELECT * FROM special_topic WHERE id ='".$_POST['id']."' and userid = '".$_SESSION['userid']."'");
	
	$row = mysqli_fetch_array($sql);
	
	echo json_encode($row);
}else if($_GET['act'] == 'update_save'){
			
	$sql="UPDATE special_topic SET title = '".$_POST['update_title']."',status = '".$_POST['update_status']."',content = '".$_POST['update_content']."' WHERE id = '".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'delete'){
	
	$sql="DELETE FROM special_topic WHERE id='".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}

mysqli_close($con);
?>