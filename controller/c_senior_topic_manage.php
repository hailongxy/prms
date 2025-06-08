<?php	
include '../config.php';
if($_GET['act'] == 'add_save'){
		
		$sql="INSERT INTO senior_topic (title,value,content,createtime,topicid,userid) VALUES ('".$_POST['add_title']."','".$_POST['add_value']."','".$_POST['add_content']."',NOW(),'".$_POST['topicid']."','".$_SESSION['userid']."')";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'pre_update'){
	
	$sql = mysqli_query($con,"SELECT * FROM senior_topic WHERE id ='".$_POST['id']."' and userid = '".$_SESSION['userid']."'");
	
	$row = mysqli_fetch_array($sql);
	
	echo json_encode($row);
}else if($_GET['act'] == 'update_save'){
			
	$sql="UPDATE senior_topic SET title = '".$_POST['update_title']."',value = '".$_POST['update_value']."',content = '".$_POST['update_content']."' WHERE id = '".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'delete'){
	
	$sql="DELETE FROM senior_topic WHERE id='".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}
mysqli_close($con);
?>