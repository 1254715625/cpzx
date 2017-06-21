
<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 首页轮播</strong></div>
  <div class="padding border-bottom">
  <button type="button" class="button border-yellow" onclick="window.location.href='<?php echo $url_dir;?>/admin/home/addnew'"><span class="icon-plus-square-o"></span> 添加内容</button>
  </div>
  <table class="table table-hover text-center">
    <tr>
      <th width="10%">ID</th>
      <th width="20%">图片</th>
      <th width="15%">名称</th>
      <th width="20%">描述</th>
      <th width="10%">类型</th>
      <th width="15%">操作</th>
    </tr>

    <?php if($listdata){foreach($listdata as $val){?>
      <tr>
        <td><?php echo $val['id'];?></td>
        <td><img src="<?php echo $url_dir.$val['img'];?>" alt="" width="120" height="50" /></td>
        <td><?php echo $val['title'];?></td>
        <td><?php echo mb_substr($val['title'],0,20).'…';?></td>
        <td><?php echo $val['name'];?></td>
        <td><div class="button-group">
            <a class="button border-main" href="<?php echo $url_dir;?>/admin/home/addnew?id=<?php echo $val['id'];?>"><span class="icon-edit"></span> 修改</a>
            <a class="button border-red" href="javascript:void(0)" onclick="return del(<?php echo $val['id'];?>)"><span class="icon-trash-o"></span> 删除</a>
          </div></td>
      </tr>
    <?php }}?>
  </table>
</div>
<script type="text/javascript">
function del(id){
  layer.confirm('您确定要删除吗?', {
    btn: ['确定','还是算了吧']
  }, function(){
    location.href = '<?php echo $url_dir;?>/admin/data/deletenews?id='+id;
  });
}
</script>
