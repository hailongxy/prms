<?php

use App\Console\Commands\ExportDB;

include '../config.php';
if($_GET['act'] == 'login'){
	$username = $_POST['username'] ?? "";
	$password = md5(md5($_POST['password'] ?? ""));
	$result = mysqli_query($con,"SELECT * FROM user where username = '".$username."' and password = '".$password."'");
	// print_r($result);
	// die;
	if($row = mysqli_fetch_array($result)){
		$_SESSION['username'] = $row['username'] ?? "";
		$_SESSION['password'] = $row['password'] ?? "";
		$_SESSION['userid'] = $row['id'] ?? "";
		$_SESSION['usertype'] = $row['user_type'] ?? "";
		$_SESSION['email'] = $row['email'] ?? "";
		echo	1;
	}else{
		echo	0;
	}
	die;
}else if($_GET['act'] == 'register'){
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5(md5($_POST['password']));
	
	$result = mysqli_query($con,"SELECT * FROM user where username = '".$username."'");
	if($row = mysqli_fetch_array($result)){	
		$return_array = array('error'=>'1','msg'=>'用户名不能重复');
		echo	json_encode($return_array);
		exit;
	}

	$result = mysqli_query($con,"SELECT * FROM user where email = '".$email."'");
	if($row = mysqli_fetch_array($result)){	
		$return_array = array('error'=>'1','msg'=>'邮箱不能重复');
		echo	json_encode($return_array);
		exit;
	}
	
	$sql="INSERT INTO user (username,password,email,user_type,createtime,last_login_time) VALUES ('".$username."','".$password."','".$email."','普通用户',NOW(),NOW())";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	$return_array = array('error'=>'0','msg'=>'注册成功');
	echo	json_encode($return_array);
	exit;
	
}else if($_GET['act'] == 'save_profile'){
	$username = $_POST['username'];
	$email = $_POST['email'];
	
	$result = mysqli_query($con,"SELECT * FROM user where username = '".$username."' and id != '".$_SESSION['userid']."'");
	if($row = mysqli_fetch_array($result)){	
		$return_array = array('error'=>'1','msg'=>'用户名不能重复');
		echo	json_encode($return_array);
		exit;
	}

	$result = mysqli_query($con,"SELECT * FROM user where email = '".$email."' and id != '".$_SESSION['userid']."'");
	if($row = mysqli_fetch_array($result)){	
		$return_array = array('error'=>'1','msg'=>'邮箱不能重复');
		echo	json_encode($return_array);
		exit;
	}
	
	$sql="UPDATE user SET username = '".$username."',email = '".$email."' WHERE id = '".$_SESSION['userid']."'";
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
	
	$_SESSION['username'] = $username;
	$_SESSION['email'] = $email;
	
	if($_POST['password'] != ''){
		$password = md5(md5($_POST['password']));
		$sql="UPDATE user SET password = '".$password."' WHERE id = '".$_SESSION['userid']."'";
		if(!mysqli_query($con,$sql)){
			die('Error: ' . mysqli_error($con));
		}
	}
		
	$return_array = array('error'=>'0','msg'=>'修改成功');
	echo	json_encode($return_array);
	exit;
	
}else if($_GET['act'] == 'logout'){
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		
		unset($_SESSION['userid']);
		unset($_SESSION['usertype']);
		unset($_SESSION['email']);
		
		echo	1;
}

?>