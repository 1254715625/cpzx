<div class="mainwd2 mt10 bo1">
    <!--leftmainB-->
    <div class="left w800p">
        <div class="title"><h1><?php echo $info['title']; ?></h1></div>
        <div class="m-info ">来源:<?php echo empty($info['source']) ? "未知" : $info['source']; ?>
            &nbsp;&nbsp;&nbsp;新闻时间:<?php echo $info['newstime']; ?>
            &nbsp;&nbsp;&nbsp;点击量:<?php echo $info['click']; ?><!--&nbsp;&nbsp;&nbsp;时长:--><?php  //$content['local_time']; ?> </div>
        <div class="g-mnc">
            <!-- 内容详情 -->
            <div class="g-article">
                <div class="m-article ti2em" style="text-align: center">
                    <div class="review">
                        <p><strong><?php echo $info['abstract']; ?></strong></p>
                    </div>
                    <?php
                    $cont = explode('.', $content['content']);
                    $total = count($cont);
                    $diz = $cont[($total - 1)];
                    if ($content['content'] == '' || !(in_array($diz, ['3gp', 'rmvb', 'flv', 'mp4', 'wmv', 'avi', 'mkv', 'wav']))){ ?>
                        <p><strong>没有上传视频或格式不对</strong></p>
                    <?php } else{
                    ; ?>
                        <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'
                                codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0'
                                height='120' width='190'>
                            <param name='movie'
                                   value='/upload/FlvsPlayer/vcastr22.swf?01=/upload/a/170614video/pre_d1942a3ab01eb59220e2b3a46e7ef09d1497410762.flv&IsAutoPlay=1'>
                            <param name='quality' value='high'>
                            <param name='allowFullScreen' value='true'/>
                            <embed src="/upload/FlvsPlayer/vcastr22.swf?vcastr_file=<?php  echo $content['content']; ?>&IsAutoPlay=1" quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer'
                                   type='application/x-shockwave-flash'
                                   width='640' height='350'></embed>
                        </object>
                        <?php }; ?>
                </div>

                <div style="position:relative;margin-left:82%;width:140px;height:40px;">
                    <div
                        style="width:2px;height:36px;background:#ccc;position:absolute;margin-left:66px;margin-top:2px"></div>
                    <button style="margin-left:4px" id="vote" rel="<?php echo $info['id']; ?>"><img
                            src="<?php echo $public_dir ?>/images/ic_vote_checked.png" alt="赞"><span
                            style="position:absolute;margin-top:6px;margin-left:2px;font-size:20px"><span
                                style="position:absolute;margin-top:-2px;margin-left:6px;font-size:20px"><?php if (!$vnum) {
                                    echo 0;
                                } else {
                                    echo $vnum;
                                } ?></span></button>

                    <button style="margin-left:38px;margin-top:1px;position:absolute" id="dvote"
                            rel="<?php echo $info['id']; ?>"><img
                            src="<?php echo $public_dir ?>/images/ic_vote_down_checked.png" alt="踩"><span
                            style="position:absolute;margin-top:2px;margin-left:6px;font-size:20px"><?php if (!$dnum) {
                                echo 0;
                            } else {
                                echo $dnum;
                            } ?></span></button>
                </div>

            </div>
            <script type="text/javascript">
                $(function () {
                    var id = $("#vote").attr('rel');
                    $("#vote").click(function () {
                        $.get("/news/vote?id=" + id, function (r) {
                            alert(r);
                            window.location.reload();
                        })
                    })

                    $("#dvote").click(function () {
                        $.get("/news/dvote?id=" + id, function (r) {
                            alert(r);
                            window.location.reload();
                        })
                    })
                })

            </script>
            <!-- 内容详情 end-->

            <!-- 上下文章翻页 -->
            <div class="g-box3 f-mt-auto">
                <div class="m-box3">
                    <div class="page-nav">
                        <?php if ($pre['title']) { ?>
                            <div class="prev left">上一篇:<a
                                    href="<?php echo site_url('News/content/') . $pre['id']; ?>"><?php echo $pre['title']; ?></a>
                            </div>
                        <?php } else { ?>
                            <div class="prev left">上一篇:<a href="javascript://">没有了</a></div>
                        <?php } ?>

                        <?php if ($next['title']) { ?>
                            <div class="next right">下一篇:<a
                                    href="<?php echo site_url('News/content/') . $next['id']; ?>"><?php echo $next['title']; ?></a>
                            </div>
                        <?php } else { ?>
                            <div class="next right">下一篇:<a href="javascript://">没有了</a></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- 上下文章翻页 end-->


        </div>
    </div>
    <!--leftmainE-->

    <?php include 'right.php'; ?>

</div>
