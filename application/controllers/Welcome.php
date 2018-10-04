<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Welcome controller
 * Get admin pass from temp table, update pass, delete temp table
 * Delete install folder
 *
 * @package         CodeIgniter
 * @category        Controller
 */
class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */


    /**
     * Install path
     * @var string
     */
    var $path;


    /**
     * Load welcome_model model
     * Load file helper
     * Define install dir path
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('welcome_model');
        $this->load->helper('file');
        $this->load->library('bcrypt');
        $this->output->enable_profiler(TRUE);
        $this->path = FCPATH.'install';
    }


    /**
     * Check temp table exists, get password, update pass in db, delete temp table, show pass to user
     * Show welcome_message view
     * Redirect to login if Install dir not exist     *
     * @return void
     */
    public function index()
    {
        //If install dir deleted redirect to login
        if (!get_dir_file_info($this->path)){
            redirect('login', 'refresh');
        }

        $data['pass'] = '';
        //If temp table exist
        if ($this->welcome_model->CheckTempTable())
        {
            //Get admin pass
            $data['pass'] = $pass = $this->welcome_model->GetTempPass();

            //Update passs
            $this->welcome_model->UpdateUserPass($this->bcrypt->hash_password($pass));

            //Delete temp table
            $this->welcome_model->DeleteTempTable();
        }

        //Show view
        $this->load->view('welcome_message', $data);
    }


    /**
     * Delete install directory, redirect to login
     * @return void
     */
    public function DeleteInstall (){
        if (delete_files($this->path, true)){
            rmdir($this->path);
            redirect('login', 'refresh');
        }
    }
}
