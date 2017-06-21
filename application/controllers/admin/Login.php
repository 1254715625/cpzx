<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends AD_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$this->loadview('admin/login.php',$this->data);
	}

	public function userlogin()
	{
		session_start();
		$code = $_POST['code'];
		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = $this->db->query( "select count(*) as dd from tx_admin where username = '".$username."'");
		$num = $query->result_array()[0];

		if(!$username || !$password)showmsg($this->data['url_dir'].'/admin/login','用户名和密码不能为空！');
		if(!$code)showmsg($this->data['url_dir'].'/admin/login','验证码不能为空！');
		if($num['dd'] ==0)showmsg($this->data['url_dir'].'/admin/login','用户名不存在！');
		if($code!=$_SESSION['logincode'])showmsg($this->data['url_dir'].'/admin/login','验证码不正确！');

		$query = $this->db->query("select * from tx_admin where password = '".md5($password)."'  and username = '".$username."'");
		$countnum = $query->result_array()[0];

		if($countnum==0)showmsg($this->data['url_dir'].'/admin/login','用户密码错误！');  //用户密码错误

		$_SESSION['adminid'] = $countnum['id'];
		$_SESSION['adminname'] = $username;
		$_SESSION['adminlogintime'] = time();

		header('Location:'.$this->data['url_dir'].'/admin');
	}

	public function userquit()
	{
		$_SESSION['adminid'] = '';
		$_SESSION['adminname'] = '';
		$_SESSION['adminlogintime'] = '';

		showmsg($this->data['url_dir'].'/admin/login','退出成功！');  //用户密码错误

	}

}
