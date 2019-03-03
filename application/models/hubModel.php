<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hubModel extends CI_Model {
	public function getKsrtc($from_id,$to_id)
	{
		$this->db->select('id,arrival,departure');
		$this->db->where('from_hub' , $from_id);
		$this->db->where('to_hub' , $to_id);
		$query=$this->db->get('ksrtc');
		foreach ($query->result() as $row)
		{
			$credentials['transporter_id']=$row->id;
        	$credentials['arrival_time']=$row->arrival;
        	$credentials['departure_time']=$row->departure;
		}
		$now = new DateTime();
		$now->setTimezone(new DateTimezone('Asia/Kolkata'));
		$time=$now->format('H:i:s');
		if($time>$credentials['departure_time'])
		{
			$credentails['departure_date'] = date("Y-m-d", time() + 86400);
			$credentails['arrival_date'] = date("Y-m-d", time() + 86400);
		}
		else
		{
			$credentails['departure_date']=date("Y-m-d");
			$credentails['arrival_date']=date("Y-m-d");
		}
		return $credentials;
	}
	public function createLuggage($credentials)
	{
		if($this->db->insert('luggage',$credentials))
		{
			return $this->db->insert_id();
		}
		else 
		{
			return false;
		}
	}
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
	public function getHubName($id)
	{
		$this->db->select('name');
		$this->db->where('id' , $id);
		$query=$this->db->get('hub');
		return $query->row()->name;
	}
	public function getHubReceive($id)
	{
		$this->db->select('luggage.id,
							transporter.name as tname,
							traveller.name,
							luggage.to_hub,
							hub.name as hname,
							luggage.arrival_date,
							luggage.arrival_time
							');
		$this->db->from('luggage');
		$this->db->join('transporter','transporter.id = luggage.transporter_id');
		$this->db->join('traveller','traveller.id = luggage.user_id');
		$this->db->join('hub','hub.id = luggage.to_hub');
		$this->db->where('luggage.to_hub',$id);
		$this->db->order_by("luggage.arrival_date", "dsc");
		$query=$this->db->get();
		if(!empty($query->result()))
		{
			$i=0;
			foreach ($query->result() as $row)
				{
        			$credentials2['luggage_id'][$i]=$row->id;
        			$credentials2['transporter_name'][$i]=$row->tname;
        			$credentials2['traveller_name'][$i]=$row->name;
        			$credentials2['hub_name'][$i]=$this->getHubName($row->to_hub);
        			$credentials2['arrival_date'][$i]=$row->arrival_date;
        			$credentials2['arrival_time'][$i]=$row->arrival_time;
        			$i++;
				}
				$credentials2['count']=$i;
				return $credentials2;
		}
		return NULL;
	}
	public function getHubTransfer($id)
	{
		$this->db->select('luggage.id,
							transporter.name as tname,
							traveller.name,
							luggage.to_hub,
							hub.name as hname,
							luggage.arrival_date,
							luggage.arrival_time
							');
		$this->db->from('luggage');
		$this->db->join('transporter','transporter.id = luggage.transporter_id');
		$this->db->join('traveller','traveller.id = luggage.user_id');
		$this->db->join('hub','hub.id = luggage.to_hub');
		$this->db->where('luggage.from_hub',$id);
		$this->db->order_by("luggage.arrival_date", "dsc");
		$query=$this->db->get();
		if(!empty($query->result()))
		{
			$i=0;
			foreach ($query->result() as $row)
				{
        			$credentials2['luggage_id'][$i]=$row->id;
        			$credentials2['transporter_name'][$i]=$row->tname;
        			$credentials2['traveller_name'][$i]=$row->name;
        			$credentials2['hub_name'][$i]=$this->getHubName($row->to_hub);
        			$credentials2['arrival_date'][$i]=$row->arrival_date;
        			$credentials2['arrival_time'][$i]=$row->arrival_time;
        			$i++;
				}
				$credentials2['count']=$i;
				return $credentials2;
		}
		return NULL;
	}
	public function getTransporter($date,$time,$to,$from)
	{
		$this->db->select('trip.id,transporter.email');
		$this->db->from('trip');
		$this->db->join('transporter','transporter.id = trip.transporter_id');
		$this->db->where('from_hub',$from);
		$this->db->where('to_hub',$to);
		//$this->db->where('arrival_date>=',$date);
		//$this->db->where('arrival_time>=' , $time);
		$query=$this->db->get();
		if(!empty($query->result()))
		{
			$i=0;
			foreach ($query->result() as $row)
				{
        			$credentials2['trip_id'][$i]=$row->id;
        			$credentials2['email'][$i]=$row->email;
        			$i++;
				}
				$credentials2['count']=$i;
				return $credentials2;
		}
		return NULL;
	}
	public function tripNot($luggage_id)
	{
		$this->db->select('ksrtc_cm');
		$this->db->where('id' , $luggage_id);
		$query=$this->db->get('luggage');
		if($query->row()->ksrtc_cm=='1')
		{
			return True;
		}
		else
		{
			return False;
		}
	}
	public function getTrip($trip_id,$luggage_id)
	{
		$k=0;
		$this->db->select('id,
							departure_date,
							arrival_date,
							departure_time,
							transporter_id,
							arrival_time
							');
		$this->db->where('id' , $trip_id);
		$query=$this->db->get('trip');
		if(!empty($query->result()))
		{
			foreach ($query->result() as $row)
				{
        			$data = array(
        'departure_date' => $row->departure_date,
        'departure_time' => $row->departure_time,
        'arrival_date' => $row->arrival_date,
        'arrival_time' =>$row->arrival_time,
        'transporter_id' =>$row->transporter_id,
        'ksrtc_cm' =>$k
			);
        			$this->db->where('id', $luggage_id);
					$this->db->update('luggage', $data);
				}
		}
		
	}
	public function getHubNames($id)
	{
		$this->db->select('name');
		$this->db->where('id' , $id);
		$query=$this->db->get('traveller');
		foreach ($query->result() as $row)
				{
					return $row->name;
				}
	}
	public function getHubEmail($id)
	{
		$this->db->select('email');
		$this->db->where('id' , $id);
		$query=$this->db->get('traveller');
		foreach ($query->result() as $row)
				{
					return $row->email;
				}
	}
	public function getHubUserId($luggage_id)
	{
		$this->db->select('user_id');
		$this->db->where('id' , $luggage_id);
		$query=$this->db->get('luggage');
		foreach ($query->result() as $row)
				{
					return $row->user_id;
				}
	}
	public function getHubTransferDone($luggage_id)
	{
		$user_id=$this->getHubUserId($luggage_id);
        			$data = array(
        'send' => '1',
        'send_date' => date('Y-m-d'),
        'send_time' => date('H:i:s')
			);
        			$this->db->where('id', $luggage_id);
					$this->db->update('luggage', $data);
				$this->db->select('*');
				$this->db->where('id' , $luggage_id);
				$query=$this->db->get('luggage');
				if(!empty($query))
			{
				foreach ($query->result() as $row)
				{
        			$credentials2['id']=$row->id;

        			$credentials2['name']=$this->getHubNames($user_id);
        			$credentials2['email']=$this->getHubEmail($user_id);;
        			$credentials2['send_time']=$row->send_time;
        			$credentials2['send_date']=$row->send_date;
        			$credentials2['arrival_time']=$row->arrival_time;
        			$credentials2['arrival_date']=$row->arrival_date;
				}
				return $credentials2;
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