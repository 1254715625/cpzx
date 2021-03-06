<div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 栏目修改</strong></div>
    <table class="table table-hover text-center">
        <tr>
            <th width="5%">ID</th>
            <th>栏目名称</th>
            <th>排序</th>
            <th>栏目关键词</th>
            <th>栏目描述</th>
            <th width="250">操作</th>
        </tr>

        <?php foreach ($type as $val){
        ; ?>
        <tr>
            <td><?php echo $val['id']; ?></td>
            <td><?php echo $val['name']; ?></td>
            <td><?php echo $val['sort']; ?></td>
            <td><?php echo $val['key']; ?></td>
            <td><?php echo $val['info']; ?></td>
            <td><?php echo $val['status'] == 1 ? '隐藏' : '显示'; ?></td>
            <td>
                <div class="button-group">
                    <a type="button" class="button border-main" href="javascript://"
                       data="<?php echo $val['id']; ?>"><span class="icon-edit"></span>修改</a>
                    <a class="button border-red" href="javascript:void(0)"
                       onclick="return del(<?php echo $val['id']; ?>,'column')"><span class="icon-trash-o"></span>
                        删除</a></div>
</div>
</td>
</tr>
<?php }; ?>

</table>
</div>

<div class="panel admin-panel margin-top">
    <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加/修改 栏目</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="<?php echo $url_dir; ?>/admin/data/type" enctype="multipart/form-data">
            <input type="hidden" name="id" value=""/>
            <div class="form-group">
                <div class="label">
                    <label>栏目名称：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="name" value="" placeholder="填写栏目名称"
                           data-validate="required:请输入栏目名称"/>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>优先级：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="sort" value="" placeholder="优先级越小越靠前 最大为999"
                           data-validate="required:请输入优先级"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>栏目关键词：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="key" value="" placeholder="填写栏目关键词"
                           data-validate="required:请输入栏目关键词"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>栏目描述：</label>
                </div>
                <div class="field">
                    <input type="text" class="input w50" name="info" value="" placeholder="填写栏目描述"
                           data-validate="required:请输入栏目描述"/>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>图片：</label>
                </div>
                <div style="float: none;" class="field"><?php echo $url_dir.$type['picture'];?>
                    <input type="text" id="url1" name="sslogo"  class="input tips" style="width:25%; float:left;"  value="<?php echo $type['picture'];?>" data-toggle="hover" data-place="right" data-image="<?php echo $url_dir.$type['picture'];?>"  />
                    <input type="file" name="picture" class="button bg-blue margin-left" id="image1" value="游览" >
                </div>
            </div>
            <script>

            </script>
            <div class="form-group">
                <div class="label">
                    <label>显示：</label>
                </div>
                <div class="field">
                    <div class="button-group radio">
                        <label class="button">
                            <span class="icon icon-check"></span>
                            <input name="status" value="0" type="radio">是
                        </label>

                        <label class="button"><span class="icon icon-times"></span>
                            <input name="status" value="1" type="radio">否
                        </label>
                    </div>
                </div>
            </div>

            <!--<div class="form-group">
                <div class="label">
                    <label>是否推荐：</label>
                </div>
                <div class="field">
                    <div class="button-group radio">
                        <label class="button">
                            <span class="icon icon-check"></span>
                            <input name="recomend" value="1" type="radio">是
                        </label>

                        <label class="button"><span class="icon icon-times"></span>
                            <input name="recomend" value="0" type="radio">否
                        </label>
                    </div>
                </div>
            </div>-->

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
    $('.border-main').click(function(){

        var id = $(this).attr('data');

        $.get(web_url + '/admin/data/columninfo?id='+id,function(r){
            if(r != 1){
                console.log(r);
                var data = eval(r);
                $('input[name="id"]').val(data[0]['id']);
                $('input[name="name"]').val(data[0]['name']);
                $('input[name="sort"]').val(data[0]['sort']);
                $('input[name="key"]').val(data[0]['key']);
                $('input[name="info"]').val(data[0]['info']);
                $('input[name="sslogo"]').val(data[0]['picture']);
                $('.active').removeClass('active');
                $('input[name="status"]:eq('+(data[0]['status'])+')').parents('label').addClass('active');
                $('input[name="status"]:eq('+(data[0]['status'])+')').prop('checked',true);
            }
        })
    })

</script>