<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function get_module_name($module_id)
	{
		$query = $this->db->get_where('modules', array('module_id' => $module_id), 1);
		
		if ($query->num_rows() ==1) {
			$row = $query->row();
			return $this->lang->line($row->name_lang_key);
		}
		
		return $this->lang->line('error_unknown');
	}
	
	public function get_module_desc($module_id)
	{
		$query = $this->db->get_where('modules', array('module_id' => $module_id), 1);
		if ($query->num_rows() ==1) {
			$row = $query->row();
			return $this->lang->line($row->desc_lang_key);
		}
	
		return $this->lang->line('error_unknown');	
	}
	
	public function get_all_modules()
	{
		$this->db->from('modules');
		$this->db->order_by("sort", "asc");
		return $this->db->get();		
	}
	public function get_editable_modules()
	{
		$this->db->from('modules');
		$this->db->where("editable",0);
		$this->db->order_by("sort", "asc");
		return $this->db->get();		
	}
	public function get_allowed_modules($user_id)
	{
	
		$this->db->from('modules');
		$this->db->join('permissions','permissions.module_id=modules.module_id');
		$this->db->where("permissions.user_id",$user_id);
		$this->db->order_by("sort", "asc");
		return $this->db->get();	

	}
	
	public function get_allowed_main_modules($user_id)
	{
        $this->db->select('DISTINCT('.$this->db->dbprefix.'main_modules.main_module_id), '.$this->db->dbprefix.'main_modules.name_lang_key,main_modules.sort');
        $this->db->from('modules');
		$this->db->join('permissions','permissions.module_id=modules.module_id');		
		$this->db->join('main_modules','main_modules.main_module_id=modules.main_module_id');
		$this->db->where("permissions.user_id",$user_id);
		$this->db->order_by("main_modules.sort", "asc");
		return $this->db->get();

		
	}
	public function get_allowed_submodules($main_module_id)
	{
		
	    $user_id=$this->User_model->get_logged_in_user_info()->user_id;
		$this->db->from('modules');
		$this->db->join('permissions','permissions.module_id=modules.module_id');
		$this->db->where("modules.main_module_id",$main_module_id);
		$this->db->where("permissions.user_id",$user_id);
		$this->db->order_by("modules.sort", "asc");
		return $this->db->get();		
	}

}

