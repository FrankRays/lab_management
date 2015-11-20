<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*	dashboard for faculty.
*
*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
*	@access public
*	@category TEACHER
*	@copyright (c) 2015, Nishchal Gautam
*	@since 0.1
*	@version 0.1
*
*/

class Dashboard extends CI_Controller {

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
		$data['role_url']="dashboard";
		return $data;
	}
	public function index()
	{
		$this->load->model('user');
		if($this->user->check_permission(TEACHER)){
			$data=$this->get_nav_items('index');
			$data=array_merge($this->user->get_current_user_info(),$data);
			$this->load->library('parser');
			$data['Title']="Dashboard | Faculty";
			$this->parser->parse('templates/header',$data);
			$this->load->model('teacher_model');
			$data=array_merge($this->teacher_model->index(),$data);
			$data['side_navbar']=$this->parser->parse('templates/side_navbar',$data,TRUE);
			$data['page_footer']=$this->parser->parse('templates/page_footer',[],TRUE);
			$data['top_navbar']=$this->parser->parse('templates/top_navbar',$data,TRUE);
			$data['sidebar_panel']=$this->parser->parse('templates/sidebar_panel',$data,TRUE);
			$this->parser->parse('class_admin_dashboard',$data);
			$this->parser->parse('templates/footer',$data);
		}else{
			header('Location:/login?error=login_required&redirect_url='.$_SERVER['REQUEST_URI']);
		}
	}

	public function infographics()
	{
		$this->load->model('user');
		if($this->user->check_permission(TEACHER)){
			$data=$this->user->get_current_user_info();
			$data=$this->get_nav_items('infographics');
			$data=array_merge($this->user->get_current_user_info(),$data);
			$this->load->library('parser');
			$data['Title']="Infographics | Faculty";
			$this->parser->parse('templates/header',$data);
			$data['side_navbar']=$this->parser->parse('templates/side_navbar',$data,TRUE);
			$data['page_footer']=$this->parser->parse('templates/page_footer',[],TRUE);
			$data['top_navbar']=$this->parser->parse('templates/top_navbar',$data,TRUE);
			$data['sidebar_panel']=$this->parser->parse('templates/sidebar_panel',$data,TRUE);
			$this->parser->parse('class_admin_infographics',$data);
			$this->parser->parse('templates/footer',$data);
		}else{
			header("Location:/login?error=login_required&redirect_url=".$_SERVER['REQUEST_URI']);
		}
	}

	public function settings()
	{
		$this->load->model('user');
		if($this->user->check_permission(TEACHER)){
			$this->load->library('parser');
			$data['Title']="Settings | Faculty";
			$data=array_merge($this->get_nav_items('settings'),$data);
			$data=array_merge($this->user->get_current_user_info(),$data);
			$this->load->model('teacher_model');
			$data=array_merge($this->teacher_model->settings(),$data);
			$this->parser->parse('templates/header',$data);
			$data['side_navbar']=$this->parser->parse('templates/side_navbar',$data,TRUE);
			$data['page_footer']=$this->parser->parse('templates/page_footer',[],TRUE);
			$data['top_navbar']=$this->parser->parse('templates/top_navbar',$data,TRUE);
			$data['sidebar_panel']=$this->parser->parse('templates/sidebar_panel',$data,TRUE);
			$this->parser->parse('class_admin_settings',$data);
			$this->parser->parse('templates/footer',$data);
		}else{
			header("Location:/login?error=login_required&redirect_url=".$_SERVER['REQUEST_URI']);
		}
	}

	public function mark($class_id="",$subject_id="")
	{
		if($class_id=="" || $subject_id==""){
			show_404();
			die();
		}
		$this->load->model('user');
		if($this->user->check_permission(TEACHER)){
			$this->load->library('parser');
			$data['Title']="Settings | Faculty";
			$data=array_merge($this->get_nav_items('index'),$data);
			$user_info=$this->user->get_current_user_info();
			$data=array_merge($data,$user_info);
			$data['url']="/dashboard/mark/{$class_id}/{$subject_id}/";
			$this->parser->parse('templates/header',$data);
			$this->load->model('utility');
			if($this->utility->check_user_class_allocation($data['id'],$class_id)){
				if($_POST){
					echo json_encode($this->utility->mark_attendance($class_id,$subject_id));
					die();
				}else{
					$data['list_students']=$this->utility->get_present_class_students($class_id);
					if($data['list_students']==FALSE){
						$data['list_students']=[];
						$data['list_students_message']="No students are under this class";
					}else{
						$data['list_students_message']="";
					}
					$data['side_navbar']=$this->parser->parse('templates/side_navbar',$data,TRUE);
					$data['page_footer']=$this->parser->parse('templates/page_footer',[],TRUE);
					$data['top_navbar']=$this->parser->parse('templates/top_navbar',$data,TRUE);
					$data['sidebar_panel']=$this->parser->parse('templates/sidebar_panel',$data,TRUE);
					$this->parser->parse('dashboard_mark_class',$data);
					$this->parser->parse('templates/footer',$data);
				}
			}else{
				die("You are not allocated in this class");
			}
		}else{
			header("Location:/login?error=login_required&redirect_url=".$_SERVER['REQUEST_URI']);
		}
	}
	public function assign_faculty()
	{
		if(!isset($_POST['faculty_email'],$_POST['subject'])){
			show_404();
			die();
		}
		$email=$_POST['faculty_email'];
		$subject=$_POST['subject'];
		if($email=="" || $subject == ""){
			$data['status']="Error";
			$data['message']="Please enter required fields";
		}else{
			$this->load->model('utility');
			if($room_info=$this->utility->get_room_of_current_user()){
				$data=$this->utility->assign_faculty($email,$room_info['id'],$subject);
			}else{
				$data['status']="Success";
				$data['message']="You aren't admin of any classes.";
			}
		}
		echo json_encode($data);
	}
	public function add_subject()
	{
		$subject_code=$_POST['subject_code'];
		$subject_name=$_POST['subject_name'];
		$this->load->model('utility');
		$data=$this->utility->add_subject($subject_code,$subject_name);
		echo json_encode($data);
	}
	public function create_students()
	{
		$info=$_POST['student_data'];
		$this->load->model('teacher_model');
		$data=$this->teacher_model->create_students($info);
		echo json_encode($data);
	}
}
