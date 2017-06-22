

<div class="mainwd2 mt10 bo1">
<!--leftmainB-->
	<div class="left w800p">
		<div class="hlrmtj-content" id="mainList">
          
			<div class="meinv-ul">
            <?php foreach($news as $key=>$val){?>
				
				<div>
					<a href="<?php echo site_url('pic/index/').$val['id'] ;?>" target="_blank" ><img src="<?php echo $url_dir.$val['img'] ; ?>"> </a>
					<span>清晰可人小美女</span>
					<p>2017-15-06 12:03</p>
				</div>
            <?php } ?>
			</div>
		   <!--页页码-->
		   <?php echo $fenye;?>
		   <!--页码E-->
          </div>
	</div>
<!--leftmainE-->

<?php include 'right.php';?>

</div>
