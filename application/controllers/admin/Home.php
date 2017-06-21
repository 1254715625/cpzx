<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	//首页
	public function index()
	{
		$action = $_POST['action'];
		switch($action){
			case 'pass':
				$this->data['pageurl'] = $this->data['url_dir'].'/admin/home/pass';
				break;
			default:
				$this->data['pageurl'] = $this->data['url_dir'].'/admin/home/info';
		}
		$this->load->view('admin/home.php',$this->data);
	}

	//网站信息
	public function info(){

		$getdata = $this->data_model;

		$info = $getdata->get_webinfo();

		$this->data['info'] = $info;
		$this->loadview('admin/info.php',$this->data);
	}

	//新闻管理
	public function content_manage(){

		$typeid = $_GET['typeid'];
		$status = $_GET['status'];
		$date = $_GET['date'];
		$keywords = $_GET['keywords'];
		$page = $_GET['page']?$_GET['page']:1;

		$getdata = $this->data_model;

		$newsinfo = $getdata->get_newmanage($typeid,$status,$date,$keywords,$page);

		$url = $this->data['url_dir'].'/admin/home/content_manage?typeid='.$typeid.'&status='.$status.'&date='.$date.'&keywords='.$keywords;

		$fenye = fenye($page,10,$newsinfo['num'],$url);

		$this->data['fenye'] = $fenye;
		$this->data['typeid'] = $typeid;
		$this->data['status'] = $status;
		$this->data['date'] = $date;
		$this->data['newsinfo'] = $newsinfo['data'];
		$this->data['type'] = $getdata->get_newtype();
		$this->data['status'] = $getdata->get_newstatus();


		$this->loadview('admin/content_manage.php',$this->data);
	}

	//新闻添加
	public function addnew(){
		$id = $_GET['id'];

		$getdata = $this->data_model;

		if($id){
			$info = $getdata->get_new($id);

			//$content = $getdata->get_newcontent($id);
			$content = $getdata->get_video_content($id);

			$this->data['info'] = $info;
			$this->data['content'] = th($content);
		}

		$type = $getdata->get_newtype();
		$status = $getdata->get_newstatus();

		$arr=[];
		$arr[0]=$status[1];
		$arr[1]=$status[0];
		$arr[2]=$status[2];
		$arr[3]=$status[3];
		$arr[4]=$status[4];
		$status=$arr;
		
		$this->data['type'] = $type;
		$this->data['status'] = $status;

		$this->loadview('admin/addnew.php',$this->data);
	}

	//密码修改
	public function pass(){
		$this->loadview('admin/pass.php',$this->data);
	}

	//栏目管理
	public function column(){

		$getdata = $this->data_model;
		$type = $getdata->get_newtype();


		$this->data['type'] = $type;
		$this->loadview('admin/column.php',$this->data);
	}

	//首页轮播
	public function adv(){

		$getdata = $this->data_model;

		$listdata = $getdata->get_advnew();

		$this->data['listdata'] = $listdata;

		$this->loadview('admin/adv.php',$this->data);
	}

	//图集管理
	public function img_manage(){

		$status = $_GET['status'];
		$date = $_GET['date'];
		$keywords = $_GET['keywords'];
		$page = $_GET['page']?$_GET['page']:1;

		$getdata = $this->data_model;

		$imginfo = $getdata->get_imgmanage($status,$date,$keywords,$page);

		$url = $this->data['url_dir'].'/admin/home/content_manage?status='.$status.'&date='.$date.'&keywords='.$keywords;

		$fenye = fenye($page,10,$imginfo['num'],$url);

		$this->data['fenye'] = $fenye;
		$this->data['status'] = $status;
		$this->data['keywords'] = $keywords;
		$this->data['date'] = $date;
		$this->data['imginfo'] = $imginfo['data'];



		$this->loadview('admin/img_manage.php',$this->data);
	}

	//添加图集
	public function addimg(){

		$id = $_GET['id'];

		$getdata = $this->data_model;

		if($id){
			$info = $getdata->get_img($id);
			$content = $getdata->get_imgcontent($id);

			$this->data['info'] = $info;
			$this->data['content'] = json_decode($content);
		}

		$this->loadview('admin/addimg.php',$this->data);
	}

	//广告管理
	public function ad(){

		$getdata = $this->data_model;
		$ad = $getdata->get_ad();


		$this->data['ad'] = $ad;
		$this->loadview('admin/ad.php',$this->data);
	}

	//友情链接
	public function f_link(){
		$page = $_GET['page']?$_GET['page']:1;

		$getdata = $this->data_model;
		$f_link = $getdata->get_f_link($page);

		$url = $this->data['url_dir'].'/admin/home/f_link?';
		$fenye = fenye($page,6,$f_link['num'],$url);
		$this->data['fenye'] = $fenye;
		$this->data['f_link'] = $f_link['data'];
		$this->loadview('admin/f_link.php',$this->data);
	}
}


