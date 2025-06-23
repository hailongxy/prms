<?php	
include '../config.php';
if($_GET['act'] == 'add_save'){
	
	//mysqli_begin_transaction($con);            // 开始事务定义
	
	$sql="INSERT INTO special_diagram (title,status,content,createtime,diagramid,userid) VALUES ('".$_POST['add_title']."','".($_POST['add_status']??"")."','".$_POST['add_content']."',NOW(),'".$_POST['diagramid']."','".$_SESSION['userid']."')";
	
	if(!mysqli_query($con,$sql)){
		mysqli_query($con, "ROLLBACK");     // 判断当执行失败时回滚
	}
	//mysqli_commit($con);            //执行事务
	echo 1;
}else if($_GET['act'] == 'pre_update'){
	
	$sql = mysqli_query($con,"SELECT * FROM special_diagram WHERE id ='".$_POST['id']."' and userid = '".$_SESSION['userid']."'");
	
	$row = mysqli_fetch_array($sql);
	
	echo json_encode($row);
}else if($_GET['act'] == 'update_save'){
	$updateStatus = $_POST['update_status'] ?? "";
	$sql="UPDATE special_diagram SET title = '".$_POST['update_title']."',status = '".$updateStatus."',content = '".$_POST['update_content']."' WHERE id = '".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'delete'){
	
	$sql="DELETE FROM special_diagram WHERE id='".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}

mysqli_close($con);
?>