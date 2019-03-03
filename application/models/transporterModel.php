<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transporterModel extends CI_Model {
	public function getHubList()
	{
		$this->db->select('id,
							name,
							email
							');
		$query=$this->db->get('hub');
		if($query->num_rows()>0)
			{
				$i=0;
				foreach ($query->result() as $row)
				{
        			$credentials2['id'][$i]=$row->id;
        			$credentials2['name'][$i]=$row->name;
        			$credentials2['email'][$i]=$row->email;
        			$i++;
				}
				$credentials2['count']=$i;
				return $credentials2;
			}
			return NULL;
	}
	public function createTrip($credentials)
	{
		if($this->db->insert('trip',$credentials))
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}
	public function createtransporter($credentials)
	{
		if($this->db->insert('transporter',$credentials))
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}
	public function istransporterExist($credentials)
		{
			$this->db->select('id,
								name,
								email
							');
			$this->db->where('email' , $credentials['email']);
			$this->db->where('password' , $credentials['password']);
			$query=$this->db->get('transporter');
			if($query->num_rows()==1)
			{
				foreach ($query->result() as $row)
				{
        			$credentials2['id']=$row->id;
        			$credentials2['name']=$row->name;
        			$credentials2['email']=$row->email;
        			$credentials2['type']="transporter";
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