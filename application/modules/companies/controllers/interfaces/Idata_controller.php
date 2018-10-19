<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
This interface is implemented by any controller that keeps track of data items, such
as the Profiles, Users, and Trashes controllers.
*/
interface iData_controller
{
	public function index();
	public function view($data_item_id=-1);
	public function save($data_item_id=-1);
	public function delete();
}
