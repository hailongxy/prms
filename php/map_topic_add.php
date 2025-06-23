<!-- BEGIN HEADER -->

<?php	include 'header.php';	?>

<link rel="stylesheet" type="text/css" href="gooflow/GooFlow/codebase/GooFlow2.css"/>

<script>
</script>

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

                    <h3 class="page-title">

                        新增流程图

                    </h3>

                </div>

            </div>

            <!-- END PAGE HEADER-->

            <!-- BEGIN PAGE CONTENT-->

            <div class="row-fluid">

                <div class="span12">

                    <!-- BEGIN SAMPLE FORM PORTLET-->

                    <div class="portlet box blue tabbable">

                        <div class="portlet-title">

                            <div class="caption">

                                <span class="hidden-480">　</span>

                            </div>

                        </div>

                        <div class="portlet-body form">

                            <div class="tabbable portlet-tabs">

                                <ul class="nav nav-tabs">

                                    <li><a href="#portlet_tab3" data-toggle="tab">　</a></li>

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane active" id="portlet_tab1">

                                        <!-- BEGIN FORM-->

                                        <form action="#" class="form-horizontal">

                                            <div class="control-group">

                                                <label class="control-label">标题：</label>

                                                <div class="controls">

                                                    <input id="update_title" type="text" placeholder="" class="m-wrap large" />

                                                    <span class="help-inline"></span>

                                                </div>

                                            </div>

                                            <div class="control-group">

                                                <label class="control-label">内容：</label>

                                                <div class="controls">

                                                    <div class="controls" style="margin-left:0px;">
                                                        <div id="update_content" style=" width:1000px;height:400px;"></div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="form-actions">

                                                <button type="button" class="btn blue update_save" id="update_save"><i class="icon-ok"></i> 保存</button>

                                                <button type="button" class="btn cancel">返回</button>

                                            </div>

                                        </form>

                                        <!-- END FORM-->

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- END SAMPLE FORM PORTLET-->

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

<script type="text/javascript" src="gooflow/GooFlow/data.js"></script>
<script type="text/javascript" src="gooflow/GooFunc.js"></script>
<script type="text/javascript" src="gooflow/json2.js"></script>
<script type="text/javascript" src="gooflow/GooFlow/codebase/GooFlow.js"></script>
<script type="text/javascript">
    var property = {
        width: 1000,
        height: 600,
        toolBtns: ["start round", "end round", "task round", "node", "chat", "state", "plug", "join", "fork", "complex mix"],
        haveHead: true,
        headBtns: ["new", "open", "save", "undo", "redo", "reload"], //如果haveHead=true，则定义HEAD区的按钮
        haveTool: true,
        haveGroup: true,
        useOperStack: true
    };
    var remark = {
        cursor: "选择指针",
        direct: "结点连线",
        start: "入口结点",
        "end": "结束结点",
        "task": "任务结点",
        node: "自动结点",
        chat: "决策结点",
        state: "状态结点",
        plug: "附加插件",
        fork: "分支结点",
        "join": "联合结点",
        "complex mix": "复合结点",
        group: "组织划分框新增开关"
    };
    var update_content;
    $(document).ready(function() {
        update_content = $.createGooFlow($("#update_content"), property);
        update_content.setNodeRemarks(remark);
        update_content.loadData('');
    });
</script>

<script type="application/javascript">

    //新增保存
    $(".update_save").click(function(){//输出选中的值

        var update_title = $('#update_title').val();
        var update_content_text = JSON.stringify(update_content.exportData());
        $.ajax({
            url:'controller/c_map_topic_manage.php?act=add_save',
            data:{'add_title':update_title,'add_content':update_content_text,'topicid':'<?php	echo	$_GET['topicid'];	?>'},
            type:'post',
            success:function(msg){
                if(msg == 1){

                    alert('新增成功');
                    window.location.href=document.referrer;

                }
            }
        });

    });

    $(".cancel").click(function(){//返回
        window.location.href=document.referrer;
    });

</script>