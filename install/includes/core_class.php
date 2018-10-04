<?php
/**
 * Core class
 *
 * Validate post data, create config files in application
 *
 */

class Core
{

    /**
     * Config folder / database.php path
     * @var $db_config_path
     */
    public $db_config_path;

    /**
     * Config folder / config.php path
     * @var $config_path string
     */
    public $config_path;


    /**
     * Construct Core object
     * @param string $db_config_path
     * @param string $config_path
     * @return void
     */
    function __construct($db_config_path = '', $config_path = null)    {
        $this->db_config_path = $db_config_path;
        $this->config_path = $config_path;
    }


    /**
     * Validate the post data
     * @param array $data
     * @return bool
     */
    function validate_post($data)
    {
        /* Validating the hostname, the database name and the username. The password is optional. */
        return !empty($data['hostname']) && !empty($data['username']) && !empty($data['database']);
    }

    /**
     * Function to show message
     * @param string $type
     * @param string $message
     * @return array
     */
    function show_message($type, $message)
    {
        return array('class' => $type, 'text' => $message);
    }

    /**
     * Function to write the db config file
     * @param array $data
     * @return bool
     */
    function write_config_db($data)
    {
        if (!$this->db_config_path){
            return false;
        }

        // Config path
        $template_path = 'config/database.php';

        // Open the file
        $database_file = file_get_contents($template_path);

        $new = str_replace('%HOSTNAME%', $data['hostname'], $database_file);
        $new = str_replace('%USERNAME%', $data['username'], $new);
        $new = str_replace('%PASSWORD%', $data['password'], $new);
        $new = str_replace('%DATABASE%', $data['database'], $new);
        $new = str_replace('%DBPREFIX%', $data['dbprefix'], $new);

        // Chmod the file, in case the user forgot
        @chmod($this->db_config_path, 0777);

        // Verify file permissions
        if (is_writable($this->db_config_path)) {

            //Open new database file, if not exist, create new
            $handle = fopen($this->db_config_path, 'w+');

            // Write the file
            if (fwrite($handle, $new)) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }


    /**
     * Copy config.php to app config directory
     * @return bool
     */
    function copy_config()
    {

        // New Config template path
        $template_path = 'config/config.php';

        // Copy the file
        if (copy($template_path, $this->config_path)) {
            return true;
        } else {
            return false;
        }
    }
}