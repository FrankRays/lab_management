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
class Sudo_model extends CI_Model {
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


	/**
	*	setting cookie time to past to destroy cookie.
	*/
	public function settings()
	{
		$number_of_admins_to_display=3;
		$admins=$this->load->model('account');
		$this->load->model('utility');

		//department part done

		//list out department and their admins
		$this->db->select()->from('groups');
		$data['list_of_groups']=$this->db->get()->result_array();
		return $data;
	}
	public function index()
	{
		$this->load->model('account');
		$this->db->select()->from('groups');
		$query=$this->db->get()->result_array();
		$data['test_list']=$query;
		return $data;
	}
	public function list_tests($group)
	{
		$this->db->select()->from('tests')->where('group_in',$group);
		$query=$this->db->get();
		$data=$query->result_array();
		return $data;
	}
	public function create_test($post)
	{
		$data['name']=$_POST['name'];
		$data['ref']=$_POST['ref_by'];
		$data['age']=$_POST['age'];
		$data['sex']=$_POST['sex'];
		$data['date_taken']=date("Y-m-d");
		$data['address']=$_POST['address'];
		$data['price']=$_POST['price_whole'];
		$data['short_clinical_history']=$_POST['short_clinical_history'];
		$this->db->insert('tests_id',$data);
		unset($data);
		$data=[];
		$test_id=$this->db->insert_id();
		// die(var_dump($_POST));
		foreach ($post['test_name'] as $key => $value) {
			$query['test_name']=$value;
			$query['test']=$key;
			$query['result']=$post['test_result']["$key"];
			$query['price']=$post['price']["$key"];
			$query['unit_measurement']=$post['unit_measurement']["$key"];
			$query['default_value']=$post['default_value']["$key"];
			$query['belongs_to']=$test_id;
			$data[]=$query;
			unset($query);
		}
		$this->db->insert_batch('results',$data);
		unset($data);
		$data['status']='Success';
		$data['test_id']=$test_id;
		$data['message']='Saved successfully';
		return $data;
	}
	public function get_report_info($id)
	{
		$this->db->select('*,name as patient_name')->from('tests_id')->where('id',$id);
		$query=$this->db->get();
		if($query->num_rows()==0){
			return FALSE;
		}else{
			$data=$query->result_array()[0];
			if(array_key_exists('date_checked',$data)){
				//do nothing
			}else{
				$sql="ALTER TABLE tests_id ADD COLUMN date_checked VARCHAR(255);";
				$this->db->query($sql);
				$data['date_checked']=date("Y-m-d");
			}
			$query=$this->db->select('groups.id,groups.group_name')->from('results')->join('tests','results.test=tests.id')->join('groups','tests.group_in=groups.id')->where('belongs_to',$id)->group_by('groups.id');
			//list of groups
			$groups=$this->db->get()->result_array();
			$i=0;
			foreach ($groups as $group) {
				//group,
				$results[$i]['name']=$group['group_name'];
				$group_id=$group['id'];
				$this->db->select()->from('results')->join('tests','results.test=tests.id')->join('groups','tests.group_in=groups.id')->where('belongs_to',$id)->where('groups.id',$group_id);
				$query=$this->db->get();
				$array_about_group=$query->result_array();
				$results[$i]['group_info']=$array_about_group;
				$i++;
			}
			$data['results']=$results;
			return $data;
		}
	}
	public function list_test($from,$to,$ref)
	{
		if($ref==""){
			$this->db->select('name,ref,date_taken,price,id')->from('tests_id')->where('date_taken BETWEEN',"'$from' AND '$to'",FALSE);
			$query=$this->db->get();
			$this->db->select('SUM(price) AS price,"Total" AS name, "" AS date_taken,"" as ref,"" as id')->from('tests_id')->where('date_taken BETWEEN',"'$from' AND '$to'",FALSE);
			$query1=$this->db->get();
		}else{
			$this->db->select('name,ref,date_taken,price,id')->from('tests_id')->where('date_taken BETWEEN',"'$from' AND '$to'",FALSE)->where('ref',$ref);
			$query=$this->db->get();
			$this->db->select('SUM(price) AS price,"Total" AS name, "" AS date_taken,"" as ref,"" as id')->from('tests_id')->where('date_taken BETWEEN',"'$from' AND '$to'",FALSE)->where('ref',$ref);
			$query1=$this->db->get();
		}
		$data=$query->result_array();
		$data=array_merge($data,$query1->result_array());
		// $data[]=$query1->result_array();
		return $data;
		// return $query->result_array();
	}
	public function dataset($from,$to,$ref)
	{
		$this->db->select('SUM(price) as amount,ref')->from('tests_id')->where('date_taken BETWEEN',"'$from' AND '$to'",FALSE)->group_by('ref');
		$query=$this->db->get();
		return $query->result_array();
	}
	public function delete_test($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('tests_id');
		$data['status']="Success";
		$data['message']="Test successfully deleted";
		return $data;
	}
}