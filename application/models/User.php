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
class User extends CI_Model {
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
	public function check_email($email)
	{
		// select id from users where email=$email (self explanatory)
		$this->db->select('id')->from('users')->where("email",$email);
		$query=$this->db->get();
		$data=$query->result_array();
		if($query->num_rows()==0){
			return FALSE;
		}
		else{
			return $data[0]['id'];
		}
	}
	public function check_group($group)
	{
		// select id from users where email=$email (self explanatory)
		$this->db->select('id')->from('groups')->where("LOWER(group_name)",$group);
		$query=$this->db->get();
		$data=$query->result_array();
		if($query->num_rows()==0){
			return FALSE;
		}
		else{
			return $data[0]['id'];
		}
	}
	public function get_current_user_info()
	{
		$email=$_COOKIE['email'];
		$this->load->model('account');
		$data=$this->account->get_user_info_from_email($email);
		return $data;
	}



	/**
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@category user
	*	@copyright (c) 2015, Nishchal Gautam
	*	@return boolean TRUE if no user are present FALSE if there are user
	*	@since 0.1
	*	@version 0.1
	*/

	public function check_to_install()
	{
		$query=$this->db->query("SHOW TABLES");
		if($query->num_rows()==0){
			return TRUE;
		}
		$this->db->select()->from('users');
		$query=$this->db->get();
		if($query->num_rows()==0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function authenticate($email,$password){
		//todo, check if there's remember me set and set the cookie accordingly
		setcookie('email',$email,NULL,'/');
		setcookie('token',password_hash($password,PASSWORD_DEFAULT),NULL,'/');
		return;
	}
	public function check_password()
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		$this->db->select('password,user_type,status,blocked')->from('users')->where('email',$email)->where('deleted','0');
		$query = $this->db->get();
		if($query->num_rows()==0){
			$data['status']='Error';
			$data['message']='This email address is not registered with us.';
		}
		$result = $query->result_array();
		if($result){
			$password_in_db = $result[0]['password'];
			$status=$result[0]['status'];
			$blocked=$result[0]['blocked'];
			if(password_verify($password,$password_in_db)){
				if($status==0){
					$data['status']='Error';
					$data['message'] = "Your email is not verified, please <a href='/login/verification' style='color:#428bca;font-family:monospace;'>verify</a> email account";
				}elseif($blocked==1){
					$data['status']='Error';
					$data['message'] = "Your account is blocked, please contact admin";
				}elseif($result[0]['user_type']!=ROOT && $result[0]['user_type']!=SUPER_ADMIN && $result[0]['department']==NULL){
					$data['status']='Error';
					$data['message'] = "You're not assigned to any department, please contact admin";
				}else{
					$this->authenticate($email,$password_in_db);
					$data['status']='Success';
					$data['url'] = $this->get_role_redirect_url($result[0]['user_type']);
					if(isset($_GET['redirect_url'])){
						$data['url']=$_GET['redirect_url'];
					}
				}
				//authenticate him
				//generate a password_hash using password_default then set it on a cookie,
			}else{
				$data['status']='Error';
				$data['message']='Password Mismatch';
			}
		}
		return $data;
	}

	public function check_permission($role){
		if(isset($_COOKIE['email'],$_COOKIE['token'])){
			$email=$_COOKIE['email'];
			$token=$_COOKIE['token'];
			//check
			$result=$this->check_cookie_auth($email,$token);
			if($result){

				if($result['user_type'] == $role){
					return TRUE;
				}else{
					//redirect him to his page
					$data['url'] = $this->get_role_redirect_url($result['user_type']);
					//header("Location:{$data['url']}");
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}
	}
	public function get_role_redirect_url($role)
	{
		switch ($role) {
			case ROOT:
				$url = '/root';
				break;
			case SUPER_ADMIN:
				$url = '/sudo';
				break;
			case ADMIN:
				$url = '/admin';
				break;
			case TEACHER:
				$url = '/dashboard';
				break;
			case STUDENT:
				$url = '/home';
				break;
			case PARENTS:
				$url = '/parents';
				break;
		}
		return $url;
	}

	/**
	*	setting cookie time to past to destroy cookie.
	*/
	public function logout()
	{
		setcookie('email','',time()-100,'/');
		setcookie('token','',time()-100,'/');
	}
	public function check_cookie_auth($email,$password)
	{
		$this->db->select('password,user_type')->from('users')->where('email',$email);
		$query = $this->db->get();
		if($query->num_rows()==0){
			$data = FALSE;
		}
		$result = $query->result_array();
		if($result){
			$token=$result[0]['password'];
			// password_verify($password,$hash)
			// now password is $token and $password is the password in cookie
			if(password_verify($token,$password)){
				$user_type_db=$result[0]['user_type'];
				$data['user_type']=$user_type_db;
			}else{
				//probably log his ip address and flag a cookie to track him properly.
				$data = FALSE;
			}
		}else{
			$data = FALSE;
		}
		return $data;
	}
	public function create($email,$role)
	{
		if($this->check_email($email)){
			$data['status']="Error";
			$data['message']="This email is already used";
		}else{
			$user_info=$this->get_current_user_info();
			if($user_info['user_type']!=ROOT && $user_info['user_type']!=SUPER_ADMIN){
				$data['department']=$user_info['department'];
			}
			$data['email']=$email;
			$data['name']=explode("@", $email)[0];
			$data['user_type']=$role;
			$this->db->insert('users',$data);
			$insert_id=$this->db->insert_id();
			unset($data);
			$data['status']="Success";
			$data['message']="User succssfully created";
			$data['user_id']=$insert_id;
		}
		return $data;
	}
	public function create_group($group)
	{
		$user_info=$this->get_current_user_info();
		$data['group_name']=$group;
		$this->db->insert('groups',$data);
		$insert_id=$this->db->insert_id();
		unset($data);
		$data['status']="Success";
		$data['message']="Group succssfully created";
		$data['group_id']=$insert_id;
		return $data;
	}
	public function assign_department($user_id,$department)
	{
		$data['department']=$department;
		$this->db->where('id',$user_id);
		$this->db->update('users',$data);
	}
}