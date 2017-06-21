<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	header('Content-type:text/html;charset=utf-8');
	class Search extends Base_Controller{
		public function index(){

			$keyword = $_GET['keyword'];
			$page = $_GET['page']?$_GET['page']:1;

			if(strlen($keyword)<1){
				showmsg($_SERVER['HTTP_REFERER'],'字符数不能小于2个字符');
			}

			$news=$this->data_model->get_search($keyword,$page,'search');

			foreach($news['data'] as $key=>$val){
				$news['data'][$key]['title'] = str_replace($keyword,'<span style="color:red;font-weight:900;">'.$keyword.'</span>',$val['title']);
			}

			$fenye = sfenye($page,10,$news['num'],$this->data['url_dir'].'/search/index?keyword='.$keyword);

			$this->data['keyword'] = $keyword;
			$this->data['news'] = $news['data'];
			$this->data['fenye'] = $fenye;

			$this->loadview('list',$this->data);
		}

		public function tag(){

			$keyword = $_GET['keyword'];
			$page = $_GET['page']?$_GET['page']:1;

			$news=$this->data_model->get_search($keyword,$page,'tag');

			$fenye = sfenye($page,10,$news['num'],$this->data['url_dir'].'/search/tag?keyword='.$keyword);

			$this->data['news'] = $news['data'];
			$this->data['fenye'] = $fenye;

			$this->loadview('list',$this->data);
		}
	}
 ?>