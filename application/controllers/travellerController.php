<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class travellerController extends CI_Controller {
	public function istravellerSession()
	{
		if($this->session->userdata('email') && $this->session->userdata('type')=='traveller' && $this->session->userdata('id') && $this->session->userdata('type'))
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
	public function travellerLogin()
	{
		if($this->istravellerSession())
		{

		}
		else
		{
			if($this->input->post())
			{

			}
			else
			{
				$this->load->view('travellerView/travellerLogin');
			}
		}
	}
}
