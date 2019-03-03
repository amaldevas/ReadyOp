<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transporterController extends CI_Controller {
	public function trip()
	{
		if($this->istransporterSession())
		{
			if($this->input->post())
			{
				$from_hub=$this->input->post('from_hub');
				$to_hub=$this->input->post('to_hub');
				$credentials['to_hub']=$this->hubModel->getHubId($to_hub);
				$credentials['from_hub']=$this->hubModel->getHubId($from_hub);
				$credentials['arrival_time']=$this->input->post('arrival_time');
				$credentials['departure_time']=$this->input->post('departure_time');
				$credentials['departure_date']=$this->input->post('departure_date');
				$credentials['arrival_date']=$this->input->post('arrival_date');
				$credentials['transporter_id']=$this->session->userdata('id');
				$credentials['date_created']=date('Y-m-d H:i:s');
				$data['result']=$this->transporterModel->createTrip($credentials);
				redirect('transporter/dashboard');
			}
			else
			{
				$credentials['user']=$this->gettransporterDetails();
				$credentials['hubList']=$this->transporterModel->getHubList();
				$this->load->view('transporterView/trip', $credentials);
			}
		}
		else
		{
			redirect('transporter/login');
		}
	}
	public function listHub()
	{
		if($this->istransporterSession())
		{
			$credentials['user']=$this->gettransporterDetails();
			$credentials['hubList']=$this->transporterModel->getHubList();
			$this->load->view('transporterView/transporterHubList', $credentials);
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
		redirect('transporter/login');
	}
	public function gettransporterDetails()
	{
		$credentials['email']=$this->session->userdata('email');
		$credentials['name']=$this->session->userdata('name');
		$credentials['id']=$this->session->userdata('id');
		$this->load->view('transporterView/transporterHeader', $credentials);
		return $credentials;
	}
	public function transporterDashboard()
	{
		if($this->istransporterSession())
		{
			$credentials=$this->gettransporterDetails();
			$this->load->view('transporterView/dashboard', $credentials);

		}
		else
		{
			redirect('transporter/login');
		}
	}
	public function istransporterSession()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='transporter' && $this->session->userdata('id'))
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
	public function transporterCreate()
	{
		if($this->input->post())
		{
				$credentials['name']=$this->input->post('name');
				$credentials['email']=$this->input->post('email');
				$credentials['password']=$this->input->post('password');
				$credentials['date_created']=date('Y-m-d H:i:s');
				$config['upload_path'] = './assets/biometric_images/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '10000';
				$config['max_width']  = '1024';
				$config['max_height']  = '1024';
				$this->load->library('upload', $config);
				$this->upload->do_upload('biometric');
				$upload_data =  $this->upload->data();
				$credentials['biometric']= $upload_data['file_name'];
				$this->load->library('upload', $config);
				$this->upload->do_upload('noc');
				$upload_data =  $this->upload->data();
				$credentials['noc']= $upload_data['file_name'];
				$this->load->library('upload', $config);
				$this->upload->do_upload('vehicle');
				$upload_data =  $this->upload->data();
				$credentials['vehicle']= $upload_data['file_name'];
				
				$data['result']=$this->transporterModel->createtransporter($credentials);
				redirect('transporter/login');
		}
		else
		{
			redirect('transporter/login');
		}
	}
	public function transporterLogin()
	{
		if($this->istransporterSession())
		{
			redirect('transporter/dashboard');
		}
		else
		{
			if($this->input->post())
			{
				$credentials['email']=$this->input->post('email');
				$credentials['password']=$this->input->post('password');
				$data['result']=$this->transporterModel->istransporterExist($credentials);
				var_dump($data);
				#exit(0);
				if(empty($data['result']))
				{
					$data['message'] = "Sorry, failed to login";
					$this->load->view('transporterView/transporterLogin', $data);
				}
				else
				{
					$credentials1['id']=$data['result']['id'];
					$credentials1['name']=$data['result']['name'];
					$credentials1['email']=$data['result']['email'];
					$credentials1['type']=$data['result']['type'];
					$result=$this->registerSessionFortransporter($credentials1);
					$data['message']="Login Successfull";
					redirect('transporter/dashboard');

				}
			}
			else
			{
				$this->load->view('transporterView/transporterLogin');
			}
		}
	}
	public function registerSessionFortransporter($credentials)
	{
		var_dump($credentials);
		$this->session->set_userdata($credentials);
		return True;
	}
}
