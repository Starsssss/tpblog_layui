<?php /*a:1:{s:77:"C:\phpstudy_pro\WWW\www.tp.layui.com\application\admin\view\article\edit.html";i:1604196066;}*/ ?>
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
        <label class="layui-form-label required">文章标题</label>
        <div class="layui-input-block">
            <input type="text" name="arc_title" lay-verify="required" lay-reqtext="文章标题1不能为空" placeholder="文章标题不能为空" value="<?php echo htmlentities($article['arc_title']); ?>"
                   class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label required">文章作者</label>
        <div class="layui-input-block">
            <input type="text" name="arc_author" lay-verify="required" lay-reqtext="文章作者不能为空" placeholder="文章作者不能为空" value="<?php echo htmlentities($article['arc_author']); ?>"
                   class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label required">文章摘要</label>
        <div class="layui-input-block">
            <input type="text" name="arc_digest" lay-verify="required" lay-reqtext="文章摘要不能为空" placeholder="文章摘要不能为空" value="<?php echo htmlentities($article['arc_digest']); ?>"
                   class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label required">文章排序</label>
        <div class="layui-input-block">
            <input type="number" name="arc_sort" lay-verify="required" lay-reqtext="文章排序不能为空" placeholder="文章排序不能为空" value="<?php echo htmlentities($article['arc_sort']); ?>"
                   class="layui-input">
        </div>
    </div>


    <div class="layui-form-item">
        <label class="layui-form-label">标签云</label>
        <div class="layui-input-block" id="tags">
            <?php if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): if( count($tags)==0 ) : echo "" ;else: foreach($tags as $key=>$v): ?>
            <input type="checkbox" name="tags[]" title="<?php echo htmlentities($v['tag_name']); ?>" value="<?php echo htmlentities($v['tag_id']); ?>" <?php if(in_array($v['tag_id'],$a_tags)): ?>checked<?php endif; ?>>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>



    <!--<div class="layui-form-item">
    <input type="file" name="image" /> <br>
    </div>-->
    <textarea id="content" style="" name="arc_content" lay-verify="content"><?php echo htmlentities($article['arc_content']); ?></textarea>


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


    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
            <!--<input type="submit" class="layui-btn layui-btn-normal" lay-submit value="确认保存">-->
        </div>
    </div>
</div>
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/admin/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
<!--获取标签复选框-->
<script>
    /* $(document).ready(function () {
         $.ajax({
             url:'/admin/tag/getAllTags',
             method:'POST',
             success:function (res) {
                 alert(res.msg);
                 console.log(res)
                 var data=res.data;
                 var str='';
                 for (i in data) {
                     str+='<input type="checkbox" name="like[]" title="写作">'+alert(data[i]['tag_name'])
                 }
             }
         })
         $('#tags').html();
     })*/
</script>


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
                console.log(data.field)
                // return;
                $.ajax({
                    url: '/admin/article/edit/aid/'+<?php echo htmlentities($aid); ?>,
                    type: 'POST',
                    /*dataType: "json",*/
                    data: data.field,
                    success: function (res) {
                        // if(msg==1){
                        layer.msg(res.msg)
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
            // alert(JSON.stringify(data.field))


            return true;
        });

    });
</script>
<script>
    layui.use('upload', function(){
        var upload = layui.upload;

        //执行实例
        var uploadInst = upload.render({
            elem: '#btn_show' //绑定元素
            ,url: '/admin/article/upload' //上传接口
            ,done: function(res){
                //上传完毕回调
                layer.msg(res)

            }
            ,error: function(){
                //请求异常回调
                layer.msg(res)
            }
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