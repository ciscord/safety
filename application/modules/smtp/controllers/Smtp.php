<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Smtp Controller
 * Example of send email
 *
 * @package         CodeIgniter
 * @category        Controller
 */
class Smtp extends UNF_Controller
{
    /**
     * Load library smtp_lib
     * @return void
     */
    public function __construct () {
        parent::__construct();
        $this->load->library('smtp_lib');

    }


    /**
     * Email send example
     * @return void
     */
    public function index()
    {
        //Get current time
        $date = new DateTime();

        //Convert to unix time
        $unix_time = $date->getTimestamp();

        //Set email params
        $this->email->from('sender@gmail.com', 'Sender Name');
        $this->email->to('receiver@gmail.com');
        $this->email->subject('Subject');
        $this->email->message('Message');

        //Send email
        $this->email->send();

        //Get queue array
        $queue = $this->smtp_lib->get_sender_queue($unix_time);

        //Get delivery array
        $delivery = $this->smtp_lib->get_sender_delivery($unix_time);
    }

}