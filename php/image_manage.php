		<?php	include 'header.php';	?>


	<link href="media/css/jquery.fancybox.css" rel="stylesheet" />

	<link href="media/css/chosen.css" rel="stylesheet" type="text/css"/>

	<!-- BEGIN HEADER -->

	

	<!-- END HEADER -->

	<!-- BEGIN CONTAINER -->

	<div class="page-container row-fluid">

		<!-- BEGIN SIDEBAR -->

			<?php	include 'left.php';	?>


		<!-- END SIDEBAR -->

		<!-- BEGIN PAGE -->

		<div class="page-content">

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

							图片管理

						</h3>

						

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN GALLERY MANAGER PORTLET-->

						<div class="portlet box purple">

							<div class="portlet-title">

								<div class="caption"><i class="icon-reorder"></i>图片管理</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">

								<!-- BEGIN GALLERY MANAGER PANEL-->

								<div class="row-fluid">

									<div class="span4">
										<?php
                                        	if(isset($_GET['folder'])){
												$folder = $_GET['folder'];
												//print_r($folder);
                                            	$title_result = mysqli_query($con,"SELECT * FROM folder where userid = '".$_SESSION['userid']."'  and content='".$folder."'");
												if($row = mysqli_fetch_array($title_result)){	
													$title = $row['title'];
												}
											}else{
												$folder = '';
												$title = '所有分类';
											}

										?>
										<h4>浏览 <?php	echo $title;	?></h4>

									</div>

									<div class="span8">

										<div class="pull-right">

											<?php
                                            $folder_result = mysqli_query($con,"SELECT * FROM folder where userid = '".$_SESSION['userid']."'  order by id desc ");

											?>
		
											<select data-placeholder="Select Category" class="chosen" tabindex="-1" id="inputCategory">
												<option value="">所有分类</option>
												<?php	while($row = mysqli_fetch_array($folder_result)){	?>
												<option <?php	if($row['content'] == $folder){ echo	'selected'; };	?> value="<?php	echo $row['content'];	?>"><?php	echo $row['title'];	?></option>
												<?php	}	?>

											</select>

											

											<div class="clearfix space5"></div>

											

										</div>

									</div>

								</div>

								<!-- END GALLERY MANAGER PANEL-->

								<hr class="clearfix" />

								<!-- BEGIN GALLERY MANAGER LISTING-->


<?php	
if(isset($_GET['page'])){
	$start_item = ($_GET['page']-1)*20;
	$page = $_GET['page'];
}else{
	$start_item = 0;	
	$page = 1;
}
if($folder == ''){
	$sql = "SELECT COUNT(*) FROM image where userid = '".$_SESSION['userid']."'  order by id desc";
}else{
	$sql = "SELECT COUNT(*) FROM image where userid = '".$_SESSION['userid']."'  and folder = '".$folder."' order by id desc";
}
$row = mysqli_fetch_array( mysqli_query($con,$sql) );
$count = $row[0];

$last_page = (int)($count/20)+1;
if($folder == ''){
	$result = mysqli_query($con,"SELECT * FROM image where userid = '".$_SESSION['userid']."'  order by id desc limit ".$start_item.",20");
}else{
	$result = mysqli_query($con,"SELECT * FROM image where userid = '".$_SESSION['userid']."'   and folder = '".$folder."'  order by id desc limit ".$start_item.",20");
}

?>


								<div class="row-fluid">

									<?php
									$position = 0;	
									while($row = mysqli_fetch_array($result)){
										if($position >= 0&&$position <= 3){	
									?>

								  <div class="span3">

										<div class="item">

											<a class="fancybox-button" data-rel="fancybox-button" title="Photo" href="upload1/server/php/<?php	echo $row['url'];	?>">

												<div class="zoom">

													<img src="upload1/server/php/<?php	echo $row['url'];	?>" alt="Photo" />                    

													<div class="zoom-icon"></div>

												</div>

											</a>

											<div class="details">

												<a href="#" class="icon"><i class="icon-paper-clip"></i></a>

												<a href="#" class="icon"><i class="icon-link"></i></a>

												<a href="#" class="icon"><i class="icon-pencil"></i></a>

												<a href="#" class="icon"><i class="icon-remove"></i></a>    

											</div>

										</div>

									</div>
                                    <?php	
											$position++;
											}else{
												break;	
											}
											
										}	
										?>
								</div>
								<div class="space10"></div>								<!-- END GALLERY MANAGER LISTING-->



								<div class="row-fluid">

									<?php
									$position = 0;	
									while($row = mysqli_fetch_array($result)){
										if($position >= 0&&$position <= 3){	
									?>

								  <div class="span3">

										<div class="item">

											<a class="fancybox-button" data-rel="fancybox-button" title="Photo" href="upload1/server/php/<?php	echo $row['url'];	?>">

												<div class="zoom">

													<img src="upload1/server/php/<?php	echo $row['url'];	?>" alt="Photo" />                    

													<div class="zoom-icon"></div>

												</div>

											</a>

											<div class="details">

												<a href="#" class="icon"><i class="icon-paper-clip"></i></a>

												<a href="#" class="icon"><i class="icon-link"></i></a>

												<a href="#" class="icon"><i class="icon-pencil"></i></a>

												<a href="#" class="icon"><i class="icon-remove"></i></a>    

											</div>

										</div>

									</div>
                                    <?php	
											$position++;
											}else{
												break;	
											}
											
										}	
										?>
								</div>
								<div class="space10"></div>								<!-- END GALLERY MANAGER LISTING-->

								<div class="row-fluid">

									<?php
									$position = 0;	
									while($row = mysqli_fetch_array($result)){
										if($position >= 0&&$position <= 3){	
									?>

								  <div class="span3">

										<div class="item">

											<a class="fancybox-button" data-rel="fancybox-button" title="Photo" href="upload1/server/php/<?php	echo $row['url'];	?>">

												<div class="zoom">

													<img src="upload1/server/php/<?php	echo $row['url'];	?>" alt="Photo" />                    

													<div class="zoom-icon"></div>

												</div>

											</a>

											<div class="details">

												<a href="#" class="icon"><i class="icon-paper-clip"></i></a>

												<a href="#" class="icon"><i class="icon-link"></i></a>

												<a href="#" class="icon"><i class="icon-pencil"></i></a>

												<a href="#" class="icon"><i class="icon-remove"></i></a>    

											</div>

										</div>

									</div>
                                    <?php	
											$position++;
											}else{
												break;	
											}
											
										}	
										?>
								</div>
								<div class="space10"></div>								<!-- END GALLERY MANAGER LISTING-->
								<div class="row-fluid">

									<?php
									$position = 0;	
									while($row = mysqli_fetch_array($result)){
										if($position >= 0&&$position <= 3){	
									?>

								  <div class="span3">

										<div class="item">

											<a class="fancybox-button" data-rel="fancybox-button" title="Photo" href="upload1/server/php/<?php	echo $row['url'];	?>">

												<div class="zoom">

													<img src="upload1/server/php/<?php	echo $row['url'];	?>" alt="Photo" />                    

													<div class="zoom-icon"></div>

												</div>

											</a>

											<div class="details">

												<a href="#" class="icon"><i class="icon-paper-clip"></i></a>

												<a href="#" class="icon"><i class="icon-link"></i></a>

												<a href="#" class="icon"><i class="icon-pencil"></i></a>

												<a href="#" class="icon"><i class="icon-remove"></i></a>    

											</div>

										</div>

									</div>
                                    <?php	
											$position++;
											}else{
												break;	
											}
											
										}	
										?>
								</div>
								<div class="space10"></div>								<!-- END GALLERY MANAGER LISTING-->


								<!-- BEGIN GALLERY MANAGER PAGINATION-->

								<div class="row-fluid">

									<div class="span12">

										<div class="pagination pull-right">

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
										<li class="active"><a href="image_manage.php?page=<?php	echo	$i;	?>"><?php	echo	$i;	?></a></li>
                                        <?php	}else{	?>
										<li><a href="image_manage.php?page=<?php	echo	$i;	?>"><?php	echo	$i;	?></a></li>
                                       	<?php	}	?> 
                                       	<?php	}	?> 
                                        
                                        
                                        <?php	if($page < $last_page){	?>
										<li><a href="image_manage.php?page=<?php	echo	$page+1;	?>">下一页</a></li>
										<li><a href="image_manage.php?page=<?php	echo	$last_page;	?>">末页</a></li>
										<?php	}	?>
									</ul>

										</div>

									</div>

								</div>

								<!-- END GALLERY MANAGER PAGINATION-->

							</div>

						</div>

						<!-- END GALLERY MANAGER PORTLET-->

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




	<script src="media/js/jquery.fancybox.pack.js"></script>   

	<script type="text/javascript" src="media/js/chosen.jquery.min.js"></script>



	<script src="media/js/gallery.js"></script>  

	<script>

		jQuery(document).ready(function() {       

		   // initiate layout and plugins


		   Gallery.init();

		});
		
		$("#inputCategory").change(function(){
		 
			var folder =$(this).val();
			//alert(folder);		
			if(folder == ''){
				window.location.href="image_manage.php";  	//所有分类
			}else{
				window.location.href="image_manage.php?folder="+folder;  
			}
		}); 
	</script>
