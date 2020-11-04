<?php /*a:1:{s:78:"C:\phpstudy_pro\WWW\www.tp.layui.com\application\admin\view\article\index.html";i:1604203726;}*/ ?>
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
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">

        <fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">文章标题</label>
                            <div class="layui-input-inline">
                                <input type="text" name="arc_title" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button type="submit" class="layui-btn layui-btn-primary"  lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>

        <script type="text/html" id="toolbarDemo">
            <div class="layui-btn-container">
                <button class="layui-btn layui-btn-normal layui-btn-sm data-add-btn" lay-event="add"> 添加 </button>
                <button class="layui-btn layui-btn-sm layui-btn-danger data-delete-btn" lay-event="delete"> 删除 </button>
            </div>
        </script>

        <table class="layui-hide" id="currentTableId" lay-filter="currentTableFilter"></table>

        <script type="text/html" id="currentTableBar">
            <a class="layui-btn layui-btn-normal layui-btn-xs data-count-edit" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete">删除</a>
        </script>

    </div>
</div>
<script src="/static/admin/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
<script>
    layui.use(['form', 'table'], function () {
        var $ = layui.jquery,
            form = layui.form,
            table = layui.table;

        table.render({
            elem: '#currentTableId',
            url: '/admin/article',
            toolbar: '#toolbarDemo',
            defaultToolbar: ['filter', 'exports', 'print', {
                title: '提示',
                layEvent: 'LAYTABLE_TIPS',
                icon: 'layui-icon-tips'
            }],
            cols: [[
                {type: "checkbox", width: 50},
                {field: 'arc_id', width: 80, title: 'ID', sort: true},
                {field: 'arc_title', width: 280, title: '文章标题',sort: true,edit:'text'},
                {field: 'review_count', width: 100, title: '评论数',sort: true},
                {field: 'likes', width: 100, title: '点赞数',sort: true},
                {title: '操作', minWidth: 150, toolbar: '#currentTableBar', align: "center"}
            ]],
            limits: [10, 15, 20, 25, 50, 100],
            limit: 15,
            page: true,
            height: 420, //固定值
            skin: 'line row',
            title:'文章表',
            loading:true
        });

        // 监听搜索操作
        form.on('submit(data-search-btn)', function (data) {
            var result = JSON.stringify(data.field);
            layer.alert(result, {
                title: '最终的搜索信息'
            });

            //执行搜索重载
/*
            table.reload('currentTableId', {
                page: {
                    curr: 1
                }
                , where: {
                    searchParams: result
                }
            }, 'data');
*/


            table.reload('currentTableId', {
                url: '/admin/article/searchTitle'
                ,method:'post'
                ,where: {
                    arc_title: data.field
                } //设定异步数据接口的额外参数
                //,height: 300
            });





            return false;
        });

        /**
         * toolbar监听事件
         */
        table.on('toolbar(currentTableFilter)', function (obj) {
            if (obj.event === 'add') {  // 监听添加操作
                var index = layer.open({
                    title: '添加文章',
                    type: 2,
                    shade: 0.2,
                    maxmin:true,
                    shadeClose: true,
                    area: ['100%', '100%'],
                    content: '/admin/article/add',
                    // content: '/admin/article/add',
                });
                $(window).on("resize", function () {
                    layer.full(index);
                });
            } else if (obj.event === 'delete') {  // 监听删除操作
                var checkStatus = table.checkStatus('currentTableId')
                    , data = checkStatus.data;
                layer.alert(JSON.stringify(data));


                $.ajax({
                    url:"/admin/article/del",
                    method:"POST",
                    data: {data},
                    success:function (res) {
                        console.log(res);
                        layer.msg(res.msg,(function (res) {
                            if(res.code==1){
                                location.href='';
                            }
                        })(res));
                    }
                });
            }
        });

        //监听表格复选框选择
       /* table.on('checkbox(currentTableFilter)', function (obj) {
            console.log(obj)
        });*/

        //监听单元格编辑
        table.on('edit(currentTableFilter)', function(obj){ //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
            console.log(obj.value); //得到修改后的值
            console.log(obj.field); //当前编辑的字段名
            console.log(obj.data); //所在行的所有相关数据
            var curr=obj.field;
            $.ajax({
               url:'/admin/article/editTitle',
               data:{arc_id:obj.data.arc_id,arc_title:obj.value} ,
                method:'get',
                success:function (res) {
                    layer.msg(res.msg);
                }
            });



        });



        table.on('tool(currentTableFilter)', function (obj) {
            var data = obj.data;
            console.log(data)
            if (obj.event === 'edit') {

                var index = layer.open({
                    title: '编辑用户',
                    type: 2,
                    shade: 0.2,
                    maxmin:true,
                    shadeClose: true,
                    area: ['100%', '100%'],
                    content: '/admin/article/edit/aid/'+data.arc_id,
                });
                $(window).on("resize", function () {
                    layer.full(index);
                });
                return false;
            } else if (obj.event === 'delete') {
                layer.confirm('真的删除行么', function (index) {
                    console.log('----------')
                    console.log(obj.data.arc_id)
                    console.log('----------')
                    $.ajax({
                        url:"/admin/article/del/aid/"+obj.data.arc_id,
                        method:"GET",
                        success:function (res) {
                            console.log(res);
                            layer.msg(res.msg,(function (res) {
                                if(res.code==1){
                                    location.href='';
                                }
                            })(res));
                        }
                    });
                    obj.del();
                    layer.close(index);
                });
            }
        });

    });
</script>

</body>
</html>