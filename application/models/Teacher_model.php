<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// check if it's a direct script access

	/**
	*	Here's the teacher model which is responsible for
	*	teacher related operations
	*
	*	@ author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@ access public
	*	@ category user
	*	@ copyright (c) 2015, Nishchal Gautam
	*	@ since 0.1
	*	@ version 0.1
	*
	*/

class Teacher_model extends CI_Model {
	/**
	*	Here's the Install controller which is responsible for
	*	installation.
	*
	*	@ author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@ access public
	*	@ category user
	*	@ copyright (c) 2015, Nishchal Gautam
	*	@ param string $email Email to check
	*	@ return boolean FALSE if the email is not registered and ID of user if email is registered
	*	@ since 0.1
	*	@ version 0.1
	*
	*/


	/**
	*	setting cookie time to past to destroy cookie.
	*/
	public function settings()
	{
		$this->load->model('user');
		$user_info=$this->user->get_current_user_info();
		$user_id=$user_info['id'];
		//get list of assigned departments for user_id
		$this->db->select('*,rooms.id as room_id')->from('room_admin_allocation')->join('rooms','rooms.id=room_admin_allocation.room')->where('admin',$user_id);
		$query=$this->db->get();
		$result=$query->result_array()[0];
		$data['class_name']=$result['name'];
		$room_id=$result['room_id'];
		$this->db->select()->from('room_subject_allocation')->join('subjects','room_subject_allocation.subject=subjects.id')->where('room',$room_id);
		$query=$this->db->get();
		$data['subject_list']=$query->result_array();
		$data['subject_list_count']=count($data['subject_list']);
		$subject_list_less=$data['subject_list'];
		array_splice($subject_list_less, 4);
		$data['count_subject_list_badge']=count($data['subject_list'])-count($subject_list_less);
		$data['subject_list_less']=$subject_list_less;
		$this->db->select('*,subject_name,users.name as user_name')->from('room_teacher_allocation')->join('subjects','subjects.id=room_teacher_allocation.subject')->join('users','room_teacher_allocation.teacher=users.id')->where('room',$room_id);
		$query=$this->db->get();
		$data['faculties_list']=$query->result_array();
		$faculties_list=$data['faculties_list'];
		$data['faculties_list_count']=count($data['faculties_list']);
		$data['faculties_list_less']=$faculties_list;
		array_splice($data['faculties_list_less'],4);
		$data['faculties_list_less_count']=$data['faculties_list_count']-count($data['faculties_list_less']);
		// die(var_dump($data['faculties_list']));
		return $data;
	}
	public function index()
	{
		$this->load->model('user');
		$user_info=$this->user->get_current_user_info();
		$department=$user_info['department'];
		$this->load->model('utility');
		// get list of classes where that user is assigned to.
		$user_id=$user_info['id'];

		$data['list_of_classes']=$this->utility->get_list_of_classes_for_faculty($user_id);
		return $data;
	}
	public function infographics()
	{
		return TRUE;
	}
	public function create_students($info)
	{
		$students=explode("\n", $info);
		$this->load->model('user');
		$current_user_info=$this->user->get_current_user_info();
		$emails=[];
		$usns=[];
		//check for validity of each and every students, create a insert batch, send a email to everyone one by one.
		//here, we have to check if a user already exists with that email.
		//now iterate through students, explode further, get USN,email,Phone Number, check for validity for each entity
		// if all data is valid, create an insert batch, then insert ALL AT ONCE (!important for performance) also keep track of which accounts were created so that we can send reset password link
		// send reset password link
		//also get the room for which current user is admin for. then assign all students to that room.
		$insert=[];
		foreach ($students as $student_info) {
			$student_info=chop($student_info);
			$student_info=explode(',', $student_info);
			$USN=$student_info[0];
			$email=$student_info[1];
			$parent_number=$student_info[2];
			$name=explode('@', $email);
			$name=$name[0];
			$st_info=array('email'=>$email,'phone_num_parents'=>$parent_number,'sn'=>$USN,'user_type'=>STUDENT,'department'=>$current_user_info['department'],'name'=>$name);
			$insert[]=$st_info;
			$emails[]=$email;
			$usns[]=$USN;
			if (filter_var($email, FILTER_VALIDATE_EMAIL)==FALSE) {
				$data['status']="Error";
				$data['message']="Email is invalid, first occurrence: ".$email;
				die(json_encode($data));
			}
			//check if it's valid.
		}
		//insert batch created on $insert
		$this->db->select('email')->from('users')->where_in('email',$emails);
		$query=$this->db->get();
		$this->db->select('sn')->from('users')->where_in('sn',$usns);
		$query1=$this->db->get();
		if($query->num_rows()!=0){
			$num_rows=$query->num_rows();
			$students=$query->result_array();
			//some of emails are already registered...
			$data['status']="Error";
			$data['message']="{$num_rows} email(s) already registered, first occurrence: {$students[0]['email']}";
		}elseif($query1->num_rows()!=0){
			$num_rows=$query1->num_rows();
			$students=$query1->result_array();
			$data['status']="Error";
			$data['message']="{$num_rows} USN(s) already registered, first occurrence: {$students[0]['sn']}";
		}else{
			//none of emails were used, and all emails are valid,
			//here, we create accounts and send email to everyone.
			$this->db->insert_batch('users',$insert);
			$number_of_emails=count($emails);
			//now send emails to everyone.
			$this->load->model('account');
			foreach ($emails as $email) {
				//send forgot password thing.
				$this->account->send_forgot_password($email);
			}


			$user_info=$this->user->get_current_user_info();
			$user_id=$user_info['id'];
			//get list of assigned departments for user_id
			$this->db->select('*,rooms.id as room_id')->from('room_admin_allocation')->join('rooms','rooms.id=room_admin_allocation.room')->where('admin',$user_id);
			$query=$this->db->get();
			$result=$query->result_array()[0];
			$room_id=$result['room_id'];

			$this->db->select("id as student,'{$room_id}' as room")->from('users')->where_in('email',$emails);
			$query=$this->db->get()->result_array();
			$this->db->insert_batch('student_allocation',$query);
			$data['status']="Success";
			$data['message']="{$number_of_emails} account(s) created.";
		}
		return $data;
	}
}