<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
    }
	
	public function totalUsers()
	{
		$this->db->from('users');
		$this->db->where('deleted',0);
		return $this->db->count_all_results();
	}
	
	public function totalActiveUsers()
	{
		$this->db->from('users');
		$this->db->where('deleted',0);
		$this->db->where('active',0);
		return $this->db->count_all_results();
	}
	
	public function totalDeactivatedUsers()  
	{
		$this->db->from('users');
		$this->db->where('deleted',0);
		$this->db->where('active',1);
		return $this->db->count_all_results();
	}
	
	public function totalDeletedUsers()  
	{
		$this->db->from('users');
		$this->db->where('deleted',1);
		return $this->db->count_all_results();
	}
	
	public function totalCountryList()  
	{
		$this->db->select('country_name');
		$this->db->from('userinfo');
		$this->db->join('users','users.user_id=userinfo.user_id');		
		$this->db->group_by('country_name');
		$this->db->where('deleted',0);
		$result=$this->db->get();	;
	$country_name="";
 
	  foreach ($result->result() as $row) {
		    if ($country_name!="") {
		        $country_name = $country_name.",".$row->country_name;	
		    }
	        else {
			    $country_name = $row->country_name;	
		    }
		
		}	
		return $country_name;
	}
	
	public function totalRegForMonth($dates)
	{
		
 
	    $this->db->select('count(*) counts');
		$this->db->from('userinfo');
		$this->db->join('users','users.user_id=userinfo.user_id');		
		$this->db->where("(	register_date LIKE '%".$this->db->escape_like_str($dates)."%'
	    ) and deleted=0");
		$result=$this->db->get();	 

	    foreach ($result->result() as $row) {
		    $counts=$row->counts;	
		}	
		return $counts;
	}
	
	public function totalActiveUsersForMonth($dates)
	{
		$this->db->select('count(*) counts');
		$this->db->from('userinfo');
		$this->db->join('users','users.user_id=userinfo.user_id');		
		$this->db->where("(	register_date LIKE '%".$this->db->escape_like_str($dates)."%'
	    ) and deleted=0 and active=0");
		$result=$this->db->get();	

	    foreach ($result->result() as $row) {
		$counts=$row->counts;	
		}	
		return $counts;
	}
	
	public function totalDeactivatedUsersForMonth($dates)
	{
		$this->db->select('count(*) counts');
		$this->db->from('userinfo');
		$this->db->join('users','users.user_id=userinfo.user_id');		
		$this->db->where("(	register_date LIKE '%".$this->db->escape_like_str($dates)."%'
	    ) and deleted=0 and active=1");
		$result=$this->db->get();	

	 foreach ($result->result() as $row)
		{
		$counts=$row->counts;	
		}	
		return $counts;
	}
	
	public function totalDeletionForMonth($dates)
	{
		$this->db->select('count(*) counts');
		$this->db->from('userinfo');
		$this->db->join('users','users.user_id=userinfo.user_id');		
		$this->db->where("(	register_date LIKE '%".$this->db->escape_like_str($dates)."%'
	    ) and deleted=1");
		$result=$this->db->get();	

	    foreach ($result->result() as $row) {
		$counts=$row->counts;	
		}	
		return $counts;
	}
		
		public function userbyCountry()
	{
		$this->db->select('country_code,count(*) counts');
		$this->db->from('userinfo');
		$this->db->join('users','users.user_id=userinfo.user_id');	
        $this->db->where('deleted',0);		
		$this->db->group_by('country_code');
		return $result=$this->db->get();	
		
	
	}
	
}

