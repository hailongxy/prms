<?php	
include '../config.php';

if($_GET['act'] == 'add_save'){
	$sql="INSERT INTO image (title,url,folder,createtime,userid) VALUES ('".$_POST['title']."','".$_POST['image_url']."','".$_POST['folder']."',NOW(),'".$_SESSION['userid']."')";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'delete'){
	
	$url_array = explode('/upload1/server/php/',$_POST['image_url']);
	
	$url = $url_array[1];
	
	$sql="DELETE FROM image WHERE url='".$url."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	unlink(dirname(dirname(__FILE__)).'/upload1/server/php/'.$url);	//删除图片文件
	echo 1;
}

mysqli_close($con);
?>