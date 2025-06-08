<?php	include 'header.php';	?>
<div class="page-container row-fluid">

    <?php	include 'left.php';	?>

    <div class="page-content" style="background:url(images/new_images/4436663_095951336812_2.jpg) repeat; background-size:cover">

        <div id="portlet-config" class="modal hide">

            <div class="modal-header">

                <button data-dismiss="modal" class="close" type="button"></button>

                <h3>portlet Settings</h3>

            </div>

            <div class="modal-body">

                <p>Here will be a configuration form</p>

            </div>

        </div>

        <div class="container-fluid">

            <div class="row-fluid">

                <div class="span12">

                    <h3 class="page-title">

                        <?php	echo	$topic_menu[$_GET['topicid']]	?>图表 <small></small>
                        
                    </h3>

                </div>

            </div>

            <div class="row-fluid">

                <div class="span12">

                    <div class="portlet box green">

                        <div class="portlet-title">
                          <div class="tools" style="height:22px;">

                          </div>

                        </div>

                        <div class="portlet-body">
                            
                            <div id="line" style="min-width:400px;height:400px"></div>                                
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php	include 'footer.php';	?>

<script type="application/javascript">
$(function () {
	
	$.ajax({
		url:'controller/c_special_topic_map_manage.php?act=get_topic_data',
		data:{'topicid':<?php	echo	$_GET['topicid'];	?>},
		type:'post',
		success:function(msg){
			
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
					 labels:{
								 align: 'left',
							}
					},  
				 exporting:{  
					 enabled:false,  
				 },
				series : [{
					name : '<?php	echo	$topic_menu[$_GET['topicid']]	?>',//data1.categories,
					//数据
					data : data1,
					//工具提示
					tooltip: {
					},
				}]
			});
			$('.highcharts-yaxis-labels').children().attr('x','');
		}
    });
});
</script>