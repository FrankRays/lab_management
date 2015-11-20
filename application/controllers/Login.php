<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*	Here's the Install controller which is responsible for
*	installation.
*
*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
*	@access public
*	@category installation
*	@copyright (c) 2015, Nishchal Gautam
*	@since 0.1
*	@version 0.1
*
*/

class Login extends CI_Controller {

	/**
	*	Here's the index of Install controller populates database and displays
	*	form to create a superadmin
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@category installation
	*	@copyright (c) 2015, Nishchal Gautam
	*	@since 0.1
	*	@version 0.1
	*
	*/

	public function index()
	{
		$this->load->model('user');
		if(isset($_COOKIE['email'],$_COOKIE['token'])){
			$role=$this->user->check_cookie_auth($_COOKIE['email'],$_COOKIE['token']);
			if($role){
				header("Location:".$this->user->get_role_redirect_url($role['user_type']));
			}
		}
		$data['Title']="Login | ".APP_NAME;
		$this->load->library('parser');
		$this->parser->parse('templates/header', $data);
		unset($data);
		if(isset($_GET['redirect_url'])){
			$data['url']="?redirect_url=".$_GET['redirect_url'];
		}else{
			$data['url']="";
		}
		$this->parser->parse('login',$data);
		$this->parser->parse('templates/footer',[]);
	}
	/**
	*	Save the superadmin creation request
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@category installation
	*	@copyright (c) 2015, Nishchal Gautam
	*	@since 0.1
	*	@todo Probably should log the ip address and everything about user on the else part
	*	@version 0.1
	*
	*/
	public function save()
	{

		//check if user is already created, if it's not created, create user,
		//if it's created, show him a warning

		$this->load->model('user');
		if($this->user->check_to_install()){
			$this->load->model('installer');
			$data=$this->installer->save();
			echo json_encode($data);
		}else{
			//probably should log the ip address
			// $data['status']="error";
			// $data['message']="Super admin is already created, please login to that account, this page is disabled";
			// echo json_encode($data);
			show_404();
		}
	}
	public function check()
	{
		$this->load->model('user');
		$data=$this->user->check_password();
		echo json_encode($data);
	}
	public function logout()
	{
		$this->load->model('user');
		$this->user->logout();
		header("Location:/login");
	}
	public function verification()
	{
		$this->load->library('parser');
		$data['Title']="Settings | Superadmin";
		$this->parser->parse('templates/header',$data);
		$data['page_footer']=$this->parser->parse('templates/page_footer',[],TRUE);
		$this->parser->parse('resend_verification_email',$data);
		$this->parser->parse('templates/footer',$data);
	}
	public function forgot()
	{
		$this->load->library('parser');
		$data['Title']="Settings | Superadmin";
		$this->parser->parse('templates/header',$data);
		$data['page_footer']=$this->parser->parse('templates/page_footer',[],TRUE);
		$this->parser->parse('forgot_password',[]);
		$this->parser->parse('templates/footer',$data);
	}
	public function verification_send()
	{
		$email=$_POST['email'];
		$this->load->model('account');
		$data=$this->account->send_verification_email($email);
		echo json_encode($data);
	}
	public function forgot_send()
	{
		$email=$_POST['email'];
		$this->load->model('account');
		$data=$this->account->send_forgot_password($email);
		echo json_encode($data);
	}
	public function reset($user_id="",$token="")
	{
		if($user_id=="" || $token==""){
			show_404();
		}else{
			if(isset($_POST['repassword'],$_POST['password'])){
				if($_POST['repassword']!=$_POST['password']){
					$data['status']="Error";
					$data['message']="Password and Confirm password mismatch";
				}else{
					$password=$_POST['password'];
					//change actual password
					$this->load->model('account');
					if($this->account->check_token_password($user_id,$token)){
						$data=$this->account->set_password($user_id,$token,$password);
						$data['url']='/login';
					}else{
						$data['status']="Error";
						$data['message']="The link might have expired, please try again";
					}
				}
				echo json_encode($data);
			}else{
				$this->load->model('account');
				if($this->account->reset_password($user_id,$token)){
					$this->load->library('parser');

					$data['url']=$_SERVER['REQUEST_URI'];
					$data['Title']="Reset password";
					$this->parser->parse('templates/header',$data);
					$this->parser->parse('change_password',$data);
					$this->parser->parse('templates/footer',[]);
				}else{
					//To-Do instead of 404, display link expired
					show_404();
				}
			}
		}
	}

}
