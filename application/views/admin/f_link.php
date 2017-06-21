<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 友情链接管理</strong></div>
  <table class="table table-hover text-center">
    <tr>
      <th width="5%">ID</th>
      <th>链接名称</th>  
      <th>排序</th>     
      <th>链接网址</th>          
      <th width="250">操作</th>
    </tr>

    <?php if($f_link){foreach($f_link as $val){;?>
      <tr>
        <td><?php echo $val['id'];?></td>
        <td><?php echo $val['title'];?></td>
        <td><?php echo $val['sort'];?></td>
        <td><?php echo $val['link']; ?></td>
        <td>
          <div class="button-group">
            <a type="button" class="button border-main" href="javascript://" data="<?php echo $val['id'];?>"><span class="icon-edit"></span>修改</a>
            <a class="button border-red" href="javascript:void(0)" onclick="return del(<?php echo $val['id']; ?>,'f_link')"><span class="icon-trash-o"></span> 删除</a></div>
          </div>
        </td>
      </tr>
    <?php }};?>
    <tr>
        <td colspan="5">
          <?php echo $fenye; ?>
        </td>
      </tr>
  </table>
</div>

<div class="panel admin-panel margin-top">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加/修改 友情链接</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" action="<?php echo $url_dir;?>/admin/data/f_link">
      <input type="hidden" name="id"  value="" />
      <div class="form-group">
        <div class="label">
          <label>链接名称：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="title" value="" placeholder="填写链接名称" data-validate="required:请输入链接名称" />
          <div class="tips"></div>
        </div>
      </div> 

      <div class="form-group">
        <div class="label">
          <label>优先级：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="sort" value="" placeholder="优先级越小越靠前 最大为999"  data-validate="required:请输入优先级"  />
        </div>
      </div>

      <div class="form-group">
        <div class="label">
          <label>链接网址：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" name="link" value="" placeholder="格式：http://www.baidu.com"  data-validate="required:请输入链接网址"  />
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
  f_link.get_f_link();
</script>