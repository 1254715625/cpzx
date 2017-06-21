<link href="<?php echo $public_dir;?>/css/pic.css" rel="stylesheet" type="text/css">
<!--图集B-->
<div class="mainwd2 mt10 bo1">
	<div class="swp-tit clearfix" slide-type="title"><h2><?php echo $info['title'];?></h2></div>
	<div class="swp-tool">
		<div class="left c999"><?php echo $info['addtime'];?></div>
		<div class="right c000"></div>
	</div>
	<div class="swp-tool mt10">
			<div class="swp-img" >
			<div style="width:25%;height:78%;position: absolute;left:23%;" class="swpl-fastprev" title="上一张"></div>
			<div style="width:25%;height:78%;position: absolute;left:52%;" class="swpl-fastprev" title="下一张"></div>
				<img src="" o-width="950" o-height="633">
			</div>	
	</div>			
	<div class="swp-list-wrap " scroll-type="wrap" id="SI_SmallList">
		<div class="swp-list">
			<a href="<?php echo $pre['id']?site_url('Pic/index/').$pre['id']:'javascript://';?>" class="swpl-group swpl-group-prev" scroll-type="groupprev"  title="上一图集" suda-uatrack="key=hdphoto_20140213&amp;value=prephoto">
				<span class="bg bg-a">
					<span class="inner">
						<?php if($pre['id']){?>
						<img  src="<?php echo $url_dir.$pre['img'];?>" alt="<?php echo $pre['title'];?>">
						<?php }else{?>
							没有了
						<?php }?>
					</span>
				</span>
				<span class="bg bg-b"></span>
				<span class="bg bg-c"></span>
				<i>&nbsp;</i><em title="<?php echo $pre['title'];?>">上一篇：<?php echo $pre['id']?$pre['title']:'没有了';?></em>
			</a>
			<div class="left">
				<a class="swpl-btn swpl-fastprev "  title="上一张" ><img src="<?php echo $public_dir;?>/images/ro-rsl.jpg" /></a>
			</div>
			<div class="swp-list-cont" scroll-type="cont" style="width: 718px;">
				<ul scroll-type="list" style="width: 8160px;">
					<?php foreach($content as $val){?>
					<li scroll-type="item" class="" action-type="select" action-data="index=0" suda-uatrack="key=hdphotov2&amp;value=thumb">
						<a class="imgurl" title="<?php echo $info['title'];?>"><img src="<?php echo $url_dir.$val?>"></a>
					</li>
					<?php }?>
				</ul>
			</div>
			<div class="left mr20p">
				<a class="swpl-btn swpl-fastprev "  title="下一张" ><img src="<?php echo $public_dir;?>/images/ro-rs.jpg" /></a>
			</div>
			<a href="<?php echo $next['id']?site_url('Pic/index/').$next['id']:'javascript://';?>" class="swpl-group swpl-group-prev" scroll-type="groupprev"  title="下一图集" >
				<span class="bg bg-a">
					<span class="inner">
						<?php if($next['id']){?>
							<img  src="<?php echo $url_dir.$next['img'];?>" alt="<?php echo $next['title'];?>">
						<?php }else{?>
							没有了
						<?php }?>
					</span>
				</span>
				<span class="bg bg-b"></span>
				<span class="bg bg-c"></span>
				<i>&nbsp;</i><em title="<?php echo $next['title'];?>">下一篇：<?php echo $next['id']?$next['title']:'没有了';?></em>
			</a>
		</div>
	</div>

</div>
<script>
	$(function(){
		var imgurl1 = $('.imgurl img:eq(0)').attr('src');
		$('.swp-img img').attr('src',imgurl1);
		$('.imgurl:eq(0)').addClass('onfouse');


		$('.imgurl img').click(function(){

			var weizhi1 = parseInt($('.onfouse').index());
			var imgurl = $(this).attr('src');
			var weizhi2 = $('.swp-list-cont ul li').index($(this).parents('li'));

			gaoliang(imgurl,weizhi2); //高亮和替换图片

			var num = $('.imgurl').length;

		})

		$('.swpl-fastprev').click(function(){

			var type = 1;
			if($(this).attr('title')=='上一张'){
				type = -1;
			}
			var num = $('.imgurl').length;
			var weizhi1 = parseInt($('.swp-list-cont ul li').index($('.onfouse').parents('li')));
			if(!(weizhi1 == 0 && type==-1)&& !(weizhi1 == (num-1)&&type==1)){

				var imgurl = $('.swp-list-cont ul li a:eq('+(weizhi1+type)+') img').attr('src');
				var weizhi2 = weizhi1+type;

				gaoliang(imgurl,weizhi2); //高亮和替换图片
			}


			yidong(weizhi2,num,type); //移动

		})


		function gaoliang(src,num){
			$('.swp-img img').attr('src',src);
			$('.onfouse').removeClass('onfouse');
			$('.imgurl:eq('+num+')').addClass('onfouse');
		}

		function yidong(index,num,len){
			if(num>6){
				if(index>2 && index < (num-2)){
					$('.swp-list-cont ul').animate({'marginLeft':-120*(index-2)},500);
				}else if(index<=2 && len<0&&index>1){
					$('.swp-list-cont ul').animate({'marginLeft':-120*(index-2)},500);
				}
			}
		}

	})
	
</script>

