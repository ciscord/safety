<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Statistics hook
 * Log user activity in db
 *
 * @package         CodeIgniter
 * @category        Hook
 */

class Statistics {

    /**
     * log_activity
     * Save user activity in db
     * @return void
     */
    public function log_activity() {
        // We need an instance of CI as we will be using some CI classes
        $CI =& get_instance();
 
        // Load user model
        $CI->load->model('User');

        //IF user logined, get user info
        if ($CI->User->is_logged_in()) {
            $logged_in_info = $CI->User->get_logged_in_user_info();
            $data['user_id'] = $logged_in_info->user_id;
            //$data['project_id'] = $logged_in_info->user_id;
            $data['user_level'] = $logged_in_info->user_level;
            $data['username'] = $logged_in_info->username;
        }

        // Next up, we want to know what page we're on, use the router class
        $data['section'] = $CI->router->class;
        $data['action'] = $CI->router->method;

        // Lastly, we need to know when this is happening
        $data['when_log'] = date("Y-m-d H:i:s");

        // We don't need it, but we'll log the URI just in case
        $data['uri'] = uri_string();

        // And write it to the database
        $CI->db->insert('statistics', $data);
    }
}