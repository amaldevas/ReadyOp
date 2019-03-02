<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hubController extends CI_Controller {
	public function isHubSession()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='hub' && $this->session->userdata('id') && $this->session->userdata('type'))
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
	public function hubLogin()
	{
		if($this->isHubSession())
		{

		}
		else
		{
			if($this->input->post())
			{

			}
			else
			{
				$this->load->view('hubView/hubLogin');
			}
		}
	}
}
