





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

							状态图表 <small></small>
							
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


								
                                
                                
                                
                                
                                
<div id="line" style="min-width:400px;height:400px"></div>                                





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
$(function () {
	
	
	$.ajax({
		url:'controller/c_lose_map_manage.php?act=get_lose_data',
		data:{},
		type:'post',
		success:function(msg){
			
			//alert(msg);
			
			var data1 = eval("("+msg+")");
  			Highcharts.setOptions({ global: { useUTC: false } });   
			$('#line').highcharts('StockChart', {
			//范围选择
				rangeSelector : {
					selected : 1,
					inputDateFormat: '%Y-%m-%d',
         			inputEditDateFormat: '%Y-%m-%d'

				},
				
			   xAxis: {  
					minTickInterval: 86400000,
				},  
				
				 yAxis: {  
						min: 0  ,
						allowDecimals:false,     //不显示小数
						align: 'right',
						//offset:-line_width,
					 labels:{
								 align: 'left',
							}
					},  
				 exporting:{  
					 enabled:false,  
				 },
				series : [{
					name : '状态图表',//data1.categories,
					//数据
					data : data1,
					//工具提示
					tooltip: {
						//valueDecimals: 2
					},
					//yAxis:{
						//allowDecimals:false //是否允许刻度有小数
					//}
				}]
			});
			$('.highcharts-yaxis-labels').children().attr('x','');
		}
    });

	
	
	
	
	
	/*
    $.getJSON('http://www.hcharts.cn/datas/jsonp.php?filename=aapl-c.json&callback=?', function (data) {
        // Create the chart
        $('#container').highcharts('StockChart', {


            rangeSelector : {
                selected : 1
            },

            title : {
                text : 'AAPL Stock Price'
            },

            series : [{
                name : 'AAPL',
                data : data,
                tooltip: {
                    valueDecimals: 2
                }
            }]
        });
    });
	*/

});

</script>