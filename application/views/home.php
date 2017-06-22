<script type="text/javascript" src="<?php echo $public_dir;?>/js/main.js"></script>

<div class="mainwd2 mt10 bo1">
<!--leftmainB-->
	<div class="left w800p">
		<!--头部新闻图B-->
		<div class="main-content-l-banner clearfix" id="main-content-l-banner">
			<?php
			$ls1 = array('l','r-t','r-b'); $ls2 = array('-b','','');
			foreach($adv as $key=>$val){ ;?>
				<div class="banner-<?php echo $ls1[$key];?>">
					<a href="<?php echo site_url('News/content/').$val['id'] ;?>" class="mask-<?php echo $ls1[$key];?>" id="mask-<?php echo $ls1[$key];?>"><img src="<?php echo $url_dir.$val['img'] ?>" id="img-<?php echo $ls1[$key];?>" ><span class="zt-size<?php echo $ls2[$key];?>"><?php echo mb_substr($val['title'],0,22)?></span></a>
				</div>
			<?php } ;?>
			<script type="text/javascript">function zhezhao(a,m){var o=document.getElementById(a);o.onmouseover=function(){this.className=m},o.onmouseout=function(){o.className=a}}zhezhao("mask-l","mask-l-m"),zhezhao("mask-r-t","mask-r-t-m"),zhezhao("mask-r-b","mask-r-b-m");</script>
		</div>
		<!--头部新闻图E-->
		<!--彩市新闻B-->
		<div class="main-content-l-important">
			<div class="important-t">
				<p>奇闻趣事 | Significant</p>
			</div>
		
			<div class="important-t-list clearfix">
				<ul class="important-t-list-l">
				<?php foreach($csxw as $val){ ;?>
					<li><a href="<?php echo site_url('News/content/').$val['id'] ;?>"><?php echo $val['title'] ;?></a></li>
				<?php } ;?>
				</ul>
			</div>
		</div>
		<!--彩市新闻E-->
		<!--预测软件B-->
		<div class="main-content-l-Vmeti">
			<div class="Vmeti-title clearfix"><span>福利视频app | Benefit APP</span></div>
			<div class="Vmeti-gz clearfix">
				<ul class="Vmeti-gz-r clearfix">
					<?php foreach($ycrj as $val){ ;?>
						<li class="clearfix ycrjf">
							<a href="<?php echo site_url('News/content/').$val['id'] ;?>">
								<img class="tu-01" src="<?php echo $url_dir.$val['img'] ;?>">
								<p><?php echo $val['title'];?></p>
								<img class="tu-02" src="<?php echo $url_dir.$val['img2'] ;?>"  style="display: none;">
							</a>
						</li>
					<?php } ;?>
				</ul>
				<script>
					$('.Vmeti-gz-r li a').mouseover(function() {
						$(this).children('.tu-02').css('display','block');
					});
					$('.Vmeti-gz-r li a').mouseout(function() {
						$(this).children('.tu-02').css('display','none');
					});
				</script>
				
			</div>

		</div>
		<!--预测软件E-->
		<!--彩界杂谈B-->
		<div class="main-content-l-XiTalk">
			<div class="XiTalk-title">
				<p><a class="a-color">恶搞新编 | Kuso</a> <span>啪啪啪视频娱乐，带给你不一样的欢乐正能量！</span></p>
				<div><br></div>
			</div>
			<ul class="XiTalk-p clearfix fs333">
			<?php foreach($cjzt as $val){ ;?>
				<li>
					<a target="_blank" style="display:inline-block;width:200px;height:120px;" href="<?php echo site_url('News/content/').$val['id'] ;?>" class="xiaoxi-a"><img style="width:200px;height:120px;" src="<?php echo $url_dir.$val['img']; ?>" ></a>
					<a class="xiaoxi-t" target="_blank" href="<?php echo site_url('News/content/').$val['id'] ;?>" title="<?php echo $val['title'] ;?>"><?php echo $val['title'] ;?></a>
				</li>
			<?php } ;?>
			</ul>
		</div>
		<!--彩界杂谈E-->
		<!--彩票美女B-->
		<div class="rollphotos main-content-l-Vmeti">
		<div class="Vmeti-title clearfix"><span>美女福利 | Beauty lottery</span></div>
			<div class="blk_29">
				<div class="LeftBotton" id="LeftArr"></div>
				<div class="Cont" id="ISL_Cont_1">
					<!-- 图片列表 begin -->
					<?php foreach($cpmn as $val){?>
						<div class="box">
							<A class="imgBorder" href="<?php echo site_url('Pic/index/').$val['id'] ;?>" target=_blank><IMG height=120 alt="" src="<?php echo $url_dir.$val['img']; ?>" width=100 border=0></A>
						</div>
					<?php }?>
					<!-- 图片列表 end -->
				</div>
				<div class=RightBotton id=RightArr></div>
			</div>
			<SCRIPT language=javascript type=text/javascript>
					<!--//--><![CDATA[//><!--
					var scrollPic_02 = new ScrollPic();
					scrollPic_02.scrollContId   = "ISL_Cont_1"; //内容容器ID
					scrollPic_02.arrLeftId      = "LeftArr";//左箭头ID
					scrollPic_02.arrRightId     = "RightArr"; //右箭头ID
			
					scrollPic_02.frameWidth     = 817;//显示框宽度
					scrollPic_02.pageWidth      = 103; //翻页宽度
			
					scrollPic_02.speed          = 10; //移动速度(单位毫秒，越小越快)
					scrollPic_02.space          = 10; //每次移动像素(单位px，越大越快)
					scrollPic_02.autoPlay       = true; //自动播放
					scrollPic_02.autoPlayTime   = 4; //自动播放间隔时间(秒)
			
					scrollPic_02.initialize(); //初始化
										
					//--><!]]>
			</SCRIPT>
		</div>
		<!--彩票美女E-->
		<!--彩票资讯B-->
		<div class="main-content-l-important">
			<div class="important-t">
				<p>搞笑典籍 | Funny books</p>
			</div>
			<div class="w100p"></div>
		</div>
		<!--彩票资讯E-->

</div>
<!--leftmainE-->

	<?php include 'right.php';?>
</div>

<script type="text/javascript">
	home.cpzx('<?php echo $url_dir;?>');
</script>

