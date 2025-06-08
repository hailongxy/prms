<?php	include '../config.php';

function deldir($dir) {
  //先删除目录下的文件：
  $dh=opendir($dir);
  while ($file=readdir($dh)) {
    if($file!="." && $file!="..") {
      $fullpath=$dir."/".$file;
      if(!is_dir($fullpath)) {
          unlink($fullpath);
      } else {
          deldir($fullpath);
      }
    }
  }
 
  closedir($dh);
  //删除当前文件夹：
  if(rmdir($dir)) {
    return true;
  } else {
    return false;
  }
}

if($_GET['act'] == 'add_save'){
	if (!file_exists('../upload1/server/php/'.$_POST['add_content'])){
		mkdir ('../upload1/server/php/'.$_POST['add_content']); 
	}else{
		die('需创建的文件夹'.$_POST['add_content'].'已经存在');
	}
	$sql="INSERT INTO folder (title,content,createtime,userid) VALUES ('".$_POST['add_title']."','".$_POST['add_content']."',NOW(),'".$_SESSION['userid']."')";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'pre_update'){
	$sql = mysqli_query($con,"SELECT * FROM folder WHERE id ='".$_POST['id']."' and userid = '".$_SESSION['userid']."'");
	
	$row = mysqli_fetch_array($sql);
	
	echo json_encode($row);
}else if($_GET['act'] == 'update_save'){
	if(!rename('../upload1/server/php/'.$_POST['pre_content'],'../upload1/server/php/'.$_POST['update_content'])){ 
		die("更名失败"); 
	} 
	
	$sql="UPDATE folder SET title = '".$_POST['update_title']."',content = '".$_POST['update_content']."' WHERE id = '".$_POST['id']."' and userid = '".$_SESSION['userid']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}else if($_GET['act'] == 'delete'){
	if(!deldir('../upload1/server/php/'.$_POST['content'])){
		die("删除失败"); 
	}
	$sql="DELETE FROM folder WHERE id='".$_POST['id']."'";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	echo 1;
}
mysqli_close($con);
?>