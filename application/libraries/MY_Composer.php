<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Library MY_Composer
 *
 * Load dependencies via composer
 */
class MY_Composer
{
    function __construct()
    {
        include APPPATH.'/third_party/autoload.php';
    }
}