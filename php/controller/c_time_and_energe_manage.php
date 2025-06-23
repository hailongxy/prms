<?php	
include '../config.php';
if($_GET['act'] == 'add_save'){
		
	$sql="INSERT INTO time_and_energe (work_title,work_time,man,study_title,study_time,normal_title,normal_time,createtime,content,point,control,userid) VALUES ('".$_POST['add_work_title']."','".$_POST['add_work_time']."','".$_POST['add_man']."','".$_POST['add_study_title']."','".$_POST['add_study_time']."','".$_POST['add_normal_title']."','".$_POST['add_normal_time']."','".$_POST['add_createtime']."','".$_POST['add_content']."','".$_POST['add_point']."','".$_POST['add_control']."','".$_SESSION['userid']."')";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'pre_update'){
	
	$sql = mysqli_query($con,"SELECT * FROM time_and_energe WHERE id ='".$_POST['id']."' and userid = '".$_SESSION['userid']."'");
	
	$row = mysqli_fetch_array($sql);
	
	echo json_encode($row);
}else if($_GET['act'] == 'update_save'){
	$sql="UPDATE time_and_energe SET createtime = '".$_POST['update_createtime']."',work_title = '".$_POST['update_work_title']."',work_time = '".$_POST['update_work_time']."',man = '".$_POST['update_man']."',study_title = '".$_POST['update_study_title']."',study_time = '".$_POST['update_study_time']."',normal_title = '".$_POST['update_normal_title']."',normal_time = '".$_POST['update_normal_time']."',content = '".$_POST['update_content']."',point = '".$_POST['update_point']."',control = '".$_POST['update_control']."' WHERE id = '".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
	
}else if($_GET['act'] == 'back_update'){
	$sql="UPDATE time_and_energe SET back = back + 1 WHERE id = '".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
	
}else if($_GET['act'] == 'delete'){
	
	$sql="DELETE FROM time_and_energe WHERE id='".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}
	
mysqli_close($con);
?>