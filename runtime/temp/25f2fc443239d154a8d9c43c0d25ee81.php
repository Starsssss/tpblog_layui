<?php /*a:2:{s:78:"C:\phpstudy_pro\WWW\www.tp.layui.com\application\index\view\article\index.html";i:1604242169;s:69:"C:\phpstudy_pro\WWW\www.tp.layui.com\application\index\view\base.html";i:1604239163;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>博客/static<?php echo session('user.u_username'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/static/res/layui/css/layui.css">
    <link rel="stylesheet" href="/static/res/static/css/mian.css">
    <!--tp分页用 -->
    <link rel="stylesheet" href="/static/pagination.css">

    <script src="/static/home/js/jquery-1.11.3.min.js"></script>

</head>
<body class="lay-blog">
<div class="header">
    <div class="header-wrap">
        <h1 class="logo pull-left">
            <a href="<?php echo url('index/index/index'); ?>">
                <img src="/static/res/static/images/logo.png" alt="" class="logo-img">
                <img src="/static/res/static/images/logo-text.png" alt="" class="logo-text">
            </a>
        </h1>
        <form class="layui-form blog-seach pull-left" action="<?php echo url('index/search/sear'); ?>" method="post">
            <div class="layui-form-item blog-sewrap">
                <div class="layui-input-block blog-sebox">
                    <i class="layui-icon layui-icon-search"></i>
                    <input type="text" name="title" lay-verify="title" autocomplete="off" class="layui-input">
                </div>
            </div>
        </form>
        <div class="blog-nav pull-right">
            <ul class="layui-nav pull-left">
                <li class="layui-nav-item layui-this"><a href="<?php echo url('index/index'); ?>">首页</a></li>
                <li class="layui-nav-item"><a href="message.html">留言</a></li>
                <li class="layui-nav-item"><a href="about.html">关于</a></li>

                <?php if(!empty(session('user.u_id'))): ?>
                <li class="layui-nav-item layuimini-setting">
                    <a href="javascript:;"><?php echo session('user.u_username'); ?></a>
                    <dl class="layui-nav-child">
                        <br>
                        <!--<dd>
                            <a href="javascript:;" layuimini-content-href="page/user-setting.html" data-title="基本资料" data-icon="fa fa-gears">基本资料<span class="layui-badge-dot"></span></a>
                        </dd>
                        <dd>
                            <a href="javascript:;" layuimini-content-href="page/user-password.html" data-title="修改密码" data-icon="fa fa-gears">修改密码</a>
                        </dd>
                        <dd>
                            <hr>
                        </dd>-->
                        <dd>
                            <a href="javascript:;" class="login-out" id="user_option" >退出登录</a>
                        </dd>
                    </dl>
                </li>
                <?php endif; ?>
            </ul>
            <?php if(empty(session('user.u_id'))): ?>
            <a href="<?php echo url('index/login/index'); ?>" class="personal pull-left">
                登录
                <!-- <i class="layui-icon layui-icon-username"><?php echo session('user.u_username')??'未登录'; ?></i>-->
            </a>
            <a href="#" class="personal pull-left">
                注册
                <!-- <i class="layui-icon layui-icon-username"><?php echo session('user.u_username')??'未登录'; ?></i>-->
            </a>
            <?php endif; ?>
            <!--<ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;" data-refresh="刷新"><i class="fa fa-refresh"></i></a>
                </li>
                <li class="layui-nav-item layuimini-setting">
                    <a href="javascript:;">admin</a>
                    <dl class="layui-nav-child">

                        <dd>
                            <a href="javascript:;" class="login-out">退出登录</a>
                        </dd>
                    </dl>
                </li>

            </ul>-->
        </div>
        <div class="mobile-nav pull-right" id="mobile-nav">
            <a href="javascript:;">
                <i class="layui-icon layui-icon-more"></i>
            </a>
        </div>
    </div>
    <ul class="pop-nav" id="pop-nav">
        <li><a href="<?php echo url('index/index'); ?>">首页</a></li>
        <li><a href="message.html">留言</a></li>
        <li><a href="about.html">关于</a></li>

    </ul>
</div>
<div class="container-wrap">

    <!--左边侧边栏-->
    <!--    <div class="left_con_box  ">
            <ul class="layui-nav layui-nav-tree left_con layui-bg-blue" lay-filter="test" >
                &lt;!&ndash; 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> &ndash;&gt;
                <li class="layui-nav-item layui-nav-itemed">
                    <a href="javascript:;">默认展开</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;">选项1</a></dd>
                        <dd><a href="javascript:;">选项2</a></dd>
                        <dd><a href="">跳转</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">解决方案</a>
                    <dl class="layui-nav-child">
                        <dd><a href="">移动模块</a></dd>
                        <dd><a href="">后台模版</a></dd>
                        <dd><a href="">电商平台</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="">产品</a></li>
                <li class="layui-nav-item"><a href="">大数据</a></li>
            </ul>
        </div>-->
    <!--左边侧边栏end-->


    <!--中间内容start-->
    
<div class="container container-message container-details">
    <div class="contar-wrap">
        <div class="item">
            <div class="item-box  layer-photos-demo1 layer-photos-demo">
                <h3><a href="javascript:;"><?php echo htmlentities($article['arc_title']); ?></a></h3>
                <h5>发布于：<span id="updatetime">刚刚</span></h5>
                <p>
                    <?php echo $article['arc_content']; ?></p>
                <img src="../res/static/images/item.png" alt="">
                <div class="count layui-clear">
                    <span class="pull-left">阅读 <em><?php echo htmlentities($article['arc_click']); ?></em></span>
                    <span class="pull-right like"><i class="layui-icon layui-icon-praise"></i><em><?php echo htmlentities($likes); ?></em></span>
                </div>
            </div>
        </div>
        <a name="comment"> </a>
        <div class="comt layui-clear" style="margin-bottom:10px;">
            <a href="javascript:;" class="pull-left">评论<?php echo htmlentities($reviews_count); ?></a>
            <!--<a href="comment.html" class="pull-right">写评论</a>-->
        </div>
        <!--写评论开始-->
        <div class="layui-form-item layui-form-text">
            <textarea id="comment_block" class="layui-textarea"  style="resize:none" placeholder="写点什么11啊" article_id="<?php echo htmlentities($article['arc_id']); ?>"></textarea>
        </div>
        <div class="layui-btn layui-btn-sm" id="comment_btn">确定</div>
        <!--写评论结束-->
        <div id="LAY-msg-box">
            <?php if(is_array($reviews) || $reviews instanceof \think\Collection || $reviews instanceof \think\Paginator): if( count($reviews)==0 ) : echo "" ;else: foreach($reviews as $key=>$v): ?>
            <div class="info-item">
                <img class="info-img" src="/static/res/static/images/info-img.png" alt="">
                <div class="info-text">
                    <p class="title count">
                        <span class="name"><?php echo htmlentities($v['user']['u_username']); ?></span>
                        <span class="info-img like"><i class="layui-icon layui-icon-praise"></i>5.8万</span>
                    </p>
                    <p class="info-intr">
                        <?php echo htmlentities($v['rev_content']); ?></p>
                    <div><span class="rev_time"><?php echo htmlentities($v['rev_time']); ?></span> <span
                            class="layui-btn  layui-btn-xs reply-action"
                            from_uid="<?php echo htmlentities($v['user']['u_id']); ?>" from_username="<?php echo htmlentities($v['user']['u_username']); ?>"  article_id="<?php echo htmlentities($article['arc_id']); ?>" rev_id="<?php echo htmlentities($v['rev_id']); ?>">回复</span></div>
                    <div>共有<span><?php echo htmlentities(count($v['reply'])); ?></span>条回复</div>
                    
                    <div class="reply-box">
                        <?php if(is_array($v['reply']) || $v['reply'] instanceof \think\Collection || $v['reply'] instanceof \think\Paginator): if( count($v['reply'])==0 ) : echo "" ;else: foreach($v['reply'] as $key=>$v1): ?>
                        <div>
                            <!-- <span class="from_uid" style="display: none"><?php echo htmlentities($v1['u_id']); ?></span>
                             <span class="to_uid" style="display: none"><?php echo htmlentities($v1['to_uid']); ?></span>-->
                            <span class=""><?php echo htmlentities($v1['u_username']); ?></span>:回复@<span><?php echo htmlentities($v1['to_username']); ?></span>: </span>
                            <span><?php echo htmlentities($v1['rev_content']); ?></span>
                            <div><span class="rev_time"><?php echo htmlentities($v1['rev_time']); ?></span> <span
                                    class="layui-btn  layui-btn-xs reply-action" from_uid="<?php echo htmlentities($v1['u_id']); ?>"
                                    to_uid="<?php echo htmlentities($v1['to_uid']); ?>" to_username="<?php echo htmlentities($v1['to_username']); ?>"  from_username="<?php echo htmlentities($v1['u_username']); ?>"article_id="<?php echo htmlentities($article['arc_id']); ?>" rev_id="<?php echo htmlentities($v['rev_id']); ?>">回复</span></div>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </div>
                    

                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>

<script src="/static/res/layui/layui.all.js"></script>

<!--评论时间处理-->
<script>
    $(document).ready(function () {
        layui.use('util', function () {
            var util = layui.util;
            layui.$('#updatetime').html(util.timeAgo(<?php echo htmlentities($article['updatetime']); ?> * 1000, true));
            $('.rev_time').each(function () {
                $(this).html(util.timeAgo($(this).html() * 1000, true));

            });

        });
    });

</script>
<script>
    $('.reply-action').click(function () {
        /*layer.msg($(this).attr('from_uid'));
        layer.msg($(this).attr('to_uid'));*/
       // layer.msg($(this).attr('to_username'));
        var data = {
            to_uid: $(this).attr('from_uid'),
            from_uid: "<?php echo session('user.u_id'); ?>",
            article_id:$(this).attr('article_id'),
            rev_id:$(this).attr('rev_id'),
        };
        let to_username=$(this).attr('to_username');
        let from_username=$(this).attr('from_username');
        layer.open({
            id: 1,
            type: 1,
            title: '评论回复',
            skin: 'layui-layer-rim',
            area: ['450px', 'auto'],

            content: ' <div class="row" style="width: 420px;  margin-left:7px; margin-top:10px;">'
                + '<div class="col-sm-12" style="margin-top: 10px">'
                + '<div class="input-group">'
                + '<textarea id="content" required lay-verify="required" placeholder="回复'+from_username+'" class="layui-textarea"></textarea>'
                + '</div>'
                + '</div>'
                + '</div>'
            ,
            btn: ['确认', '取消'],
            btn1: function (index, layero) {
                data['content']=$('#content').val();
                $.ajax({
                    url: "<?php echo url('index/reply/index'); ?>",
                    data: data,
                    method:'post',
                    success: function (res) {
                        layer.alert(res.msg)
                        if(res.code==1){
                            // layer.msg( res.msg);
                            //刷新页面
                            location.reload();

                        }else if(res.code==99){
                            // alert(99)
                           /* location.reload();
                          window.location-"/index/login/index";*/
                            layer.closeAll();
                            location.href='<?php echo url("index/login/index"); ?>';
                        }
                    },
                    error: function () {
                        layer.msg('请求失败')
                    }
                })
            },
            btn2: function (index, layero) {
                layer.close(index);
            }

        });


    });
</script>

<script>
    $('#comment_btn').click(function () {

        /*alert($('#comment_block').attr('article_id'));
        alert($('#comment_block').val());
        alert(<?php echo session('user.u_id'); ?>);*/


        var arc_id=$('#comment_block').attr('article_id');
        var rev_content=($('#comment_block').val());
        var u_id="<?php echo session('user.u_id'); ?>";

        $.ajax({
            url:"<?php echo url('index/reply/index'); ?>",
            data:{arc_id:arc_id,rev_content:rev_content,u_id:u_id},
            success:function (res) {
                layer.msg(res.msg)
                if(res.code==0){
                    window.location='/index/login/index';
                }
            }
        })
    });
</script>


    <!--中间内容END-->


    <!--右边边侧边栏start-->
    <div class="right_con">
        <div class="layui-card">

            <div class="layui-card-header "><span class="layui-icon layui-icon-note" style="font-size: 30px; "></span>云标签
            </div>
            <div class="layui-card-body ">
                <div class="layui-btn-container">
                    <?php if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): if( count($tags)==0 ) : echo "" ;else: foreach($tags as $key=>$tag): ?>
                    <a href="<?php echo url('tag/index',['tag_id'=>$tag['tag_id']]); ?>"
                       class="layui-btn layui-btn-radius layui-btn-normal layui-anim layui-anim-up layui-anim-scale"><?php echo htmlentities($tag['tag_name']); ?></a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                </div>
            </div>
        </div>
        <!--右边边侧边栏end-->
    </div>
</div>
<div class="footer">
    <p>
        <span>&copy; 2020</span>
        <span><a href="" target="_blank">William</a></span>
        <span>MIT license</span>
    </p>
    <p><span>人生就是一场修行</span></p>
</div>
<script src="/static/res/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/res/static/js/'
    }).use('blog');
</script>

</body>
</html>

<style>
    .left_con_box {
        width: 200px;
        height: 300px;
        display: inline-block;
        float: left;
        /*overflow: auto;*/
    }

    /*左边公共部分*/
    .left_con {
        display: inline-block;
        position: fixed;
        width: 250px;
        top: 100px;
        left: 0;
        overflow: hidden;
        background: #2F4056;
        z-index: 999;
    }

    /*右边公共部分*/
    .right_con {
        width: 270px;
        display: inline-block;
        position: fixed;
        top: 100px;
        right: 0;

    }


/*    用户*/
    /*#user_option{
        position: relative;
        top: 0;
        z-index: 9999999;
    }*/
</style>
<script>
    $('.login-out').click(function () {
        $.ajax({
        url:"<?php echo url('index/login/logout',['u_id'=>session('user.u_id')]); ?>",
            success:function () {
                window.location='';
            }
        })
    })
</script>