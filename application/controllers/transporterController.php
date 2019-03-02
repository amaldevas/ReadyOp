<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transporterController extends CI_Controller {
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
