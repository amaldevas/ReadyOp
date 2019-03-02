<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hubModel extends CI_Model {
	public function addKsrtc($credentials)
	{
		if($this->db->insert('ksrtc',$credentials))
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}
	public function getHubId($name)
	{
		$this->db->select('id');
		$this->db->where('name' , $name);
		$query=$this->db->get('hub');
		return $query->row()->id;
	}
	public function createHub($credentials)
	{
		if($this->db->insert('hub',$credentials))
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}
	public function isHubExist($credentials)
		{
			$this->db->select('id,
								name,
								email
							');
			$this->db->where('email' , $credentials['email']);
			$this->db->where('password' , $credentials['password']);
			$query=$this->db->get('hub');
			if($query->num_rows()==1)
			{
				foreach ($query->result() as $row)
				{
        			$credentials2['id']=$row->id;
        			$credentials2['name']=$row->name;
        			$credentials2['email']=$row->email;
        			$credentials2['type']="hub";
				}
				return $credentials2;
			}
			else
			{
				return NULL;
			}
		}
}
?>