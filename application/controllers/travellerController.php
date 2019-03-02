<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class travellerController extends CI_Controller {
	public function listHub()
	{
		if($this->istravellerSession())
		{
			$credentials['user']=$this->gettravellerDetails();
			$credentials['hubList']=$this->transporterModel->getHubList();
			$this->load->view('travellerView/travellerHubList', $credentials);
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
		redirect('traveller/login');
	}
	public function getTravellerDetails()
	{
		$credentials['email']=$this->session->userdata('email');
		$credentials['name']=$this->session->userdata('name');
		$credentials['id']=$this->session->userdata('id');
		$credentials['id']=$this->session->userdata('type');
		$this->load->view('travellerView/travellerHeader', $credentials);
		return $credentials;
	}
	public function travellerDashboard()
	{
		if($this->isTravellerSession())
		{
			$credentials=$this->getTravellerDetails();
			$this->load->view('travellerView/dashboard', $credentials);

		}
		else
		{
			redirect('traveller/login');
		}
	}
	public function isTravellerSession()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='traveller' && $this->session->userdata('id'))
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
	public function travellerCreate()
	{
		if($this->input->post())
		{
				$credentials['name']=$this->input->post('name');
				$credentials['email']=$this->input->post('email');
				$credentials['password']=$this->input->post('password');
				$credentials['date_created']=date('Y-m-d H:i:s'); 
				$data['result']=$this->travellerModel->createtraveller($credentials);
				redirect('traveller/login');
		}
		else
		{
			redirect('traveller/login');
		}
	}
	public function travellerLogin()
	{
		if($this->isTravellerSession())
		{
			redirect('traveller/dashboard');
		}
		else
		{
			if($this->input->post())
			{
				$credentials['email']=$this->input->post('email');
				$credentials['password']=$this->input->post('password');
				$data['result']=$this->travellerModel->istravellerExist($credentials);
				var_dump($data);
				#exit(0);
				if(empty($data['result']))
				{
					$data['message'] = "Sorry, failed to login";
					$this->load->view('travellerView/travellerLogin', $data);
				}
				else
				{
					$credentials1['id']=$data['result']['id'];
					$credentials1['name']=$data['result']['name'];
					$credentials1['email']=$data['result']['email'];
					$credentials1['type']=$data['result']['type'];
					$result=$this->registerSessionFortraveller($credentials1);
					$data['message']="Login Successfull";
					redirect('traveller/dashboard');

				}
			}
			else
			{
				$this->load->view('travellerView/travellerLogin');
			}
		}
	}
	public function registerSessionFortraveller($credentials)
	{
		var_dump($credentials);
		$this->session->set_userdata($credentials);
		return True;
	}
}
