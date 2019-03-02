<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hubController extends CI_Controller {
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
