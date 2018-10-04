<?php
/**
 * Database Class
 *
 * Install database
 *
 */

class Database
{

    /**
     * Error
     * @var string $error
     */
    var $error;

    /**
     * Function to create the database
     * @param array $data
     * @return bool|mysqli_result
     */
    function create_database($data)
    {
        // Connect to the database
        $mysqli = new mysqli($data['hostname'], $data['username'], $data['password'], '');

        // Check for errors
        if (mysqli_connect_errno())
            return false;

        // Create the prepared statement
        $res = $mysqli->query("CREATE DATABASE IF NOT EXISTS " . $data['database']);

        //Check errors
        if (!$res) {
            $this->error = '#' . $mysqli->errno . ' ' . $mysqli->error;
        }
        // Close the connection
        $mysqli->close();

        return $res;
    }


    /**
     * Function to create the tables and fill them with the default data
     * @param array $data
     * @return bool
     */
    function create_tables($data)
    {
        // Connect to the database
        $mysqli = new mysqli($data['hostname'], $data['username'], $data['password'], $data['database']);

        // Check for errors
        if (mysqli_connect_errno())
            return false;

        //Generate pass
        $pass = $this::generate_pass();

        // Open the default SQL file
        $query = file_get_contents('assets/install.sql');

        //Update Pass
        $query = str_replace("'unifeyed', ''", "'unifeyed', '" . md5($pass) . "'", $query);
        $query = str_replace('temp_pass_val', $pass, $query);

        //Update Prefix
        if ($data['dbprefix'] != 'unf_') {
            $query = str_replace("unf_", $data['dbprefix'], $query);
        }

        // Execute a multi query, check first query for errors
        if (!$mysqli->multi_query($query)) {
            $this->error = '#' . $mysqli->errno . ' ' . $mysqli->error;
            return false;

        } else {

            // Execute each query
            do{ } while($mysqli->more_results() && $mysqli->next_result());
        }

        //Check erorrs
        if($mysqli->error){
            $this->error = '#' . $mysqli->errno . ' ' . $mysqli->error;
            return false;
        }

        return true;
    }


    /**
     * Generate new password
     * @return string
     */
    function generate_pass()
    {
        $arr = array('a', 'b', 'c', 'd', 'e', 'f',
            'g', 'h', 'i', 'j', 'k', 'l',
            'm', 'n', 'o', 'p', 'r', 's',
            't', 'u', 'v', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F',
            'G', 'H', 'I', 'J', 'K', 'L',
            'M', 'N', 'O', 'P', 'R', 'S',
            'T', 'U', 'V', 'X', 'Y', 'Z',
            '1', '2', '3', '4', '5', '6',
            '7', '8', '9', '0', '.', ',',
            '(', ')', '[', ']', '!', '?',
            '&', '^', '%', '@', '*', '$',
            '<', '>', '/', '|', '+', '-',
            '{', '}', '`', '~');

        $pass = "";

        // Generate pass
        for ($i = 0; $i < 10; $i++) {
            // Get random index of the array
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }

        return $pass;
    }
}