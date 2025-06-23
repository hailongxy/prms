<?php
$current_page = str_replace("prms/", "", $_SERVER['PHP_SELF'].$_SERVER['REQUEST_URI']);
?>
<div class="page-sidebar nav-collapse collapse">
    <ul class="page-sidebar-menu">

        <li>

            <div class="sidebar-toggler hidden-phone"></div>

        </li>

        <li>

            <form class="sidebar-search">

                <div class="input-box"></div>

            </form>

        </li>
		<?php	
		if(isset($_GET['menu_type'])){
			$menu_type = $_GET['menu_type'];
		}else{
			$menu_type = '';
		}
		?>
		<?php	
		if($menu_type == 'topic'||strstr($current_page,"topic_control_manage.php")){	
		?>

		<?php	
		if(strstr($current_page,"topic_control_manage.php")){
        ?>
        <li class="active">
        <?php	
		}else{
        ?>
        <li class="">
        <?php	
		}
        ?>

            <a href="<?php	echo	"topic_control_manage.php";	?>">

                <i class="icon-bar-chart"></i> 
                
                <span class="title">专题管理</span>
                <span class="selected"></span>
            </a>

        </li>   
        
		<?php	
		
				//$result = mysqli_query($con,"SELECT * FROM topic_control where userid = '".$_SESSION['userid']."'");
				//while($row = mysqli_fetch_array($result)){
				if(!empty($topic_menu)){
					foreach($topic_menu as $topic_key => $topic_value){						
		?>
		<?php	
				if(isset($_GET['topicid'])){
					$get_topicid = $_GET['topicid'];
				}else{
					$get_topicid = '';
				}
								
				if($topic_key == $get_topicid&&($topic_key != 0||$get_topicid != '')){
        ?>
        <li class="active">
        <?php	
				}else{
        ?>
        <li class="">
        <?php	
				}
        ?>

            <a href="<?php	echo	"special_topic_manage.php?menu_type=topic&topicid=".$topic_key;	?>">

                <i class="icon-bar-chart"></i> 
                
                <span class="title"><?php	echo	$topic_value;	?></span>
                <span class="selected"></span>
            </a>

        </li>   
        <?php	
				}
			}	
		?>

        <?php
        }else if($menu_type == 'mind'||strstr($current_page,"mind_control_manage.php")){
            ?>

            <?php
            if(strstr($current_page,"mind_control_manage.php")){
                ?>
                <li class="active">
                <?php
            }else{
                ?>
                <li class="">
                <?php
            }
            ?>

            <a href="<?php	echo	"mind_control_manage.php";	?>">

                <i class="icon-bar-chart"></i>

                <span class="title">思维导图管理</span>
                <span class="selected"></span>
            </a>

            </li>

            <?php
            if(!empty($mind_menu)){
                foreach($mind_menu as $mind_key => $mind_value){
                    ?>
                    <?php
                    if(isset($_GET['mindid'])){
                        $get_mindid = $_GET['mindid'];
                    }else{
                        $get_mindid = '';
                    }

                    if($mind_key == $get_mindid&&($mind_key != 0||$get_mindid != '')){
                        ?>
                        <li class="active">
                        <?php
                    }else{
                        ?>
                        <li class="">
                        <?php
                    }
                    ?>

                    <a href="<?php	echo	"special_mind_manage.php?menu_type=mind&mindid=".$mind_key;	?>">

                        <i class="icon-bar-chart"></i>

                        <span class="title"><?php	echo	$mind_value;	?></span>
                        <span class="selected"></span>
                    </a>

                    </li>
                    <?php
                }
            }
            ?>

            <?php
        }else if($menu_type == 'diagram'||strstr($current_page,"diagram_control_manage.php")){
            ?>

            <?php
            if(strstr($current_page,"diagram_control_manage.php")){
                ?>
                <li class="active">
                <?php
            }else{
                ?>
                <li class="">
                <?php
            }
            ?>

            <a href="<?php	echo	"diagram_control_manage.php";	?>">

                <i class="icon-bar-chart"></i>

                <span class="title">图管理</span>
                <span class="selected"></span>
            </a>

            </li>

            <?php
            if(!empty($diagram_menu)){
                foreach($diagram_menu as $diagram_key => $diagram_value){
                    ?>
                    <?php
                    if(isset($_GET['diagramid'])){
                        $get_diagramid = $_GET['diagramid'];
                    }else{
                        $get_diagramid = '';
                    }

                    if($diagram_key == $get_diagramid&&($diagram_key != 0||$get_diagramid != '')){
                        ?>
                        <li class="active">
                        <?php
                    }else{
                        ?>
                        <li class="">
                        <?php
                    }
                    ?>

                    <a href="<?php	echo	"special_diagram_manage.php?menu_type=diagram&diagramid=".$diagram_key;	?>">

                        <i class="icon-bar-chart"></i>

                        <span class="title"><?php	echo	$diagram_value;	?></span>
                        <span class="selected"></span>
                    </a>

                    </li>
                    <?php
                }
            }
            ?>

		<?php	
		}else if($menu_type == 'topic_map'){	
		?>
        
		<?php	
		
				//$result = mysqli_query($con,"SELECT * FROM topic_control");
				//while($row = mysqli_fetch_array($result)){
				if(!empty($topic_menu)){
					foreach($topic_menu as $topic_key => $topic_value){						
		?>
		<?php	
				if(isset($_GET['topicid'])){
					$get_topicid = $_GET['topicid'];
				}else{
					$get_topicid = '';
				}
								
				if($topic_key == $get_topicid){
        ?>
        <li class="active">
        <?php	
				}else{
        ?>
        <li class="">
        <?php	
				}
        ?>

            <a href="<?php	echo	"special_topic_map_manage.php?menu_type=topic_map&topicid=".$topic_key;	?>">

                <i class="icon-bar-chart"></i> 
                
                <span class="title"><?php	echo	$topic_value;	?>图表</span>
                <span class="selected"></span>
            </a>

        </li>   
        <?php	
				}
			}	
		?>
        
		<?php	
		}else if($menu_type == 'flow'){	
		?>
		<?php	
			foreach($map_menu as $map_key => $map_value){
		?>
		<?php	
				if(strstr($current_page,"map_topic_manage.php?menu_type=flow&topicid=".$map_key)||strstr($current_page,"map_topic_edit.php?menu_type=flow&topicid=".$map_key)||strstr($current_page,"map_topic_add.php?menu_type=flow&topicid=".$map_key)){
        ?>
        <li class="active">
				<?php	
                    }else{
                ?>
        <li class="">
                <?php	
					}
				?>

            <a href="<?php	echo	"map_topic_manage.php?menu_type=flow&topicid=".$map_key;	?>">

                <i class="icon-bar-chart"></i> 
    
                <span class="title"><?php	echo	$map_value;	?></span>
                <span class="selected"></span>
            </a>

        </li>   
        
        <?php	
			}	
		?>
		<?php	
		}else if($menu_type == 'senior_topic'){	
		?>
		<?php	
			foreach($senior_topic_menu as $senior_topic_key => $senior_topic_value){
		?>
                <?php	
				if(strstr($current_page,"senior_topic_manage.php?menu_type=senior_topic&topicid=".$senior_topic_key)){
				?>
        <li class="active">
                <?php	
				}else{
				?>
        <li class="">
                <?php	
				}
				?>

            <a href="<?php	echo	"senior_topic_manage.php?menu_type=senior_topic&topicid=".$senior_topic_key;	?>">

                <i class="icon-bar-chart"></i> 
    
                <span class="title"><?php	echo	$senior_topic_value;	?></span>
                <span class="selected"></span>
            </a>

        </li>   
        
        <?php	
		}	
		?>
        
	<?php	
	}else if($menu_type == 'map'){	
	?>
		<?php	
		if(strstr($current_page,"status_map_manage.php?menu_type=map")){
        ?>
        <li class="active">
        <?php	
		}else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="status_map_manage.php?menu_type=map">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">状态图表</span>
                <span class="selected"></span>
            </a>

        </li>   


            <?php	
                if(strstr($current_page,"back_map_manage.php?menu_type=map")){
            ?>
        <li class="active">
            <?php	
                }else{
            ?>
        <li class="">
            <?php	
                }
            ?>

            <a href="back_map_manage.php?menu_type=map">

            <i class="icon-bar-chart"></i> 

            <span class="title">回归图表</span>
            <span class="selected"></span>
            </a>

        </li>   
                
		<?php	
            if(strstr($current_page,"get_map_manage.php?menu_type=map")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="get_map_manage.php?menu_type=map">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">得图表</span>
                <span class="selected"></span>
            </a>

        </li>   
    
		<?php	
		if(strstr($current_page,"lose_map_manage.php?menu_type=map")){
        ?>
        <li class="active">
        <?php	
		}else{
        ?>
        <li class="">
        <?php	
		}
        ?>

            <a href="lose_map_manage.php?menu_type=map">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">失图表</span>
                <span class="selected"></span>
            </a>

        </li>   
                
		<?php	
		if(strstr($current_page,"think_map_manage.php?menu_type=map")){
        ?>
        <li class="active">
        <?php	
		}else{
        ?>
        <li class="">
        <?php	
		}
        ?>

            <a href="think_map_manage.php?menu_type=map">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">心得图表</span>
                <span class="selected"></span>
            </a>

        </li>   
        
        <?php	
		if(strstr($current_page,"energy_map_manage.php?menu_type=map")){
        ?>
        <li class="active">
        <?php	
		}else{
        ?>
        <li class="">
        <?php	
		}
        ?>

            <a href="energy_map_manage.php?menu_type=map">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">得势图表</span>
                <span class="selected"></span>
            </a>

        </li>   
                
    
		<?php	
		}else{	
		?>

        <?php	
            if(strstr($current_page,"index.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="index.php">
    
                <i class="icon-cogs"></i> 
    
                <span class="title">资金管理</span>
    
                <span class="selected"></span>
            </a>

        </li>

        <?php
        if($_SESSION['usertype'] == '管理员'){
		?>        
		<?php	
            if(strstr($current_page,"time_and_energe_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="time_and_energe_manage.php">
    
                <i class="icon-bookmark-empty"></i> 
    
                <span class="title">时间和精力管理</span>
    
            </a>

        </li>
        <?php	
		}
        ?>

		<?php	
            if(strstr($current_page,"knowledge_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="knowledge_manage.php">
    
                <i class="icon-table"></i> 
    
                <span class="title">知识管理</span>
            </a>
        </li>

		<?php	
            if(strstr($current_page,"ability_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="ability_manage.php">
    
                <i class="icon-briefcase"></i> 
    
                <span class="title">能力管理</span>
            </a>

        </li>

        <?php
        if($_SESSION['usertype'] == '管理员'){
		?>        
		<?php	
            if(strstr($current_page,"teach_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="teach_manage.php">
    
                <i class="icon-briefcase"></i> 
    
                <span class="title">我离XF有多远</span>
    
            </a>

        </li>
        <?php	
		}
        ?>

        <?php
        if($_SESSION['usertype'] == '管理员'){
		?>        
		<?php	
            if(strstr($current_page,"terminal_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="terminal_manage.php">
    
                <i class="icon-briefcase"></i> 
    
                <span class="title">终极学习管理</span>

            </a>

        </li>
        <?php	
		}
        ?>

        <?php
        if($_SESSION['usertype'] == '管理员'){
		?>        
		<?php	
            if(strstr($current_page,"live_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="live_manage.php">
    
                <i class="icon-briefcase"></i> 
    
                <span class="title">生命专题</span>
            </a>

        </li>
        <?php	
		}
        ?>

        <?php
        if($_SESSION['usertype'] == '管理员'){
		?>        
		<?php	
            if(strstr($current_page,"relation_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="relation_manage.php">
    
                <i class="icon-sitemap"></i> 
    
                <span class="title">人际关系管理</span>

            </a>

        </li>
        <?php	
		}
        ?>

        <?php
        if($_SESSION['usertype'] == '管理员'){
		?>        
		<?php	
            if(strstr($current_page,"project_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="project_manage.php">
    
                <i class="icon-folder-open"></i> 
    
                <span class="title">项目管理</span>

            </a>

        </li>
        <?php	
		}
        ?>

		<?php	
            if(strstr($current_page,"idea_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="idea_manage.php">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">Idea管理</span>
    
            </a>

        </li>
                
		<?php	
            if(strstr($current_page,"reflect_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="reflect_manage.php">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">反省管理</span>
                <span class="selected"></span>
            </a>

        </li>
        
		<?php	
            if(strstr($current_page,"difficult_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="difficult_manage.php">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">难题管理</span>
                <span class="selected"></span>
            </a>

        </li>

        <?php
        if(strstr($current_page,"mind_map_manage.php") || strstr($current_page,"mind_map.php")){
            ?>
            <li class="active">
            <?php
        }else{
            ?>
            <li class="">
            <?php
        }
        ?>

        <a href="mind_map_manage.php">

            <i class="icon-bar-chart"></i>

            <span class="title">思维导图管理</span>
            <span class="selected"></span>
        </a>

        </li>

            <?php
            if(strstr($current_page,"diagram_manage.php") || strstr($current_page,"diagram.php")){
                ?>
                <li class="active">
                <?php
            }else{
                ?>
                <li class="">
                <?php
            }
            ?>

            <a href="diagram_manage.php">

                <i class="icon-bar-chart"></i>

                <span class="title">图管理</span>
                <span class="selected"></span>
            </a>

        </li>

        <?php
        if(strstr($current_page,"flow_chart_manage.php") || strstr($current_page,"flow_chart.php")){
            ?>
            <li class="active">
            <?php
        }else{
            ?>
            <li class="">
            <?php
        }
        ?>

        <a href="flow_chart_manage.php">

            <i class="icon-bar-chart"></i>

            <span class="title">流程图管理</span>
            <span class="selected"></span>
        </a>

        </li>
        
        <?php
        if($_SESSION['usertype'] == '管理员'){
		?>        
		<?php	
            if(strstr($current_page,"motto_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="motto_manage.php">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">留言板管理</span>
                <span class="selected"></span>
            </a>

        </li>	
        <?php	
		}
        ?>
        			
		<?php	
            if(strstr($current_page,"case_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="case_manage.php">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">Case管理</span>
                <span class="selected"></span>
            </a>

        </li>
        
		<?php	
            if(strstr($current_page,"learn_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="learn_manage.php">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">学习管理</span>
                <span class="selected"></span>
            </a>

        </li>   
            
        <?php
        if($_SESSION['usertype'] == '管理员'){
		?>        
		<?php	
            if(strstr($current_page,"man_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="man_manage.php">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">人物管理</span>
                <span class="selected"></span>
            </a>

        </li>   
        <?php	
		}
        ?>
            
        <?php
        if($_SESSION['usertype'] == '管理员'){
		?>        
		<?php	
            if(strstr($current_page,"status_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="status_manage.php">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">状态管理</span>
                <span class="selected"></span>
            </a>

        </li>   
        <?php	
		}
        ?>
           
        <?php
        if($_SESSION['usertype'] == '管理员'){
		?>        
		<?php	
            if(strstr($current_page,"topic_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="topic_manage.php">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">话题管理</span>
                <span class="selected"></span>
            </a>

        </li>   
        <?php	
		}
        ?>
        
        <?php
        if($_SESSION['usertype'] == '管理员'){
		?>        
		<?php	
            if(strstr($current_page,"image_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="image_manage.php">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">图片管理</span>
                <span class="selected"></span>
            </a>

        </li>  
        <?php	
            }
        ?>
         
        <?php
        if($_SESSION['usertype'] == '管理员'){
		?>        
		<?php	
            if(strstr($current_page,"folder_manage.php")){
        ?>
        <li class="active">
        <?php	
            }else{
        ?>
        <li class="">
        <?php	
            }
        ?>

            <a href="folder_manage.php">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">图片上传管理</span>
                <span class="selected"></span>
            </a>

        </li>   
        <?php	
            }
        ?>
		<?php	
            if(strstr($current_page,"memory_manage.php")){
        ?>
        <li class="active last">
        <?php	
            }else{
        ?>
        <li class="last">
        <?php	
            }
        ?>

            <a href="memory_manage.php">
    
                <i class="icon-bar-chart"></i> 
    
                <span class="title">备忘录管理</span>
                <span class="selected"></span>
            </a>

        </li>
	<?php	
    }	
    ?>
    </ul>
</div>