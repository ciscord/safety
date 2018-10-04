<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * SMTP Library
 * Get data from smtp.com
 *
 * @package         CodeIgniter
 * @category        Library
 */
class Smtp_Lib {

    /**
     * smtp.com API key
     * @var string
     */
    protected $key;

    /**
     * smtp.com API url
     * @var
     */
    protected $api_url;

    /**
     * @var CI_Controller
     */
    public $ci;

    /**
     * curl init
     * @var resource
     */
    protected $ch;

    /**
     * smtp.com account id
     * @var string
     */
    public $account_id;

    /**
     * smtp.com sender id
     * @var string
     */
    public $sender;

    /**
     * Load CI_Controller
     * Load MY_email library
     * Load smtp Config
     * curl setopt
     * @return void
     */
    public function __construct () {
        $this->CI =& get_instance();
        $this->CI->load->library('email');
        $config = $this->CI->config->load('smtp_email', true);
        $this->account_id = $config['smtp_account_id'];
        $this->sender = $config['smtp_sender_id'];
        $this->key = $config['smtp_key'];
        $this->api_url = $config['api_url'];
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    }


    /**
     * Get sender queue
     * @param unix datetime str $unix_time
     * @param string $sender
     * @return mixed
     */
    public function get_sender_queue ($unix_time, $sender = NULL) {
        if (!$sender){
            $sender = $this->sender;
        }

        $date = new DateTime();
        $summary_url = $this->api_url.$this->account_id.'/'.$sender.'/queue?api_key='.$this->key.'&time_start=%22'.$unix_time.'%22&time_end=%22'.$date->getTimestamp().'%22&limit=100&offset=0';
        return $this->smtpcom_get($summary_url);
    }

    /**
     * Get sender stats
     * @param unix datetime str $unix_time
     * @param string $sender
     * @return mixed
     */
    public function get_senders_stats ($unix_time, $sender = NULL) {
        if (!$sender){
            $sender = $this->sender;
        }

        $date = new DateTime();
        $summary_url = $this->api_url.$this->account_id.'/'.$sender.'/stats?api_key='.$this->key.'&time_start="'.$unix_time.'"&time_end="'.$date->getTimestamp().'"&limit=100&offset=0';
        return $this->smtpcom_get($summary_url);
    }

    /**
     * Get sender delivery
     * @param unix datetime str $unix_time
     * @param string $sender
     * @return mixed
     */
    public function get_sender_delivery ($unix_time, $sender = NULL) {
        if (!$sender){
            $sender = $this->sender;
        }

        $date = new DateTime();
        $summary_url = 'http://api.smtp.com/v1/account/senders/'.$sender.'/statistics/delivery.json?api_key='.$this->key.'&time_start="'.$unix_time.'"&time_end="'.$date->getTimestamp().'"&limit=100&offset=0';
        return $this->smtpcom_get($summary_url);
    }

    /**
     * Send request to smtp.com
     * @param string $url
     * @return mixed
     */
    function smtpcom_get($url ) {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        $res = curl_exec($this->ch);
        if ( !curl_errno($this->ch) && $res ) {
            $parsed = json_decode($res, 1);
            if ( !isset($parsed['code'] )){
                return $parsed;
            } else {
                echo 'Error ' . $parsed['code'] . '.' . $parsed['message'];
            }
        } else {
            echo 'Some error was occured: ' . curl_errno($this->ch);
        }

        return $res;
    }
}