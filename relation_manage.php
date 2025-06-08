	<!-- BEGIN HEADER -->

		<?php	include 'header.php';	?>
        
		<script>
			var editor = UE.getEditor('add_content');
        var update_editor = UE.getEditor('update_content');
		</script>
        
        
<!-- Modal -->
<div id="add_modal"  style="width:90%; left:25%;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">新增关系</h3>
  </div>
  <div class="modal-body">
    
<div class="portlet-body">

<form action="#" class="form-horizontal">


                                                
                                                
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px">姓名：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="add_name">


													</div>

												</div>
                                                <div class="control-group">

													<label class="control-label" style="width:70px">关系类型：</label>

													<div class="controls" style="margin-left:80px">

                                                        <select class="small m-wrap" tabindex="1" id="add_rel_type">

															<option value="亲人">亲人</option>
															<option value="远亲人">远亲人</option>
															<option value="近一般朋友">近一般朋友</option>
															<option value="一般朋友">一般朋友</option>
															<option value="远一般朋友">远一般朋友</option>
															<option value="好朋友">好朋友</option>
															<option value="远好朋友">远好朋友</option>
															<option value="敬重的人">敬重的人</option>
															<option value="同学">同学</option>
															<option value="近同学">近同学</option>
															<option value="同事">同事</option>
															<option value="近同事">近同事</option>
															<option value="负性关系">负性关系</option>
															<option value="敌人">敌人</option>
														</select>
                                                        


													</div>

												</div>
                                                
<div class="control-group">

													<label class="control-label" style="width:70px">关系状态：</label>

													<div class="controls" style="margin-left:80px">

                                                        <select class="small m-wrap" tabindex="1" id="add_relation_status">

															<option value="正常">正常</option>
															<option value="正性关系">正性关系</option>
															<option value="负性关系">负性关系</option>
														</select>
                                                        


													</div>

												</div>                                                
				<div class="control-group">

				  <label class="control-label" style="width:70px;">内容：</label>

													<div class="controls" style="margin-left:0px;">

														
			 <script id="add_content" type="text/plain"  style="width:100%;height:400px;"></script>
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
    <h3 id="myModalLabel">编辑关系</h3>
  </div>
  <div class="modal-body">
    
<div class="portlet-body">

<form action="#" class="form-horizontal">


                                                
                                                
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px">姓名：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="update_name">


													</div>

												</div>
                                                <div class="control-group">

													<label class="control-label" style="width:70px">关系类型：</label>

													<div class="controls" style="margin-left:80px">

                                                        <select class="small m-wrap" tabindex="1" id="update_rel_type">

															<option value="亲人">亲人</option>
															<option value="远亲人">远亲人</option>
															<option value="近一般朋友">近一般朋友</option>
															<option value="一般朋友">一般朋友</option>
															<option value="远一般朋友">远一般朋友</option>
															<option value="好朋友">好朋友</option>
															<option value="远好朋友">远好朋友</option>
															<option value="敬重的人">敬重的人</option>
															<option value="同学">同学</option>
															<option value="近同学">近同学</option>
															<option value="同事">同事</option>
															<option value="近同事">近同事</option>
															<option value="负性关系">负性关系</option>
															<option value="敌人">敌人</option>
														</select>


													</div>

												</div>
                                                
                                                
<div class="control-group">

													<label class="control-label" style="width:70px">关系状态：</label>

													<div class="controls" style="margin-left:80px">

                                                        <select class="small m-wrap" tabindex="1" id="update_relation_status">

															<option value="正常">正常</option>
															<option value="正性关系">正性关系</option>
															<option value="负性关系">负性关系</option>
														</select>


													</div>

												</div>                                                
                                                
				<div class="control-group">

				  <label class="control-label" style="width:70px;">内容：</label>

													<div class="controls" style="margin-left:0px;">

														
			 <script id="update_content" type="text/plain"  style="width:100%;height:400px;"></script>
													</div>

				</div>


							  </form>
							</div>    
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="update_save">保存</button>
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

							人际关系管理 <small></small>
							<button type="button" class="btn green" style="float:right; margin-right:10px;" data-toggle="modal" data-target="#add_modal">新增关系</button>
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

$sql = "SELECT COUNT(*) FROM relation where userid = '".$_SESSION['userid']."'  order by id desc";
$row = mysqli_fetch_array( mysqli_query($con,$sql) );
$count = $row[0];

$last_page = (int)($count/10)+1;

$result = mysqli_query($con,"SELECT * FROM relation  where userid = '".$_SESSION['userid']."' order by id desc limit ".$start_item.",10");

?>
								
                                
                                
                                
                                
                                
<table class="table table-bordered table-hover">

									<thead>

										<tr>

											<th width="9%">ID</th>

											<th width="36%">姓名</th>

											<th width="10%">关系类型</th>
											<th width="8%">关系状态</th>

											<th width="16%" class="hidden-480">添加时间</th>

											<th width="9%">修改</th>
											<th width="12%">删除</th>

										</tr>

									</thead>

									<tbody>
									<?php	while($row = mysqli_fetch_array($result)){	?>
										<tr>

											<td><?php	echo $row['id'];	?></td>

											<td><?php	echo $row['name'];	?></td>

											<td><?php	echo $row['rel_type'];	?></td>
											<td><?php	echo $row['relation_status'];	?></td>

											<td class="hidden-480"><?php	echo $row['createtime'];	?></td>

											<td><a href="javascript:;" onClick="pre_update(<?php	echo $row['id'];	?>);">修改</a>
                                            </td>
											<td><a href="javascript:;" onClick="delete_relation(<?php	echo $row['id'];	?>);">删除</a></td>

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
										<li><a href="relation_manage.php?page=1">首页</a></li>
										<li><a href="relation_manage.php?page=<?php	echo	$page-1;	?>">上一页</a></li>
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
										<li class="active"><a href="relation_manage.php?page=<?php	echo	$i;	?>"><?php	echo	$i;	?></a></li>
                                        <?php	}else{	?>
										<li><a href="relation_manage.php?page=<?php	echo	$i;	?>"><?php	echo	$i;	?></a></li>
                                       	<?php	}	?> 
                                       	<?php	}	?> 
                                        
                                        
                                        <?php	if($page < $last_page){	?>
										<li><a href="relation_manage.php?page=<?php	echo	$page+1;	?>">下一页</a></li>
										<li><a href="relation_manage.php?page=<?php	echo	$last_page;	?>">末页</a></li>
										<?php	}	?>
									</ul>

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

<script type="application/javascript">
    $("#add_save").click(function(){//输出选中的值
		var add_name = $('#add_name').val();
		var add_rel_type = $('#add_rel_type').val();
		var add_relation_status = $('#add_relation_status').val();
		var add_content = editor.getContent();
		$.ajax({
			url:'controller/c_relation_manage.php?act=add_save',
			data:{'add_name':add_name,'add_rel_type':add_rel_type,'add_relation_status':add_relation_status,'add_content':add_content},
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
			url:'controller/c_relation_manage.php?act=pre_update',
			data:{'id':id},
			type:'post',
			success:function(msg){
				//alert(msg);
				var obj = eval('('+msg+')');
				//alert(obj['name']);
				$('#update_name').val(obj['name']);
				$('#update_rel_type').val(obj['rel_type']);
				$('#update_relation_status').val(obj['relation_status']);
				update_editor.setContent(obj['content']);
			}
		});
		
		$('#update_modal').modal('show');
	}

	//编辑保存
    $("#update_save").click(function(){//输出选中的值
		var update_name = $('#update_name').val();
		var update_rel_type = $('#update_rel_type').val();
		var update_relation_status = $('#update_relation_status').val();
		var update_content = update_editor.getContent();
		$.ajax({
			url:'controller/c_relation_manage.php?act=update_save',
			data:{'id':id,'update_name':update_name,'update_rel_type':update_rel_type,'update_relation_status':update_relation_status,'update_content':update_content},
			type:'post',
			success:function(msg){
				//alert(msg);
				if(msg == 1){
					$('#update_modal').modal('hide');
					alert('编辑成功');
					window.location.href=window.location.href; 
				}
			}
		});

	});

	function delete_relation(delete_id){
		id = delete_id;
		//alert(id);
		$.ajax({
			url:'controller/c_relation_manage.php?act=delete',
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

</script>