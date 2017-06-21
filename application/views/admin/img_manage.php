<link href="<?php echo $public_dir; ?>/admin/js/rili/css/lyz.calendar.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo $public_dir; ?>/admin/js/rili/js/lyz.calendar.min.js" type="text/javascript"></script>


<div class="panel admin-panel">
  <div class="panel-head"><strong class="icon-reorder"> 图集管理</strong> <a href=""
                                                                         style="float:right; display:none;">添加字段</a>
  </div>
  <form method="get" action="<?php echo $url_dir; ?>/admin/home/img_manage" enctype="multipart/form-data">
    <div class="padding border-bottom">

      <ul class="search" style="padding-left:10px;">
        <li>搜索：</li>
        <li>
          <select name="status" class="input" style="width:200px; line-height:17px;">
            <option value="">请选择分类</option>
            <option <?php echo $status==1?'selected="selected"':''; ?> value="1">是</option>
            <option <?php echo $status==2?'selected="selected"':''; ?> value="2">否</option>
          </select>
        </li>
        <li>日期：</li>
        <li>
          <input id="txtBeginDate" name="date" style="width: 188px;" class="input" value="<?php echo $date;?>"/>
        </li>
        <li>
          <input type="text" placeholder="请输入搜索关键字" name="keywords" class="input"
                 style="width:250px; line-height:17px;display:inline-block" value="<?php echo $keywords;?>"/>
          <input type="submit" class="button border-main icon-search" value="搜索">
        </li>
      </ul>
    </div>
  </form>

  <table class="table table-hover text-center">
    <tr>
      <th width="100" style="text-align:left; padding-left:20px;">ID</th>
      <th>图片</th>
      <th>名称</th>
      <th>是否展示</th>
      <th width="10%">更新时间</th>
      <th width="310">操作</th>
    </tr>
    <volist name="list" id="vo">
      <?php foreach ($imginfo as $val) { ?>
        <tr>
          <td style="text-align:left; padding-left:20px;"><!--<input type="checkbox" name="id[]" value=""/>-->
            <?php echo $val['id']; ?>
          </td>
          <td width="10%"><img src=" <?php echo $url_dir . $val['img']; ?>" alt="" width="70" height="50"/>
          </td>
          <td><a target="_blank"  href="<?php echo $url_dir.'/pic/index/'.$val['id']; ?>"><?php echo $val['title']; ?></a></td>
          <td><?php echo $val['status']==1?'是':'否'; ?></td>
          <td><?php echo $val['addtime']; ?></td>
          <td>
            <div class="button-group"><a class="button border-main"
                                         href="<?php echo $url_dir; ?>/admin/home/addimg?id=<?php echo $val['id']; ?>"><span
                    class="icon-edit"></span> 修改</a> <a class="button border-red"
                                                        href="javascript:void(0)"
                                                        onclick="return del(<?php echo $val['id']; ?>,'img')"><span
                    class="icon-trash-o"></span> 删除</a></div>
          </td>
        </tr>
      <?php } ?>
      <tr>
        <td colspan="8">
          <?php echo $fenye; ?>
        </td>
      </tr>
  </table>
</div>
<style>
  .rili{left:361px !important;top:105px !important;}
</style>

<script>
  ascontent_manage.rili();
  $(function(){
    var left = $('input[name="date"]').offset().left;
    var top = $('input[name="date"]').offset().top;
    $('#divDate').addClass('rili');
  })

</script>
