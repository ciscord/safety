<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['post_controller_constructor'][] = array(
    'class' => '',
    'function' => 'load_config',
    'filename' => 'load_config.php',
    'filepath' => 'hooks'
);

$hook['post_controller_constructor'][] = array(
    'class' => 'Statistics',
    'function' => 'log_activity',
    'filename' => 'statistics.php',
    'filepath' => 'hooks'
);

$hook['post_controller_constructor'][] = array(
	'class'    => 'ProfilerEnabler',
	'function' => 'enableProfiler',
	'filename' => 'hooks.profiler.php',
	'filepath' => 'hooks',
	'params'   => array()
);

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */