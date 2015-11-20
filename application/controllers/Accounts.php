<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// check if it's a direct script access
class Accounts extends CI_Controller {
	/**
	*	accouonts controller handles the routes for accounts related requests
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@category accounts
	*	@copyright (c) 2015, Nishchal Gautam
	*	@since 0.1
	*	@todo Create a default view for accounts page
	*	@version 0.1
	*
	*/

	public function index()
	{
		$this->load->model('user');
		if($this->user->check_permission(ADMIN) OR $this->user->check_permission(TEACHER) OR $this->user->check_permission(STUDENT) OR $this->user->check_permission(ROOT) OR $this->user->check_permission(SUPER_ADMIN) OR $this->user->check_permission(PARENTS)){
			$this->load->library('parser');
			$data['Title']="";
			$data=array_merge($data,$this->get_nav_items('index'));
			$data=array_merge($this->user->get_current_user_info(),$data);
			$data['Title']="Welcome | {$data['name']}";
			$this->parser->parse('templates/header', $data);
			$data['side_navbar']=$this->parser->parse('templates/side_navbar',$data,TRUE);
			$data['page_footer']=$this->parser->parse('templates/page_footer',[],TRUE);
			$data['top_navbar']=$this->parser->parse('templates/top_navbar',$data,TRUE);
			$data['sidebar_panel']=$this->parser->parse('templates/sidebar_panel',$data,TRUE);
			$this->parser->parse('accounts',$data);
			$this->parser->parse('templates/footer',$data);

			$this->parser->parse('templates/footer',[]);
		}else{
			header('Location:/login?error=login_required&redirect_url='.$_SERVER['REQUEST_URI']);
		}
	}
	/**
	*	Here's the account model which is responsible for
	*	doing account related operations
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@category accounts
	*	@copyright (c) 2015, Nishchal Gautam
	*	@param string $user_id user id of user sent
	*	@param string $token token of the user.
	*	@since 0.1
	*	@version 0.1
	*
	*/

	public function verify($user_id='',$token='')
	{

		//load the account model for verification

		$this->load->model('account');

		//pass user id an token which we have from get parameter
		//we need not use $_GET because CI rewrites slash URLs into function parameters

		if($this->account->verify($user_id,$token)){
			header("Location:/login");
		}else{
			echo "Token mismatched!";
		}
	}
	private function get_nav_items($item)
	{
		$data['index']="";
		$data['settings']="";
		$data['infographics']="";
		$data[$item]=" class='active' ";
		$data['role_url']="admin";
		return $data;
	}
}
