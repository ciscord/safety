<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo base_url();?>favicon.png" type="image/x-icon">
	<title> <?php  echo $this->config->item('company'); ?> :: <?php echo  $this->lang->line('module_'.$this->router->fetch_class()) ?> </title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <link href="<?php echo base_url();?>assets/css/materialize.css" rel="stylesheet" type="text/css" /> 
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/UNIFcustom.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
	   <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/adminlte/plugins/fastclick/fastclick.min.js"></script>
	
	

	
	
	