<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	header('Content-type:text/html;charset=utf-8');
	class Home extends Base_Controller{
		public function index(){

			$this->load->database();

			$getdata = $this->data_model;

			$adv = $getdata->get_allnews('where status = 3 order by id desc limit 3');
			//原先typeid=1
			//$csxw = $getdata->get_allnews('where status != 0 and typeid = 1 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(addtime) order by click desc limit 10 ');
			$csxw = $getdata->get_allnews('where status != 0 and typeid = 2 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(addtime) order by click desc limit 10 ');
			$cjzt = $getdata->get_allnews('where status = 2 order by id desc  limit 4');
			$ycrj = $getdata->get_allnews('where status != 0 and typeid = 8 ORDER BY RAND() limit 9');
			$cpmn = $getdata->get_allimg();
			


			$this->data['adv'] = $adv;
			$this->data['csxw'] = $csxw;//欢乐精选
			$this->data['cjzt'] = $cjzt;
			$this->data['ycrj'] = $ycrj;
			$this->data['cpmn'] = $cpmn;  //美女福利
			
			$this->loadview('home',$this->data);
		}
	}
 ?>