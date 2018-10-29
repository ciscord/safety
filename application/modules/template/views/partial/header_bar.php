<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>   <!-- Main Header -->
      <header class="main-header">

        <!-- Header Text -->
        
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          
 
            <img  src="<?php
              $image_name=$this->config->item('app_logo');
              $default_image_name="logo.png";
              $upload_path=site_url("uploads");
              if($image_name!="")
              echo  $upload_path."/".$image_name;
              else
              echo $upload_path."/".$default_image_name;
              ?>?<?php echo time(); ?>" id="app_logo" alt="logo" height="50" width="50">
              <span class="main-title"> SAFETY & ENVIRONMENTAL TRACKER </span>
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
                <?php echo anchor("dashboard/home/logout",$this->lang->line("common_logout"), array('class' => 'button2 button-icon button-icon-rarrow')); ?></i>
              </li>
            </ul>
          </div>


        </nav> 
      </header>
