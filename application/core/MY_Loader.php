<?php
	/**
	*	MY_Loader loads templates from the views/templates directory
	*
	*
	*	@author Nishchal Gautam <gautam.nishchal@gmail.com>
	*	@access public
	*	@category accounts
	*	@copyright (c) 2015, Nishchal Gautam
	*	@param string $email Email to check
	*	@since 0.1
	*	@version 0.1
	*
	*/

class MY_Loader extends CI_Loader {
	public function template($part="header",$data=NULL,$return = TRUE)
	{
		if($return){
			$content  = $this->view("templates/{$part}",$data, $return);
			return $content;
		}
		else{
			$this->view("templates/{$part}",$data);
		}
	}
}
?>