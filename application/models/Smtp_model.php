<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Smtp Model
 * Save email data in db
 *
 * @package         CodeIgniter
 * @category        Model
 */
class Smtp_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }


    /**
     * Save email data in db
     * @param array $data
     * @return bool
     */
    public function Save_email_log ($data = array ()) {
        return ($this->db->insert('email_log', $data) ? $this->db->insert_id() : FALSE) ;
    }
}