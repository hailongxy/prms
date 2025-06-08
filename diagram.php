	<!-- BEGIN HEADER -->
    <?php	include 'config.php';	?>

    <?php
    if($_GET['type'] == 'edit'){
        $sql = mysqli_query($con,"SELECT * FROM diagram WHERE id ='".$_GET['id']."' and userid = '".$_SESSION['userid']."'");
        $row = mysqli_fetch_array($sql);
    }
    ?>

<iframe id="iframe_id" width="100%" height="700px" src="drawio-dev/src/main/webapp/index.html" frameborder="0"></iframe>

<script src="media/js/jquery-1.10.1.min.js" type="text/javascript"></script>

<script>
    var id = '<?php echo $_GET['id'];   ?>';
    var type = '<?php echo $_GET['type'];   ?>';

    iwin = document.getElementById("iframe_id").contentWindow;

    function toEdit(){
        if (type == 'edit') {
            var title = '<?php echo $row['title'];   ?>';
            var xml = '<?php echo $row['content'];   ?>';
        } else {
            var title = '未命名绘图';
            var xml  = '<mxfile host="prms.hailongxy.cn" modified="2022-12-24T06:28:10.724Z" agent="5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36" etag="NcfjiAtAjVyVy3EV6JhU" version="20.7.4" type="device"><diagram id="adq7enhI4CqYvb_pK0Ys" name="第 1 页">dZHBEoIgEIafhrtCk3U2y0snD50Z2YQZdB2k0Xr6dICMsU4s3/4/y+4SlrfTxfBeXlGAJjQRE2EnQmmapNl8LOTpyC7zoDFKeNEKKvWC4PT0oQQMkdAiaqv6GNbYdVDbiHFjcIxld9Rx1Z43sAFVzfWW3pSw0tEDzVZegmpkqJzujy7T8iD2nQySCxy/ECsIyw2idVE75aCX4YW5ON/5T/bzMQOd/WGYg/Xt+RJtiBVv</diagram></mxfile>';
        }

        console.log('xml:');
        console.log(xml);

        msg = {
            type: 'edit',
            data: xml,
            title: title
        }
        iwin.postMessage(msg, '*');

        console.log('toEdit:');
    }

    setTimeout(function(){
        toEdit();
    }, 2000);

    function add(title, content) {
        $.ajax({
            url:'controller/c_diagram_manage.php?act=add_save',
            data:{'add_title':title,'add_content':content},
            type:'post',
            success:function(msg){
                if(msg == 1){
                    alert('创建成功');
                    window.history.back();
                }
            }
        });
    }

    function update(title, content) {
        $.ajax({
            url:'controller/c_diagram_manage.php?act=update_save',
            data:{'id':id,'update_title':title,'update_content':content},
            type:'post',
            success:function(msg){
                if(msg == 1){
                    alert('编辑成功');
                }
            }
        });
    }

    window.addEventListener("message", function(e){

        if(type == 'add'){
            add(e.data.title, e.data.data);
        }else{
            update(e.data.title, e.data.data);
        }

    }, false);

</script>