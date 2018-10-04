<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Email Library
 * Extends CodeIgniter Email library, add function save email data in db after send it
 *
 * @package         CodeIgniter
 * @category        Library
 */
class MY_Email extends CI_Email
{

    /**
     * @var CI_Controller
     */
    public $CI;

    /**
     * Email subject
     * @var string
     */
    public $subject;

    /**
     * Config params
     * @var array
     */
    public $email_config;


    /**
     * Load smtp email config, load Smtp_model
     * @param array $config
     * @return void
     */
    public function __construct(array $config = array())
    {
        parent::__construct($config);
        $this->CI =& get_instance();
        $this->CI->config->load('smtp_email', true);
        $this->email_config = $this->CI->config->item('smtp_email');
        if (!count($config)){
            $this->initialize($this->email_config);
            $this->set_newline("\r\n");
        }

        $this->CI->load->model('Smtp_model');
    }

    /**
     * Send email and save email data in db
     * @param bool $auto_clear
     * @return bool
     */
    public function send($auto_clear = TRUE) {
        $result = parent::send(FALSE);
        if ($result) {
            $data = array (
                'address_to' => $this->_headers['To'],
                'address_from' => $this->_headers['X-Sender'],
                'sended_at' =>  date('Y-m-d H:i:s'),
                'subject' => $this->subject,
                'server_response' => null,
                'sender_ip' => $_SERVER['REMOTE_ADDR']
            );

            //Save data in db
            $this->CI->Smtp_model->Save_email_log($data);

            if ($auto_clear){
                $this->subject = '';
                $this->clear();
            }
        }

        return $result;
    }

    /**
     * Make $subject public
     * @param string $subject
     * @return void
     */
    public function subject($subject)
    {
        $this->subject = $subject;
        parent::subject($subject);
    }


}
