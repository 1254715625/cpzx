<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends Admin_Controller {
	

	//修改密码
	public function editpassword()
	{
		$password = $_POST['mpass'];
		$newpassword1 = $_POST['newpass'];
		$newpassword2 = $_POST['renewpass'];
		$id = $_SESSION['adminid'];

		if(!$password || !$newpassword1 || !$newpassword2)showmsg($this->data['url_dir'].'/admin/home/pass','信息不能为空！');
		if($newpassword1 != $newpassword2)showmsg($this->data['url_dir'].'/admin/home/pass','两次密码不一致！');

		$query = $this->db->query("select count(*) as dd from tx_admin where id = ".$id." and password = '".md5($password)."' ");
		$num = $query->result_array()[0];

		if($num['dd'] <=0)showmsg($this->data['url_dir'].'/admin/home/pass','原密码错误！');

		$this->db->query("update tx_admin set password = '".md5($newpassword1)."' where id = ".$id."");

		showmsg($this->data['url_dir'].'/admin/home/pass','修改成功！');

	}

	//网站信息修改
	public function editconfig(){

		$data[0] = $_POST['stitle'];
		$data[2] = $_POST['surl'];
		$data[3] = $_POST['skeywords'];
		$data[4] = $_POST['sdescription'];
		$data[5] = $_POST['s_name'];
		$data[6] = $_POST['s_phone'];
		$data[7] = $_POST['s_tel'];
		$data[8] = $_POST['s_email'];
		$data[9] = $_POST['s_address'];
		$data[10] = $_POST['scopyright'];
		$data[11] = $_POST['s_qq'];


		if($_FILES['slogo']['name']){
			$data[1] = ImageUpload($_FILES['slogo'],'config','logo');
		}else{
			$data[1] = $_POST['sslogo'];
		}

		foreach($data as $key => $value){
			$sql = "update tx_config set content = '".$value."' where id = ".($key+1)." ";
			$this->db->query($sql);
		}

		showmsg($_SERVER['HTTP_REFERER'],'更新成功！');
	}

	
	//添加新闻
	public function addnews(){

        //作者信息
        $aid = $_SESSION['adminid'];

        if($_POST['type'] == 1){
            $aid=$_POST['author'];
        }

		$id = $_POST['id'];
		$title = $_POST['title'];
		$shorttitle = $_POST['shorttitle'];
		$type = $_POST['type'];
		$article = $_POST['article'];
		$img = $_POST['sslogo'];
		//$aid = is_numeric($_POST['aid'])?$_POST['aid']:$_POST['aname'];

		$source = $_POST['source'];
		$tag = str_replace('，',',',$_POST['tag']);
		$abstract = $_POST['abstract'];
		$content = $_POST['param2'];
		$local_time=$_POST['local_time'];
		$newstime = $_POST['newstime']?$_POST['newstime']:'20'.date('y-m-d H:i');
		$status = $_POST['status']?$_POST['status']:0;
        /*echo $title.'/'.$aid.'/'.$type.'/'.$abstract.'/'.$content.'/'.$status.'/'.$newstime.'/'.$_SERVER['HTTP_REFERER'];
        die;*/


		if($status !=3){
			//添加水印
			$src_water="/assec/public/admin/images/6.png";
			$this->img_water_mark($img, $src_water, $savepath=null, $savename=null, $positon=3);
		}

		$getdata = $this->data_model;

		if(!$title||!$aid||!$type||!$abstract||!$content||!is_numeric($status)||!$newstime)showmsg($_SERVER['HTTP_REFERER'],'信息不能为空！');


		if($_FILES['slogo2']['name']){
			$img2 = ImageUpload($_FILES['slogo2'],'a/'.date('ymd'));
		}else{
			$img2 = $_POST['sslogo2'];
		}

		$data = array(
			'title' => $title,
			'shorttitle' => $shorttitle,
			'typeid' => $type,
			'source' => $source,
			'tag' => $tag,
			'img' => $img,
			'img2' => $img2,
			'abstract' => $abstract,
			'article'=>$article,
			'addtime' => '20'.date('y-m-d H:i'),
			'newstime' => $newstime,
			'author' => $aid,
			'status' => $status
		);

		if($id){

			$data2 = array(
				'content' => $content,
				'local_time'=>$local_time,
			);

			$msg1 = $getdata->update_new($data,$id);
			$msg2 = $getdata->update_newcontent($data2,$id);

			if($msg1&&$msg2){
				if($tag){
					$tagarr =check_strarr($tag);
					foreach($tagarr as $val){
						if($getdata->check_tag($val)){
							$getdata->insert_newtag(array('tagname'=>$val));
						}
					}
				}
				showmsg($_SERVER['HTTP_REFERER'],'修改成功！');
			}else{
				showmsg($_SERVER['HTTP_REFERER'],'修改失败！请联系管理员');
			}

		}else{

			$msg1 = $getdata->insert_new($data);

			if(!is_numeric($msg1))showmsg($_SERVER['HTTP_REFERER'],'新闻添加失败！请联系管理员');

			$data2 = array(
				'id' => $msg1,
				'content' => $content,
				'local_time'=>$local_time,
			);
			$msg2 = $getdata->insert_newcontent($data2);
			if($msg2){
				if($tag){
					$tagarr =check_strarr($tag);
					foreach($tagarr as $val){
						if($getdata->check_tag($val)){
							$getdata->insert_newtag(array('tagname'=>$val));
						}
					}
				}
				
				showmsg($_SERVER['HTTP_REFERER'],'添加成功！');	
			}else{
				showmsg($_SERVER['HTTP_REFERER'],'新闻内容添加失败！');
			}
		}
	}

	//图片加水印
	function img_water_mark($srcImg, $waterImg, $savepath=null, $savename=null, $positon=5)
{
    $temp = pathinfo($srcImg);
    $name = $temp['basename'];
    $path = $temp['dirname'];
    $exte = $temp['extension'];
    $savename = $savename ? $savename : $name;
    $savepath = $savepath ? $savepath : $path;
    $savefile = $_SERVER['DOCUMENT_ROOT'].$savepath .'/'. $savename;
    $srcinfo = @getimagesize($_SERVER['DOCUMENT_ROOT'].$srcImg);
    if (!$srcinfo) {
        return -1; //原文件不存在
    }
    $waterinfo = @getimagesize($_SERVER['DOCUMENT_ROOT'].$waterImg);
    if (!$waterinfo) {
        return -2; //水印图片不存在
    }
    $srcImgObj = $this->image_create_from_ext($srcImg);
    if (!$srcImgObj) {
        return -3; //原文件图像对象建立失败
    }
    $waterImgObj = $this->image_create_from_ext($waterImg);
    if (!$waterImgObj) {
        return -4; //水印文件图像对象建立失败
    }
    switch ($positon) {
    //1顶部居左
    case 1: $x=$y=0; break;
    //2顶部居右
    case 2: $x = $srcinfo[0]-$waterinfo[0]; $y = 0; break;
    //3居中
    case 3: $x = ($srcinfo[0]-$waterinfo[0])/2; $y = ($srcinfo[1]-$waterinfo[1])/2; break;
    //4底部居左
    case 4: $x = 0; $y = $srcinfo[1]-$waterinfo[1]; break;
    //5底部居右
    case 5: $x = $srcinfo[0]-$waterinfo[0]; $y = $srcinfo[1]-$waterinfo[1]; break;
    default: $x=$y=0;
    }

    // imagecopymerge($srcImgObj, $waterImgObj, $x, $y, 0, 0, $waterinfo[0], $waterinfo[1], $alpha);
    imagecopy($srcImgObj, $waterImgObj, $x, $y, 0, 0, $waterinfo[0], $waterinfo[1]);
    switch ($srcinfo[2]) {
    case 1: imagegif($srcImgObj, $savefile); break;
    case 2: @imagejpeg($srcImgObj, $savefile); break;
    case 3: imagepng($srcImgObj, $savefile); break;
    default: return -5; //保存失败
    }
    imagedestroy($srcImgObj);
    imagedestroy($waterImgObj);
    return $savefile;
}

function image_create_from_ext($imgfile)
{
    $info = getimagesize($_SERVER['DOCUMENT_ROOT'].$imgfile);
    $im = null;
    switch ($info[2]) {
    case 1: $im=imagecreatefromgif($_SERVER['DOCUMENT_ROOT'].$imgfile); break;
    case 2: $im=imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].$imgfile); break;
    case 3: $im=imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].$imgfile); break;
    }
    return $im;
}

	//添加图片
	public function addimg(){

		$id = $_POST['id'];
		$title = $_POST['title'];
		$status = $_POST['status']?$_POST['status']:0;
		$url = $_POST['url'];
		$img = $_POST['sslogo'];

		$getdata = $this->data_model;

		if(!$title||!count($url)>0||!is_numeric($status))showmsg($_SERVER['HTTP_REFERER'],'信息不能为空！');


		$data = array(
			'title' => $title,
			'img' => $img,
			'addtime' => '20'.date('y-m-d H:i'),
			'author' => $_SESSION['adminid'],
			'status' => $status
		);

		if($id){

			$data2 = array(
				'content' => json_encode($url)
			);

			$msg1 = $getdata->update_img($data,$id);
			$msg2 = $getdata->update_imgcontent($data2,$id);

			if($msg1&&$msg2){
				showmsg($_SERVER['HTTP_REFERER'],'修改成功！');
			}else{
				showmsg($_SERVER['HTTP_REFERER'],'修改失败！请联系管理员');
			}

		}else{
			$msg1 = $getdata->insert_img($data);

			if(!is_numeric($msg1))showmsg($_SERVER['HTTP_REFERER'],'图集添加失败！请联系管理员');

			$data2 = array(
				'id' => $msg1,
				'content' => json_encode($url)
			);
			$msg2 = $getdata->insert_imgcontent($data2);
			if($msg2){
				showmsg($_SERVER['HTTP_REFERER'],'添加成功！');
			}else{
				showmsg($_SERVER['HTTP_REFERER'],'图集内容添加失败！');
			}
		}
	}


	//首页轮播-删除新闻
	public function deletenews(){
		$id = $_GET['id'];

		$getdata = $this->data_model;

		if(!$id)showmsg($_SERVER['HTTP_REFERER'],'缺少参数！');

		$data = $getdata->del_index('tx_news','id = '.$id);
		if($data){
			$data = $getdata->del_index('tx_news_content','listid = '.$id);
			if($data){
				showmsg($_SERVER['HTTP_REFERER'],'删除成功！');
			}else{
				showmsg($_SERVER['HTTP_REFERER'],'删除新闻内容失败！');
			}

		}else{
			showmsg($_SERVER['HTTP_REFERER'],'删除新闻失败！');
		}

	}

	public function columninfo(){

		$id = $_GET['id'];

		if(!$id){echo 1;exit();}
		$getdata = $this->data_model;

		echo json_encode($getdata->get_newtype($id));
		exit();

	}

	public function adinfo(){

		$id = $_GET['id'];

		if(!$id){echo 1;exit();}
		$getdata = $this->data_model;

		echo json_encode($getdata->get_ad($id));
		exit();

	}
	
	//修改栏目和添加栏目
	public function type(){

		$id = $_POST['id'];
		$name = $_POST['name'];
		$sort = $_POST['sort'];
		$key = $_POST['key'];
		$info = $_POST['info'];
		$status = $_POST['status'];

		$getdata = $this->data_model;

		if(!$name||!is_numeric($sort)||!is_numeric($status)||!$key||!$info)showmsg($_SERVER['HTTP_REFERER'],'信息不能为空！');


		$data = array(
			'name' => $name,
			'sort' => $sort,
			'key' => $key,
			'info' => $info,
			'status' => $status,
		);

		if($id){

			$re = $getdata->update_newtype($data,$id);

			if($re){
				showmsg($_SERVER['HTTP_REFERER'],'更新成功！');
			}else{
				showmsg($_SERVER['HTTP_REFERER'],'更新失败！请联系管理员');
			}
		}else{

			$re = $getdata->insert_newtype($data);

			if(is_numeric($re)){
				showmsg($_SERVER['HTTP_REFERER'],'添加成功！');
			}else{
				showmsg($_SERVER['HTTP_REFERER'],'添加失败！请联系管理员');
			}
		}

	}


	
	//修改广告
	public function ad(){

		$id = $_POST['id'];
		$url = $_POST['url'];
		

		$getdata = $this->data_model;

		if(!$url||!is_numeric($id))showmsg($_SERVER['HTTP_REFERER'],'信息不能为空！');


		if($_FILES['slogo']['name']){
			echo 1;
			$img = ImageUpload($_FILES['slogo'],'ad',$id);
		}else{
			echo 2;
			$img = $_POST['sslogo'];
		}
		
		if(!$img)showmsg($_SERVER['HTTP_REFERER'],'广告图片不能为空！');
		
		$data = array(
			'url' => $url,
			'img' => $img,
		);


		$info = $getdata->update_ad($data,$id);

		if($info){
			showmsg($_SERVER['HTTP_REFERER'],'更新成功！');
		}else{
			showmsg($_SERVER['HTTP_REFERER'],'更新失败！请联系管理员');
		}

	}

	public function del(){

		$id = $_GET['id'];
		$type = $_GET['type'];

		if($id){

			if($type == 'img'){

				$data = $this->data_model->del_index('tx_img','id = '.$id);

				if($data){
					$this->data_model->del_index('tx_img_content','id = '.$id);
					showmsg($_SERVER['HTTP_REFERER'],'删除成功');
				}else{
					showmsg($_SERVER['HTTP_REFERER'],'删除失败');
				}
			}else if($type == 'new'){
				$data = $this->data_model->del_index('tx_news','id = '.$id);

				if($data){
					$this->data_model->del_index('tx_news_content','id = '.$id);
					showmsg($_SERVER['HTTP_REFERER'],'删除成功');
				}else{
					showmsg($_SERVER['HTTP_REFERER'],'删除失败');
				}
			}else if($type=='column'){
				$data = $this->data_model->del_index('tx_news_type','id = '.$id);
				if($data){
					$re=$this->db->query("SELECT id FROM `tx_news` WHERE `typeid`='{$id}'");
					$arr=$re->result_array();
					foreach($arr as $val){
						$this->data_model->del_index('tx_news_content','id='.$val['id']);
					}
					$this->data_model->del_index('tx_news','typeid = '.$id);
					showmsg($_SERVER['HTTP_REFERER'],'删除成功');
				}else{
					showmsg($_SERVER['HTTP_REFERER'],'删除失败');
				}
			}

		}else{
			showmsg($_SERVER['HTTP_REFERER'],'删除失败缺少固定id');
		}


	}
	
	public function uploadbase(){

		$base = $_POST['base'];

		if(!$base){
			echo 1;exit();
		}

		$a = Uploadbase($base,'a/'.date('ymd'));
		echo $a;
	}


	//获取文件时间 开始
	function BigEndian2Int($byte_word,$signed=false)
	{
		$int_value    =0;
		$byte_wordlen=strlen($byte_word);
		for($i=0;$i<$byte_wordlen;$i++){
			$int_value+=ord($byte_word{$i})*pow(256,($byte_wordlen-1-$i));
		}
		if($signed){
			$sign_mask_bit=0x80<<(8*($byte_wordlen-1));
			if($int_value&$sign_mask_bit){
				$int_value=0-($int_value&($sign_mask_bit-1));
			}
		}
		return$int_value;
	}

	function getTime($name)
	{
		if(!file_exists($name)){
			return false;
		}
		$flv_data_length=filesize($name);
		$fp              =@fopen($name,'rb');
		$flv_header      =fread($fp,5);
		fseek($fp,5,SEEK_SET);
		$frame_size_data_length  =$this->BigEndian2Int(fread($fp,4));
		$flv_header_frame_length=9;
		if($frame_size_data_length>$flv_header_frame_length){
			fseek($fp,$frame_size_data_length-$flv_header_frame_length,SEEK_CUR);
		}
		$duration=0;
		while((ftell($fp)+1)<$flv_data_length){
			$this_tag_header=fread($fp,16);
			$data_length     =$this->BigEndian2Int(substr($this_tag_header,5,3));
			$timestamp       =$this->BigEndian2Int(substr($this_tag_header,8,3));
			$next_offset     =ftell($fp)-1+$data_length;
			if($timestamp>$duration){
				$duration=$timestamp;
			}
			fseek($fp,$next_offset,SEEK_SET);
		}
		fclose($fp);
		return$duration;
	}



	function get_flv_file_time($time)
	{
		$time=$this->getTime($time);
		$num=$time;
		$sec=intval($num/1000);
		$h   =intval($sec/3600);
		$m   =intval(($sec%3600)/60);
		$s   =intval(($sec%60));
		$tm  =$h.':'.$m.':'.$s;
		return $tm;
	}

	//----------结束

	//上传视频
	public function video(){

		$file = $_FILES['files'];
		//formData传过来的参数param1和param2
		$param1 = $_POST['param1'];
		$param2 = $_POST['param2'];
		//ajax返回数组
		$data = array('sta'=>TRUE,'msg'=>'上传成功！');

		//检查是否为视频
		$ext =$this->getExt($file['name']);

		$arrExt = array('flv','mp4'); //'3gp','rmvb','flv','wmv','avi','mkv','mp4','mp3','wav'
		if(!in_array($ext,$arrExt)) {
			$data['sta'] = FALSE;
			$data['msg'] = '不支持此类型文件的上传！';
		}
		//设置预览目录
		$previewPath = "upload/a/".date('ymd',time()).'video/';
		$this->creatDir($previewPath);

		if($file['error'] == 0) {
			if(isset($param1) && isset($param2)) {
				//需要用到$param1和$param2的一些其他操作...

				//文件上传到预览目录
				$previewName = 'pre_'.md5(mt_rand(1000,9999)).time().'.'.$ext;
				$previewSrc = $previewPath.$previewName;
				if(!move_uploaded_file($file['tmp_name'],$previewSrc)) {
					$data['sta'] = FALSE;
					$data['msg'] = '上传失败！';
				} else {
					$data['previewSrc'] = $previewSrc;
					$data['local_time'] =$this->get_flv_file_time(PATH.$previewSrc);
				}

			}
		}
		echo json_encode($data);

	}

    //创建目录并赋权限
    function creatDir($path) {
        $arr = explode('/',$path);
        $dirAll = '';
        $result = FALSE;
        if(count($arr) > 0) {
            foreach($arr as $key=>$value) {
                $tmp = trim($value);
                if($tmp != '') {
                    $dirAll .= $tmp.'/';
                    if(!file_exists($dirAll)) {
                        mkdir($dirAll,0777,true);
                    }
                }
            }
        }
    }

    //获取文件扩展名
    function getExt($filename) {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        return $ext;
    }

   //友情链接
	public function f_link(){
		$id = $_POST['id'];
		$title = $_POST['title'];
		$sort = $_POST['sort'];
		$link = $_POST['link'];

		if(!$title||!is_numeric($sort)||!$link)showmsg($_SERVER['HTTP_REFERER'],'信息不能为空！');

		$data=array('title'=>$title,'sort'=>$sort,'link'=>$link);
		if($id){
			$getdata=$this->data_model;
			$re=$getdata->update_f_link($data,$id);
			if($re){
				showmsg($_SERVER['HTTP_REFERER'],'修改成功！');
			}else{
				showmsg($_SERVER['HTTP_REFERER'],'修改失败！请联系管理员！');
			}
		}else{
			$getdata=$this->data_model;
			$re=$getdata->insert_f_link($data);
			if($re){
				showmsg($_SERVER['HTTP_REFERER'],'添加成功！');
			}else{
				showmsg($_SERVER['HTTP_REFERER'],'添加失败！请联系管理员！');
			}
		}
	}
	public function f_linkinfo(){
		$id=$_GET['id'];
		if(!$id){echo 1;exit();}
		$getdata=$this->data_model;
		echo json_encode($getdata->get_f_linkinfo($id));
		exit();
	}
}
