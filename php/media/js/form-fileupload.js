
function getPar(par){
    //获取当前URL
    var local_url = document.location.href; 
    //获取要取得的get参数位置
    var get = local_url.indexOf(par +"=");
    if(get == -1){
        return false;   
    }   
    //截取字符串
    var get_par = local_url.slice(par.length + get + 1);    
    //判断截取后的字符串是否还有其他get参数
    var nextPar = get_par.indexOf("&");
    if(nextPar != -1){
        get_par = get_par.slice(0, nextPar);
    }
    return get_par;
}

var FormFileUpload = function () {


    return {
        //main function to initiate the module
        init: function () {	//初始化

            // Initialize the jQuery File Upload widget:
            $('#fileupload').fileupload({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: 'upload1/server/php/',	//上传路径
                dataType: 'json',	//数据类型
				success: function (data) {
					console.log(JSON.stringify(data));
					//var result = eval("("+data+")");
					var result = eval(data);
					//var result = JSON.parse(data);
					
					var total_url = result['files'][0]['url'];
					var file_name = total_url.substring(total_url.lastIndexOf('/')+1);
					var folder = getPar('upload_folder');
					var image_url = folder+'/'+file_name;
					var title = result['files'][0]['title'][0];
					$.ajax({
						url:'controller/c_upload_manage.php?act=add_save',
						data:{'title':title,'image_url':image_url,'folder':folder},
						type:'post',
						success:function(msg){
							//alert(msg);
							//if(msg == 1){
								//$('#add_modal').modal('hide');
								//alert('创建成功');
								//location.reload();
							//}
						}
					});
				},				
			});

            // Load existing files:
            // Demo settings:
            $.ajax({
                // Uncomment the following to send cross-domain cookies:
                //xhrFields: {withCredentials: true},
                url: $('#fileupload').fileupload('option', 'url'),
                dataType: 'json',	//数据类型
                context: $('#fileupload')[0],
                maxFileSize: 5000000,	//最大文件上传大小
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,	//文件格式
                process: [{
                        action: 'load',	//加载
                        fileTypes: /^image\/(gif|jpeg|png)$/,
                        maxFileSize: 20000000 // 20MB	//最大文件大小
                    }, {
                        action: 'resize',	//重置大小
                        maxWidth: 1440,
                        maxHeight: 900
                    }, {
                        action: 'save'	//保存
                    }
                ],
				//success: function (data) {
					//console.log(JSON.stringify(data));
				//},				
            }).done(function (result) {
                $(this).fileupload('option', 'done')
                    .call(this, null, {
                    result: result
                });
				//console.log(JSON.stringify(result));
            });

            // Upload server status check for browsers with CORS support:
            if ($.support.cors) {
                $.ajax({
                    url: 'upload1/server/php/',
                    type: 'HEAD',
					
                }).fail(function () {
                    $('<span class="alert alert-error"/>')
                        .text('Upload server currently unavailable - ' +
                        new Date())
                        .appendTo('#fileupload');	//追加
						
                });
            }

            // initialize uniform checkboxes  
            App.initUniform('.fileupload-toggle-checkbox');
        }

    };

}();