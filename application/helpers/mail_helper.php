<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	*	mail helper is responsible for sending email
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@category accounts
	*	@copyright (c) 2015, Nishchal Gautam
	*	@param string $email Email to check
	*	@return boolean FALSE if the email is not registered and ID of user if email is registered
	*	@since 0.1
	*	@version 0.1
	*
	*/

if ( ! function_exists('my_mail'))
{
	/**
	*	my_mail function is responsible to send emails
	*	for now it just writes to emails table in database,
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@param string $to Email of the receiptient.
	*	@param string $subject Subject of the email.
	*	@param string $message Body of the email.
	*	@return boolean Returns true on success and false on failure
	*	@since 0.1
	*	@version 0.1
	*/

	function my_mail($to,$subject,$message)
	{
		$CI =& get_instance();
		$data['receiptent']=$to;
		$data['subject']=$subject;
		$data['message']=$message;
		$CI->db->insert('emails',$data);
		return true;
	}   
}