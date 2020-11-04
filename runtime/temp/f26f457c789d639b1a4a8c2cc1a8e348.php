<?php /*a:2:{s:77:"C:\phpstudy_pro\WWW\www.tp.layui.com\application\index\view\index\index4.html";i:1604241828;s:69:"C:\phpstudy_pro\WWW\www.tp.layui.com\application\index\view\base.html";i:1604239163;}*/ ?>
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
    

<div class="container">
    <div class="contar-wrap">

        <h4 class="item-title notice_head">
            <i class="layui-icon layui-icon-speaker notice_text1" style="font-size: 30px; color: #1E9FFF;"></i><span class="notice_text2">公告：</span>
            <div id="FontScroll">
                <ul>
                    <?php if(is_array($affiche) || $affiche instanceof \think\Collection || $affiche instanceof \think\Paginator): if( count($affiche)==0 ) : echo "" ;else: foreach($affiche as $key=>$v): ?>
                    <li><a href="#"><?php echo htmlentities($v['aff_content']); ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
<!--                    <li><a href="#">欢迎来到我的轻博客2</a></li>
                    <li><a href="#">欢迎来到我的轻博客3</a></li>
                    <li> <span>欢迎来到我的轻博客4</span></li>
                    <li> <span>欢迎来到我的轻博客5</span></li>-->
                </ul>
            </div>


        </h4>
        <?php if(is_array($articles) || $articles instanceof \think\Collection || $articles instanceof \think\Paginator): if( count($articles)==0 ) : echo "" ;else: foreach($articles as $key=>$art): ?>
        <div class="item">
            <div class="item-box  layer-photos-demo1 layer-photos-demo">
                <h3><a href="<?php echo url('article/index',['art_id'=>$art['arc_id']]); ?>"><?php echo htmlentities($art['arc_title']); ?></a></h3>
                <h5>发布于：<span class="update_time"><?php echo htmlentities($art['updatetime']); ?></span>
                    &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    <i class="layui-icon layui-icon-note"></i>

                    <?php if(is_array($art['tags']) || $art['tags'] instanceof \think\Collection || $art['tags'] instanceof \think\Paginator): if( count($art['tags'])==0 ) : echo "" ;else: foreach($art['tags'] as $key=>$v): ?>
                    <a href="<?php echo url('tag/index',['tag_id'=>$v['tag_id']]); ?>"
                       class="layui-btn layui-btn-xs layui-btn-radius  layui-anim layui-anim-up layui-anim-scale"><?php echo htmlentities($v['tag_name']); ?></a>
                    <?php endforeach; endif; else: echo "" ;endif; ?></h5>
                <p> <?php echo htmlentities($art['arc_digest']); ?></p>
                <img src="/static/res/static/images/item.png" alt="">
            </div>
            <div class="comment count">
                <a href="<?php echo url('article/index',['art_id'=>$art['arc_id']]); ?>#comment">评论(<?php echo htmlentities($art['review_count']); ?>)</a>
                <a href="javascript:;" class="ilike" arc_id="<?php echo htmlentities($art['arc_id']); ?>">点赞(<span class="like_sum"><?php echo htmlentities($art['likes']); ?></span>)</a>
                <!--<a href="" class="like ilike">点赞</a>-->
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="item-btn">
<!--        <button class="layui-btn layui-btn-normal">下一页</button>-->
<?php echo $articles->render(); ?>
    </div>

</div>
<style>

    ul li {
        list-style: none;
    }

    #FontScroll {
        display: inline-block;
        width: 500px;
        height: 30px;
        line-height: 30px;
        border: 1px solid transparent;/*边框*/
        overflow: Hidden;
        padding: 5px 0;
    }

    #FontScroll .line {
        width: 100%;
    }

    #FontScroll .fontColor a {
        color: red;
    }
</style>
<style>
    .notice_head{
        line-height: 40px;
        height: 40px;
    }

</style>
<style>
    .notice_text1{
        position: relative;
        bottom: 11px;

    }
    .notice_text2{
        position: relative;
        bottom: 17px;

    }
</style>
<script>(function ($) {
    $.fn.FontScroll = function (options) {
        var d = {time:3000, s: 'fontColor', num: 1}
        var o = $.extend(d, options);


        this.children('ul').addClass('line');
        var _con = $('.line').eq(0);
        var _conH = _con.height(); //滚动总高度
        var _conChildH = _con.children().eq(0).height();//一次滚动高度
        var _temp = _conChildH;  //临时变量
        var _time = d.time;  //滚动间隔
        var _s = d.s;  //滚动间隔


        _con.clone().insertAfter(_con);//初始化克隆

        //样式控制
        var num = d.num;
        var _p = this.find('li');
        var allNum = _p.length;

        _p.eq(num).addClass(_s);


        var timeID = setInterval(Up, _time);
        this.hover(function () {
            clearInterval(timeID)
        }, function () {
            timeID = setInterval(Up, _time);
        });

        function Up() {
            _con.animate({marginTop: '-' + _conChildH});
            //样式控制
            _p.removeClass(_s);
            num += 1;
            _p.eq(num).addClass(_s);

            if (_conH == _conChildH) {
                _con.animate({marginTop: '-' + _conChildH}, "normal", over);
            } else {
                _conChildH += _temp;
            }
        }

        function over() {
            _con.attr("style", 'margin-top:0');
            _conChildH = _temp;
            num = 1;
            _p.removeClass(_s);
            _p.eq(num).addClass(_s);
        }
    }
})(jQuery);
$(function () {
    $('#FontScroll').FontScroll({time: 1000, num: 0});
});
</script>
<!--离开页面停止定时器,返回页面开启定时器-->
<script>

</script>


<script>
    /**/
    $(document).ready(function () {
        /*$('.update_time').each(function () {
            alert($(this).html())
        });*/
        layui.use('util', function () {
            var util = layui.util;
            $('.update_time').each(function () {
                $(this).text(util.timeAgo($(this).text() * 1000, true));

            });


        });
    });

</script>
<script>
    $('.ilike').click(function () {
        let arc_id=$(this).attr('arc_id');
        // alert($(this).children('.like_sum').text())
        let like_sum_obj=$(this).children('.like_sum');
        $.ajax({
            url:'<?php echo url("index/like/like"); ?>',
            data:{arc_id:arc_id},

            success:function (res) {
                if(res.code==0){
                    layer.msg(res.msg,function () {
                        location.href='<?php echo url("index/login/index"); ?>';
                    })
                }else if(res.code==1){

                    //已登录
                    layer.msg(res.msg);
                    if(res.msg=='已取消点赞!'){
                        var like_sum=parseInt(like_sum_obj.text());
                        like_sum--;
                        like_sum_obj.text(like_sum)
                    }else if(res.msg=='点赞成功!'){
                        var like_sum=parseInt(like_sum_obj.text());
                        like_sum++;
                        like_sum_obj.text(like_sum)
                    }
                }

                // alert(res.msg);
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