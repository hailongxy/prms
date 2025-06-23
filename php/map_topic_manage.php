	<!-- BEGIN HEADER -->

		<?php	include 'header.php';	?>
        
        <link rel="stylesheet" type="text/css" href="gooflow/GooFlow/codebase/GooFlow2.css"/>

		<script>
		</script>

<!-- Modal -->
<div id="add_modal" style="width:90%; left:25%;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">新增<?php echo $map_menu[$_GET['topicid']] ?></h3>
  </div>
  <div class="modal-body" >
    
<div class="portlet-body">

<form action="#" class="form-horizontal">

				<div class="control-group">

													<label class="control-label" style="width:70px">标题：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="add_title">

													</div>

		</div>
<div class="control-group">
													<label class="control-label" style="width:70px">状态：</label>

													<div class="controls" style="margin-left:80px">

                                                        <select class="small m-wrap" tabindex="1" id="add_status">

																														<option value=""></option>
<?php	if($_GET['topicid'] == 4){	?>															<option value="未解决">未解决</option>
															<option value="已解决">已解决</option>
															<option value="无需解决">无需解决</option>
<?php	}	?>													</select>

													</div>

		</div>                                                
				<div class="control-group">

				  <label class="control-label" style="width:70px;">内容：</label>

													<div class="controls" style="margin-left:0px;">
                                                            <div id="add_content" style=" width:100%;height:400px;"></div>
                                                    </div>

				</div>

	  </form>
	</div>    
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="add_save">保存</button>
  </div>
</div>

<!--编辑框-->
<div id="update_modal"  style="width:90%; left:25%;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">编辑<?php echo $map_menu[$_GET['topicid']] ?></h3>
  </div>
  <div class="modal-body" >
    
<div class="portlet-body">

<form action="#" class="form-horizontal">

				<div class="control-group">

													<label class="control-label" style="width:70px">标题：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="update_title">


													</div>

												</div>
<div class="control-group">

													<label class="control-label" style="width:70px">状态：</label>

													<div class="controls" style="margin-left:80px">

                                                        <select class="small m-wrap" tabindex="1" id="update_status">

																														<option value=""></option>
<?php	if($_GET['topicid'] == 4){	?>															<option value="未解决">未解决</option>
															<option value="已解决">已解决</option>
															<option value="无需解决">无需解决</option>
<?php	}	?>													</select>
														</select>
                                                        


													</div>

												</div>                                                
				<div class="control-group">

				  <label class="control-label" style="width:70px;">内容：</label>

													<div class="controls" style="margin-left:0px;">

														
            <div id="update_content" style=" width:100%;height:400px"></div>
													</div>

				</div>

							  </form>
							</div>    
    

  </div>
  <div class="modal-footer">
    <button class="btn update_save" id="update_save_not_close">保存不关闭</button>
    <button class="btn update_save" data-dismiss="modal" aria-hidden="true" id="update_save">保存</button>
  </div>
</div>

	<!-- END HEADER -->

	<!-- BEGIN CONTAINER -->

	<div class="page-container row-fluid">

		<!-- BEGIN SIDEBAR -->

			<?php	include 'left.php';	?>

		<!-- END SIDEBAR -->

		<!-- BEGIN PAGE -->

		<div class="page-content" style="background:url(images/new_images/4436663_095951336812_2.jpg) repeat; background-size:cover">

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<div id="portlet-config" class="modal hide">

				<div class="modal-header">

					<button data-dismiss="modal" class="close" type="button"></button>

					<h3>portlet Settings</h3>

				</div>

				<div class="modal-body">

					<p>Here will be a configuration form</p>

				</div>

			</div>

			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN PAGE CONTAINER-->        

			<div class="container-fluid">

				<!-- BEGIN PAGE HEADER-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN STYLE CUSTOMIZER -->

						<!-- END BEGIN STYLE CUSTOMIZER -->  

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							<?php echo $map_menu[$_GET['topicid']] ?>管理 <small></small>
							<a href="/map_topic_add.php?menu_type=flow&topicid=<?php    echo $_GET['topicid'];   ?>" type="button" class="btn green" style="float:right; margin-right:10px;">新增<?php echo $map_menu[$_GET['topicid']] ?></a>
						</h3>

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

						<div class="portlet box green">

							<div class="portlet-title">

							  <div class="tools" style="height:22px;">

							  </div>

							</div>

							<div class="portlet-body">

                            <?php
                            if(isset($_GET['page'])){
                                $start_item = ($_GET['page']-1)*10;
                                $page = $_GET['page'];
                            }else{
                                $start_item = 0;
                                $page = 1;
                            }

                            if(isset($_GET['select_title'])){
                                $select_title = $_GET['select_title'];
                            }else{
                                $select_title = '';
                            }

                            $sql = "SELECT COUNT(*) FROM map_topic where userid = '".$_SESSION['userid']."'  and topicid = ".$_GET['topicid']." and title like '%".$select_title."%' order by id desc";
                            $row = mysqli_fetch_array( mysqli_query($con,$sql) );

                            $count = $row[0];

                            $last_page = (int)($count/10)+1;

                            $result = mysqli_query($con,"SELECT * FROM map_topic where userid = '".$_SESSION['userid']."' and topicid = ".$_GET['topicid']." and title like '%".$select_title."%' order by id desc limit ".$start_item.",10");

                            ?>

                            <div class="control-group">

                                <span style="line-height:30px">标题：</span>

                                    <input type="text" placeholder="" class="m-wrap medium" id="select_title" value="<?php	echo	$select_title;	?>">

<button type="button" class="btn green" id="search">查询</button>
                            </div>

                            <table class="table table-bordered table-hover">

									<thead>

										<tr>

											<th width="10%">ID</th>
											<th>标题</th>
											<th>状态</th>
											<?php		if($_GET['topicid'] == 27){	?>

											<th>解答</th>
                                            <?php	}		?>

											<th width="18%" class="hidden-480">添加时间</th>

											<th width="11%">修改</th>
											<th width="10%">删除</th>

										</tr>

									</thead>

									<tbody>
									<?php	while($row = mysqli_fetch_array($result)){	?>
										<tr>
											<td><?php	echo $row['id'];	?></td>

											<td><?php	echo $row['title'];	?></td>
											<td><?php	echo $row['status'];	?></td>
											<?php		if($_GET['topicid'] == 27){	?>

											<td><?php	echo $row['content'];	?></td>
                                            <?php	}		?>
											<td class="hidden-480"><?php	echo $row['createtime'];	?></td>

											<td><a href="/map_topic_edit.php?menu_type=flow&topicid=<?php	echo $_GET['topicid'];	?>&id=<?php	echo $row['id'];	?>">修改</a>
                                            </td>
											<td><a href="javascript:;" onClick="delete_map_topic(<?php	echo $row['id'];	?>);">删除</a></td>

										</tr>
                                    <?php	}	?>
									</tbody>

								</table>                                

                                <?php
                                    mysqli_close($con);

                                ?>

                                <div class="pagination pagination-centered">

									<ul>
                                    	<?php	if($page > 1){	?>
										<li><a href="map_topic_manage.php?menu_type=topic&topicid=<?php	echo	$_GET['topicid'];	?>&page=1&select_title=<?php	echo	$select_title;		?>">首页</a></li>
										<li><a href="map_topic_manage.php?menu_type=topic&topicid=<?php	echo	$_GET['topicid'];	?>&page=<?php	echo	$page-1;	?>&select_title=<?php	echo	$select_title;		?>">上一页</a></li>
                                        <?php	}	?>

                                        <?php	
										
											if($last_page <= 5){
												$page_start = 1;

												$page_end = $last_page;
											}else if($page <= 3){
												$page_start = 1;
												$page_end = 5;
											}else if($page <= $last_page - 2){
												$page_start = $last_page - 4;
												$page_end = $last_page;
												
											}else{
											
												$page_start = $page - 2;
												$page_end = $page + 2;
											}
										?>
                                        <?php	for($i=$page_start;$i<=$page_end;$i++){	?>
                                        <?php	if($i == $page){	?>
										<li class="active"><a href="map_topic_manage.php?menu_type=topic&topicid=<?php	echo	$_GET['topicid'];	?>&page=<?php	echo	$i;	?>&select_title=<?php	echo	$select_title;		?>"><?php	echo	$i;	?></a></li>
                                        <?php	}else{	?>
										<li><a href="map_topic_manage.php?menu_type=topic&topicid=<?php	echo	$_GET['topicid'];	?>&page=<?php	echo	$i;	?>&select_title=<?php	echo	$select_title;		?>"><?php	echo	$i;	?></a></li>
                                       	<?php	}	?> 
                                       	<?php	}	?> 

                                        <?php	if($page < $last_page){	?>
										<li><a href="map_topic_manage.php?menu_type=topic&topicid=<?php	echo	$_GET['topicid'];	?>&page=<?php	echo	$page+1;	?>&select_title=<?php	echo	$select_title;		?>">下一页</a></li>
										<li><a href="map_topic_manage.php?menu_type=topic&topicid=<?php	echo	$_GET['topicid'];	?>&page=<?php	echo	$last_page;	?>&select_title=<?php	echo	$select_title;		?>">末页</a></li>
										<?php	}	?>
									</ul>

									<span style="float:right; margin-top:5px;">（共 <?php		echo	$count;	?> 条）</span>

								</div>

							</div>

						</div>

						<!-- END EXAMPLE TABLE PORTLET-->

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

						<!-- END EXAMPLE TABLE PORTLET-->

					</div>

				</div>

				<!-- END PAGE CONTENT-->

			</div>

			<!-- END PAGE CONTAINER-->

		</div>

		<!-- END PAGE -->

	</div>

	<!-- END CONTAINER -->

	<!-- BEGIN FOOTER -->

<?php	include 'footer.php';	?>

        <script type="text/javascript" src="gooflow/GooFlow/data.js"></script>
        <script type="text/javascript" src="gooflow/GooFunc.js"></script>
        <script type="text/javascript" src="gooflow/json2.js"></script>
        <script type="text/javascript" src="gooflow/GooFlow/codebase/GooFlow.js"></script>
        <script type="text/javascript">
                var property = {
                    width: 1200,
                    height: 600,
                    toolBtns: ["start round", "end round", "task round", "node", "chat", "state", "plug", "join", "fork", "complex mix"],
                    haveHead: true,
                    headBtns: ["new", "open", "save", "undo", "redo", "reload"], //如果haveHead=true，则定义HEAD区的按钮
                    haveTool: true,
                    haveGroup: true,
                    useOperStack: true
                };
                var remark = {
                    cursor: "选择指针",
                    direct: "结点连线",
                    start: "入口结点",
                    "end": "结束结点",
                    "task": "任务结点",
                    node: "自动结点",
                    chat: "决策结点",
                    state: "状态结点",
                    plug: "附加插件",
                    fork: "分支结点",
                    "join": "联合结点",
                    "complex mix": "复合结点",
                    group: "组织划分框编辑开关"
                };
                var add_content;
                var update_content;
                $(document).ready(function() {
                    add_content = $.createGooFlow($("#add_content"), property);
                    add_content.setNodeRemarks(remark);
                    add_content.loadData('');
                    update_content = $.createGooFlow($("#update_content"), property);
                    update_content.setNodeRemarks(remark);
                    update_content.loadData('');
                });
                //var out;
                //function Export() {
                    //document.getElementById("result").value = JSON.stringify(add_content.exportData());
                //}
        </script>

<script type="application/javascript">
    $("#add_save").click(function(){//输出选中的值
		//alert(1234);
		var add_title = $('#add_title').val();
		var add_status = $('#add_status').val();
		var add_content_text = JSON.stringify(add_content.exportData());
		$.ajax({
			url:'controller/c_map_topic_manage.php?act=add_save',
			data:{'add_title':add_title,'add_status':add_status,'add_content':add_content_text,'topicid':'<?php	echo	$_GET['topicid'];	?>'},
			type:'post',
			success:function(msg){
				//alert(msg);
				if(msg == 1){
					$('#add_modal').modal('hide');
					alert('创建成功');
					window.location.href=window.location.href; 
				}
			}
		});

	});

	function pre_update(update_id){
		id = update_id;
		//alert(id);
		$.ajax({
			url:'controller/c_map_topic_manage.php?act=pre_update',
			data:{'id':id},
			type:'post',
			success:function(msg){
				//alert(msg);
				var obj = eval('('+msg+')');
				//alert(obj['name']);
				$('#update_title').val(obj['title']);
				$('#update_status').val(obj['status']);
				var content = eval('('+obj['content']+')');
				update_content.loadData(content);
			}
		});
		
		$('#update_modal').modal('show');
	}

	//编辑保存
    $(".update_save").click(function(){//输出选中的值
	
		var update_type = $(this).attr('id');
	
		var update_title = $('#update_title').val();
		var update_status = $('#update_status').val();
		var update_content_text = JSON.stringify(update_content.exportData());
		$.ajax({
			url:'controller/c_map_topic_manage.php?act=update_save',
			data:{'id':id,'update_title':update_title,'update_status':update_status,'update_content':update_content_text},
			type:'post',
			success:function(msg){
				//alert(msg);
				if(msg == 1){
					//$('#update_modal').modal('hide');
					//alert('编辑成功');
					//window.location.href=window.location.href; 
					
					if(update_type == 'update_save'){
						$('#update_modal').modal('hide');
						alert('编辑成功');
						window.location.href=window.location.href; 
					}else{
						alert('编辑成功');
					}

				}
			}
		});

	});

	function delete_map_topic(delete_id){
		id = delete_id;
		//alert(id);
		$.ajax({
			url:'controller/c_map_topic_manage.php?act=delete',
			data:{'id':id},
			type:'post',
			success:function(msg){
				if(msg == 1){
					alert('删除成功');
					window.location.href=window.location.href; 
				}
				
			}
		});
	}

    $("#search").click(function(){//查询
		var select_title = $('#select_title').val();
		window.location.href=window.location.href+'&select_title='+select_title;
	});

</script>