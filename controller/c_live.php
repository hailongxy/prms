<?php

include '../config.php';

if($_GET['act'] == 'add_save'){
	
	$sql="INSERT INTO live (title,parent_id,createtime,userid) VALUES ('新生命','".$_POST['add_parent_id']."',NOW(),'".$_SESSION['userid']."')";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
	
}else if($_GET['act'] == 'add_top_save'){
		
	$sql="INSERT INTO live (title,parent_id,createtime,userid) VALUES ('新生命','0',NOW(),'".$_SESSION['userid']."')";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;			
	
}else if($_GET['act'] == 'pre_update'){
	
	$sql = mysqli_query($con,"SELECT * FROM live WHERE id ='".$_POST['id']."' and userid = '".$_SESSION['userid']."'");
	
	$row = mysqli_fetch_array($sql);
	
	echo json_encode($row);
}else if($_GET['act'] == 'update_save'){
	
	
	$sql="UPDATE live SET metric = '".$_POST['update_metric']."',content = '".$_POST['update_content']."' WHERE id = '".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'update_name_save'){
	
	
	$sql="UPDATE live SET title = '".$_POST['name']."' WHERE id = '".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'update_parent_id_save'){
	
	
	$sql="UPDATE live SET parent_id = '".$_POST['parent_id']."' WHERE id = '".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'delete'){
	
	$sql="DELETE FROM live WHERE id='".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}
mysqli_close($con);
?>