	<!-- BEGIN HEADER -->
    <?php	include 'header.php';	?>

    <?php
    if($_GET['type'] == 'edit'){
        $sql = mysqli_query($con,"SELECT * FROM flow_chart WHERE id ='".$_GET['id']."' and userid = '".$_SESSION['userid']."'");
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

							流程图 <small></small>
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

                                    <div id="container"></div>

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

<script src="https://unpkg.com/@antv/x6/dist/x6.js"></script>

<script>
    var id = '<?php echo $_GET['id'];   ?>';
    var type = '<?php echo $_GET['type'];   ?>';

    const { Graph } = X6

    // 为了协助代码演示
    preWork()

    // #region 初始化画布
    const graph = new Graph({
        container: document.getElementById('graph-container')!,
        grid: true,
        mousewheel: {
        enabled: true,
            zoomAtMousePosition: true,
            modifiers: 'ctrl',
            minScale: 0.5,
            maxScale: 3,
    },
    connecting: {
        router: {
            name: 'manhattan',
                args: {
                padding: 1,
            },
        },
        connector: {
            name: 'rounded',
                args: {
                radius: 8,
            },
        },
        anchor: 'center',
            connectionPoint: 'anchor',
            allowBlank: false,
            snap: {
            radius: 20,
        },
        createEdge() {
            return new Shape.Edge({
                attrs: {
                    line: {
                        stroke: '#A2B1C3',
                        strokeWidth: 2,
                        targetMarker: {
                            name: 'block',
                            width: 12,
                            height: 8,
                        },
                    },
                },
                zIndex: 0,
            })
        },
        validateConnection({ targetMagnet }) {
            return !!targetMagnet
        },
    },
    highlighting: {
        magnetAdsorbed: {
            name: 'stroke',
                args: {
                attrs: {
                    fill: '#5F95FF',
                        stroke: '#5F95FF',
                },
            },
        },
    },
    resizing: true,
        rotating: true,
        selecting: {
        enabled: true,
            rubberband: true,
            showNodeSelectionBox: true,
    },
    snapline: true,
        keyboard: true,
        clipboard: true,
    })
    // #endregion

    // #region 初始化 stencil
    const stencil = new Addon.Stencil({
        title: '流程图',
        target: graph,
        stencilGraphWidth: 200,
        stencilGraphHeight: 180,
        collapsable: true,
        groups: [
            {
                title: '基础流程图',
                name: 'group1',
            },
            {
                title: '系统设计图',
                name: 'group2',
                graphHeight: 250,
                layoutOptions: {
                    rowHeight: 70,
                },
            },
        ],
        layoutOptions: {
            columns: 2,
            columnWidth: 80,
            rowHeight: 55,
        },
    })
    document.getElementById('stencil')!.appendChild(stencil.container)
    // #endregion

    // #region 快捷键与事件
    // copy cut paste
    graph.bindKey(['meta+c', 'ctrl+c'], () => {
        const cells = graph.getSelectedCells()
        if (cells.length) {
            graph.copy(cells)
        }
        return false
    })
    graph.bindKey(['meta+x', 'ctrl+x'], () => {
        const cells = graph.getSelectedCells()
        if (cells.length) {
            graph.cut(cells)
        }
        return false
    })
    graph.bindKey(['meta+v', 'ctrl+v'], () => {
        if (!graph.isClipboardEmpty()) {
            const cells = graph.paste({ offset: 32 })
            graph.cleanSelection()
            graph.select(cells)
        }
        return false
    })

    //undo redo
    graph.bindKey(['meta+z', 'ctrl+z'], () => {
        if (graph.history.canUndo()) {
            graph.history.undo()
        }
        return false
    })
    graph.bindKey(['meta+shift+z', 'ctrl+shift+z'], () => {
        if (graph.history.canRedo()) {
            graph.history.redo()
        }
        return false
    })

    // select all
    graph.bindKey(['meta+a', 'ctrl+a'], () => {
        const nodes = graph.getNodes()
        if (nodes) {
            graph.select(nodes)
        }
    })

    //delete
    graph.bindKey('backspace', () => {
        const cells = graph.getSelectedCells()
        if (cells.length) {
            graph.removeCells(cells)
        }
    })

    // zoom
    graph.bindKey(['ctrl+1', 'meta+1'], () => {
        const zoom = graph.zoom()
        if (zoom < 1.5) {
            graph.zoom(0.1)
        }
    })
    graph.bindKey(['ctrl+2', 'meta+2'], () => {
        const zoom = graph.zoom()
        if (zoom > 0.5) {
            graph.zoom(-0.1)
        }
    })

    // 控制连接桩显示/隐藏
    const showPorts = (ports: NodeListOf<SVGElement>, show: boolean) => {
        for (let i = 0, len = ports.length; i < len; i = i + 1) {
            ports[i].style.visibility = show ? 'visible' : 'hidden'
        }
    }
    graph.on('node:mouseenter', () => {
        const container = document.getElementById('graph-container')!
        const ports = container.querySelectorAll(
            '.x6-port-body',
        ) as NodeListOf<SVGElement>
        showPorts(ports, true)
    })
    graph.on('node:mouseleave', () => {
        const container = document.getElementById('graph-container')!
        const ports = container.querySelectorAll(
            '.x6-port-body',
        ) as NodeListOf<SVGElement>
        showPorts(ports, false)
    })
    // #endregion

    // #region 初始化图形
    const ports = {
        groups: {
            top: {
                position: 'top',
                attrs: {
                    circle: {
                        r: 4,
                        magnet: true,
                        stroke: '#5F95FF',
                        strokeWidth: 1,
                        fill: '#fff',
                        style: {
                            visibility: 'hidden',
                        },
                    },
                },
            },
            right: {
                position: 'right',
                attrs: {
                    circle: {
                        r: 4,
                        magnet: true,
                        stroke: '#5F95FF',
                        strokeWidth: 1,
                        fill: '#fff',
                        style: {
                            visibility: 'hidden',
                        },
                    },
                },
            },
            bottom: {
                position: 'bottom',
                attrs: {
                    circle: {
                        r: 4,
                        magnet: true,
                        stroke: '#5F95FF',
                        strokeWidth: 1,
                        fill: '#fff',
                        style: {
                            visibility: 'hidden',
                        },
                    },
                },
            },
            left: {
                position: 'left',
                attrs: {
                    circle: {
                        r: 4,
                        magnet: true,
                        stroke: '#5F95FF',
                        strokeWidth: 1,
                        fill: '#fff',
                        style: {
                            visibility: 'hidden',
                        },
                    },
                },
            },
        },
        items: [
            {
                group: 'top',
            },
            {
                group: 'right',
            },
            {
                group: 'bottom',
            },
            {
                group: 'left',
            },
        ],
    }

    Graph.registerNode(
        'custom-rect',
        {
            inherit: 'rect',
            width: 66,
            height: 36,
            attrs: {
                body: {
                    strokeWidth: 1,
                    stroke: '#5F95FF',
                    fill: '#EFF4FF',
                },
                text: {
                    fontSize: 12,
                    fill: '#262626',
                },
            },
            ports: { ...ports },
        },
        true,
    )

    Graph.registerNode(
        'custom-polygon',
        {
            inherit: 'polygon',
            width: 66,
            height: 36,
            attrs: {
                body: {
                    strokeWidth: 1,
                    stroke: '#5F95FF',
                    fill: '#EFF4FF',
                },
                text: {
                    fontSize: 12,
                    fill: '#262626',
                },
            },
            ports: {
                ...ports,
                items: [
                    {
                        group: 'top',
                    },
                    {
                        group: 'bottom',
                    },
                ],
            },
        },
        true,
    )

    Graph.registerNode(
        'custom-circle',
        {
            inherit: 'circle',
            width: 45,
            height: 45,
            attrs: {
                body: {
                    strokeWidth: 1,
                    stroke: '#5F95FF',
                    fill: '#EFF4FF',
                },
                text: {
                    fontSize: 12,
                    fill: '#262626',
                },
            },
            ports: { ...ports },
        },
        true,
    )

    Graph.registerNode(
        'custom-image',
        {
            inherit: 'rect',
            width: 52,
            height: 52,
            markup: [
                {
                    tagName: 'rect',
                    selector: 'body',
                },
                {
                    tagName: 'image',
                },
                {
                    tagName: 'text',
                    selector: 'label',
                },
            ],
            attrs: {
                body: {
                    stroke: '#5F95FF',
                    fill: '#5F95FF',
                },
                image: {
                    width: 26,
                    height: 26,
                    refX: 13,
                    refY: 16,
                },
                label: {
                    refX: 3,
                    refY: 2,
                    textAnchor: 'left',
                    textVerticalAnchor: 'top',
                    fontSize: 12,
                    fill: '#fff',
                },
            },
            ports: { ...ports },
        },
        true,
    )

    const r1 = graph.createNode({
        shape: 'custom-rect',
        label: '开始',
        attrs: {
            body: {
                rx: 20,
                ry: 26,
            },
        },
    })
    const r2 = graph.createNode({
        shape: 'custom-rect',
        label: '过程',
    })
    const r3 = graph.createNode({
        shape: 'custom-rect',
        attrs: {
            body: {
                rx: 6,
                ry: 6,
            },
        },
        label: '可选过程',
    })
    const r4 = graph.createNode({
        shape: 'custom-polygon',
        attrs: {
            body: {
                refPoints: '0,10 10,0 20,10 10,20',
            },
        },
        label: '决策',
    })
    const r5 = graph.createNode({
        shape: 'custom-polygon',
        attrs: {
            body: {
                refPoints: '10,0 40,0 30,20 0,20',
            },
        },
        label: '数据',
    })
    const r6 = graph.createNode({
        shape: 'custom-circle',
        label: '连接',
    })
    stencil.load([r1, r2, r3, r4, r5, r6], 'group1')

    const imageShapes = [
        {
            label: 'Client',
            image:
                'https://gw.alipayobjects.com/zos/bmw-prod/687b6cb9-4b97-42a6-96d0-34b3099133ac.svg',
        },
        {
            label: 'Http',
            image:
                'https://gw.alipayobjects.com/zos/bmw-prod/dc1ced06-417d-466f-927b-b4a4d3265791.svg',
        },
        {
            label: 'Api',
            image:
                'https://gw.alipayobjects.com/zos/bmw-prod/c55d7ae1-8d20-4585-bd8f-ca23653a4489.svg',
        },
        {
            label: 'Sql',
            image:
                'https://gw.alipayobjects.com/zos/bmw-prod/6eb71764-18ed-4149-b868-53ad1542c405.svg',
        },
        {
            label: 'Clound',
            image:
                'https://gw.alipayobjects.com/zos/bmw-prod/c36fe7cb-dc24-4854-aeb5-88d8dc36d52e.svg',
        },
        {
            label: 'Mq',
            image:
                'https://gw.alipayobjects.com/zos/bmw-prod/2010ac9f-40e7-49d4-8c4a-4fcf2f83033b.svg',
        },
    ]
    const imageNodes = imageShapes.map((item) =>
        graph.createNode({
            shape: 'custom-image',
            label: item.label,
            attrs: {
                image: {
                    'xlink:href': item.image,
                },
            },
        }),
    )
    stencil.load(imageNodes, 'group2')
    // #endregion

    function preWork() {
        // 这里协助演示的代码，在实际项目中根据实际情况进行调整
        const container = document.getElementById('container')!
        const stencilContainer = document.createElement('div')
        stencilContainer.id = 'stencil'
        const graphContainer = document.createElement('div')
        graphContainer.id = 'graph-container'
        container.appendChild(stencilContainer)
        container.appendChild(graphContainer)

        insertCss(`
    #container {
      display: flex;
      border: 1px solid #dfe3e8;
    }
    #stencil {
      width: 180px;
      height: 100%;
      position: relative;
      border-right: 1px solid #dfe3e8;
    }
    #graph-container {
      width: calc(100% - 180px);
      height: 100%;
    }
    .x6-widget-stencil  {
      background-color: #fff;
    }
    .x6-widget-stencil-title {
      background-color: #fff;
    }
    .x6-widget-stencil-group-title {
      background-color: #fff !important;
    }
    .x6-widget-transform {
      margin: -1px 0 0 -1px;
      padding: 0px;
      border: 1px solid #239edd;
    }
    .x6-widget-transform > div {
      border: 1px solid #239edd;
    }
    .x6-widget-transform > div:hover {
      background-color: #3dafe4;
    }
    .x6-widget-transform-active-handle {
      background-color: #3dafe4;
    }
    .x6-widget-transform-resize {
      border-radius: 0;
    }
    .x6-widget-selection-inner {
      border: 1px solid #239edd;
    }
    .x6-widget-selection-box {
      opacity: 0;
    }
  `)
    }

    //console.log('MindElixir.SIDE', MindElixir.SIDE)
    //let mind = new MindElixir({
    //    el: '#map',
    //    direction: MindElixir.SIDE,
    //    data: eval('('+'<?php //   echo $row['content'] ?? '{}';    ?>//'+')'),
    //    draggable: true,
    //    contextMenu: true,
    //    toolBar: true,
    //    nodeMenu: true,
    //    keypress: true,
    //})
    //mind.init()
    //console.log('test E function', E('bd4313fbac40284b'))

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
            url:'controller/c_flow_chart_manage.php?act=add_save&select_title=<?php	echo	$select_title;		?>',
            data:{'add_title':title,'add_content':content},
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
            url:'controller/c_flow_chart_manage.php?act=update_save&select_title=<?php	echo	$select_title;		?>',
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