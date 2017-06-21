<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Base_Controller  extends CI_Controller{


    public function __construct()
    {
        parent::__construct();

        //session_start();
        $this->load->database();
        $this->load->helper('function');
        $this->load->model('data_model');
        $this->load->helper('url');
        $this->data['public_dir'] = $this->config->item('public_dir');
        $this->data['url_dir'] = $this->config->item('url_dir');

        $getdata = $this->data_model;

        $type = $getdata->get_type();
        $tag = $getdata->get_newtag();
        $webinfo = $getdata->get_webinfo();
		$ad = $getdata->get_ad();
        $f_link=$getdata->get_f_link_all();

        $rightnewinfo = $getdata->get_allnews('where status != 0 order by newstime desc limit 10');
        $day = $getdata->get_allnews('where status != 0 and to_days(addtime) = to_days(now()) limit 6');
        $week = $getdata->get_allnews('where status != 0 and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(addtime) limit 6');
        $incd = $getdata->get_allnews('where status != 0 and typeid = 9 ORDER BY RAND() limit 6');


        foreach($webinfo as $val){
            $webarr[$val['name']] = $val['content'];
        }

        $this->data['type'] = $type;
        $this->data['day'] = $day;
        $this->data['week'] = $week;
        $this->data['tag'] = $tag;
        $this->data['incd'] = $incd;
        $this->data['webinfo'] = $webarr;
        $this->data['rightnewinfo'] = $rightnewinfo;
		$this->data['ad'] = $ad;
        $this->data['f_link']=$f_link;
        

    }

    public function loadview($url,$data){
        $this->load->view('head.php',$data);
        $this->load->view($url,$data);
        $this->load->view('foot.php',$data);
    }
}

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('function');
        $this->load->model('data_model');
        $this->load->helper('url');
        $this->data['public_dir'] = $this->config->item('public_dir');
        $this->data['url_dir'] = $this->config->item('url_dir');

        $getdata = $this->data_model;

        $type = $getdata->get_type();
        $tag = $getdata->get_newtag();
        $webinfo = $getdata->get_webinfo();
		$ad = $getdata->get_ad();
        
        foreach($webinfo as $val){
            $webarr[$val['name']] = $val['content'];
        }

        $this->data['type'] = $type;
        $this->data['tag'] = $tag;
        $this->data['webinfo'] = $webarr;
		$this->data['ad'] = $ad;

    }

    public function loadview($url,$data){
        $this->load->view('head.php',$data);
        $this->load->view($url,$data);
        $this->load->view('foot.php',$data);
    }
}


class AD_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('function');
        $this->data['public_dir'] = $this->config->item('public_dir');
        $this->data['url_dir'] = $this->config->item('url_dir');

    }

    public function loadview($url,$data){
        $this->load->view('admin/head.php',$data);
        $this->load->view($url,$data);
        $this->load->view('admin/foot.php',$data);
    }
}

class Admin_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        session_start();
        $this->load->database();
        $this->load->helper('function');
        $this->load->model('data_model');
        $this->data['public_dir'] = $this->config->item('public_dir');
        $this->data['url_dir'] = $this->config->item('url_dir');

        if(time() - $_SESSION['adminlogintime']>2*3600){
            $_SESSION['adminname'] = '';
        }

        if(!$_SESSION['adminname']){
            if(!$_SESSION['adminlogintime']){
                header('Location:/admin/login');
            }else{
                showmsg('/admin/login','请重新登录');
            }
        }

    }

    public function loadview($url,$data){
        $this->load->view('admin/head.php',$data);
        $this->load->view($url,$data);
        $this->load->view('admin/foot.php',$data);
    }
}



