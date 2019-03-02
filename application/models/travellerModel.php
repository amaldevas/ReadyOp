<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class travellerModel extends CI_Model {
	public function createtraveller($credentials)
	{
		if($this->db->insert('traveller',$credentials))
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}
	public function istravellerExist($credentials)
		{
			$this->db->select('id,
								name,
								email
							');
			$this->db->where('email' , $credentials['email']);
			$this->db->where('password' , $credentials['password']);
			$query=$this->db->get('traveller');
			if($query->num_rows()==1)
			{
				foreach ($query->result() as $row)
				{
        			$credentials2['id']=$row->id;
        			$credentials2['name']=$row->name;
        			$credentials2['email']=$row->email;
        			$credentials2['type']="traveller";
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