<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Location_model  extends CI_Model
{
	/*
	Determines if a given user_id is exist
	*/
	public function exists($location_id)
	{
		$this->db->from('locations');	
		$this->db->where('locations.location_id',$location_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}	
	
	public function count_all()
	{
		$this->db->from('locations');
		$this->db->where('deleted',0);
		return $this->db->count_all_results();
    }
    
    public function get_emergency_list($location_id)
	{
		$this->db->from('emergency_location');
		$this->db->where('emergency_location.location_id',$location_id);
		return $this->db->get();
		
    }
    
    public function get_assign_users($location_id)
	{
		$this->db->from('assign_location_users');
        $this->db->where('assign_location_users.location_id',$location_id);
        $this->db->join('userinfo','assign_location_users.user_id=userinfo.user_id');
		return $this->db->get();
		
	}

    /*
	Inserts or updates an user
	*/
	public function save(&$location_data, &$other_data, $location_id=-1)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();	
		if (!empty($location_data)) {
			
			if ($location_id == -1 or !$this->exists($location_id)) {
                $success = $this->db->insert('locations',$location_data);
                $location_id=$this->db->insert_id();

                if ($other_data['emergency_locations'] != null) {
                    foreach (json_decode($other_data['emergency_locations']) as $data) {

                        $emergency_data=array(
                            'emergency_name'=>$data->locationname,
                            'emergency_type'=>$data->locationtype,
                            'location_id'=>$location_id
                        );

                        $this->db->insert('emergency_location',$emergency_data);
                        
                    }
                }

                if ($other_data['userids'] != null) {
                    foreach ($other_data['userids'] as $data) {

                        $emergency_data=array(
                            'location_id'=>$location_id,
                            'user_id'=>$data
                        );
    
                        $this->db->insert('assign_location_users',$emergency_data);
                        
                    }
                }


			}
			else {
				$this->db->where('location_id', $location_id);
                $success = $this->db->update('locations',$location_data);		
                
                $this->db->delete('emergency_location', array('location_id' => $location_id));
                $this->db->delete('assign_location_users', array('location_id' => $location_id));

                if ($other_data['emergency_locations'] != null) {
                    foreach (json_decode($other_data['emergency_locations']) as $data) {

                        $emergency_data=array(
                            'emergency_name'=>$data->locationname,
                            'emergency_type'=>$data->locationtype,
                            'location_id'=>$location_id
                        );

                        $this->db->insert('emergency_location',$emergency_data);
                        
                    }
                }

                if ($other_data['userids'] != null) {
                    foreach ($other_data['userids'] as $data) {

                        $emergency_data=array(
                            'location_id'=>$location_id,
                            'user_id'=>$data
                        );
    
                        $this->db->insert('assign_location_users',$emergency_data);
                        
                    }
                }
                
			}
            
            
		}
		else {
			$success=true;
		}
		
		$this->db->trans_complete();		
		return $success;
	}

	
	

}

