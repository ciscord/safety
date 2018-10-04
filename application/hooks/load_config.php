<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Loads configuration from database into global CI config
function load_config()
{
	$CI =& get_instance();
	foreach ( $CI->Appconfig->get_all()->result() as $app_config ) {
		$CI->config->set_item( $app_config->key, $app_config->value );
	}
	

    //Load language config
	if ( $CI->config->item( 'language' ) ) {
		$CI->config->set_item( 'language', $CI->config->item( 'language' ) );
        $loaded = $CI->lang->is_loaded;
        $CI->lang->is_loaded = array();

        foreach($loaded as  $key => $item) { 
            $CI->lang->load( str_replace( '_lang.php', '', $key ) );    
        }
	}
}
