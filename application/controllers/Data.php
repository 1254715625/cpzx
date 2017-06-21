<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	header('Content-type:text/html;charset=utf-8');
	class Data extends MY_Controller{
		public function cpzx(){

			$getdata = $this->data_model;

			$cpzx = $getdata->get_cpzx();

			echo json_encode($cpzx);
			exit();
		}

	}
 ?>