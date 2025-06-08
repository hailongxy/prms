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

							<?php echo $mind_menu[$_GET['mindid']] ?>管理 <small></small>
                            <a type="button" class="btn green" style="float:right; margin-right:10px;" href="/special_mind.php?menu_type=mind&mindid=<?php  echo $_GET['mindid'];   ?>&type=add">新增思维导图</a>
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

if(isset($_GET['select_status'])){
    $select_status = $_GET['select_status'];
}else{
    $select_status = '';
}

$sql = "SELECT COUNT(*) FROM special_mind where userid = '".$_SESSION['userid']."'  and mindid = ".$_GET['mindid']." and (title like '%".$select_title."%' or content like '%".$select_title."%') and status like '%{$select_status}%' order by id desc";
$row = mysqli_fetch_array( mysqli_query($con,$sql) );

$count = $row[0];

$last_page = (int)($count/10)+1;

$result = mysqli_query($con,"SELECT * FROM special_mind where userid = '".$_SESSION['userid']."'  and mindid = ".$_GET['mindid']." and (title like '%".$select_title."%' or content like '%".$select_title."%') and status like '%{$select_status}%' order by id desc limit ".$start_item.",10");

$arList = array();

while($row = mysqli_fetch_array($result)){

	$arList[] = $row;
	
}

?>
                                
    <div class="control-group">

        <span style="line-height:30px">标题：</span>

        <input type="text" placeholder="" class="m-wrap medium" id="select_title" value="<?php	echo	$select_title;	?>">

        <span style="line-height:30px">状态：</span>

        <select class="small m-wrap" tabindex="1" id="select_status">
            <option value=""></option>
            <?php	if(in_array($_GET['mindid'],[4,236,252])){	?>
                <option <?php if($select_status == "未解决") echo "selected"; ?> value="未解决">未解决</option>
                <option <?php if($select_status == "已解决") echo "selected"; ?> value="已解决">已解决</option>
                <option <?php if($select_status == "无需解决") echo "selected"; ?> value="无需解决">无需解决</option>
            <?php	}else if($_GET['mindid'] == 48||$_GET['mindid'] == 62||$_GET['mindid'] == 87){	?>
                <option <?php if($select_status == "未完成") echo "selected"; ?> value="未完成">未完成</option>
                <option <?php if($select_status == "已完成") echo "selected"; ?> value="已完成">已完成</option>
            <?php	}	?>
        </select>

        <button type="button" class="btn green" id="search">查询</button>
    </div>

<table class="table table-bordered table-hover">

									<thead>

										<tr>

											<th width="10%">ID</th>
											<th>标题</th>
											<th>状态</th>
											<th width="18%" class="hidden-480">添加时间</th>

											<th width="11%">修改</th>
											<th width="10%">删除</th>

										</tr>

									</thead>

									<tbody>
									<?php	
									if(!empty($arList)){
										foreach($arList as $row){
									?>
										<tr>

											<td><?php	echo $row['id'];	?></td>

											<td><?php	echo $row['title'];	?></td>
											<td><?php	echo $row['status'];	?></td>
											<td class="hidden-480"><?php	echo $row['createtime'];	?></td>

                                            <td><a href="/special_mind.php?menu_type=mind&mindid=<?php  echo $_GET['mindid'];   ?>&type=edit&id=<?php	echo $row['id'];	?>">修改</a>
                                            </td>
											<td><a href="javascript:;" onClick="delete_special_mind(<?php	echo $row['id'];	?>);">删除</a></td>

										</tr>
                                    <?php	
										}
									}
									?>
									</tbody>

								</table>                                

<?php
	mysqli_close($con);
?>

<div class="pagination pagination-centered">

									<ul>
                                    	<?php	if($page > 1){	?>
										<li><a href="special_mind_manage.php?menu_type=mind&mindid=<?php	echo	$_GET['mindid'];	?>&page=1&select_title=<?php	echo	$select_title;		?>&select_status=<?php	echo	$select_status;		?>">首页</a></li>
										<li><a href="special_mind_manage.php?menu_type=mind&mindid=<?php	echo	$_GET['mindid'];	?>&page=<?php	echo	$page-1;	?>&select_title=<?php	echo	$select_title;		?>&select_status=<?php	echo	$select_status;		?>">上一页</a></li>
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
										<li class="active"><a href="special_mind_manage.php?menu_type=mind&mindid=<?php	echo	$_GET['mindid'];	?>&page=<?php	echo	$i;	?>&select_title=<?php	echo	$select_title;		?>&select_status=<?php	echo	$select_status;		?>"><?php	echo	$i;	?></a></li>
                                        <?php	}else{	?>
										<li><a href="special_mind_manage.php?menu_type=mind&mindid=<?php	echo	$_GET['mindid'];	?>&page=<?php	echo	$i;	?>&select_title=<?php	echo	$select_title;		?>&select_status=<?php	echo	$select_status;		?>"><?php	echo	$i;	?></a></li>
                                       	<?php	}	?> 
                                       	<?php	}	?> 

                                        <?php	if($page < $last_page){	?>
										<li><a href="special_mind_manage.php?menu_type=mind&mindid=<?php	echo	$_GET['mindid'];	?>&page=<?php	echo	$page+1;	?>&select_title=<?php	echo	$select_title;		?>&select_status=<?php	echo	$select_status;		?>">下一页</a></li>
										<li><a href="special_mind_manage.php?menu_type=mind&mindid=<?php	echo	$_GET['mindid'];	?>&page=<?php	echo	$last_page;	?>&select_title=<?php	echo	$select_title;		?>&select_status=<?php	echo	$select_status;		?>">末页</a></li>
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

<script type="application/javascript">

	function delete_special_mind(delete_id){
		id = delete_id;
		$.ajax({
			url:'controller/c_special_mind_manage.php?act=delete',
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
        var select_status = $('#select_status option:selected').val();
		window.location.href=window.location.href+'&select_title='+select_title+'&select_status='+select_status;
	});
</script>