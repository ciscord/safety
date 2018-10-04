<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?> <!-- sidebar -->
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
            <div class=" info" style="margin:auto;    text-align: center;    left: 0;
    right: 0;
        padding: 10px 0px 0px 0px;
">
              <p><?php echo anchor("dashboard/home/logout",$this->lang->line("common_logout"), array('class' => 'button2 button-icon button-icon-rarrow')); ?></i></p>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header"><?php foreach($first_name->result() as $name) { echo  $name->first_name; }?></li>
				<?php
			    foreach($allowed_main_modules->result() as $main_module) {
			    ?>
		    <li class="treeview" >
		    <a href="#" > <i class="<?php echo $this->lang->line("main_module_".$main_module->	main_module_id."_icon");?>"></i><span><?php echo $this->lang->line("main_module_".$main_module->	main_module_id);
			$main_module_id=$main_module->main_module_id;
			?></span> <i class="fa fa-angle-left pull-right"></i></a>
		 
			
			<ul  class="treeview-menu">
			<?php
			$allowed_submodules=$this->Module->get_allowed_submodules($main_module_id);
			foreach($allowed_submodules->result() as $sub_module) {
			?>
		    <li  id="<?php echo $sub_module->module_id;?>_menu_act">
 
			 <a href="<?php echo site_url(str_replace('main_module_','',$main_module->name_lang_key)."/"."$sub_module->module_id"); ?>"><i class="fa fa-circle-o"></i>
			<?php echo $this->lang->line("module_".$sub_module->module_id); ?></a></li>
			<?php
			   }
			   ?>
			</ul>
		</li>
		
		<?php
			}
			?>
			
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->