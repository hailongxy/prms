<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<script type="text/javascript">
    var _speedMark = new Date();
</script>

<head>

	<meta charset="utf-8" />

	<title>个人资源管理系统</title>

	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

		<meta content="个人资源管理系统，信息化世界，对个人资源进行管理，能够让您运筹帷幄，决胜疆场" name="description" />
	<meta name="Keywords" content="个人资源管理系统,prms，personal resource manage system,个人资源管理,资源管理,个人,信息化,战略,伍海龙">	


	<meta content="伍海龙" name="author" />

	<!-- BEGIN GLOBAL MANDATORY STYLES -->

	<link href="media/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

	<link href="media/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

	<link href="media/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<link href="media/css/style-metro.css" rel="stylesheet" type="text/css"/>

	<link href="media/css/style.css" rel="stylesheet" type="text/css"/>

	<link href="media/css/style-responsive.css" rel="stylesheet" type="text/css"/>

	<link href="media/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>

	<link href="media/css/uniform.default.css" rel="stylesheet" type="text/css"/>

	<!-- END GLOBAL MANDATORY STYLES -->

	<!-- BEGIN PAGE LEVEL STYLES -->

	<link rel="stylesheet" type="text/css" href="media/css/select2_metro.css" />

	<link rel="stylesheet" href="media/css/DT_bootstrap.css" />

	<!-- END PAGE LEVEL STYLES -->

	<link rel="shortcut icon" href="media/image/favicon.ico" />
	<style type="text/css">
	.page-content {
		background:url(images/new_images/4436663_095951336812_2.jpg) repeat !important; 
		background-size:cover !important;
	}
    </style>

    <link rel="stylesheet" href="public/css/common.css" />

		<!--
		<link rel="stylesheet" href="./kindeditor/themes/default/default.css" />
		<script charset="utf-8" src="./kindeditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="./kindeditor/lang/zh_CN.js"></script>
		-->

		<script type="text/javascript" charset="utf-8" src="./ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="./ueditor/ueditor.all.min.js"> </script>
        <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
        <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
        <script type="text/javascript" charset="utf-8" src="./ueditor/lang/zh-cn/zh-cn.js"></script>

		<!--<script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "//hm.baidu.com/hm.js?93726903dc7aff7179fe840117eebb42";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>-->	<!--百度统计-->
        
<!-- start Dplus --><!--<script type="text/javascript">!function(a,b){if(!b.__SV){var c,d,e,f;window.dplus=b,b._i=[],b.init=function(a,c,d){function g(a,b){var c=b.split(".");2==c.length&&(a=a[c[0]],b=c[1]),a[b]=function(){a.push([b].concat(Array.prototype.slice.call(arguments,0)))}}var h=b;for("undefined"!=typeof d?h=b[d]=[]:d="dplus",h.people=h.people||[],h.toString=function(a){var b="dplus";return"dplus"!==d&&(b+="."+d),a||(b+=" (stub)"),b},h.people.toString=function(){return h.toString(1)+".people (stub)"},e="disable track track_links track_forms register unregister get_property identify clear set_config get_config get_distinct_id track_pageview register_once track_with_tag time_event people.set people.unset people.delete_user".split(" "),f=0;f<e.length;f++)g(h,e[f]);b._i.push([a,c,d])},b.__SV=1.1,c=a.createElement("script"),c.type="text/javascript",c.charset="utf-8",c.async=!0,c.src="//w.cnzz.com/dplus.php?token=871698826a2a1fbe7fbe",d=a.getElementsByTagName("script")[0],d.parentNode.insertBefore(c,d)}}(document,window.dplus||[]),dplus.init("871698826a2a1fbe7fbe");</script>--><!-- end Dplus -->	<!--udplus统计-->
        

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed">

<script language="JavaScript" type="text/javascript"> 
function setCookie(c_name,value,expiredays)  
{  
    var exdate=new Date();  
    exdate.setDate(exdate.getDate()+expiredays)  
    document.cookie=c_name+ "=" +escape(value)+  
    ((expiredays==null) ? "" : "; expires="+exdate.toGMTString());  
}
setCookie('zhujiwusysdomain','ftp341091.host510.zhujiwu.me',null);  
</script>

<?php
	include 'config.php';
	$login_url = "login.php";

    //$_SESSION['a'] = 1;
	//print_r($_SESSION);die;

	if(isset($_SESSION['username'])&&isset($_SESSION['password'])){
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		$result = mysqli_query($con,"SELECT * FROM user where username = '".$username."' and password = '".$password."'");
		if($row = mysqli_fetch_array($result)){	
			$_SESSION['username'] = $row['username'];
			$_SESSION['password'] = $row['password'];
		}else{
			echo "<script language='javascript' 
			type='text/javascript'>";  
			echo "window.location.href='$login_url'";
			echo "</script>"; 	
		}
	}else{
		echo "<script language='javascript' 
		type='text/javascript'>";  
		echo "window.location.href='$login_url'";
		echo "</script>"; 	
	}
	//print_r($_SESSION);
?>

<div class="header navbar navbar-inverse navbar-fixed-top">

		<!-- BEGIN TOP NAVIGATION BAR -->

		<div class="navbar-inner">

			<div class="container-fluid">

				<!-- BEGIN LOGO -->

				<a class="brand" href="index.php" style="color:#FFF; margin-left:5px;">

				个人资源管理系统

				</a>

				<!-- END LOGO -->

				<!-- BEGIN RESPONSIVE MENU TOGGLER -->

				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

				<img src="media/image/menu-toggler.png" alt="" />

				</a>          

				<!-- END RESPONSIVE MENU TOGGLER -->            

				<!-- BEGIN TOP NAVIGATION MENU -->              

				

				<!-- END TOP NAVIGATION MENU --> 
                
                
                <a href="index.php"  style="line-height:42px; color:#FFF; cursor:pointer">主菜单</a>
                <a href="topic_control_manage.php" style="line-height:42px; color:#FFF; cursor:pointer">专题中心</a>
                <a href="mind_control_manage.php" style="line-height:42px; color:#FFF; cursor:pointer">思维导图中心</a>
                <a href="diagram_control_manage.php" style="line-height:42px; color:#FFF; cursor:pointer">结构图中心</a>
                <?php
                if(!empty($topic_menu)){
				?>
<!--                <a href="special_topic_map_manage.php?menu_type=topic_map&topicid=1" style="line-height:42px; color:#FFF; cursor:pointer">专题图表中心</a>-->
                <?php
				}
				?>
                <?php
                if($_SESSION['usertype'] == '管理员'){
				?>
                <a href="senior_topic_manage.php?menu_type=senior_topic&topicid=0" style="line-height:42px; color:#FFF; cursor:pointer">高级专题</a>
                <a href="/react/list/knowledge-category-list" style="line-height:42px; color:#FFF; cursor:pointer">知识管理</a>
                    <!--                <a href="status_map_manage.php?menu_type=map" style="line-height:42px; color:#FFF; cursor:pointer">图表中心</a>-->
<!--                <a href="map_topic_manage.php?menu_type=flow&topicid=0" style="line-height:42px; color:#FFF; cursor:pointer">流程图</a>-->
                <?php
				}
				?>
<ul class="nav pull-right">

					<!-- BEGIN NOTIFICATION DROPDOWN -->   

					

					<!-- END NOTIFICATION DROPDOWN -->

					<!-- BEGIN INBOX DROPDOWN -->

					

					<!-- END INBOX DROPDOWN -->

					<!-- BEGIN TODO DROPDOWN -->

					

					<!-- END TODO DROPDOWN -->

					<!-- BEGIN USER LOGIN DROPDOWN -->

					<li class="dropdown user">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

						
<img width="29px" height="29px" alt="" src="media/image/elementary_school.png">						<span class="username"><?php	echo	$_SESSION['username'];	?></span>

						<i class="icon-angle-down"></i>

						</a>

						<ul class="dropdown-menu">

							<li><a href="profile.php"><i class="icon-user"></i>账号设置</a></li>
							<li><a onclick="logout();"><i class="icon-user"></i>退出</a></li>

						</ul>

					</li>

					<!-- END USER LOGIN DROPDOWN -->

				</ul>                

			</div>

		</div>

		<!-- END TOP NAVIGATION BAR -->

	</div>
    
<script type="application/javascript">
function logout(){
	$.ajax({
		url:'controller/c_login.php?act=logout',
		data:{},
		type:'post',
		success:function(msg){
			if(msg == 1){
				window.location.href = "login.php";
			}else{
				alert('退出失败');
			}
		}
	});

}


</script>




