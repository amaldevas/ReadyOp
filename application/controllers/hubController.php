<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hubController extends CI_Controller {
	public function confirmTrip()
	{
		$luggage_id=$this->uri->segment(2);
		$trip_id=$this->uri->segment(3);
		if($this->hubModel->tripNot($luggage_id))
		{
			$this->hubModel->getTrip($trip_id,$luggage_id);
			var_dump("TRIP CONFIRMED");
		}
		else
		{
			var_dump("TRIP NOT CONFIRMED");
		}
	}
	public function addLuggage()
	{
		if($this->isHubSession())
		{
			if($this->input->post())
			{
				$from_hub=$this->input->post('from_hub');
				$to_hub=$this->input->post('to_hub');
				$credentials['to_hub']=$this->hubModel->getHubId($to_hub);
				$credentials['from_hub']=$this->hubModel->getHubId($from_hub);
				$credentials['user_id']=$this->input->post('user_id');
				$credentials['arrival_time_user']=$this->input->post('arrival_time');
				$credentials['arrival_date_user']=$this->input->post('arrival_date');
				$credentials['date_created']=date('Y-m-d H:i:s');
				$credentials['received']=1;
				$credentials['received_date']=date('Y-m-d');
				$credentials['received_time']=date('H:i:s');
				$credentials1=$this->hubModel->getKsrtc($credentials['from_hub'],$credentials['to_hub']);
				$credentials2 = array_merge($credentials, $credentials1);
				$id=$this->hubModel->createLuggage($credentials2);
				$credentials3=$this->hubModel->getTransporter($credentials2['arrival_date_user'],$credentials2['arrival_time_user'],$credentials2['to_hub'],$credentials2['from_hub']);
				for($i=0;$i<$credentials3['count'];$i++)
				{
					$this->emailSend($id,$credentials3['email'][$i],$credentials3['trip_id'][$i]);
				}
				redirect('hub/dashboard');
			}
			else
			{
				$credentials['user']=$this->getHubDetails();
				$credentials['hubList']=$this->transporterModel->getHubList();
				$this->load->view('hubView/addLuggage', $credentials);
			}
		}
		else
		{
			redirect('transporter/login');
		}
	}
	public function emailSend($luggage_id,$email,$trip_id)
	{
		if($this->input->post()){
			$toEmail=$email;
			$message="To Confirm the trip click the link : http://localhost/Luggo/index.php/trip-confirm/".$luggage_id."/".$trip_id;
			$this->load->library('email');
			$config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.googlemail.com';
            $config['smtp_port'] = '465';
            $config['smtp_user'] = 'luggolight@gmail.com';
            $config['smtp_pass'] = "luggodevi";

            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;
            $config['newline'] = "\r\n"; 
            $this->email->initialize($config);  

			$this->email->from('luggolight@gmail.com', 'Luggo');
			$this->email->to($toEmail);
			$this->email->cc('');
			$this->email->bcc('');
			$this->email->subject('Confirm Trip');
			$this->email->message($message);
			if($this->email->send()){
				
			}else{
				$data['message']="To Confirm the trip click the link : http://localhost/Luggo/index.php/trip-confirm/".$luggage_id."/".$trip_id;
				
			}

		}else{
			
		}

	}
	public function addKsrtc()
	{
		if($this->isHubSession())
		{
			if($this->input->post())
			{
				$name=$this->input->post('to_hub');
				$credentials['to_hub']=$this->hubModel->getHubId($name);
				$credentials['from_hub']=$this->session->userdata('id');
				$credentials['departure']=$this->input->post('departure');
				$credentials['arrival']=$this->input->post('arrival');
				$credentials['date_created']=date('Y-m-d H:i:s'); 
				$data['result']=$this->hubModel->addKsrtc($credentials);
				redirect('hub/dashboard');
			}
			else
			{
				$credentials['user']=$this->gethubDetails();
				$credentials['hubList']=$this->transporterModel->getHubList();
				$this->load->view('hubView/hubKsrtcAdd', $credentials);
			}
			
		}
		else
		{
			redirect('transporter/login');
		}
	}
	public function listHub()
	{
		if($this->isHubSession())
		{
			$credentials['user']=$this->gethubDetails();
			$credentials['hubList']=$this->transporterModel->getHubList();
			$this->load->view('hubView/hubHubList', $credentials);
		}
		else
		{
			redirect('transporter/login');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('type');
		redirect('hub/login');
	}
	public function getHubDetails()
	{
		$credentials['email']=$this->session->userdata('email');
		$credentials['name']=$this->session->userdata('name');
		$credentials['id']=$this->session->userdata('id');
		$this->load->view('hubView/hubHeader', $credentials);
		return $credentials;
	}
	public function hubDashboard()
	{
		if($this->isHubSession())
		{
			$credentials=$this->getHubDetails();
			$this->load->view('hubView/dashboard', $credentials);

		}
		else
		{
			redirect('hub/login');
		}
	}
	public function isHubSession()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='hub' && $this->session->userdata('id'))
		{
			$credentials['email']=$this->session->userdata('email');
			$credentials['name']=$this->session->userdata('name');
			$credentials['id']=$this->session->userdata('id');
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	public function hubCreate()
	{
		if($this->input->post())
		{
				$credentials['name']=$this->input->post('name');
				$credentials['email']=$this->input->post('email');
				$credentials['password']=$this->input->post('password');
				$credentials['date_created']=date('Y-m-d H:i:s'); 
				$data['result']=$this->hubModel->createHub($credentials);
				redirect('hub/login');
		}
		else
		{
			redirect('hub/login');
		}
	}
	public function hubLogin()
	{
		if($this->isHubSession())
		{
			redirect('hub/dashboard');
		}
		else
		{
			if($this->input->post())
			{
				$credentials['email']=$this->input->post('email');
				$credentials['password']=$this->input->post('password');
				$data['result']=$this->hubModel->isHubExist($credentials);
				var_dump($data);
				#exit(0);
				if(empty($data['result']))
				{
					$data['message'] = "Sorry, failed to login";
					$this->load->view('hubView/hubLogin', $data);
				}
				else
				{
					$credentials1['id']=$data['result']['id'];
					$credentials1['name']=$data['result']['name'];
					$credentials1['email']=$data['result']['email'];
					$credentials1['type']=$data['result']['type'];
					$result=$this->registerSessionForHub($credentials1);
					$data['message']="Login Successfull";
					redirect('hub/dashboard');

				}
			}
			else
			{
				$this->load->view('hubView/hubLogin');
			}
		}
	}
	public function registerSessionForHub($credentials)
	{
		var_dump($credentials);
		$this->session->set_userdata($credentials);
		return True;
	}
}
