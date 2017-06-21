

<div class="mainwd2 mt10 bo1">
<!--leftmainB-->
	<div class="left w800p">
		<div class="hlrmtj-content" id="mainList">
          <!--<ul>
          <?php /*foreach($news as $val){ ;*/?>
			<li class="<?php /*echo $val['img']?'rtmj-box':'rtmj-box2';*/?>">
				<dl>
					<?php /*if($val['img']){*/?>
					<dt><a href="<?php /*echo site_url('pic/index/').$val['id'] ;*/?>" target="_blank" > <img src="<?php /*echo $url_dir.$val['img'] ;*/?>"  width="250" height="165"></a></dt>
					<?php /*}*/?>
					 <dd>
					 <h3><a href="<?php /*echo site_url('pic/index/').$val['id'] ;*/?>" target="_blank"><?php /*echo $val['title'] ;*/?></a></h3>
					<p><?php /*echo mb_substr($val['abstract'],0,114);*/?></p>
					<p>来源：<?php /*echo empty($val['addtime'])?"未知":$val['addtime']; */?> </p>
					</dd>
				</dl>
			</li>
			<?php /*} ;*/?>
           </ul>-->

            <?php foreach($news as $val){ ;?>

            <a href="<?php echo site_url('pic/index/').$val['id'] ;?>" target="_blank" ><img src="<?php echo $url_dir.$val['img'] ; ?>"> </a>

            <?php } ;?>

		   <!--页页码-->
		   <?php echo $fenye;?>
		   <!--页码E-->
          </div>
	</div>
<!--leftmainE-->

<?php include 'right.php';?>

</div>
