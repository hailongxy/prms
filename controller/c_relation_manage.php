<?php	
include '../config.php';
if($_GET['act'] == 'add_save'){
	
	$sql="INSERT INTO relation (name,rel_type,relation_status,content,createtime,userid) VALUES ('".$_POST['add_name']."','".$_POST['add_rel_type']."','".$_POST['add_relation_status']."','".$_POST['add_content']."',NOW(),'".$_SESSION['userid']."')";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'pre_update'){
	
	$sql = mysqli_query($con,"SELECT * FROM relation WHERE id ='".$_POST['id']."' and userid = '".$_SESSION['userid']."'");
	
	$row = mysqli_fetch_array($sql);
	
	echo json_encode($row);
}else if($_GET['act'] == 'update_save'){
			
	$sql="UPDATE relation SET name = '".$_POST['update_name']."',rel_type = '".$_POST['update_rel_type']."',relation_status = '".$_POST['update_relation_status']."',content = '".$_POST['update_content']."' WHERE id = '".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'delete'){
	
	$sql="DELETE FROM relation WHERE id='".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}
mysqli_close($con);
?>