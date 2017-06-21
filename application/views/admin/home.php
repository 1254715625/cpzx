<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <title>后台管理中心</title>
    <link rel="stylesheet" href="<?php echo $public_dir; ?>/admin/css/pintuer.css">
    <link rel="stylesheet" href="<?php echo $public_dir; ?>/admin/css/admin.css">
    <script src="<?php echo $public_dir; ?>/admin/js/jquery.js"></script>
    <script src="<?php echo $public_dir; ?>/admin/js/main.js"></script>
    <script src="<?php echo $public_dir; ?>/admin/js/special.js"></script>
    <script src="<?php echo $public_dir; ?>/admin/js/layer/layer.js"></script>
</head>
<body style="background-color:#f2f9fd;">
    <div class="header bg-main">
        <div class="logo margin-big-left fadein-top">
            <h1><img src="<?php echo $public_dir; ?>/admin/images/y.jpg" class="radius-circle rotate-hover" height="50" title="<?php echo $_SESSION['adminname'];?>"/>后台管理中心</h1>
        </div>
        <div class="head-l">
            <a class="button button-little bg-green" href="<?php echo $url_dir.'/index.php';?>" target="_blank"><span class="icon-home"></span>
                前台首页</a>  &nbsp;&nbsp;<a class="button button-little bg-red" href="<?php echo $url_dir;?>/admin/login/userquit"><span
                    class="icon-power-off"></span> 退出登录</a>
        </div>
    </div>
    <div class="leftnav">
        <div class="leftnav-title"><strong><span class="icon-list"></span>菜单列表</strong></div>
        <h2><span class="icon-user"></span>基本设置</h2>
        <ul style="display:block">
            <li><a href="<?php echo $url_dir;?>/admin/home/info" target="right"><span class="icon-caret-right"></span>网站设置</a></li>
            <li><a href="<?php echo $url_dir;?>/admin/home/pass" target="right"><span class="icon-caret-right"></span>修改密码</a></li>
        </ul>
        <h2><span class="icon-pencil-square-o"></span>栏目管理</h2>
        <ul>
            <li><a href="<?php echo $url_dir;?>/admin/home/column" target="right"><span class="icon-caret-right"></span>栏目管理</a></li>
            <li><a href="<?php echo $url_dir;?>/admin/home/addimg" target="right"><span class="icon-caret-right"></span>添加图集</a></li>
            <li><a href="<?php echo $url_dir;?>/admin/home/addnew" target="right"><span class="icon-caret-right"></span>新闻添加</a></li>
            <li><a href="<?php echo $url_dir;?>/admin/home/content_manage" target="right"><span class="icon-caret-right"></span>新闻管理</a></li>
            <li><a href="<?php echo $url_dir;?>/admin/home/img_manage" target="right"><span class="icon-caret-right"></span>美女图集</a></li>
            <li><a href="<?php echo $url_dir;?>/admin/home/adv" target="right"><span class="icon-caret-right"></span>首页轮播</a></li>
			<li><a href="<?php echo $url_dir;?>/admin/home/ad" target="right"><span class="icon-caret-right"></span>广告管理</a></li>
            <li><a href="<?php echo $url_dir;?>/admin/home/f_link" target="right"><span class="icon-caret-right"></span>链接管理</a></li>
        </ul>
    </div>
    <script type="text/javascript">

    </script>
    <ul class="bread">
        <li><a href="javascript://" target="right" class="icon-home"> 首页</a></li>
        <li><a href="javascript://" id="a_leader_txt">网站信息</a></li>
    </ul>
    <div class="admin">
        <iframe scrolling="auto" rameborder="0" src="<?php echo $pageurl;?>" name="right" width="100%" height="100%"></iframe>
    </div>
    <script src="<?php echo $public_dir; ?>/admin/js/main.js"></script>
    <script>
        ashome.left_change();
    </script>
</body>
</html>

