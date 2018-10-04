<?php
error_reporting(E_ALL); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.


//Define Environment
if (isset($_SERVER['CI_ENV'])){
    $env = $_SERVER['CI_ENV'];
} elseif ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
    $env = 'development';
} elseif (substr_count($_SERVER['HTTP_HOST'], 'staging.unifeyed.com') > 0) {
    $env = 'staging';
} else {
    $env = 'production';
}

//Define configs paths
define('ENV', $env);
if (ENV !== 'development') {
    $db_config_path = '../application/config/' . ENV . '/database.php';
    $config_path = '../application/config/' . ENV . '/config.php';

    //If ENV is development
} else {
    $db_config_path = '../application/config/development/database.php';
    $config_path = '../application/config/development/config.php';

    //Create config files if it's not exist
    if (!file_exists($db_config_path)) {
        $fp = fopen($db_config_path, "w+");
        fclose($fp);
    }

    if (!file_exists($config_path)) {
        $fp = fopen($config_path, "w+");
        fclose($fp);
    }
}

$upload_path = '../uploads/';
$captcha = '../captcha/';
$cache = '../application/cache/';

// Load the classes
require_once('includes/core_class.php');
require_once('includes/database_class.php');


// Only load the classes in case the user submitted the form
if ($_POST) {
    //Create the new objects
    $database = new Database($_POST);
    $core = new Core($db_config_path, $config_path);

    // Validate the post data
    if ($core->validate_post($_POST) == true) {

        // First create the database, then create tables, then write config file
        if ($database->create_database($_POST) == false) {
            $message = $core->show_message('error', "The database could not be created, please verify your settings. " . $database->error);
        } else if ($database->create_tables($_POST) == false) {
            $message = $core->show_message('error', "The database tables could not be created, please verify your settings. " . $database->error);
        } else if ($core->write_config_db($_POST) == false) {
            $message = $core->show_message('error', "The database configuration file could not be written, please chmod application/config/database.php file to 777");
        } else if (ENV == 'development') {
            if ($core->copy_config() == false) {
                $error = "Please make the application/config/database.php file writable. <strong>Example</strong>:<br/><br/><code>chmod 777 application/config/database.php</code>";
                $message = $core->show_message('error', $error);
            }
        }

        // If no errors, redirect to registration page
        if (!isset($message)) {
            $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $redir .= "://" . $_SERVER['HTTP_HOST'];
            $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
            $redir = str_replace('install/', '', $redir);
            header('Location: ' . $redir . 'welcome');
        }

    } else {
        $message = $core->show_message('error', 'Not all fields have been filled in correctly. The host, username, password, and database name are required.');
    }
}

?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <title>Install | Your App</title>
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link href="../assets/css/materialize.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">
            body {
                font-size: 75%;
                font-family: Helvetica, Arial, sans-serif;
                background-color: #222d32;
                margin: 0 auto;
            }

            .error {
                background: #ffd1d1;
                border: 1px solid #ff5858;
                padding: 4px;
            }

            .warning h6 {
                color: #8a6d3b;
            }

            .warning {
                background: #f5ee91;
                border: 1px solid #ffb258;
                padding: 4px;
            }

            .form-group {

                padding-bottom: 50px;
            }

            .row {
                width: 600px;
                margin: auto;
                margin-top: 150px;

                position: relative;
                border-radius: 3px;
                background: #ffffff;
                border-top: 3px solid #d2d6de;
                margin-bottom: 20px;
                width: 100%;
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
                padding: 5px;
            }

            legend {
                padding-left: 15px;
            }
        </style>
    </head>
    <body>
    <section class="content">
        <div class="row" style=" width: 600px;">
            <center><h1>Install</h1></center>
            <br>
            <?php if (!is_writable_r($upload_path)) { ?>
                <div class="warning"><h6>Warning</h6>

                    <p>The uploads directory is not writable. Please check the permissions on that directory<i> (change
                            the folder permissions to CHMOD 757 on the 'uploads' folder and all sub folders).</i></p>
                </div>
            <?php } ?>
            <br>
            <?php if (!is_writable_r($captcha)) { ?>
                <div class="warning"><h6>Warning</h6>

                    <p>The captcha directory is not writable. Please check the permissions on that directory<i>(change
                            the folder permissions to CHMOD 757 on the 'uploads' folder and all sub folders)</i></p>
                </div>
            <?php } ?>
            <br>
            <?php if (!is_writable_r($cache)) { ?>
                <div class="warning"><h6>Warning</h6>

                    <p>The cache(application/cache) directory is not writable. Please check the permissions on that
                        directory<i>(change the folder permissions to CHMOD 757 on the 'uploads' folder and all sub
                            folders)</i></p>
                </div>
            <?php } ?>
            <br>
            <?php if (is_writable($db_config_path)) { ?>
                <?php if (isset($message)) {
                    echo '<p class="' . $message['class'] . '">' . $message['text'] . '</p>';
                } ?>

                <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <fieldset>
                        <br>
                        <legend>Database settings</legend>
                        <br>

                        <div class="form-group">
                            <label for="hostname" class="col-sm-4">Hostname</label>

                            <div class="col-sm-8">
                                <input type="text" id="hostname" value="" class="input_text form-control"
                                       name="hostname"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-4">Username</label>

                            <div class="col-sm-8">
                                <input type="text" id="username" class="input_text form-control" name="username"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-4">Password</label>

                            <div class="col-sm-8">
                                <input type="password" id="password" class="input_text form-control"
                                       name="password"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="database" class="col-sm-4">Database Name</label>

                            <div class="col-sm-8">
                                <input type="text" id="database" class="input_text form-control" name="database"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="dbprefix" class="col-sm-4">Database Prefix</label>

                            <div class="col-sm-8">
                                <input type="text" id="dbprefix" value="unf_" class="input_text form-control"
                                       name="dbprefix"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="password" class="col-sm-4"></label>

                            <div class="col-sm-8">
                                <input type="submit" class="btn btn-info pull-right" value="Install" id="submit"/>
                            </div>
                        </div>
                    </fieldset>
                </form>
            <?php } else { ?>
                <p class="error">Please make the application/config/database.php file writable. <strong>Example</strong>:<br/><br/><code>chmod
                        777 application/config/database.php</code></p>
            <?php } ?>


        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    </body>
    </html>
<?php


/**
 * Check the directory for writing
 * @param string $dir
 * @return bool
 */
function is_writable_r($dir)
{
    if (is_dir($dir)) {
        if (is_writable($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (!is_writable_r($dir . "/" . $object)) return false;
                    else continue;
                }
            }
            return true;
        } else {
            return false;
        }

    } else if (file_exists($dir)) {
        return (is_writable($dir));
    }
}

?>