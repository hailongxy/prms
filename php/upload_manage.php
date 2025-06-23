	<?php	include 'header.php';	?>
	<?php	
	$_SESSION['upload_folder'] = $_GET['upload_folder'];
	
	?>

	<link href="media/css/jquery.fancybox.css" rel="stylesheet" />

	<link href="media/css/jquery.fileupload-ui.css" rel="stylesheet" />

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

							图片上传

						</h3>

						

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->

				<div class="row-fluid">

					<div class="span12">
                    
                    
						<div class="portlet box green">

							<div class="portlet-title">

							  <div class="tools" style="height:22px;">

							  </div>

							</div>

							<div class="portlet-body">
                    

                                <blockquote>
        
        <p>jQuery File Upload 文件上传插件支持多文件选择、文件拖拽、上传进度显示以及跨域名、分块、可恢复的文件上传插件，<br>
               同时支持多个后台服务语言平台(PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) 也支持标准的Html Form表单上传</p>
                                </blockquote>
        
                                <br>
        
                                <!-- The file upload form used as target for the file upload widget -->
        
                                <form id="fileupload" action="upload1/server/php/index.php" method="POST" enctype="multipart/form-data">
        
                                    <!-- Redirect browsers with JavaScript disabled to the origin page -->
        
                                    <noscript><input type="hidden" name="redirect" value="http://blueimp.github.com/jQuery-File-Upload/"></noscript>
        
                                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        
                                    <div class="row-fluid fileupload-buttonbar">
        
                                        <div class="span7">
        
                                            <!-- The fileinput-button span is used to style the file input field as button -->
        
                                            <span class="btn green fileinput-button">
        
                                            <i class="icon-plus icon-white"></i>
        
                                            <span>添加文件...</span>
        
                                            <input type="file" name="files[]" multiple>
        
                                            </span>
        
                                            <button type="submit" class="btn blue start">
        
                                            <i class="icon-upload icon-white"></i>
        
                                            <span>开始上传</span>
        
                                            </button>
        
                                            <button type="reset" class="btn yellow cancel">
        
                                            <i class="icon-ban-circle icon-white"></i>
        
                                            <span>取消上传</span>
        
                                            </button>
        
                                            <button type="button" class="btn red delete">
        
                                            <i class="icon-trash icon-white"></i>
        
                                            <span>删除</span>
        
                                            </button>
        
                                            <input type="checkbox" class="toggle fileupload-toggle-checkbox">
        
                                        </div>
        
                                        <!-- The global progress information -->
        
                                        <div class="span5 fileupload-progress fade">
        
                                            <!-- The global progress bar -->
        
                                            <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
        
                                                <div class="bar" style="width:0%;"></div>
        
                                            </div>
        
                                            <!-- The extended global progress information -->
        
                                            <div class="progress-extended">&nbsp;</div>
        
                                        </div>
        
                                    </div>
        
                                    <!-- The loading indicator is shown during file processing -->
        
                                    <div class="fileupload-loading"></div>
        
                                    <br>
        
                                    <!-- The table listing the files available for upload/download -->
        
                                    <table role="presentation" class="table table-striped">
        
                                        <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
        
                                    </table>
        
                                </form>
        
                                <br>
        
                                <div class="well">
        
                                    <h3>Demo Notes</h3>
        
                                    <ul>
                        <li>演示DEMO最大上传文件大小为<strong>1 MB</strong> (默认是没有限制).</li>
                        <li>只能上传图片格式文件(<strong>JPG, GIF, PNG</strong>).</li>
                        <li>上传文件自动删除在<strong>3分钟之后</strong>.</li>
                        <li>你可以<strong>拖拽</strong> 文件从你的桌面到这个页面(看下<a href="https://github.com/blueimp/jQuery-File-Upload/wiki/Browser-support">浏览器支持</a>).</li>
                        <li>更多信息查看 <a href="https://github.com/blueimp/jQuery-File-Upload">项目网站</a> 和 <a href="https://github.com/blueimp/jQuery-File-Upload/wiki">文档</a> .</li>
                        <li>样式是基于Twitter's <a href="http://twitter.github.com/bootstrap/">Bootstrap</a> CSS 框架以及图标是来自<a href="http://glyphicons.com/">Glyphicons</a>.</li>
                    </ul>
        
                                </div>
        
                            </div>
        
                        </div>
        
                        <div class="row-fluid">
        
                            <div class="span12">	<!--遍历所有文件-->
        
                                <script id="template-upload" type="text/x-tmpl">
        
                                    {% for (var i=0, file; file=o.files[i]; i++) { %}
        
                                        <tr class="template-upload fade">
        
                                            <td class="preview"><span class="fade"></span></td>
        
                                            <td class="name"><span>{%=file.name%}</span></td>	<!--文件名称-->
        
                                            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        
                                            {% if (file.error) { %}
        
                                                <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        
                                            {% } else if (o.files.valid && !i) { %}
        
                                                <td>
        
                                                    <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
        
                                                </td>
        
                                                <td class="start">{% if (!o.options.autoUpload) { %}
        
                                                    <button class="btn">	<!--自动上传-->
        
                                                        <i class="icon-upload icon-white"></i>
        
                                                        <span>Start</span>
        
                                                    </button>
        
                                                {% } %}</td>
        
                                            {% } else { %}
        
                                                <td colspan="2"></td>
        
                                            {% } %}
        
                                            <td class="cancel">{% if (!i) { %}
        
                                                <button class="btn red">
        
                                                    <i class="icon-ban-circle icon-white"></i>
        
                                                    <span>Cancel</span>	<!--退出-->
        
                                                </button>
        
                                            {% } %}</td>
        
                                        </tr>
        
                                    {% } %}
        
                                </script>
        
                                <!-- The template to display files available for download -->
        
                                <script id="template-download" type="text/x-tmpl">
        
                                    {% for (var i=0, file; file=o.files[i]; i++) { %}
        
                                        <tr class="template-download fade">
        
                                            {% if (file.error) { %}
        
                                                <td></td>
        
                                                <td class="name"><span>{%=file.name%}</span></td>
        
                                                <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>	<!--格式化文件大小-->
        
                                                <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        
                                            {% } else { %}
        
                                                <td class="preview">
        
                                                {% if (file.url) { %}
        
                                                    <a class="fancybox-button" data-rel="fancybox-button" href="{%=file.url%}" title="{%=file.name%}">	<!--文件路径，文件名称-->
                                                            <img width="50" height="50" src="{%=file.url%}">	<!--缩略图-->
                                                    </a>
        
                                                {% } %}</td>
        
                                                <td class="name">
        
                                                    <a href="{%=file.url%}" title="{%=file.title%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.title%}</a>
        
                                                </td>
        
                                                <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        
                                                <td colspan="2"></td>
        
                                            {% } %}
        
                                            <td class="delete">
        
                                                <button class="btn red delete_image" image_url="{%=file.url%}" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
        
                                                    <i class="icon-trash icon-white"></i>
        
                                                    <span>Delete</span>
        
                                                </button>
        
                                                <input type="checkbox" class="fileupload-checkbox hide" name="delete" value="1">
        
                                            </td>
        
                                        </tr>
        
                                    {% } %}
        
                                </script>
        
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




	<!-- BEGIN PAGE LEVEL PLUGINS -->

	<script src="media/js/jquery.fancybox.pack.js"></script>

	<!-- BEGIN:File Upload Plugin JS files-->

	<script src="media/js/jquery.ui.widget.js"></script>	<!--插件-->

	<!-- The Templates plugin is included to render the upload/download listings -->

	<script src="media/js/tmpl.min.js"></script>

	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->

	<script src="media/js/load-image.min.js"></script>	<!--加载图片-->

	<!-- The Canvas to Blob plugin is included for image resizing functionality -->

	<script src="media/js/canvas-to-blob.min.js"></script>

	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->

	<script src="media/js/jquery.iframe-transport.js"></script>

	<!-- The basic File Upload plugin -->

	<script src="media/js/jquery.fileupload.js"></script>	<!--文件上传-->

	<!-- The File Upload file processing plugin -->

	<script src="media/js/jquery.fileupload-fp.js"></script>

	<!-- The File Upload user interface plugin -->

	<script src="media/js/jquery.fileupload-ui.js"></script>	<!--文件上传ui-->

	<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->

	<!--[if gte IE 8]><script src="media/js/jquery.xdr-transport.js"></script><![endif]-->

	<!-- END:File Upload Plugin JS files-->

	<!-- END PAGE LEVEL PLUGINS -->
	<script src="media/js/form-fileupload.js"></script>	<!--表单文件上传-->

	<script>

		jQuery(document).ready(function() {

		// initiate layout and plugins


		FormFileUpload.init();	//文件上传初始化

		});
		
		$('.delete_image').live("click",function(){
			var image_url = $(this).attr('image_url');
			$.ajax({
				url:'controller/c_upload_manage.php?act=delete',
				data:{'image_url':image_url},
				type:'post',
				success:function(msg){
					if(msg == 1){
						alert('删除成功');
						window.location.href=window.location.href; 
					}
					
				}
			});
		});
	</script>
