
	<!-- BEGIN HEADER -->

		<?php	include 'header.php';	?>

	<link rel="stylesheet" type="text/css" href="media/css/jquery.nestable.css" />
    
	<link rel="stylesheet" href="zTree_v3/css/demo.css" type="text/css">
	<link rel="stylesheet" href="zTree_v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
    
	<style type="text/css">
.ztree li span.button.add {margin-left:2px; margin-right: -1px; background-position:-144px 0; vertical-align:top; *vertical-align:middle}
	</style>
		<script>
			 var editor = UE.getEditor('content');
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

							生命专题
                            <button type="button" class="btn green" style="float:right; margin-right:10px;" onClick="add_top_live();">新增一级生命</button>
						</h3>

						

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->

				

				<div class="row-fluid">

					

				</div>

				

				<div class="row-fluid">

					<div class="span6">

						<div class="portlet box blue">

							<div class="portlet-title">

								<div class="caption"><i class="icon-comments"></i>问题列表</div>
							</div>




		<ul id="treeDemo" class="ztree" style="width:auto; height:auto; margin-top:0px; padding-top:0px;"></ul>
    					

						</div>

					</div>

					<div class="span6">

						<div class="portlet box green">

							<div class="portlet-title">

								<div class="caption"><i class="icon-comments"></i>详情</div>

								

							</div>

							<div class="portlet-body">

<form action="#" class="form-horizontal">

<div class="control-group">

													<label class="control-label" style="width:70px">ID：</label>

													<label id="update_id" class="control-label" style="width:70px; text-align:left; margin-left:10px"></label>

												</div>
                                                
<div class="control-group">

													<label class="control-label" style="width:80px">创建时间：</label>

													<label id="update_createtime" class="control-label" style="width:170px; text-align:left; margin-left:10px"></label>

												</div>                                                
                                                
				<div class="control-group">

													<label class="control-label" style="width:80px">标题：</label>

													<div class="controls" style=" margin-left:80px">
													<label id="update_title" class="control-label" style="width:100%; text-align:left; margin-left:10px"></label>

													</div>

												</div>
                                                <div class="control-group">

													<label class="control-label" style="width:80px">熟练程度：</label>

													<div class="controls" style="margin-left:80px">

														<input id="update_metric" type="text" placeholder="" class="m-wrap medium">


													</div>

												</div>
				<div class="control-group">

				  <label class="control-label" style="width:80px;">内容：</label>

													<div class="controls" style="margin-left:0px;">

														
			 <script id="content" type="text/plain"  style="width:100%;height:400px;"></script>
													</div>

				</div>

												<div class="form-actions">

													<button id="update_save" type="button" class="btn blue"><i class="icon-ok"></i> 保存</button>


												</div>

							  </form>
							</div>

						</div>

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



	<script type="text/javascript" src="zTree_v3/js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="zTree_v3/js/jquery.ztree.core-3.5.js"></script>
	<script type="text/javascript" src="zTree_v3/js/jquery.ztree.excheck-3.5.js"></script>
	<script type="text/javascript" src="zTree_v3/js/jquery.ztree.exedit-3.5.js"></script>
	<SCRIPT type="text/javascript">
		<!--
		var setting = {
			async: {	//异步
				enable: true,
				url:"controller/getNodes_live.php",
				autoParam:["id", "name=n", "level=lv"],	//自动参数
				otherParam:{"otherParam":"zTreeAsyncTest"},	//其他参数
				dataFilter: filter	//过滤器
			},
			view: {expandSpeed:"",	//扩张速度
				addHoverDom: addHoverDom,	//添加滑动DOM
				removeHoverDom: removeHoverDom,	//删除滑动DOM
				selectedMulti: false	//多选
			},
			edit: {
				enable: true	//可用
			},
			data: {
				simpleData: {
					enable: true
				}
			},
			callback: {
				beforeRemove: beforeRemove,	//开始删除
				beforeRename: beforeRename,	//开始重命名
				onClick: zTreeOnClick,
				onDrop:zTreeOnDrop,
			}
		};
		
		
		function zTreeOnDrop(event, treeId, treeNodes, targetNode, moveType) {
			id = treeNodes[0].id;
			//var parent_id = targetNode.id;
			//alert(targetNode.id);
			//console.log(event.target);
			//alert(targetNode);
			
			if(targetNode == null){
				var parent_id = '0';
			}else{
				var parent_id = targetNode.id;
			}
			
			//alert(parent_id);
			$.ajax({
				url:'controller/c_live.php?act=update_parent_id_save',
				data:{'id':id,'parent_id':parent_id},
				type:'post',
				success:function(msg){
					//alert(msg);
					if(msg == 1){
						//alert('重命名成功');
						//window.location.href=window.location.href; 
					}
				}
			});
		};
		
		function zTreeOnClick(event, treeId, treeNode) {
			id = treeNode.id;
			$.ajax({
				url:'controller/c_live.php?act=pre_update',
				data:{'id':id},
				type:'post',
				success:function(msg){
					var obj = eval('('+msg+')');
					//alert(obj['name']);
					$('#update_id').html(obj['id']);
					$('#update_createtime').html(obj['createtime']);
					$('#update_title').html(obj['title']);
					$('#update_metric').val(obj['metric']);
					editor.setContent(obj['content']);
				}
			});
			
					
		};
		
			

		function filter(treeId, parentNode, childNodes) {	//过滤器
			if (!childNodes) return null;
			for (var i=0, l=childNodes.length; i<l; i++) {
				childNodes[i].name = childNodes[i].name.replace(/\.n/g, '.');
			}
			return childNodes;
		}
		function beforeRemove(treeId, treeNode) {	//开始删除
			var zTree = $.fn.zTree.getZTreeObj("treeDemo");
			zTree.selectNode(treeNode);
			
			id = treeNode.id;	//要删除的节点的id
			//alert(id);
			$.ajax({
				url:'controller/c_live.php?act=delete',
				data:{'id':id},
				type:'post',
				success:function(msg){
					if(msg == 1){
						alert('删除成功');
					}
					
				}
			});
			
			return true;
		}		
		function beforeRename(treeId, treeNode, newName) {	//开始重命名
			//alert(treeId);
			if (newName.length == 0) {
				alert("节点名称不能为空.");
				return false;
			}else{
				id = treeNode.id;
				name = newName;
				var nameArray = newName.split("_");
				name = nameArray[0];
				$.ajax({
					url:'controller/c_live.php?act=update_name_save',
					data:{'id':id,'name':name},
					type:'post',
					success:function(msg){
						//alert(msg);
						if(msg == 1){
							//alert('重命名成功');
							//window.location.href=window.location.href; 
							
							
							$.ajax({
								url:'controller/c_live.php?act=pre_update',
								data:{'id':id},
								type:'post',
								success:function(msg){
									var obj = eval('('+msg+')');
									//alert(obj['name']);
									$('#update_id').html(obj['id']);
									$('#update_createtime').html(obj['createtime']);
									$('#update_title').html(obj['title']);
									$('#update_metric').val(obj['metric']);
									editor.setContent(obj['content']);
								}
							});
							
							
						}
					}
				});
			
			
			
			
			}
			
			return true;
		}

		var newCount = 1;
		function addHoverDom(treeId, treeNode) {	//添加滑动DOM
			var sObj = $("#" + treeNode.tId + "_span");
			if (treeNode.editNameFlag || $("#addBtn_"+treeNode.tId).length>0) return;
			var addStr = "<span class='button add' id='addBtn_" + treeNode.tId
				+ "' title='add node' onfocus='this.blur();'></span>";
			sObj.after(addStr);
			var btn = $("#addBtn_"+treeNode.tId);
			if (btn) btn.bind("click", function(){
				//alert(123);
				var zTree = $.fn.zTree.getZTreeObj("treeDemo");
				//zTree.addNodes(treeNode, {id:12233, pId:treeNode.id, name:"new node" + (newCount++)});	//添加节点

				//alert(123455);
				var parent_id = treeNode.id;
				$.ajax({
					url:'controller/c_live.php?act=add_save',
					data:{'add_parent_id':parent_id},
					type:'post',
					success:function(msg){
						//alert(msg);
						if(msg == 1){
							//alert('创建成功');
							
							var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
							var nodes = treeObj.getSelectedNodes();
							if (nodes.length>0) {
								nodes[0].isParent = true;	//设置为可展开的节点
								treeObj.reAsyncChildNodes(nodes[0], "refresh");	//刷新当前节点
								treeObj.expandNode(nodes[0], true, true, true);	//展开当前节点
							}			
							
							
						}
					}
				});


				
				
				return false;
			});
		};
		function removeHoverDom(treeId, treeNode) {	//删除滑动DOM
			$("#addBtn_"+treeNode.tId).unbind().remove();
		};

		$(document).ready(function(){	//页面开始
			$.fn.zTree.init($("#treeDemo"), setting);	//初始化
			setTimeout("expandallnode()",2000);
		});
		
	var node_id_array = new Array();
		
	function filter1(node) {
		return true;
	}	
		
	function expandallnode(){
		var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
		var nodes = treeObj.getNodes(); 
		for(i = 0;i<nodes.length;i++){
			if(nodes[i].isParent == true){	//是否为可展开的节点
				treeObj.reAsyncChildNodes(nodes[i], "refresh");	//刷新当前节点
				treeObj.expandNode(nodes[i], true, true, true);	//展开当前节点
				setTimeout("expandallnode1('"+nodes[i].id+"')",2000);
				
			}
		}    
	}
	
	function expandallnode1(nodeid){
		var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
		var node = treeObj.getNodeByParam("id", nodeid, null);
		for(i = 0;i<node.children.length;i++){
			if(node.children[i].isParent == true){	//是否为可展开的节点
				treeObj.reAsyncChildNodes(node.children[i], "refresh");	//刷新当前节点
				treeObj.expandNode(node.children[i], true, true, true);	//展开当前节点
				setTimeout("expandallnode1('"+node.children[i].id+"')",2000);
			}
		}    
	}
	
		
	//编辑保存
    $("#update_save").click(function(){//输出选中的值
		var update_metric = $('#update_metric').val();
		var update_content = editor.getContent();
		$.ajax({
			url:'controller/c_live.php?act=update_save',
			data:{'id':id,'update_metric':update_metric,'update_content':update_content},
			type:'post',
			success:function(msg){
				//alert(msg);
				if(msg == 1){
					alert('编辑成功');
					window.location.href=window.location.href; 
				}
			}
		});
	});
		
		
		//$('.treenode_a').live('click', function() {
			//alert(123);
		//});
		
		//-->
		
	function add_top_live(){	//新增一级生命
		$.ajax({
			url:'controller/c_live.php?act=add_top_save',
			data:{},
			type:'post',
			success:function(msg){
				if(msg == 1){
					alert('新增成功');
					window.location.href=window.location.href; 
				}
			}
		});
	}		
		
	</SCRIPT>
