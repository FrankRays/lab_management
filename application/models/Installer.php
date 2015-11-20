<?php
	/**
	*	Here's the installation model which Install controller uses.
	*
	*	This model is responsible for populating database with tables and creating
	*	a super admin user
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@category installation
	*	@copyright (c) 2015, Nishchal Gautam
	*	@since 0.1
	*	@todo Description
	*	@version 0.1
	*
	*/

defined('BASEPATH') OR exit('No direct script access allowed');

// check if it's a direct script access

class Installer extends CI_Model {
	/**
	*	populate_database function is responsible for populating database
	*	with the table structure for the first time
	*
	*	populate_database grabs tables.sql file and executes the query.
	*	if there are any table creations, just add the sql to tables.sql
	*	and it'll execute at the beginning of the installation
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@return boolean Returns true on success and false on failure
	*	@since 0.1
	*	@version 0.1
	*/
	public function populate_database()
	{
		$data=file_get_contents("tables.sql");
		$queries=explode(';', $data);
		array_pop($queries);
		$this->db->trans_start();
		foreach ($queries as $key) {
			$this->db->query($key);
		}
		$this->db->trans_complete();
		if($this->db->trans_status()){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	/**
	*	populate_database function is responsible for populating database
	*	with the table structure for the first time
	*
	*	populate_database grabs tables.sql file and executes the query.
	*	if there are any table creations, just add the sql to tables.sql
	*	and it'll execute at the beginning of the installation
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@return Array Array with two keys, status (ok or error) and message
	*	@since 0.1
	*	@version 0.1
	*/

	public function save()
	{
		if(isset($_POST['email'],$_POST['password'],$_POST['repass'])){

			$user_email=$_POST['email'];
			$password=$_POST['password'];
			$re_password=$_POST['repass'];
			$this->load->helper('email');
			$this->load->model('user');
			if (!valid_email($user_email))
			{
				$data['status']="error";
				$data['message']="Please enter a valid email!";
			}
			else if($password != $re_password)
			{
				$data['status']="error";
				$data['message']="Password and Confirmation password mismatch";
			}elseif(strlen($password)<6)
			{
				$data['status']="error";
				$data['message']="Password must be minimum of 6 characters";
			}elseif($this->user->check_email($user_email))
			{
				$data['status']="error";
				$data['message']="This email is already registered with us.";
			}else{
				$data['status']="ok";
				$data['message']="User Created, please check email for verification";
				$query['email']=$user_email;
				$query['password']=password_hash($password,PASSWORD_DEFAULT);
				$query['name']=$_POST['name'];
				$query['user_type']=SUPER_ADMIN;
				$user_name=$_POST['name'];
				$this->db->insert('users',$query);
				$insert_id = $this->db->insert_id();
				$token=md5(rand().microtime().rand()).md5(time());
				unset($query);
				$query['verification_code']=$token;
				$query['user']=$insert_id;
				$query['status']='0';
				$this->db->insert('email_verification',$query);
				$baseurl=base_url();
				$this->load->helper('mail_helper');
				$body = <<<MARKUP
					Welcome {$user_name}, please click on this <a href='{$baseurl}accounts/verify/{$insert_id}/{$token}'>link</a> to vefity your account.
MARKUP;
				my_mail($user_email,"Welcome to ".APP_NAME." | email verification.",$body);
			}
			return $data;
		}else{
			show_404();
		}
	}
}