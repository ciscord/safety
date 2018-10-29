<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> 
<!-- sidebar -->
	<section class="sidebar">
        <!-- Sidebar user panel  -->
        <div class="user-panel">
     
            
			<div class="info" style="margin:auto; text-align: center; left: 0; right: 0; padding: 10px 0px 0px 0px;">
              	<p>MAIN NAVIGATION</p>
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