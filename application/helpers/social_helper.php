<?php

	function load_social()  
	{
		$CI =& get_instance();
		$config =
	    array(
		// set on "base_url" the relative url that point to HybridAuth Endpoint
		'base_url' => '/login/endpoint',

		"providers" => array (
			
			"Google" => array (
				"enabled" => true,
				"keys"    => array ( "id" => $CI->config->item('google_appid'), "secret" => $CI->config->item('google_secret') ),
			),

			"Facebook" => array (
				"enabled" => true,
				"keys"    => array ( "id" => $CI->config->item('facebook_appid'), "secret" => $CI->config->item('facebook_secret')),
			),

			"Twitter" => array (
				"enabled" => true,
				"keys"    => array ( "key" => $CI->config->item('twitter_appid'), "secret" => $CI->config->item('twitter_secret'))
			),

		
		),

 
	);

	return $config;

	}
	
	