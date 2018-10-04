<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends UNF_Controller 
{
	public function __construct($module_id=null)
	{
		parent::__construct();	

	}
	
	public function home_template($data=NULL)
	{
		$this->load->view("template/home_template",$data);
	}
	
	public function manage_tables_template($data=NULL)
	{
		$this->load->view("template/manage_tables_template",$data);
	}
	
	public function login_template($data=NULL)
	{
		$this->load->view("template/login_template",$data);
	}
	
	public function registration_template($data=NULL)
	{
		$this->load->view("template/registration_template",$data);
	}
}