<link rel="stylesheet" type="text/css" href="<?php echo $public_dir;?>/admin/js/imgup/diyUpload/css/webuploader.css">
<link rel="stylesheet" type="text/css" href="<?php echo $public_dir;?>/admin/js/imgup/diyUpload/css/diyUpload.css">
<script type="text/javascript" src="<?php echo $public_dir;?>/admin/js/imgup/diyUpload/js/webuploader.html5only.min.js"></script>
<script type="text/javascript" src="<?php echo $public_dir;?>/admin/js/imgup/diyUpload/js/diyUpload.js"></script>
<script src="<?php echo $public_dir; ?>/admin/js/caijian/iscroll-zoom.js"></script>
<script src="<?php echo $public_dir; ?>/admin/js/caijian/hammer.js"></script>
<script src="<?php echo $public_dir; ?>/admin/js/caijian/lrz.all.bundle.js"></script>
<script src="<?php echo $public_dir; ?>/admin/js/caijian/jquery.photoClip.js"></script>

<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>添加图集</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo $url_dir;?>/admin/data/addimg" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $info['id'];?>">
      <div class="form-group">
        <div class="label">
          <label>标题：</label>
        </div>
        <div class="field">
          <input type="text" width="300px" class="input" name="title" value="<?php echo $info['title'];?>" data-validate="required:请输入标题" />
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>封面图片：</label>
        </div>
        <div style="float: none;" class="field">
          <input type="text" id="url1" name="sslogo"  class="input tips" style="width:25%; float:left;" value="<?php echo $info['img'];?>" data-toggle="hover" data-place="right" data-image="<?php echo $url_dir.$info['img'];?>"  />
          <input type="file" name="slogo" class="button bg-blue margin-left" id="image1" value="游览" >
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>上传图片：</label>
        </div>
        <div class="field">
          <div id="test" name="content"></div>
          <div class="parentFileBox">
            <ul class="fileBoxUl"></ul>
          </div>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>上传完成图片：</label>
        </div>
        <div class="field">
          <div class="input" style="height:450px; border:1px solid #ddd;">
            <ul class="imgcontent">
              <?php if($content){foreach($content as $val){?>
              <li>
                <input type="hidden" name="url[]" value="<?php echo $val;?>">
                <div class="imgst"><img src="<?php echo $url_dir.$val;?>"></div>
                <div class="delimg"><img src="<?php echo $public_dir;?>/admin/images/x_alt.png"></div>
              </li>
              <?php }}?>

            </ul>
          </div>
          <div class="tips"></div>
        </div>
      </div>
      <div class="form-group">
        <div class="label">
          <label>是否展示：</label>
        </div>
        <div class="field">
          <select name="status" class="dinput">
            <option  value="">是否展示</option>
            <option <?php echo $info['status']==1? 'selected="selected"':'';?> value="1">是</option>
            <option <?php echo $info['status']==2? 'selected="selected"':'';?> value="2">否</option>
          </select>
          <div class="tips"></div>
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

<script type="text/javascript">


  //插件上传图片
  $('#test').diyUpload({
    url:'<?php echo $public_dir;?>/admin/js/imgup/server/fileupload.php',
    success:function( data ) {
      if(data.status == 1){
        var content = '<li><input type="hidden" name="url[]" value="'+data.msg+'"><div class="imgst"><img src="<?php echo $url_dir;?>'+data.msg+'"></div><div class="delet" id="delet"></div></li>';
        $('.imgcontent').append(content);
      }else if(data.status == 0){
        layer.alert(data.msg);
      }

      $('#fileBox_'+ data.id).remove();
    },
    error:function( err ) {
      console.info( err );
    }
  });

  asaddimg.del();
</script>