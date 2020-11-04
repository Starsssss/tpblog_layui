<?php /*a:1:{s:72:"C:\phpstudy_pro\WWW\www.tp.layui.com\application\admin\view\tag\add.html";i:1604141246;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/static/admin/lib/layui-v2.5.4/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/admin/css/public.css" media="all">
    <style>
        body {
            background-color: #ffffff;
        }
    </style>
</head>
<body>
<div class="layui-form layuimini-form">
    <div class="layui-form-item">
        <label class="layui-form-label required">标签名称1</label>
        <div class="layui-input-block">
            <input type="text" name="tag_name" lay-verify="required" lay-reqtext="标签名称不能为空" placeholder="标签标题不能为空" value=""
                   class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">展示</label>
        <div class="layui-input-block">
            <input type="checkbox" name="tag_isshow" lay-skin="switch">
        </div>
    </div>

    <!--<div class="layui-form-item">
        <label class="layui-form-label required">标签是否展示</label>
        <div class="layui-input-block">
            <input type="number" name="arc_sort" lay-verify="required" lay-reqtext="标签排序不能为空" placeholder="标签排序不能为空" value=""
                   class="layui-input">
        </div>
    </div>-->


<!--
    <div class="layui-form-item">
    <input type="file" name="image" /> <br>
    </div>-->



    <!-- <div class="layui-form-item">
         <label class="layui-form-label required">上传图片</label>
         <button type="button" class="layui-btn" id="test1">
             <i class="layui-icon">&#xe67c;</i>上传图片
         </button>
     </div>-->

    <!--<div class="layui-form-item">
        <label class="layui-form-label">上传展示图</label>
        <div class="layui-input-block">
            <div class="layui-upload">
                <button type="button" class="layui-btn" id="btn_show">图片上传</button>
                <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                    预览图：
                    <div class="layui-upload-list" id="show_img"
                         value=""></div>
                </blockquote>
            </div>
        </div>
    </div>-->
   <!-- <textarea id="content" style="" name="arc_content" lay-verify="content"></textarea>-->


    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
            <!--<input type="submit" class="layui-btn layui-btn-normal" lay-submit value="确认保存">-->
        </div>
    </div>
</div>
<script src="/static/admin/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
<script>
    layui.use(['form'], function () {
        var form = layui.form,
            layer = layui.layer,
            $ = layui.$;

        //监听提交
        form.on('submit(saveBtn)', function (data) {
            var index = layer.alert(JSON.stringify(data.field), {
                title: '最终的提交信息'
            }, function () {
                            // console.log(data.field)
                $.ajax({
                    url: '/admin/tag/add',
                    type: 'POST',
                    /*dataType: "json",*/
                    data: data.field,
                    success: function (res) {
                        // if(msg==1){
                        layer.msg(res.msg);
                        console.log(res.msg)

                        // alert(msg);
                        // }

                    },
                    complete: function (msg) {
                        // alert("complete: " + msg);
                    },
                    error: function (msg) {
                        // alert("error: " + msg);
                    }


                })
                // 关闭弹出层
                layer.close(index);

                var iframeIndex = parent.layer.getFrameIndex(window.name);
                parent.layer.close(iframeIndex);

            });


            return true;
        });

    });







</script>
<script src="/static/res/layui/lay/modules/layedit.js"></script>
<script>

        layui.use('layedit', function(){
            var layedit = layui.layedit;
            var index1 = layedit.build('content', {
                tool: ['strong','italic','face','underline','del', 'link', 'unlink', '|', 'left', 'center', 'right','b']
                ,height: 150
            })
            layui.form.verify({
                content: function(value) {
                    return layedit.sync(index1);
                }
            });
        });





</script>
</body>
</html>