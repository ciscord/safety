<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Welcome Model
 * Update admin pass in db
 *
 * @package         CodeIgniter
 * @category        Model
 */
class Welcome_model extends CI_Model
{
    /**
     * Load database library
     * Load dbforge library
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->dbforge();
    }


    /**
     * Check temp_pass table exists
     * @return bool
     */
    function CheckTempTable ()
    {
        return $this->db->table_exists('temp_pass');
    }

    /**
     * Get password from temp_pass table
     * @return string
     */
    function GetTempPass()
    {
        $query = $this->db->get('temp_pass', 1);
        $row = $query->row();
        return $row->pass;
    }

    /**
     * Delete temp_pass table
     * @return bool
     */
    function DeleteTempTable ()
    {
        return $this->dbforge->drop_table('temp_pass',TRUE);
    }


    /**
     * Update pass for Admin
     * @param string $hash_pass
     * @return void
     */
    function UpdateUserPass ($hash_pass) {
        $this->db->set('password', $hash_pass);
        $this->db->where('user_id', 1);
        $this->db->update('users');
    }
}