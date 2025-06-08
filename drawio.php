<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<!-- 父页面从本地引入该脚本 -->
<script type="text/javascript" src="/drawio-dev/src/main/webapp/js/viewer-static.min.js"></script>

<button onclick="toEdit()">编辑</button>

<iframe id="iframe_id" width="100%" height="650px" src="drawio-dev/src/main/webapp/index.html" frameborder="0"></iframe>

<script>
    iwin = document.getElementById("iframe_id").contentWindow;

    function toEdit(){
        var xml = '<mxfile host="prms.hailongxy.cn" modified="2022-12-18T09:41:12.539Z" agent="5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36" etag="IuqrmV1GGxBjN7sugfWS" version="20.7.4"><diagram id="adq7enhI4CqYvb_pK0Ys" name="第 1 页">jZLBboMwDIafhmOlAu3ojhtj7WXSJqRN2i0Dl0RKMAppgT39wuIUEJo0Dsj+/Mdx/iSIU9UfNWv4C5Ygg2hb9kH8FET229n/CAYHdkniQKVF6VA4gVx8A8Et0YsooV0IDaI0olnCAusaCrNgTGvslrIzyuWuDatgBfKCyTX9EKXhjh6iZOInEBX3O4d3966imBfTSVrOSuxmKM6CONWIxkWqT0GO3nlf3LrnP6q3wTTU5j8L9q+Ytac39bU/Xx/wffOp+LChLlcmL3RgGtYM3gHbxZptk8eOCwN5w4qx0tnrtowbJW0W2nA9kO8O2kA/QzTgEVCB0YOVUDUhr+ixhAfKu8n60PvJZ7Z7HaPbrm6dJ0NsQJ74dPL+tzZ7wHH2Aw==</diagram></mxfile>';
        msg = {
            type: 'edit',
            data: xml,
            title: '编辑.html'
        }
        iwin.postMessage(msg, '*');

        console.log('toEdit:');
    }

    window.addEventListener("message", function(e){
        console.log('e.data:');
        console.log(e.data);
    }, false);
</script>

</body>
</html>