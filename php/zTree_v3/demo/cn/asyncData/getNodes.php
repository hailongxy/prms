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

//for ($i=1; $i<9999; $i++) {
//	for ($j=1; $j<999; $j++) {
//
//	}
//}
/*
for ($i=1; $i<5; $i++) {
	$nId = $pId.$i;
	$nName = $pName."n".$i;
	echo "{ id:'".$nId."',	name:'".$nName."',	isParent:".(( $pLevel < "2" && ($i%2)!=0)?"true":"false").($pCheck==""?"":((($pLevel < "2" && ($i%2)!=0)?", halfCheck:true":"").($i==3?", checked:true":"")))."}";
	if ($i<4) {
		echo ",";
	}
}
*/	include 'config.php';$sql = mysqli_query($con,"SELECT * FROM knowledge where parent_id = '".$pId."'");
	
	while($row = mysqli_fetch_array($sql)){
		
		$sub_sql = mysqli_query($con,"SELECT * FROM knowledge where parent_id = '".$row['id']."'");
				
		if(!mysqli_num_rows($sub_sql)){
			echo "{ id:'".$row['id']."',	name:'".$row['title']."',	isParent:false}";
		}else{
			echo "{ id:'".$row['id']."',	name:'".$row['title']."',	isParent:true}";
		}
		
		echo ",";
	}
	//echo json_encode($row);
	
	mysqli_close($con);

?>]
