<?php
$topic_menu = array(
    '57' => 'FF科学家法',
    '56' => '中心论',
    '55' => '平衡论',
    '54' => '芳芳论',
    '16' => '错误专题',
    '53' => '个人网站专题',
    '52' => '疏忽挽救生存方法——方法论——FF讨论法',
    '51' => 'Girl Friend专题',
    '4' => '机器人开发专题',
    '50' => '人性专题',
    '49' => '状态专题',
    '48' => '任务专题',
    '47' => '话题专题',
    '46' => '工作政治学习专题',
    '45' => '工作学习专题',
    '44' => '新工作专题',
    '43' => '非常时期专题',
    '42' => '战斗力专题',
    '41' => 'FF代替法',
    '39' => 'FFJR法',
    '40' => '心态专题',
    '37' => 'FFMR法',
    '38' => '工作学习专题',
    '36' => '文章专题',
    '35' => '心理学专题',
    '34' => '对话专题',
    '33' => '心理调节专题',
    '32' => 'YX塑造法专题',
    '31' => '本能探讨专题',
    '30' => '生存方法专题',
    '29' => '问题——解决方案专题',
    '0' => '甲沟炎专题',
    '1' => 'SHQQSZ专题',
    '3' => '口才专题',
    '5' => '学习专题',
    '6' => '工作专题',
    '7' => '不死专题',
    '8' => '突破宇宙专题',
    '9' => '粒子微小化专题',
    '11' => '健康专题',
    '12' => '父母专题',
    '14' => '快乐专题',
    '15' => '正确专题',

    '17' => 'XF专题',
    '18' => '生活中的美',
    '19' => '得专题',
    '20' => '失专题',
    '21' => '心得专题',
    '22' => '超越专题',
    '23' => '做到专题',
    '24' => '没做到专题',
    '25' => '感动自己专题',
    '26' => 'fangfang2专题',
    '27' => '烦恼专题',
);
$con = mysqli_connect("localhost:3306","edusoho_root","9YHUyFL2V7c2hGPA","prms");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
mysqli_query($con, "set names utf8");

foreach($topic_menu as $key => $value){
	$sql="INSERT INTO topic_control (id,title,content,createtime) VALUES ('".$key."','".$value."','',NOW())";
	
	if(!mysqli_query($con,$sql)){
		die('Error: ' . mysqli_error($con));
	}
}

?>