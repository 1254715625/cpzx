<div class="botbanner"><a href="<?php echo $ad[3]['url'];?>" target="_blank"><img src="<?php echo $url_dir.$ad[3]['img']; ?>" ></a></div>

<div class="footer">
    <div class="obj-cro">友情链接</div>
    <div class="content-cooperationmain">
    <?php foreach($f_link as $val){; ?>
        <a href="<?php echo $val['link']; ?>" title="<?php echo $val['title']; ?>" target="_blank"><?php echo $val['title']; ?></a>
    <?php }; ?>
    </div>
</div>

<div class="footbg">
    <div class="w1200p contents"><a href="#" title="关于我们" target="_blank">关于我们</a><a href="#" title="广告与服务" target="_blank">广告与服务</a><a href="http://hk.szhk.com" title="版权声明" target="_blank">版权声明</a></div>
    <div class="w1200p contents2"><?php echo $webinfo['web_bottommes'];?></div>
</div>
</body>
</html>