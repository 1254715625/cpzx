<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	header('Content-type:text/html;charset=utf-8');
	class Pic extends MY_Controller{
		public function index(){
			error_reporting(E_ERROR);
			$id=$this->uri->segment(3);

			$getdata = $this->data_model;

			$info = $getdata->get_img($id);
			$content = $getdata->get_imgcontent($id);
			$prenext = $getdata->get_imgpn($id);

			$this->data['info'] = $info;
			$this->data['content'] = json_decode($content);
			$this->data['pre'] = $prenext['pre'];
			$this->data['next'] = $prenext['next'];

			$this->loadview('pic',$this->data);
		}
	}
 ?>