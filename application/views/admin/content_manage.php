<link href="<?php echo $public_dir; ?>/admin/js/rili/css/lyz.calendar.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo $public_dir; ?>/admin/js/rili/js/lyz.calendar.min.js" type="text/javascript"></script>


<div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 新闻管理</strong> <a href=""
                                                                           style="float:right; display:none;">添加字段</a>
    </div>
    <form method="get" action="<?php echo $url_dir; ?>/admin/home/content_manage" enctype="multipart/form-data">
        <div class="padding border-bottom">

            <ul class="search" style="padding-left:10px;">
                <li>搜索：</li>
                <li>
                    <select name="status" class="input" style="width:200px; line-height:17px;">
                        <option value="">请选择分类</option>
                        <?php foreach ($status as $val) {
                            if ($val['id'] == $status) {
                                echo '<option selected="selected" value="' . $val['id'] . '">' . $val['name'] . '</option>';
                            } else {
                                echo '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
                            }
                        } ?>
                    </select>
                </li>
                <li>
                    <select name="typeid" class="input" style="width:200px; line-height:17px;">
                        <option value="">请选择栏目</option>
                        <?php foreach ($type as $val) {
                            if ($val['id'] == $typeid) {
                                echo '<option selected="selected" value="' . $val['id'] . '">' . $val['name'] . '</option>';
                            } else {
                                echo '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
                            }
                        } ?>
                    </select>
                </li>
                <li>日期：</li>
                <li>
                    <input id="txtBeginDate" name="date" style="width: 188px;" class="input" value="<?php echo $date;?>"/>
                </li>
                <li>
                    <input type="text" placeholder="请输入搜索关键字" name="keywords" class="input"
                           style="width:250px; line-height:17px;display:inline-block"/>
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
            <th>分类名称</th>
            <th>作者</th>
            <th width="10%">更新时间</th>
            <th width="310">操作</th>
        </tr>
        <volist name="list" id="vo">
            <?php foreach ($newsinfo as $val) { ?>
                <tr>
                    <td style="text-align:left; padding-left:20px;"><!--<input type="checkbox" name="id[]" value=""/>-->
                        <?php echo $val['id']; ?>
                    </td>
                    <td width="10%"><img src=" <?php echo $url_dir . $val['img']; ?>" alt="" width="70" height="50"/>
                    </td>
                    <td><a target="_blank"  href="<?php echo $url_dir.'/news/content/'.$val['id']; ?>"><?php echo $val['title']; ?></a></td>
                    <td><?php echo $val['name']; ?></td>
                    <td><?php echo $val['author']; ?></td>
                    <td><?php echo $val['newstime']; ?></td>
                    <td>
                        <div class="button-group"><a class="button border-main"
                                                     href="<?php echo $url_dir; ?>/admin/home/addnew?id=<?php echo $val['id']; ?>"><span
                                    class="icon-edit"></span> 修改</a> <a class="button border-red"
                                                                        href="javascript:void(0)"
                                                                        onclick="return del(<?php echo $val['id']; ?>,'new')"><span
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


<script>
    ascontent_manage.rili();
</script>
