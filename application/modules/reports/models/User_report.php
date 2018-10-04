<?php
//class User extends Userinfo
class User_report  extends Userinfo
{
	/*
	Determines if a given user_id is exist
	*/
	public function exists($user_id)
	{
		$this->db->from('users');	
		$this->db->join('userinfo', 'userinfo.user_id = users.user_id');
		$this->db->where('users.user_id',$user_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}	
	
	/*
	Returns all the users
	*/
	public function get_all($limit=10000, $offset=0)
	{
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');			
		$this->db->where('users.deleted',0);	
        $this->db->order_by("first_name", "asc");		
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
		
	}
	
	public function count_all()
	{
		$this->db->from('users');
		$this->db->where('deleted',0);
		return $this->db->count_all_results();
	}
	
	
	public function totalActiveUsers($limit=10000, $offset=0)
	{
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');			
		$this->db->where('deleted',0);
		$this->db->where('active',0);
		$this->db->order_by("first_name", "asc");
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}
	
	public function count_totalActiveUsers()
	{
		$this->db->from('users');
		$this->db->where('deleted',0);
		$this->db->where('active',0);
		return $this->db->count_all_results();
	}
	
	public function totalDeactivatedUsers($limit=10000, $offset=0)  
	{
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where('deleted',0);
		$this->db->where('active',1);
		$this->db->order_by("first_name", "asc");		
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}
	
	public function count_totalDeactivatedUsers()  
	{	
		$this->db->from('users');	
		$this->db->where('deleted',0);
		$this->db->where('active',1);
		return $this->db->count_all_results();
	}
	
	public function totalDeletedUsers($limit=10000, $offset=0)  
	{
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where('deleted',1);
		$this->db->order_by("first_name", "asc");		
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}
	
	public function count_totalDeletedUsers()  
	{
		$this->db->from('users');
		$this->db->where('deleted',1);
		return $this->db->count_all_results();
	}
	

		/*
	Get search suggestions to find users
	*/
	public function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();
		$this->db->select('first_name');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	first_name LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=0");		
		$this->db->order_by("first_name", "asc");
		
		$by_name = $this->db->get();
		foreach ($by_name->result() as $row) {
			$suggestions[]=$row->first_name;		
		}
		
		$this->db->select('email');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	email LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=0");		
		$this->db->order_by("email", "asc");
		
		$email = $this->db->get();
		foreach ($email->result() as $row) {
			$suggestions[]=$row->email;		
		}
		
		$this->db->select('phone_number');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	phone_number LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=0");		
		$this->db->order_by("phone_number", "asc");
		
		$phone_number = $this->db->get();
		foreach ($phone_number->result() as $row) {
			$suggestions[]=$row->phone_number;		
		}
		return $suggestions;
	
	}
	
	/*
	Get search suggestions to find users
	*/
	public function get_active_search_suggestions($search,$limit=5)
	{
		$suggestions = array();
		
		$this->db->select('first_name');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	first_name LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=0 and active=0 ");		
		$this->db->order_by("first_name", "asc");
		
		$by_name = $this->db->get();
		foreach ($by_name->result() as $row) {
			$suggestions[]=$row->first_name;		
		}
		
		$this->db->select('email');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	email LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=0 and active=0");		
		$this->db->order_by("email", "asc");
		
		$email = $this->db->get();
		foreach($email->result() as $row) {
			$suggestions[]=$row->email;		
		}
		
		$this->db->select('phone_number');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	phone_number LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=0 and active=0");		
		$this->db->order_by("phone_number", "asc");
		
		$phone_number = $this->db->get();
		foreach($phone_number->result() as $row) {
			$suggestions[]=$row->phone_number;		
		}

		return $suggestions;
	
	}
	
	public function get_deactvated_search_suggestions($search,$limit=5)
	{
		$suggestions = array();
		
		$this->db->select('first_name');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	first_name LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=0 and active=1 ");		
		$this->db->order_by("first_name", "asc");
		
		$by_name = $this->db->get();
		foreach($by_name->result() as $row) {
			$suggestions[]=$row->first_name;		
		}
		
		$this->db->select('email');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	email LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=0 and active=1");		
		$this->db->order_by("email", "asc");
		
		$email = $this->db->get();
		foreach($email->result() as $row) {
			$suggestions[]=$row->email;		
		}
		
		$this->db->select('phone_number');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	phone_number LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=0 and active=1");		
		$this->db->order_by("phone_number", "asc");
		
		$phone_number = $this->db->get();
		foreach ($phone_number->result() as $row) {
			$suggestions[]=$row->phone_number;		
		}

		return $suggestions;
	
	}
	
	public function get_deleted_search_suggestions($search,$limit=5)
	{
		$suggestions = array();
		
		$this->db->select('first_name');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	first_name LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=1");		
		$this->db->order_by("first_name", "asc");
		
		$by_name = $this->db->get();
		foreach ($by_name->result() as $row) {
			$suggestions[]=$row->first_name;		
		}
		
		
		$this->db->select('email');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	email LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=1");		
		$this->db->order_by("email", "asc");
		
		$email = $this->db->get();
		foreach($email->result() as $row) {
			$suggestions[]=$row->email;		
		}
		
		$this->db->select('phone_number');
		$this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	phone_number LIKE '%".$this->db->escape_like_str($search)."%'
	    ) and deleted=1");		
		$this->db->order_by("phone_number", "asc");
		
		$phone_number = $this->db->get();
		foreach($phone_number->result() as $row) {
			$suggestions[]=$row->phone_number;		
		}

		return $suggestions;
	
	}
	
	/*
	Preform a search on users
	*/
	public function search($search)
	{
		
	    $this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		email LIKE '%".$this->db->escape_like_str($search)."%' or 
		phone_number LIKE '%".$this->db->escape_like_str($search)."%'  ) and  deleted=0");		
		$this->db->order_by("first_name", "asc");
		return $this->db->get();		
	}
	public function search_active($search)
	{
		
	    $this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		email LIKE '%".$this->db->escape_like_str($search)."%' or 
		phone_number LIKE '%".$this->db->escape_like_str($search)."%'  ) and  deleted=0 and active=0");		
		$this->db->order_by("first_name", "asc");
		return $this->db->get();		
	}
	public function search_deactvated($search)
	{
		
	    $this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		email LIKE '%".$this->db->escape_like_str($search)."%' or 
		phone_number LIKE '%".$this->db->escape_like_str($search)."%'  ) and  deleted=0 and active=1");		
		$this->db->order_by("first_name", "asc");
		return $this->db->get();		
	}
	public function search_deleted($search)
	{
		
	    $this->db->from('users');
		$this->db->join('userinfo','users.user_id=userinfo.user_id');		
		$this->db->where("(	first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		email LIKE '%".$this->db->escape_like_str($search)."%' or 
		phone_number LIKE '%".$this->db->escape_like_str($search)."%'  ) and  deleted=1");		
		$this->db->order_by("first_name", "asc");
		return $this->db->get();		
	}
	
}

