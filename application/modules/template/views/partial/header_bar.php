<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>   <!-- Main Header -->
      <header class="main-header">

        <!-- Header Text -->
        <a href="<?php echo site_url()."/login"; ?>" class="logo"><b><?php  echo $this->config->item('company'); ?></b></a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          </a>
          <!-- Navbar Right Logout Menu -->
          <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><span class="hidden-xs">Logout</span></a>
          </li>
        </ul>
      </div>


        </nav> 
      </header>
