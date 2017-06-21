<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	header('Content-type:text/html;charset=utf-8');
	class News extends Base_Controller{
		public function index(){

			$id = $this->uri->segment(3);
			$page = $this->uri->segment(4)?$this->uri->segment(4):1;

			$news=$this->data_model->get_list($id,$page);
			$newtype = $this->data_model->get_newtype($id)[0];
			$fenye = qfenye($page,10,$news['num'],$this->data['url_dir'].'/news/index/'.$id);

			$name = $newtype['name'];
			$key = $newtype['key'];
			$info = $newtype['info'];

			$this->data['typeid'] = $id;
			$this->data['name'] = '-'.$name;
			$this->data['news'] = $news['data'];
			$this->data['fenye'] = $fenye;
			$this->data['web_key'] = $key;
			$this->data['web_info'] = $info;
			$this->loadview('list',$this->data);
		}

		public function content(){

			$id=$this->uri->segment(3);
			$getdata = $this->data_model;

			$typeid = $getdata->update_click($id);
			$data = $getdata->get_content($id);
			$prenext = $getdata->get_prenext($id,$typeid);
			$arr=$getdata->get_vote($id);

			$newtype = $this->data_model->get_newtype($typeid)[0];
			$key = $newtype['key'];
			$info = $newtype['info'];
			$this->data['typeid'] = $typeid;
			$this->data['info'] = $data['info'];
			$this->data['content'] = $data['content'];
			$this->data['local_time'] = $data['local_time'];
			$this->data['info'] = $data['info'];
			$this->data['article'] = $data['article'];
            $this->data['pre'] = $prenext['pre'];
			$this->data['next'] = $prenext['next'];
			$this->data['web_key'] = $key;
			$this->data['web_info'] = $info;
			foreach($arr as $val){
				if($val['vote']==1){
					$vote[]=$val;
				}else if($val['dvote']==0){
					$dvote[]=$val;
				}

			}
			$vnum=count($vote);
			$dnum=count($dvote);
			$this->data['vnum']=$vnum;
			$this->data['dnum']=$dnum;
			$this->loadview('listdetails',$this->data);
		}

		public function vote(){
			$id=$_GET['id'];
			$ip=getIP();
			$getdata=$this->data_model;
			$data=$getdata->get_vote_ip($id,$ip);
			$msg="";
			if(empty($data['ip']) || !$data['ip']){
				$data=array('nid'=>$id,'vote'=>1,'ip'=>$ip);
				$re=$getdata->insert_vote($data);
				$msg.="点赞成功";
			}else{
				$msg.="一个ip只能操作一次";
			}
			echo $msg;
		}

		public function dvote(){
			$id=$_GET['id'];
			$ip=getIP();
			$getdata=$this->data_model;
			$data=$getdata->get_vote_ip($id,$ip);
			$msg="";
			if(empty($data['ip']) || !$data['ip']){
				$data=array('nid'=>$id,'dvote'=>0,'ip'=>$ip);
				$re=$getdata->insert_vote($data);
				$msg.="踩成功";
			}else{
				$msg.="一个ip只能操作一次";
			}
			echo $msg;
		}

	}
 ?>