	<!-- BEGIN HEADER -->

		<?php	include 'header.php';	?>
        
        
        
<!-- Modal -->
<div id="add_modal" style="width:90%; left:25%;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">新增文件夹</h3>
  </div>
  <div class="modal-body">
    
<div class="portlet-body">

<form action="#" class="form-horizontal">


                                                
                                                
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px">分类名：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="add_title">


													</div>

												</div>
                                                
				
				<div class="control-group">

													<label class="control-label" style="width:70px">文件夹名：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="add_content">


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
    <h3 id="myModalLabel">编辑文件夹</h3>
  </div>
  <div class="modal-body">
    
<div class="portlet-body">

<form action="#" class="form-horizontal">


                                                
                                                
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px">分类名：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="update_title">


													</div>

												</div>
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px">文件夹名：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" pre_content="" id="update_content">


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

							图片上传管理 <small></small>
							<button type="button" class="btn green" style="float:right; margin-right:10px;" data-toggle="modal" data-target="#add_modal">新增文件夹</button>
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

$sql = "SELECT COUNT(*) FROM folder where userid = '".$_SESSION['userid']."'  order by id desc";
$row = mysqli_fetch_array( mysqli_query($con,$sql) );
$count = $row[0];

$last_page = (int)($count/10)+1;

$result = mysqli_query($con,"SELECT * FROM folder where userid = '".$_SESSION['userid']."'  order by id desc limit ".$start_item.",10");

?>
								
                                
                                
                                
                                
                                
<table class="table table-bordered table-hover">

									<thead>

										<tr>

											<th width="10%">ID</th>

											<th>分类名</th>
											<th>文件夹名</th>

											<th width="18%" class="hidden-480">上传文件</th>

											<th width="11%">修改</th>
											<th width="10%">删除</th>

										</tr>

									</thead>

									<tbody>
									<?php	while($row = mysqli_fetch_array($result)){	?>
										<tr>

											<td><?php	echo $row['id'];	?></td>

											<td><?php	echo $row['title'];	?></td>
											<td><?php	echo $row['content'];	?></td>

											<td class="hidden-480"><a href="upload_manage.php?upload_folder=<?php	echo $row['content'];	?>">上传文件</a></td>

											<td><a href="javascript:;" onClick="pre_update(<?php	echo $row['id'];	?>);">修改</a>
                                            </td>
											<td><a href="javascript:;" onClick="delete_folder(<?php	echo $row['id'];	?>,'<?php	echo $row['content'];	?>');">删除</a></td>

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
										<li><a href="folder_manage.php?page=1">首页</a></li>
										<li><a href="folder_manage.php?page=<?php	echo	$page-1;	?>">上一页</a></li>
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
										<li class="active"><a href="folder_manage.php?page=<?php	echo	$i;	?>"><?php	echo	$i;	?></a></li>
                                        <?php	}else{	?>
										<li><a href="folder_manage.php?page=<?php	echo	$i;	?>"><?php	echo	$i;	?></a></li>
                                       	<?php	}	?> 
                                       	<?php	}	?> 
                                        
                                        
                                        <?php	if($page < $last_page){	?>
										<li><a href="folder_manage.php?page=<?php	echo	$page+1;	?>">下一页</a></li>
										<li><a href="folder_manage.php?page=<?php	echo	$last_page;	?>">末页</a></li>
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
		//alert(1234);
		var add_title = $('#add_title').val();
		var add_content = $('#add_content').val();
		$.ajax({
			url:'controller/c_folder_manage.php?act=add_save',
			data:{'add_title':add_title,'add_content':add_content},
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
			url:'controller/c_folder_manage.php?act=pre_update',
			data:{'id':id},
			type:'post',
			success:function(msg){
				//alert(msg);
				var obj = eval('('+msg+')');
				//alert(obj['name']);
				$('#update_title').val(obj['title']);
				$('#update_content').val(obj['content']);
				$('#update_content').attr('pre_content',obj['content']);
			}
		});
		
		$('#update_modal').modal('show');
	}

	//编辑保存
    $(".update_save").click(function(){//输出选中的值
	
		var update_type = $(this).attr('id');
	
		var update_title = $('#update_title').val();
		var update_content = $('#update_content').val();
		var pre_content = $('#update_content').attr('pre_content');
		$.ajax({
			url:'controller/c_folder_manage.php?act=update_save',
			data:{'id':id,'update_title':update_title,'update_content':update_content,'pre_content':pre_content},
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

	function delete_folder(delete_id,delete_content){
		id = delete_id;
		content = delete_content;
		//alert(id);
		$.ajax({
			url:'controller/c_folder_manage.php?act=delete',
			data:{'id':id,'content':content},
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