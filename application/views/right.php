<!--rightmainB-->
<div class="right w390p ">

    <!--最新资讯B-->
    <div class="main-content-r-activities">
        <div class="activities-title">
            <p><span>娱乐精选|Entertainment</span></p>
        </div>
        <div class="pannel-body">
            <div class="m-list2 m-list2-rt">
                <ul>
                    <?php foreach($rightnewinfo as $zval){ ;?>
                        <li><a href="<?php echo site_url('News/content/').$zval['id'] ;?>" target="_blank"><?php echo $zval['title'] ;?></a><i class="dot"></i></li>
                    <?php } ;?>
                </ul>
            </div>
        </div>
    </div>
    <!--最新资讯E-->

    <!--3个广告位B-->
    <div class="main-content-r-topic">
        <a href="<?php echo $ad[0]['url'];?>" target="_blank"><img src="<?php echo $url_dir.$ad[0]['img']; ?>" style="width:100%;height:120px;" ></a>
        <a href="<?php echo $ad[1]['url'];?>" target="_blank"><img src="<?php echo $url_dir.$ad[1]['img']; ?>" style="width:100%;height:120px;"></a>
        <a href="<?php echo $ad[2]['url'];?>" target="_blank"><img src="<?php echo $url_dir.$ad[2]['img']; ?>" style="width:100%;height:120px;" ></a>
    </div>
    <!--3个广告位E-->

    <!--热文榜B-->
    <div class="index-wrap com-width clearfix">
        <div class="sidebar-r pull-right">
            <div class="pannel-block pannel-rank">
                <div class="activities-title">
                    <p><span>热文榜|Hot list</span></p>
                </div>
                <div class="pannel-body">
                    <div class="rank-tit">
                        <a class="current" href="javascript:;">日排行</a>
                        <a href="javascript:;">周排行</a>
                    </div>
                    <div class="rank-content">
                        <ul class="rank-item show-item">
                            <?php foreach($day as $val){?>
                                <li>
                                    <a target="_blank" href="<?php echo site_url('News/content/').$val['id'] ;?>"><?php echo $val['title']?></a>
                                </li>
                            <?php }?>
                        </ul>
                        <ul class="rank-item">
                            <?php foreach($week as $val){?>
                                <li>
                                    <a target="_blank" href="<?php echo site_url('News/content/').$val['id'] ;?>"><?php echo $val['title']?></a>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--热文榜E-->
</div>
<!--rightmainE-->
