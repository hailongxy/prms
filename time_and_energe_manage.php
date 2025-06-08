	<!-- BEGIN HEADER -->

		<?php	include 'header.php';	?>
        
        
<!-- Modal -->
<div id="add_modal"  style="width:90%; left:25%;"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">新增时间</h3>
  </div>
  <div class="modal-body">
    
<div class="portlet-body">

<form action="#" class="form-horizontal">


				<div class="control-group">

                    <label class="control-label" style="width:70px">日期：</label>

                    <div class="controls" style=" margin-left:80px">






<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="margin-left:0px;">
                    <input size="16" type="text" value="" readonly id="add_createtime">
					<span class="add-on"><i class="icon-th"></i></span>
                </div>






                    </div>

                </div>
                                                
                                                
<div class="control-group">

													<label class="control-label" style="width:70px">人物：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="add_man">


													</div>

												</div>                                                


				<div class="control-group">

													<label class="control-label" style="width:70px; font-weight:bold">工作：</label>

												</div>
                                                
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px">时长：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="add_work_time">


													</div>

												</div>
                                                <div class="control-group">

													<label class="control-label" style="width:70px">内容：</label>

													<div class="controls" style="margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="add_work_title">


													</div>

												</div>
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px; font-weight:bold">学习：</label>

												</div>
                                                
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px">时长：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="add_study_time">


													</div>

												</div>
                                                <div class="control-group">

													<label class="control-label" style="width:70px">内容：</label>

													<div class="controls" style="margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="add_study_title">


													</div>

												</div>
                                                
				<div class="control-group">

													<label class="control-label" style="width:100px; font-weight:bold">日常事务：</label>

												</div>
                                                
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px">时长：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="add_normal_time">


													</div>

												</div>
                                                <div class="control-group">

													<label class="control-label" style="width:70px">内容：</label>

													<div class="controls" style="margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="add_normal_title">


													</div>

												</div>
                                                
                                                
                                                <div class="control-group">

													<label class="control-label" style="width:70px">状态：</label>

													<div class="controls" style="margin-left:80px">


                                                        <select class="small m-wrap" tabindex="1" id="add_point">
															<option value="0" selected>0</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															<option value="9">9</option>
															<option value="10">10</option>
														</select>


													</div>

												</div>
                                                
                                         
                                         
<div class="control-group">

													<label class="control-label" style="width:70px">自控能力：</label>

													<div class="controls" style="margin-left:80px">


                                                        <select class="small m-wrap" tabindex="1" id="add_control">

															<option value=""></option>
															<option value="很好">很好</option>

															<option value="还可以">还可以</option>
															<option value="一般">一般</option>
															<option value="很差">很差</option>

														</select>


													</div>

												</div>                                         
                                         
                                                
                                                <div class="control-group">
                                
                                                  <label class="control-label" style="width:70px;">日记：</label>
                                
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
    <h3 id="myModalLabel">编辑时间</h3>
  </div>
  <div class="modal-body">
    
<div class="portlet-body">

<form action="#" class="form-horizontal">




				<div class="control-group">

                    <label class="control-label" style="width:70px">日期：</label>

                    <div class="controls" style=" margin-left:80px">






<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="margin-left:0px;">
                    <input size="16" type="text" value="" readonly id="update_createtime">
					<span class="add-on"><i class="icon-th"></i></span>
                </div>






                    </div>

                </div>

<div class="control-group">

													<label class="control-label" style="width:70px">人物：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="update_man">


													</div>

												</div>
				<div class="control-group">

													<label class="control-label" style="width:70px; font-weight:bold">工作：</label>

												</div>
                                                
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px">时长：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="update_work_time">


													</div>

												</div>
                                                <div class="control-group">

													<label class="control-label" style="width:70px">内容：</label>

													<div class="controls" style="margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="update_work_title">


													</div>

												</div>
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px; font-weight:bold">学习：</label>

												</div>
                                                
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px">时长：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="update_study_time">


													</div>

												</div>
                                                <div class="control-group">

													<label class="control-label" style="width:70px">内容：</label>

													<div class="controls" style="margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="update_study_title">


													</div>

												</div>
                                                
				<div class="control-group">

													<label class="control-label" style="width:100px; font-weight:bold">日常事务：</label>

												</div>
                                                
                                                
				<div class="control-group">

													<label class="control-label" style="width:70px">时长：</label>

													<div class="controls" style=" margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="update_normal_time">


													</div>

												</div>
                                                <div class="control-group">

													<label class="control-label" style="width:70px">内容：</label>

													<div class="controls" style="margin-left:80px">

														<input type="text" placeholder="" class="m-wrap medium" id="update_normal_title">


													</div>

												</div>
                                                
                                                
                                                <div class="control-group">

													<label class="control-label" style="width:70px">状态：</label>

													<div class="controls" style="margin-left:80px">


                                                        <select class="small m-wrap" tabindex="1" id="update_point">
															<option value="0">0</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
															<option value="6">6</option>
															<option value="7">7</option>
															<option value="8">8</option>
															<option value="9">9</option>
															<option value="10">10</option>
														</select>

													</div>

												</div>
                    
                    
                    
<div class="control-group">

													<label class="control-label" style="width:70px">自控能力：</label>

													<div class="controls" style="margin-left:80px">


                                                        <select class="small m-wrap" tabindex="1" id="update_control">

															<option value=""></option>
															<option value="很好">很好</option>

															<option value="还可以">还可以</option>
															<option value="一般">一般</option>
															<option value="很差">很差</option>

														</select>

													</div>

												</div>                    
                                                
                                                
                                                <div class="control-group">
                                
                                                  <label class="control-label" style="width:70px;">日记：</label>
                                
                                                                                    <div class="controls" style="margin-left:0px;">
                                
                                                                                        
                                             <script id="update_content" type="text/plain"  style="width:100%;height:400px;"></script>
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
        
        
		<script>
			var editor = UE.getEditor('add_content');
        var update_editor = UE.getEditor('update_content');
		</script>


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

							时间和精力管理 <small></small>
							<button type="button" class="btn green" style="float:right; margin-right:10px;" data-toggle="modal" data-target="#add_modal">新增时间</button>
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

$sql = "SELECT COUNT(*) FROM time_and_energe where userid = '".$_SESSION['userid']."'  order by id desc ";
$row = mysqli_fetch_array( mysqli_query($con,$sql) );
$count = $row[0];

$last_page = (int)($count/10)+1;

$result = mysqli_query($con,"SELECT * FROM time_and_energe where userid = '".$_SESSION['userid']."'  order by id desc limit ".$start_item.",10");

?>
								
                                
                                
                                
                                
                                
<table class="table table-bordered table-hover">

									<thead>

										<tr>

											<th width="8%">ID</th>
											<th>人物</th>
											<th colspan="2">工作</th>

											<th colspan="2">学习</th>

											<th colspan="2" class="hidden-480">日常事务</th>

											<th width="16%">时间</th>
											<th width="6%">状态</th>
											<th width="6%">自控能力</th>
											<th width="6%">回归</th>
											<th width="7%">修改</th>
											<th width="7%">删除</th>

										</tr>

									</thead>

									<tbody>
									<?php	while($row = mysqli_fetch_array($result)){	?>
										<tr>

											<td><?php	echo $row['id'];	?></td>

											<td width="8%"><?php	echo $row['man'];	?></td>
											<td width="6%"><?php	echo $row['work_time'];	?></td>
											<td width="6%"><?php	echo $row['work_title'];	?></td>

											<td width="6%"><?php	echo $row['study_time'];	?></td>
											<td width="6%"><?php	echo $row['study_title'];	?></td>

											<td width="6%" class="hidden-480"><?php	echo $row['normal_time'];	?></td>
											<td width="6%" class="hidden-480"><?php	echo $row['normal_title'];	?></td>

											<td><?php	echo $row['createtime'];	?>
                                            </td>
											<td><?php	echo $row['point'];	?></td>
											<td><?php	echo $row['control'];	?></td>
											<td><a class="btn mini blue" href="javascript:;" onClick="back_update(<?php	echo $row['id'];	?>);"><?php	echo $row['back'];	?></a></td>
											<td><a href="javascript:;" onClick="pre_update(<?php	echo $row['id'];	?>);">修改</a></td>
											<td><a href="javascript:;" onClick="delete_time_and_energe(<?php	echo $row['id'];	?>);">删除</a></td>

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
										<li><a href="time_and_energe_manage.php?page=1">首页</a></li>
										<li><a href="time_and_energe_manage.php?page=<?php	echo	$page-1;	?>">上一页</a></li>
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
										<li class="active"><a href="time_and_energe_manage.php?page=<?php	echo	$i;	?>"><?php	echo	$i;	?></a></li>
                                        <?php	}else{	?>
										<li><a href="time_and_energe_manage.php?page=<?php	echo	$i;	?>"><?php	echo	$i;	?></a></li>
                                       	<?php	}	?> 
                                       	<?php	}	?> 
                                        
                                        
                                        <?php	if($page < $last_page){	?>
										<li><a href="time_and_energe_manage.php?page=<?php	echo	$page+1;	?>">下一页</a></li>
										<li><a href="time_and_energe_manage.php?page=<?php	echo	$last_page;	?>">末页</a></li>
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
		var add_work_title = $('#add_work_title').val();
		var add_work_time = $('#add_work_time').val();
		var add_man = $('#add_man').val();
		var add_study_title = $('#add_study_title').val();
		var add_study_time = $('#add_study_time').val();
		var add_normal_title = $('#add_normal_title').val();
		var add_normal_time = $('#add_normal_time').val();
		var add_createtime = $('#add_createtime').val();
		var add_point = $('#add_point').val();
		var add_control = $('#add_control').val();
		var add_content = editor.getContent();
		//alert(123);
		//alert(add_content);
		$.ajax({
			url:'controller/c_time_and_energe_manage.php?act=add_save',
			data:{'add_work_title':add_work_title,'add_work_time':add_work_time,'add_man':add_man,'add_study_title':add_study_title,'add_study_time':add_study_time,"add_normal_title":add_normal_title,"add_normal_time":add_normal_time,"add_point":add_point,"add_control":add_control,"add_content":add_content,"add_createtime":add_createtime},
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
			url:'controller/c_time_and_energe_manage.php?act=pre_update',
			data:{'id':id},
			type:'post',
			success:function(msg){
				//alert(msg);
				var obj = eval('('+msg+')');
				//alert(obj['name']);
				$('#update_createtime').val(obj['createtime']);
				$('#update_work_title').val(obj['work_title']);
				$('#update_work_time').val(obj['work_time']);
				$('#update_man').val(obj['man']);
				$('#update_study_title').val(obj['study_title']);
				$('#update_study_time').val(obj['study_time']);
				$('#update_normal_title').val(obj['normal_title']);
				$('#update_normal_time').val(obj['normal_time']);
				$('#update_point').val(obj['point']);
				$('#update_control').val(obj['control']);
				update_editor.setContent(obj['content']);
			}
		});
		
		$('#update_modal').modal('show');
	}

	//编辑保存
    $(".update_save").click(function(){//输出选中的值
	
		var update_type = $(this).attr('id');
		
		var update_createtime = $('#update_createtime').val();
		var update_work_title = $('#update_work_title').val();
		var update_work_time = $('#update_work_time').val();
		var update_man = $('#update_man').val();
		var update_study_title = $('#update_study_title').val();
		var update_study_time = $('#update_study_time').val();
		var update_normal_title = $('#update_normal_title').val();
		var update_normal_time = $('#update_normal_time').val();
		var update_point = $('#update_point').val();
		var update_control = $('#update_control').val();
		//alert(update_point);
		var update_content = update_editor.getContent();
		$.ajax({
			url:'controller/c_time_and_energe_manage.php?act=update_save',
			data:{'id':id,'update_createtime':update_createtime,'update_work_title':update_work_title,'update_work_time':update_work_time,'update_man':update_man,'update_study_title':update_study_title,'update_study_time':update_study_time,"update_normal_title":update_normal_title,"update_normal_time":update_normal_time,"update_point":update_point,"update_control":update_control,"update_content":update_content},
			type:'post',
			success:function(msg){
				//alert(msg);
				if(msg == 1){
					
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

	function delete_time_and_energe(delete_id){
		id = delete_id;
		//alert(id);
		$.ajax({
			url:'controller/c_time_and_energe_manage.php?act=delete',
			data:{'id':id},
			type:'post',
			success:function(msg){
				//alert(msg);
				if(msg == 1){
					alert('删除成功');
					window.location.href=window.location.href; 
				}
				
			}
		});
	}

	function back_update(back_id){
		id = back_id;
		//alert(id);
		$.ajax({
			url:'controller/c_time_and_energe_manage.php?act=back_update',
			data:{'id':id},
			type:'post',
			success:function(msg){
				//alert(msg);
				if(msg == 1){
					alert('更新成功');
					window.location.href=window.location.href; 
				}
				
			}
		});
	}



</script>


<script type="text/javascript" src="datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="datetimepicker/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>
