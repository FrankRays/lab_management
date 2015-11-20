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

class Install extends CI_Controller {

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


		//check if user is already created, if it's not created, create user,
		//if it's created, show a disabled page

		$this->load->model('user');
		if($this->user->check_to_install()){
			// load installer model and populate the database with table structures

			$this->load->model('installer');
			$this->installer->populate_database();

			//display creation of super_admin form

			$data['Title']="Create Admin";
			$this->load->library('parser');
			$this->parser->parse('templates/header', $data);
			$this->parser->parse('create_superadmin',[]);
			$this->parser->parse('templates/footer',[]);
		}else{
			$data['Title']="Create Admin";
			$this->load->library('parser');
			$this->parser->parse('templates/header', $data);
			$this->parser->parse('create_superadmin_disabled',[]);
			$this->parser->parse('templates/footer',[]);
			
			// show_404();
			// or could show_404();

		}
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
}
