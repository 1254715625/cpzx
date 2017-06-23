<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Cache-Control" content="no-transform" /> 
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta name="baidu-site-verification" content="24Ojc03BLg" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $webinfo['web_name'].$name;?></title>
    <meta name="keywords" content="<?php if($web_key){echo $web_key;}else{echo $webinfo['web_keywords'];}?>"/>
    <meta name="description" content="<?php if($web_info){echo $web_info;}else{echo $webinfo['web_inc'];} ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo $public_dir;?>/css/index.css" />
    <script type="text/javascript" src="<?php echo $public_dir;?>/js/sea.js"></script>
    <script type="text/javascript" src="<?php echo $public_dir;?>/js/sea_config.js"></script>
    <script type="text/javascript" src="<?php echo $public_dir;?>/js/jquery.js"></script>
    <link href="<?php echo $public_dir;?>/css/css.css" rel="stylesheet" type="text/css">
    <SCRIPT src="<?php echo $public_dir;?>/js/ScrollPic.js" type=text/javascript></SCRIPT>
</head>

<body>
<!--navB-->

<div class="contentBox">
    <div class="mainwd2">
        <div class="navBox"> <a class="logo left" href="<?php echo site_url('Home/index');?>"><img src="<?php echo $url_dir.$webinfo['web_logo']; ?>"></a>
            <div class="nav right">
                <ul>
                    <li class="<?php echo !$typeid?'currentnav':''?>"><a href="<?php echo site_url('Home/index');?>">首页</a></li>
                    <?php foreach($type as $val){
                            if($val['id'] !=9){
                                ?>
                                <li <?php echo ($val['id']==$typeid)?'class="currentnav"':'';?>><a  href='<?php echo site_url("news/index/{$val['id']}");?>'><?php echo $val['name']; ?></a></li>

                                <?php
                            }
                        } ;?>


                    <?php /*foreach($type as $val){ */?><!--
                        <li <?php /*echo ($val['id']==$typeid)?'class="currentnav"':'';*/?>><a  href='<?php /*echo site_url("news/index/{$val['id']}");*/?>'><?php /*echo $val['name']; */?></a></li>

                    --><?php /*} ;*/?>


                    <li> <a href="/news/meinv">美女图集</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--navE-->

<div class="btxx"></div>

<!--searchB-->
<div class="contentBox">
    <div class="mainwd2 top-nav">
        <div class="left top-navl"><a style="background:#fff;">热门标签：</a>
            <?php if($tag){foreach($tag as $val){ ?>
                <span><a class="tag" href="<?php echo $url_dir;?>/search/tag?keyword=<?php echo urlencode($val['tagname']);?>"><?php echo $val['tagname'];?></a></span>
            <?php }} ;?>
        </div>
        <div class="right">
            <div class="cp-a ">
                <form role="search" method="get" class="td-search-form" action="<?php echo $url_dir;?>/search/index">
                    <div class="td-head-form-search-wrap">
                        <input class="needsclick" id="td-header-search" value="<?php echo $keyword;?>" name="keyword" autocomplete="off" type="text"><input class="wpb_button wpb_btn-inverse btn" id="td-header-search-top" value="搜索" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--searchE-->