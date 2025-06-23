<?php ?>
[<?php
$pId = "0";
$pName = "";
$pLevel = "";
$pCheck = "";
if(array_key_exists( 'id',$_REQUEST)) {
	$pId=$_REQUEST['id'];	//id
}
if(array_key_exists( 'lv',$_REQUEST)) {
	$pLevel=$_REQUEST['lv'];	//级别
}
if(array_key_exists('n',$_REQUEST)) {
	$pName=$_REQUEST['n'];
}
if(array_key_exists('chk',$_REQUEST)) {
	$pCheck=$_REQUEST['chk'];	//检测
}
if ($pId==null || $pId=="") $pId = "0";
if ($pLevel==null || $pLevel=="") $pLevel = "0";
if ($pName==null) $pName = "";	//名称
else $pName = $pName.".";

include '../config.php';
$sql = mysqli_query($con,"SELECT * FROM knowledge where parent_id = '".$pId."' and userid = '".$_SESSION['userid']."'");

while($row = mysqli_fetch_array($sql)){
	
	$sub_sql = mysqli_query($con,"SELECT * FROM knowledge where parent_id = '".$row['id']."' and userid = '".$_SESSION['userid']."'");
			
	if(!mysqli_num_rows($sub_sql)){
		echo "{ id:'".$row['id']."',	name:'".$row['title']."_".$row['metric']."',	isParent:false}";
	}else{
		echo "{ id:'".$row['id']."',	name:'".$row['title']."_".$row['metric']."',	isParent:true}";
	}
	
	echo ",";
}

mysqli_close($con);

?>]
