<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 广告修改</strong></div>
  <table class="table table-hover text-center">
    <tr>
      <th width="5%">ID</th>
      <th>链接</th>  
      <th>图片</th>  
	  <th>名称</th>  	  
      <th width="250">操作</th>
    </tr>

    <?php if($ad){foreach($ad as $val){?>
      <tr>
        <td><?php echo $val['id'];?></td>
        <td><?php echo $val['url'];?></td>
        <td><img src=" <?php echo $url_dir . $val['img']; ?>" alt="" width="70" height="50"/></td>
		<td><?php echo $val['name'];?></td>
        <td>
          <div class="button-group">
            <a type="button" class="button border-main" href="javascript://" data="<?php echo $val['id'];?>"><span class="icon-edit"></span>修改</a>
          </div>
        </td>
      </tr>
    <?php }}?>

  </table>
</div>

<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>修改广告</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo $url_dir;?>/admin/data/ad" enctype="multipart/form-data">
      <input type="hidden" name="id"  value="" />
      <div class="form-group">
        <div class="label">
          <label>广告名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="name" value="" placeholder="填写广告名称" data-validate="required:请输入广告名称" />
          <div class="tips"></div>
        </div>
      </div> 

      <div class="form-group">
        <div class="label">
          <label>链接：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="url" value="" placeholder="广告链接"  data-validate="required:请输入广告链接"  />
        </div>
      </div>
     <div class="form-group">
        <div class="label">
          <label>广告图片：</label>
        </div>
        <div class="field">
          <input type="text" id="url1" name="sslogo"  class="input tips" style="width:25%; float:left;" value="" data-toggle="hover" data-place="right" data-image="<?php echo $url_dir;?>"  />
          <input type="file" name="slogo" class="button bg-blue margin-left" id="image1" value="+ 浏览上传" >
        </div>
      </div>
     <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  amad.get_adinfo();
</script>