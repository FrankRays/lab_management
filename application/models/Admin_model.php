<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	*	Here's the Install controller which is responsible for
	*	installation.
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@category user
	*	@copyright (c) 2015, Nishchal Gautam
	*	@since 0.1
	*	@version 0.1
	*
	*/

// check if it's a direct script access
class Admin_model extends CI_Model {
	/**
	*	Here's the Install controller which is responsible for
	*	installation.
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@category user
	*	@copyright (c) 2015, Nishchal Gautam
	*	@param string $email Email to check
	*	@return boolean FALSE if the email is not registered and ID of user if email is registered
	*	@since 0.1
	*	@version 0.1
	*
	*/


	/**
	*	setting cookie time to past to destroy cookie.
	*/
	public function admin_settings()
	{
		$this->load->model('user');
		$user_info=$this->user->get_current_user_info();
		$department=$user_info['department'];
		$this->load->model('utility');
		$data['classes']=$this->utility->get_classes($department);
		$data['class_less']=$data['classes'];
		array_splice($data['class_less'], 4);
		$data['count_classes']=count($data['classes']);
		$data['count_badge']=count($data['classes'])-count($data['class_less']);

		$data['faculties_list_full']=$this->utility->get_class_admins($department);
		$data['faculties_less']=$data['faculties_list_full'];
		array_splice($data['faculties_less'], 4);
		$data['count_faculties']=count($data['faculties_list_full']);
		$data['count_faculties_badge']=$data['count_faculties']-count($data['faculties_less']);
		return $data;
	}
	public function index()
	{
		$data['number_of_departments']=$this->db->count_all('departments');
		$this->load->model('account');
		$admins=$this->account->get_all_user_type(ADMIN);
		$data['number_of_admins']=count($admins);
		return $data;
	}
}