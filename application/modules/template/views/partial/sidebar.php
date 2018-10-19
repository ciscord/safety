<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<!-- sidebar -->
	<section class="sidebar">
        <!-- Sidebar user panel  -->
        <div class="user-panel">
            <div class=" image" style="text-align: center;">
             
				<img  src="<?php
					$image_name=$this->config->item('app_logo');
					$default_image_name="logo.png";
					$upload_path=site_url("uploads");
					if($image_name!="")
					echo  $upload_path."/".$image_name;
					else
					echo $upload_path."/".$default_image_name;
					?>?<?php echo time(); ?>" id="app_logo" alt="logo" height="250" >

			</div>
            
			<div class="info" style="margin:auto; text-align: center; left: 0; right: 0; padding: 10px 0px 0px 0px;">
              	<p><?php echo anchor("dashboard/home/logout",$this->lang->line("common_logout"), array('class' => 'button2 button-icon button-icon-rarrow')); ?></i></p>
            </div>
        </div>

          <!-- Sidebar Menu -->
		  <ul class="sidebar-menu">
            
			<li class="treeview">
				<a href="<?php echo site_url()."dashboard/dashboards"; ?>"> 
					<i class="fa fa-tachometer-alt"></i>
					<span>Dashboard</span>
				</a>
			</li>
						    
		
			<li class="treeview">
				<a href="<?php echo site_url()."users/users"; ?>">
					<i class="fa fa-user"></i>
					<span>Admins</span>
				</a>
			</li>
						    
		
			<li class="treeview">
				<a href="<?php echo site_url()."companies/companies"; ?>">
					<i class="fa fa-users"></i>
					<span>Companies</span>
				</a>
			</li>
						    
		
			<li class="treeview">
				<a href="<?php echo site_url()."eventcategories/eventcategories"; ?>">
					<i class="fa fa-check-circle"></i>
					<span>Event Categories</span>
				</a>
			</li>

			<li class="treeview">
				<a href="<?php echo site_url()."reports/user_reports"; ?>">
					<i class="fa fa-chart-pie"></i>
					<span>Reports</span>
				</a>
			</li>
			
		
					
          </ul>
        </section>
        <!-- /.sidebar -->