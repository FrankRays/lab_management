<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utility extends CI_Model {
	public function check_test($test_name,$group)
	{
		$this->db->select()->from('tests')->where('test_name',strtolower($test_name))->where('group_in',$group);
		$query=$this->db->get();
		if($query->num_rows()==0){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	public function add_test($group,$test_name,$unit_measurement,$default_value,$prefill_value,$input_field,$price)
	{
		$data['group_in']=$group;
		$data['test_name']=$test_name;
		$data['unit_measurement']=$unit_measurement;
		$data['default_value']=$default_value;
		$data['prefill_value']=$prefill_value;
		$input_field=explode(",", $input_field);
		if(count($input_field)==1){
			$select="";
		}else{
			$select="<select tabindex='1' class='form-control' name='{name}'><option value=''>Select One</option>";
			foreach ($input_field as $value) {
				$select.="<option value='{$value}'>{$value}</option>";
			}
			$select.="</select>";
		}
		$data['input_field']=$select;
		$data['price']=$price;
		$this->db->insert('tests',$data);
		unset($data);
		$data['status']="Success";
		$data['message']="Test Created";
		return $data;
	}
	public function create_department($department)
	{
		$data['short_name']=$department;
		$this->db->insert('departments',$data);
		return $this->db->insert_id();
	}
	public function add_admin_department($department,$user_id)
	{
		$data['department']=$department;
		$data['admin']=$user_id;

		$this->db->insert('department_admin',$data);
		$this->db->where('id',$user_id);
		$user['department']=$department;
		$this->db->update('users',$user);
		unset($data);
		$data['status']="Success";
		$data['message']="Department Created";

		return $data;
	}
	public function check_user_admin_status($user_id)
	{
		$this->db->select()->from('department_admin')->where('admin',$user_id);
		$query=$this->db->get();
		if($query->num_rows()){
			$data=$query->result_array();
			return $data[0]['department'];
		}else{
			return FALSE;
		}
	}
	public function get_department_faculties($department)
	{
		$this->db->select()->from('users')->where('department',$department)->where('user_type',TEACHER);
		$query=$this->db->get();
		$data['faculties']=$query->result_array();
		return $data;
	}
	public function check_user_class_admin_status($user_id)
	{
		$this->db->select()->from('room_admin_allocation')->where('admin',$user_id);
		$query=$this->db->get();
		if($query->num_rows()){
			$data=$query->result_array();
			return $data[0];
		}else{
			return FALSE;
		}
	}
	public function create_class($class_name,$department)
	{
		$data['name']=$class_name;
		$data['department']=$department;
		$this->db->insert('rooms',$data);
		return $this->db->insert_id();
	}
	public function check_class($class_name)
	{
		$this->db->select('id')->from('rooms')->where('name',$class_name);
		$query=$this->db->get();
		if($query->num_rows()==0){
			return FALSE;
		}
		else{
			$data=$query->result_array();
			return $data[0]['id'];
		}
	}
	public function add_admin_class($class_id,$user_id)
	{
		$data['room']=$class_id;
		$data['admin']=$user_id;
		$this->db->insert('room_admin_allocation',$data);
		$data['status']="Success";
		$data['message']="Class Created";
		return $data;
	}
	public function get_classes($department)
	{
		$this->db->select()->from('rooms')->where('department',$department);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function get_class_admins($department)
	{
		$this->db->select('*,date(register_date) as c_date,rooms.name as room_name,users.name as user_name')->from('room_admin_allocation')->join('users','users.id=room_admin_allocation.admin','left outer')->join('rooms','room_admin_allocation.room=rooms.id')->where('users.department',$department)->where('users.user_type',TEACHER);
		$query=$this->db->get();
		$data=$query->result_array();
		// die(var_dump($data));
		return $data;
	}
	public function list_class_in_department($department)
	{
		$this->db->select()->from('rooms')->where('department',$department);
		$query=$this->db->get();
		$data=$query->result_array();
		return $data;
	}
	public function enroll_faculty_to_class($class_id,$user_id)
	{
		$this->db->select()->from('room_teacher_allocation')->where('teacher',$user_id)->where('room',$class_id);
		$query=$this->db->get();
		if($query->num_rows()==0){
			//insert the data
			$data['room']=$class_id;
			$data['teacher']=$user_id;
			$this->db->insert('room_teacher_allocation',$data);
		}else{
			//don't do anything as it's already enrolled.
		}
	}
	public function get_room_of_current_user()
	{
		$this->load->model('user');
		$user_info=$this->user->get_current_user_info();
		$user_id=$user_info['id'];
		//get list of assigned departments for user_id
		$this->db->select()->from('room_admin_allocation')->join('rooms','rooms.id=room_admin_allocation.room')->where('admin',$user_id);
		$query=$this->db->get();
		if($query->num_rows()==0){
			return FALSE;
		}
		$result=$query->result_array()[0];
		return $result;
	}
	public function assign_faculty($email,$room_number,$subject)
	{
		/*
		*****************************************************
		*
		*	This method is not complete,
		*	first should do the addition of subjects thingy.
		*
		*****************************************************
		*/
		//check if that user exists
		$this->load->model('account');
		$user_info=$this->account->get_user_info_from_email($email);
		$this->db->select()->from('subjects')->where('subject_code',$subject);
		$result=$this->db->get()->result_array()[0];
		$subject_id=$result['id'];
		if($user_info){
			$user_id=$user_info['id'];
		}else{
			$user_info=$this->user->create($email,TEACHER);
			$this->load->model('account');
			$this->account->send_forgot_password($email);
			$user_id=$user_info['user_id'];
		}
		// check if that user is already present there,
		$query['subject']=$subject_id;
		$query['teacher']=$user_id;
		$query['room']=$room_number;

		$this->db->select()->from('room_teacher_allocation')->where('subject',$subject_id)->where('teacher',$user_id)->where('room',$room_number);
		$result=$this->db->get();
		if($result->num_rows()==0){
			$data['status']="Success";
			$data['message']="Faculty assigned to your class";
			$this->db->insert('room_teacher_allocation',$query);
		}else{
			$data['status']="Error";
			$data['message']="This faculty already enrolled for this subject";
		}
		return $data;
	}
	public function add_subject($subject_code,$subject_name)
	{
		//first check if that subject is already there,
		//if subject is not there, do 3 things, first create that subject, then add subject to department which user belongs to, then finally add subject to that class.
		//if subject is there, check if it's allocated in current department, allocate if not so, allocate that subject for that department
		//if subject is there and is allocated for current department, check if it's allocated to that class. if not so, allocate for that class
		$this->db->select()->from('subjects')->where('upper(subject_code)',$subject_code);
		$query=$this->db->get();
		if($query->num_rows()==0){
			$data['subject_code']=$subject_code;
			$data['subject_name']=$subject_name;
			$this->db->insert('subjects',$data);
			$subject_id=$this->db->insert_id();
			unset($data);
		}else{
			$info=$query->result_array();
			$subject_id=$info[0]['id'];
		}
		$this->load->model('user');
		$user_info=$this->user->get_current_user_info();
		$user_id=$user_info['id'];

		$department=$user_info['department'];
		$this->db->select()->from('subject_department_allocation')->where('subject',$subject_id)->where('department',$department);
		$query=$this->db->get();
		if($query->num_rows()==0){
			// insert into subject_department_allocation
			$insert['subject']=$subject_id;
			$insert['department']=$department;
			$this->db->insert('subject_department_allocation',$insert);
		}
		//check if it's already allocated to that class.
		$this->db->select('*,rooms.id as room_id')->from('room_admin_allocation')->join('rooms','rooms.id=room_admin_allocation.room')->where('admin',$user_id);
		
		$query=$this->db->get();
		$result=$query->result_array()[0];
		$room_id=$result['room_id'];
		$this->db->select()->from('room_subject_allocation')->where('subject',$subject_id)->where('room',$room_id);
		$query=$this->db->get();
		unset($data);
		if($query->num_rows()==0){
			//it's not already allocated, insert into that.
			$values['subject']=$subject_id;
			$values['room']=$room_id;
			$this->db->insert('room_subject_allocation',$values);
			$data['status']="Success";
			$data['message']="Successfully added subject";
		}else{
			//it's allocated, return a error
			$data['status']="Error";
			$data['message']="This subject is already enrolled";
		}
		return $data;
	}
	public function get_list_of_classes_for_faculty($user_id)
	{
		$this->db->select('*,rooms.name AS room_name,subjects.id AS subject_id, rooms.id as room_id')->from('room_teacher_allocation')->join('subjects','subjects.id=room_teacher_allocation.subject')->join('rooms','rooms.id=room_teacher_allocation.room')->where('teacher',$user_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function get_present_class_students($class_id)
	{
		$this->db->select('*,users.id as user_id')->from('student_allocation')->join('users','users.id=student_allocation.student')->where('room',$class_id);
		$query=$this->db->get();
		if($query->num_rows()==0){
			$data=FALSE;
		}else{
			$data=$query->result_array();
		}
		return $data;
	}
	public function check_user_class_allocation($user,$class_id)
	{
		$this->db->select()->from('room_teacher_allocation')->where('room',$class_id)->where('teacher',$user);
		$query=$this->db->get();
		if($query->num_rows()==0){
			$data = FALSE;
		}else{
			$data = $query->result_array();
		}
		return $data;
	}
	public function get_absent_from_present	($class_id,$present)
	{
		if(count($present)!=0){
			$this->db->select('users.id')->from('student_allocation')->join('users','users.id=student_allocation.student')->where('room',$class_id)->where_in('users.id NOT',$present);
		}else{
			$this->db->select('users.id')->from('student_allocation')->join('users','users.id=student_allocation.student')->where('room',$class_id);
		}
		$query=$this->db->get();
		if($query->num_rows()==0){
			$data=FALSE;
		}else{
			$data=$query->result_array();
		}
		return $data;
	}
	public function mark_attendance($class_id,$subject_id)
	{
		//check if the attendance is already been marked.
		$this->load->model('user');
		$user_info=$this->user->get_current_user_info();
		$data['for_day']=date("Y-m-d");
		$hour=$_POST['hour'];
		$data['for_hour']=$hour;
		$data['room']=$class_id;
		$this->db->select()->from('marked_presence')->where($data);
		$query=$this->db->get();
		if($query->num_rows()!=0){
			$rows=$query->result_array();
			$user="someone else.";
			if($rows[0]['marked_by']==$user_info['id']){
				$user="you.";
			}
			unset($data);
			$data['status']="Error";
			$data['message']="Attendance for this hour has already been marked by {$user}";
			return $data;
		}
		$present=[];
		if(!isset($_POST['student'])){
			$_POST['student']=[];
		}
		$count_present=count($_POST['student']);
		if($count_present!=0){
			foreach ($_POST['student'] as $student => $value) {
				$present[]=$student;
				$pre=['user'=>$student,'status'=>"P",'marked_by'=>$user_info['id'],'subject'=>$subject_id,'hour'=>$hour];
				$presence[] = $pre;
			}
		}else{
			$presence=[];
		}
		//we've list of present student here,
		$absent=$this->utility->get_absent_from_present($class_id,$present);
		$count_absent=count($absent);
		if($absent !=0 ){
			foreach ($absent as $key) {
				$absence[]=$key;
				$abs=['user'=>$key['id'],'status'=>"A",'marked_by'=>$user_info['id'],'subject'=>$subject_id,'hour'=>$hour];
				$presence[]=$abs;
			}
		}
		$this->db->insert_batch('presence',$presence);
		if($present){
			$count_present=count($present);
		}else{
			$count_present=0;
		}
		if($absent){
			$count_absent=count($absence);
		}else{
			$count_absent=0;
		}
		unset($data);
		$data['for_hour']=$hour;
		$this->load->helper('date');
		$data['for_day']=date("Y-m-d");
		$data['room']=$class_id;
		$data['marked_by']=$user_info['id'];
		$this->db->insert('marked_presence',$data);
		$count_total=$count_present+$count_absent;
		unset($data);
		$data['status']="Success";
		$data['message']="Data successfully saved: {$count_present} present out of {$count_total} students";
		// To-Do
		//save $hour for today has been marked, check that condition, and also save who marked, and display an error if already marked for an hour,
		//give them functionality to edit the attendance, probably confirm before saving


		return $data;
	}
}
?>