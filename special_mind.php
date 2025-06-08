<!-- BEGIN HEADER -->
<?php	include 'header.php';	?>

<?php
if($_GET['type'] == 'edit'){
    $sql = mysqli_query($con,"SELECT * FROM special_mind WHERE id ='".$_GET['id']."' and userid = '".$_SESSION['userid']."'");
    $row = mysqli_fetch_array($sql);
}
?>

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

                        思维导图 <small></small>
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

                            <form action="#" class="form-horizontal">

                                <div class="control-group">

                                    <label class="control-label">标题</label>

                                    <div class="controls">

                                        <input id="title" type="text" class="m-wrap span12" value="<?php   echo $row['title'] ?? '';    ?>">

                                    </div>

                                </div>

                                <div class="control-group">

                                    <label class="control-label">内容</label>

                                </div>

                                <div id="map"></div>

                                <div class="form-actions">

                                    <button type="button" class="btn blue save"><i class="icon-ok"></i> 保存</button>

                                    <button type="button" onclick="window.history.back();" class="btn">返回</button>

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

<script src="/plugins/mind-elixir-core-develop/dist/regenerator-runtime.js"></script>
<script src="/plugins/mind-elixir-core-develop/dist/mind-elixir.js"></script>

<script>
    var id = '<?php echo $_GET['id'] ?? '';   ?>';
    var type = '<?php echo $_GET['type'] ?? '';   ?>';
    var mindid = '<?php echo $_GET['mindid'] ?? '';   ?>';

    console.log('MindElixir.SIDE', MindElixir.SIDE)
    let mind = new MindElixir({
        el: '#map',
        direction: MindElixir.SIDE,
        data: eval('('+'<?php    echo $row['content'] ?? '{}';    ?>'+')'),
        draggable: true,
        contextMenu: true,
        toolBar: true,
        nodeMenu: true,
        keypress: true,
    })
    mind.init()
    console.log('test E function', E('bd4313fbac40284b'))

    //编辑保存
    $(".save").click(function(){//输出选中的值
        if(type == 'add'){
            add();
        }else{
            update();
        }

    });

    function add() {
        var title = $('#title').val();
        var content = mind.getAllDataString();
        $.ajax({
            url:'controller/c_special_mind_manage.php?act=add_save&select_title=<?php	echo	$select_title ?? '';		?>',
            data:{'mindid':mindid,'add_title':title,'add_content':content},
            type:'post',
            success:function(msg){
                if(msg == 1){
                    $('#update_modal').modal('hide');
                    alert('创建成功');
                    window.history.back();
                }
            }
        });
    }

    function update() {
        var title = $('#title').val();
        var content = mind.getAllDataString();
        $.ajax({
            url:'controller/c_special_mind_manage.php?act=update_save&select_title=<?php	echo	$select_title ?? '';		?>',
            data:{'id':id,'update_title':title,'update_content':content},
            type:'post',
            success:function(msg){
                if(msg == 1){
                    alert('编辑成功');
                }
            }
        });
    }

</script>