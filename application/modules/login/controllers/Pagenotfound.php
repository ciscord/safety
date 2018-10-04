<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagenotfound extends UNF_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 

        $data['content_view']='login/pagenotfound';
		$this->load->module("template");
		$this->template->login_template($data);
    } 
} 
