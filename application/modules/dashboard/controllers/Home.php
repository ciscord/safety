<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ("Secure_area.php");
class Home  extends Secure_area 
{
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{
	    $data['content_view']='dashboard/home';
		$data['controller_name']=strtolower(get_class());
		$this->load->module("template");
		$this->template->home_template($data);
	}
	
	public function logout()
	{
		$this->User->logout();
	}
}
