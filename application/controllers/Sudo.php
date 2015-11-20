<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*	dashboard for sudo user.
*
*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
*	@access public
*	@category sudo
*	@copyright (c) 2015, Nishchal Gautam
*	@since 0.1
*	@version 0.1
*
*/

class Sudo extends CI_Controller {

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
	private function get_nav_items($item)
	{
		$data['index']="";
		$data['settings']="";
		$data['infographics']="";
		$data[$item]=" class='active' ";
		$data['role_url']="sudo";
		return $data;
	}
	public function index()
	{
		$this->load->model('user');
		if($this->user->check_permission(SUPER_ADMIN)){
			$data=$this->get_nav_items('index');
			$data=array_merge($this->user->get_current_user_info(),$data);
			$this->load->library('parser');
			$data['Title']="Dashboard | Superadmin";
			$this->parser->parse('templates/header',$data);
			$this->load->model('sudo_model');
			$data=array_merge($this->sudo_model->index(),$data);
			$data['side_navbar']=$this->parser->parse('templates/side_navbar',$data,TRUE);
			$data['page_footer']=$this->parser->parse('templates/page_footer',[],TRUE);
			$data['top_navbar']=$this->parser->parse('templates/top_navbar',$data,TRUE);
			$data['sidebar_panel']=$this->parser->parse('templates/sidebar_panel',$data,TRUE);
			$this->parser->parse('sudo_dashboard',$data);
			$this->parser->parse('templates/footer',$data);
		}else{
			header("Location:/login?error=login_required&redirect_url=".$_SERVER['REQUEST_URI']);
		}
	}

	public function settings()
	{
		$this->load->model('user');
		if($this->user->check_permission(SUPER_ADMIN)){
			$this->load->model('sudo_model');
			$data=$this->sudo_model->settings();

			$this->load->library('parser');
			$data['Title']="Settings | Superadmin";
			$data=array_merge($this->get_nav_items('settings'),$data);
			$data=array_merge($this->user->get_current_user_info(),$data);
			$this->parser->parse('templates/header',$data);
			$data['side_navbar']=$this->parser->parse('templates/side_navbar',$data,TRUE);
			$data['page_footer']=$this->parser->parse('templates/page_footer',[],TRUE);
			$data['top_navbar']=$this->parser->parse('templates/top_navbar',$data,TRUE);
			$data['sidebar_panel']=$this->parser->parse('templates/sidebar_panel',$data,TRUE);
			$this->parser->parse('sudo_settings',$data);
			$this->parser->parse('templates/footer',$data);
		}else{
			header("Location:/login?error=login_required&redirect_url=".$_SERVER['REQUEST_URI']);
		}
	}
	public function create_group()
	{
		$this->load->model('user');
		if($this->user->check_permission(SUPER_ADMIN)){
			if(isset($_POST['group'])){
				if($this->user->check_group($_POST['group'])){
					$data['status']="Error";
					$data['message']="This group is already created";
				}else{
					$group=$_POST['group'];
					$data=$this->user->create_group($group);
				}
			}else{
				$data['status']="Error";
				$data['message']="There was error with form submission";
			}
			echo json_encode($data);
		}else{
			header('Location:/login?error=login_required&redirect_url='.$_SERVER['REQUEST_URI']);
		}
	}
	public function create_test()
	{
		$this->load->model('user');
		if($this->user->check_permission(SUPER_ADMIN)){
			if(isset($_POST['group'],$_POST['test_name'],$_POST['unit_measurement'],$_POST['default_value'])){
				$group=$_POST['group'];
				$test_name=$_POST['test_name'];
				$unit_measurement=$_POST['unit_measurement'];
				$default_value=$_POST['default_value'];
				$prefill_value=$_POST['prefill_value'];
				$input_field=$_POST['input_field'];
				$price=$_POST['price'];
				if($group == "" OR $test_name == ""){
					$data['status']="Error";
					$data['message']="Please enter both the fields";
				}else{
					$this->load->model('utility');
					if($this->utility->check_test($test_name,$group)){
						$data['status']="Error";
						$data['message']="That test already exists";
					}else{
						$this->load->model('account');
						$data=$this->utility->add_test($group,$test_name,$unit_measurement,$default_value,$prefill_value,$input_field,$price);
					}
				}
			}else{
				$data['status']="Error";
				$data['message']="Please enter all fields";
			}
			
		}else{
			$data['status']="Error";
			$data['message']="Please enter all fields";
		}
		echo json_encode($data);
	}
	public function list_tests()
	{
		$this->load->model('user');
		if($this->user->check_permission(SUPER_ADMIN)){
			$group=$_GET['group'];
			$this->load->model('sudo_model');
			$data['status']="Success";
			$data['lists']=$this->sudo_model->list_tests($group);
		}else{
			$data['status']="Error";
			$data['message']="Please enter all fields";
		}
			echo json_encode($data);
	}
	public function next()
	{
		$this->load->model('sudo_model');
		$data=$this->sudo_model->create_test($_POST);
		echo json_encode($data);
	}
	public function tests($id="")
	{
		$this->load->model('user');
		if($this->user->check_permission(SUPER_ADMIN)){
			$data=$this->get_nav_items('index');
			$data=array_merge($this->user->get_current_user_info(),$data);
			$this->load->library('parser');
			$data['Title']="Lab Number: $id";
			$data['lab_number']=$id;
			$this->parser->parse('templates/header',$data);
			$data['side_navbar']=$this->parser->parse('templates/side_navbar',$data,TRUE);
			$data['page_footer']=$this->parser->parse('templates/page_footer',[],TRUE);
			$data['top_navbar']=$this->parser->parse('templates/top_navbar',$data,TRUE);
			$data['sidebar_panel']=$this->parser->parse('templates/sidebar_panel',$data,TRUE);
			$this->load->model('sudo_model');
			$test_info=$this->sudo_model->get_report_info($id);
			// die(var_dump($test_info));
			if(!$test_info){
				show_404();
				die();
			}else{
				$data=array_merge($test_info,$data);
			}
			
			$this->parser->parse('sudo_report',$data);
			$this->parser->parse('templates/footer',$data);
		}else{
			header("Location:/login?error=login_required&redirect_url=".$_SERVER['REQUEST_URI']);
		}
	}
	public function infographics()
	{
		$this->load->model('user');
		if($this->user->check_permission(SUPER_ADMIN)){
			$data=$this->get_nav_items('infographics');
			$data=array_merge($this->user->get_current_user_info(),$data);
			$this->load->library('parser');
			$data['Title']="Lists";
			$this->parser->parse('templates/header',$data);
			$data['side_navbar']=$this->parser->parse('templates/side_navbar',$data,TRUE);
			$data['page_footer']=$this->parser->parse('templates/page_footer',[],TRUE);
			$data['top_navbar']=$this->parser->parse('templates/top_navbar',$data,TRUE);
			$data['sidebar_panel']=$this->parser->parse('templates/sidebar_panel',$data,TRUE);
			$this->load->model('sudo_model');
			$this->parser->parse('sudo_list',$data);
			$this->parser->parse('templates/footer',$data);
		}else{
			header("Location:/login?error=login_required&redirect_url=".$_SERVER['REQUEST_URI']);
		}
	}
	public function infographics_list_tests()
	{
		$this->load->model('user');
		if($this->user->check_permission(SUPER_ADMIN)){
			$this->load->model('sudo_model');
			$tests=$this->sudo_model->list_test($_POST['from'],$_POST['to'],$_POST['ref']);
			$dataset=$this->sudo_model->dataset($_POST['from'],$_POST['to'],$_POST['ref']);
			$html="<table class='table table-bordered'><tr><th>name</th><th>ref</th><th>date</th><th>price</th><th>View/Delete</th></tr>";
			foreach ($tests as $test) {
				$html.="<tr><td>{$test['name']}</td><td>{$test['ref']}</td><td>{$test['date_taken']}</td><td>{$test['price']}</td><td><a href='/sudo/tests/{$test['id']}'>View</a> / <a href='#' onclick='delete_test({$test['id']},this)'>Delete</a></td></tr>";
			}
			$data['status']="Success";
			$data['html']=$html;
			$data['dataset']=$dataset;
			echo json_encode($data);
		}else{
			$data['status']="Error";
			$data['message']="You are not logged in";
			echo json_encode($data);
		}
	}
	public function delete_test()
	{
		$this->load->model('user');
		if($this->user->check_permission(SUPER_ADMIN)){
			$this->load->model('sudo_model');
			$id=$_GET['id'];
			$data=$this->sudo_model->delete_test($id);
			echo json_encode($data);
		}else{
			$data['status']="Error";
			$data['message']="You are not logged in";
			echo json_encode($data);
		}
	}
}
