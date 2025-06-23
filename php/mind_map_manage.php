	<!-- BEGIN HEADER -->
		<?php	include 'header.php';	?>

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

							思维导图管理 <small></small>
							<a type="button" class="btn green" style="float:right; margin-right:10px;" href="/mind_map.php?type=add">新增思维导图</a>
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

$sql = "SELECT COUNT(*) FROM mind_map where userid = '".$_SESSION['userid']."' and title like '%".$select_title."%' order by id desc";
$row = mysqli_fetch_array( mysqli_query($con,$sql) );

$count = $row[0];

$last_page = (int)($count/10)+1;

$result = mysqli_query($con,"SELECT * FROM mind_map  where userid = '".$_SESSION['userid']."' and (title like '%".$select_title."%' or content like '%".$select_title."%') order by id desc limit ".$start_item.",10");

?>

<div class="control-group">

													<span style="line-height:30px">标题：</span>

														<input type="text" placeholder="" class="m-wrap medium" id="select_title" value="<?php	echo	$select_title;		?>">

<button type="button" class="btn green" id="search">查询</button>
												</div>                                

<table class="table table-bordered table-hover">

									<thead>

										<tr>

											<th width="10%">ID</th>

											<th>标题</th>

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

											<td class="hidden-480"><?php	echo $row['createtime'];	?></td>

											<td><a href="/mind_map.php?type=edit&id=<?php	echo $row['id'];	?>">修改</a>
                                            </td>
											<td><a href="javascript:;" onClick="delete_mind_map(<?php	echo $row['id'];	?>);">删除</a></td>

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
										<li><a href="mind_map_manage.php?page=1&select_title=<?php	echo	$select_title;		?>">首页</a></li>
										<li><a href="mind_map_manage.php?page=<?php	echo	$page-1;	?>&select_title=<?php	echo	$select_title;		?>">上一页</a></li>
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
										<li class="active"><a href="mind_map_manage.php?page=<?php	echo	$i;	?>&select_title=<?php	echo	$select_title;		?>"><?php	echo	$i;	?></a></li>
                                        <?php	}else{	?>
										<li><a href="mind_map_manage.php?page=<?php	echo	$i;	?>&select_title=<?php	echo	$select_title;		?>"><?php	echo	$i;	?></a></li>
                                       	<?php	}	?> 
                                       	<?php	}	?> 

                                        <?php	if($page < $last_page){	?>
										<li><a href="mind_map_manage.php?page=<?php	echo	$page+1;	?>&select_title=<?php	echo	$select_title;		?>">下一页</a></li>
										<li><a href="mind_map_manage.php?page=<?php	echo	$last_page;	?>&select_title=<?php	echo	$select_title;		?>">末页</a></li>
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

<script>
    var id = '';

	function delete_mind_map(delete_id){
		id = delete_id;
		$.ajax({
			url:'controller/c_mind_map_manage.php?act=delete&select_title=<?php	echo	$select_title;		?>',
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
		if(window.location.href.indexOf("?") > 0 ){
			window.location.href=window.location.href+'&select_title='+select_title;
		}else{
			window.location.href=window.location.href+'?select_title='+select_title;
		}
	});

</script>