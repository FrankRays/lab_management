<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	*	Here's the account model which is responsible for
	*	doing account related operations
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@category accounts
	*	@copyright (c) 2015, Nishchal Gautam
	*	@since 0.1
	*	@version 0.1
	*
	*/

// check if it's a direct script access
class Account extends CI_Model {
	/**
	*	Here's the account model which is responsible for
	*	doing account related operations
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@category accounts
	*	@copyright (c) 2015, Nishchal Gautam
	*	@param string $user user id of the user sent to email
	*	@param string $token token sent to the user
	*	@return Boolean TRUE on success and FALSE on failure
	*	@since 0.1
	*	@version 0.1
	*
	*/

	public function verify($user,$token)
	{
		$this->db->select('id')->from('email_verification')->where('user',$user)->where('verification_code',$token);
		$query=$this->db->get();

		//see if that token and user are really valid
		
		$data=$query->result_array();
		if($query->num_rows()==0){
			//there's no such user and token match in database
			return FALSE;
		}else{
			//this is a valid request. update users and activate his account.
			$this->db->where('id',$user);
			unset($data);
			$data['status']='1';
			$this->db->update('users',$data);
			
			$this->db->select('email,password')->from('users');
			$result=$this->db->get();
			$data=$result->result_array();
			$email=$data[0]['email'];
			$pass=$data[0]['password'];
			$this->load->model('user');
			$this->user->authenticate($email,$pass);
			return TRUE;
		}
	}
	public function send_verification_email($email)
	{
		$this->db->select('email_verification.verification_code,users.id');
		$this->db->from('email_verification');
		$this->db->join('users', 'users.id = email_verification.user');
		$this->db->where('email',$email);
		$query = $this->db->get();
		$user=$this->get_user_info_from_email($email);
		if(!$user){
			$data['status']="Error";
			$data['message']="This email is not registered with us!";
			return $data;
		}elseif($user['status']==1){
			$data['status']="Error";
			$data['message']="This email is already verified";
			return $data;
		}elseif($query->num_rows()==0){
			//generate one and send
			$token=md5(rand().microtime().rand()).md5(time());
			unset($query);
			$query['verification_code']=$token;
			$query['user']=$user['id'];
			$query['status']='0';
			$this->db->insert('email_verification',$query);
		}else{
			//send the same one.
			$data=$query->result_array();
			$token=$data[0]['verification_code'];
		}
		$user_name=$user['name'];
		$baseurl=base_url();
		$this->load->helper('mail_helper');

		$body = <<<MARKUP
			Welcome {$user_name}, please click on this <a href='{$baseurl}login/verify/{$user['id']}/{$token}'>link</a> to vefity your account.
MARKUP;
		my_mail($user['email'],"Welcome to ".APP_NAME." | email verification.",$body);
		unset($data);
		$data['status']="Success";
		$data['message']="Verification email sent";
		return $data;
	}
	public function get_user_info_from_email($email)
	{
		$this->db->select('id,sn,email,name,register_date,last_visit_date,status,user_type')->from('users')->where('email',$email);
		$query=$this->db->get();
		$data=$query->result_array();
		if($query->num_rows()==0){
			return FALSE;
		}
		return $data[0];
	}
	public function send_forgot_password($email)
	{
		$this->db->select()->from('users')->where('email',$email);
		$query=$this->db->get();
		if($query->num_rows()==0){
			$data['status']="Error";
			$data['message']="This email is not registered with us";
		}else{
			$result=$query->result_array();
			$result=$result[0];
			$token=md5(rand().microtime().rand()).md5(time());
			$value['email']=$email;
			$value['token']=$token;
			$value['used']='0';
			$this->db->insert('lost_password',$value);
			$data['status']="Success";
			$data['message']="Reset link sent, please check email";
			$this->load->helper('mail_helper');
			$baseurl=base_url();
			$user_name=$result['name'];
			$user_id=$result['id'];
			$body = <<<MARKUP
			Welcome {$user_name}, please click on this <a href='{$baseurl}login/reset/{$user_id}/{$token}'>link</a> to set your account's password.
MARKUP;
			my_mail($email,"Set new password",$body);
		}
			return $data;

	}
	public function reset_password($user_id,$token)
	{
		return $this->check_token_password($user_id,$token);
	}
	public function check_token_password($user_id,$token)
	{
		$this->db->select('email')->from('users')->where('id',$user_id);
		$query=$this->db->get();
		if($query->num_rows()==0){
			return FALSE;
		}else{
			$result=$query->result_array();
			$result=$result[0];
			$this->db->select()->from('lost_password')->where('token',$token)->where('email',$result['email'])->where('used','0');
			$query=$this->db->get();
			if($query->num_rows()==0){
				return FALSE;
			}else{
				return TRUE;
			}
		}
	}
	public function set_password($user_id,$token,$password)
	{
		$this->db->where('id',$user_id);
		$value['password']=password_hash($password,PASSWORD_DEFAULT);
		$value['status']='1';
		$this->db->select('email')->from('users')->where('id',$user_id);
		$email=$this->db->get()->result_array()[0]['email'];
		$this->load->model('user');
		$this->user->authenticate($email,$value['password']);
		$this->db->update('users',$value);
		$this->db->where('token',$token);
		unset($value);
		$value['used']='1';
		$this->db->update('lost_password',$value);
		$data['status']="Success";
		$data['message']="Password Reset successful, you can now login";
		return $data;
	}
	public function get_all_user_type($role=ADMIN)
	{
		$this->db->select('*,date(register_date) as reg_date')->from('users')->where('user_type',$role)->where('deleted','0')->order_by('email');
		$query=$this->db->get();
		$data=$query->result_array();
		return $data;
	}
	public function get_limited_users($role=ADMIN,$limit=4)
	{
		$this->db->select()->from('users')->where('user_type',$role)->where('deleted','0')->limit($limit);
		$query=$this->db->get();
		$data=$query->result_array();
		$this->db->select()->from('users')->where('user_type',$role)->where('deleted','0');
		$query=$this->db->get();
		$count=$query->num_rows();
		$count=$count-$limit;
		$data['list']=$data;
		$data['count_in_badge']=$count;
		return $data;
	}
}