<httpRuntime executionTimeout="90" maxRequestLength="2091151" useFullyQualifiedRedirectUrl="false" minFreeThreads="8" minLocalRequestFreeThreads="4" appRequestQueueLimit="100"/>
<link href="<?php echo $public_dir; ?>/admin/js/rili/css/lyz.calendar.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo $public_dir; ?>/admin/js/rili/js/lyz.calendar.min.js" type="text/javascript"></script>
<script src="<?php echo $public_dir; ?>/admin/js/caijian/iscroll-zoom.js"></script>
<script src="<?php echo $public_dir; ?>/admin/js/caijian/hammer.js"></script>
<script src="<?php echo $public_dir; ?>/admin/js/caijian/lrz.all.bundle.js"></script>
<script src="<?php echo $public_dir; ?>/admin/js/caijian/jquery.photoClip.js"></script>
<script src="<?php echo $public_dir; ?>/admin/js/caijian/jquery.photoClip.js"></script>


<script src="<?php echo $public_dir; ?>/admin/js/file_upload/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php echo $public_dir; ?>/admin/js/file_upload/js/jquery.iframe-transport.js"></script>
<script src="<?php echo $public_dir; ?>/admin/js/file_upload/js/jquery.fileupload.js"></script>
<script src="<?php echo $public_dir; ?>/admin/js/file_upload/js/cors/jquery.xdr-transport.js"></script>


<script type="text/javascript">window.UEDITOR_HOME_URL="<?php echo $public_dir; ?>/admin/js/ueditor/"; </script>
<script type="text/javascript" charset="utf-8" src="<?php echo $public_dir; ?>/admin/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $public_dir; ?>/admin/js/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo $public_dir; ?>/admin/js/ueditor/lang/zh-cn/zh-cn.js"></script>

<div class="panel admin-panel">
    <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 新闻添加</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="<?php echo $url_dir; ?>/admin/data/addnews"
              enctype="multipart/form-data">
            <input type="hidden" class="input" name="id" value="<?php echo $info['id']; ?>"/>

            <div class="form-group">
                <div class="label">
                    <label>作者：</label>
                </div>
                <div class="field">
                    <input type="text" width="300px" class="input" name="author"
                           value="<?php echo str_replace('"', '&quot', $info['author']); ?>"
                           data-validate="required:请输入作者,没有可不填"/>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>标题：</label>
                </div>
                <div class="field">
                    <input type="text" width="300px" class="input" name="title"
                           value="<?php echo str_replace('"', '&quot', $info['title']); ?>"
                           data-validate="required:请输入标题"/>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>短标题：</label>
                </div>
                <div class="field">
                    <input type="text" name="shorttitle" width="120px" class="input w50"
                           value="<?php echo str_replace('"', '&quot', $info['shorttitle']); ?>"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>类型：</label>
                </div>
                <div class="field">
                    <select name="type" class="dinput">
                        <?php foreach ($type as $val) {
                            if($val['id'] != 9){
                                if ($val['id'] == $info['typeid']) {
                                    echo '<option selected="selected" value="' . $val['id'] . '">' . $val['name'] . '</option>';
                                } else {
                                    echo '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
                                }
                            }

                        } ?>
                    </select>
                    <div class="tips"></div>
                </div>
            </div>
            <!--<div class="form-group">
        <div class="label">
          <label>作者：</label>
        </div>
        <div class="field">
          <input type="text" class="dinput" name="aid" placeholder="ID或作者名" value="<?php /*echo $info['author'];*/ ?>" data-validate="required:请输入作者信息" />
          <input type="text" class="dinput" readonly="readonly" name="aname" placeholder="填写作者名" style="display: none" value="" />
          <div class="tips"></div>
        </div>
      </div>-->
            <div class="form-group">
                <div class="label">
                    <label>来源：</label>
                </div>
                <div class="field">
                    <input type="text" class="dinput" name="source" placeholder="文章来源"
                           value="<?php echo $info['source']; ?>" data-validate="required:请输入文章来源"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>标签：</label>
                </div>
                <div class="field">
                    <input type="text" class="dinput" name="tag" placeholder="格式: ×××,×××"
                           value="<?php echo $info['tag']; ?>"/>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>封面图片：</label>
                </div>
                <div style="float: none;" class="field">
                    <input type="text" id="url1" name="sslogo" class="input tips" style="width:25%; float:left;"
                           value="<?php echo $info['img']; ?>" data-toggle="hover" data-place="right"
                           data-image="<?php echo $url_dir . $info['img']; ?>"/>
                    <input type="file" name="slogo" class="button bg-blue margin-left" id="image1" value="游览">
                </div>

            </div>
            <div class="form-group">
                <div class="label">
                    <label>软件二维码：</label>
                </div>
                <div class="field">
                    <input type="text" id="url1" name="sslogo2" class="input tips" style="width:25%; float:left;"
                           value="<?php echo $info['img2']; ?>" data-toggle="hover" data-place="right"
                           data-image="<?php echo $url_dir . $info['img2']; ?>"/>
                    <input type="file" name="slogo2" class="button bg-blue margin-left" id="image1" value="+ 浏览上传">
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>导语简介：</label>
                </div>
                <div class="field">
                    <textarea name="abstract" data-validate="required:请输简介"><?php echo $info['abstract']; ?></textarea>
                    <div class="tips"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label>文章：</label>
                </div>
                <div class="field">
                    <?php if($content =='') { ?>
                        <script id="article" name="article" type="text/plain" style="width:100%; height:160px;"></script>
                    <?php } else{ ?>
                        <script id="article" name="article" type="text/plain" style="width:100%; height:160px;"><?php echo $info['article'];  ?></script>
                    <?php } ?>

                </div>
            </div>



            <div class="form-group">
                <div class="label">
                    <label>上传视频：</label>
                </div>
                <div class="field">

                    <div style="margin-top:20px;">
                        <span>请上传：</span>
                        <span style='color:blue;'>(支持'mp4,flv'格式)</span> <!--3gp','rmvb','','wmv','avi','mkv','mp4','mp3','-->
                    </div>
                    <div style="margin-top:10px;">

                        <input type="file" name="files" class="upinput" param1="xxx"/>
                        <input type="hidden" name="local_time" value="" class="param1">
                        <input type="hidden" name="param2" value="<?php echo $content; ?>" class="param2">

                    </div>
                    <!-- 上传进度条及状态： -->
                    <div class="progress" style='height:40px'>
                        <div class="bar" style="width: 0%;"></div>
                        <div class="upstatus" style="margin-top:10px;"></div>
                    </div>
                    <!-- 预览框： -->
                    <div class="preview">
							
                        <?php if($content =='') { ?>

                        <?php } else{ ?>
                            <object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'
                                    codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0'
                                    height='120' width='190'>
                                <param name='movie'
                                       value='/upload/FlvsPlayer/vcastr22.swf?01=/upload/a/170614video/pre_d1942a3ab01eb59220e2b3a46e7ef09d1497410762.flv&IsAutoPlay=1'>
                                <param name='quality' value='high'>
                                <param name='allowFullScreen' value='true'/>
                                <embed src="/upload/FlvsPlayer/vcastr22.swf?vcastr_file=<?php echo $content; ?>&IsAutoPlay=1" quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer'
                                       type='application/x-shockwave-flash'
                                       width='640' height='350'></embed>
                            </object>


                        <?php } ?>
						
                    </div>

                </div>

                <script>
                    $(function () {
                        $(".upinput").fileupload({

                            url: '<?php echo $url_dir;?>/admin/data/video',//文件上传地址，当然也可以直接写在input的data-url属性内
                            dataType: "json", //如果不指定json类型，则传来的json字符串就需要解析jQuery.parseJSON(data.result);
                            formData: function (form) {//如果需要额外添加参数可以在这里添加
                                return [{name: "param1", value: $(".upinput").attr("param1")},
                                    {name: "param2", value: $(".param2").val()}];
                            },
                            done: function (e, data) {
                                //done方法就是上传完毕的回调函数，其他回调函数可以自行查看api
                                //注意data要和jquery的ajax的data参数区分，这个对象包含了整个请求信息
                                //返回的数据在data.result中，这里dataType中设置的返回的数据类型为json
                                if (data.result.sta) {
                                     console.log(data.result.previewSrc);
                                    $("input[name='param2']").val('/' + data.result.previewSrc);
                                    $("input[name='local_time']").val(data.result.local_time);
                                    // 上传成功：
                                    $(".upstatus").html(data.result.msg);

                                    var fsw='/upload/FlvsPlayer/vcastr22.swf?vcastr_file=';
                                    var src="/"+data.result.previewSrc+"&IsAutoPlay=1";

                                    $('.preview').html("<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'" +
                                        " codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0'" +
                                        " height='120' width='190'><param name='movie'" +
                                        " value='/upload/FlvsPlayer/vcastr22.swf?01=/upload/a/170614video/pre_d1942a3ab01eb59220e2b3a46e7ef09d1497410762.flv&IsAutoPlay=1'>" +
                                        "<param name='quality' value='high'><param name='allowFullScreen' value='true' />" +
                                        "<embed src="+fsw+src+" quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'" +
                                        " width='640' height='350'></embed></object>");

                                   /*
                                   $(".preview").html("<embed src=" + '/' + data.result.previewSrc +
                                        " allowscriptaccess='always' allowfullscreen='true' wmode='opaque'" +
                                        " width='480' height='400'></embed>");
                                        */
                                } else {
                                    // 上传失败：
                                    alert('格式不支持');
                                    $(".progress .bar").css("width", "0%");
                                    $(".upstatus").html("<span style='color:red;'>" + data.result.msg + "</span>");
                                }

                            },
                            progress: function (e, data) {//上传进度
                                var progress = parseInt(data.loaded / data.total * 100, 10);
                                console.log(progress);
                                $(".progress .bar").css("width", progress + "%");
                                $(".upstatus").html("正在上传...");
                            }
                        });

                    })
                </script>

            </div>


            <div class="form-group">
                <div class="label">
                    <label>新闻时间：</label>
                </div>
                <div class="field">
                    <input type="text" class="input" name="newstime" placeholder=" 格式：2016-12-03 13:53 默认为发布时间"
                           value="<?php echo $info['newstime']; ?>"/>
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>优先级：</label>
                </div>
                <div class="field">
                    <select name="status" class="dinput">
                        <?php foreach ($status as $val) {
                            if ($val['id'] == $info['status']) {
                                echo '<option selected="selected" value="' . $val['id'] . '">' . $val['name'] . '</option>';
                            } else {
                                echo '<option value="' . $val['id'] . '">' . $val['name'] . '</option>';
                            }
                        } ?>
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

    var ue = UE.getEditor('article', {
        toolbars: [
            [ 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
                'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                'print', 'preview', 'searchreplace', 'drafts', 'help']
        ],
        autoHeightEnabled: true,
        autoFloatEnabled: true
    });
    ue.ready(function() {

        ue.setContent('<?php echo $info['article']?>');

    });


</script>


