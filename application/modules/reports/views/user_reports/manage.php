<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
  ?>
 
<script type="text/javascript">
   $(document).ready(function() 
   {   	var csfrData = {};
        csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
    $(function() {
       // Attach csfr data token
       $.ajaxSetup({
          data: csfrData
       });
   });
       init_table_sorting();
       enable_select_all();
       enable_row_selection();
       enable_search('<?php
      if ($report_function=="user_all_report") echo site_url("$controller_path/suggest");
      else if($report_function=="user_active_report") echo site_url("$controller_path/suggest_active");
      else if($report_function=="user_deactvated_report") echo site_url("$controller_path/suggest_deactvated");
      else if($report_function=="user_deleted_report") echo site_url("$controller_path/suggest_deleted");
      	?>','<?php echo $this->lang->line("common_confirm_search")?>');
    
   }); 
   
   function init_table_sorting()
   {
   	//Only init if there is more than one row
   	if($('.tablesorter tbody tr').length >1)
   	{
   		$("#sortable_table").tablesorter(
   		{ 
   			sortList: [[1,0]], 
   			headers: 
   			{ 
   				0: { sorter: false}, 
   				5: { sorter: false} 
   			} 
   
   		}); 
   	}
   }
   
   
</script>
 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>
               <br>
               <small><br></small>
            </h1>
         </section>
         <!-- Main content -->
         <section class="content">
            <div id="title_bar">
               <div id="title" class="float_left"><?php echo $this->lang->line('module_'.$controller_name); ?></div>
            </div>
            <div id="pagging">
               <?php echo $this->pagination->create_links();?>
            </div>
            <div id="table_action_header">
               <ul>
                  <li  class="float_right">
                     <?php
                        if($report_function=="user_all_report")
                        {
                            echo "<span  id='search_clear'  >".anchor("$controller_path/user_all_report","Clear Search")."</span>";
                        	$search_form="$controller_path/search";
                        }
                        else if($report_function=="user_active_report")
                        {
                        	echo "<span  id='search_clear' >".anchor("$controller_path/user_active_report","Clear Search")."</span>";
                        	$search_form="$controller_path/search_active";
                        }
                        else if($report_function=="user_deactvated_report")
                        {
                        	echo "<span  id='search_clear' >".anchor("$controller_path/user_deactvated_report","Clear Search")."</span>";
                        	$search_form="$controller_path/search_deactvated";
                        }
                        else if($report_function=="user_deleted_report")
                        {
                        	echo "<span  id='search_clear' >".anchor("$controller_path/user_deleted_report","Clear Search")."</span>";
                        	$search_form="$controller_path/search_deleted";
                        }
                        
                        ?>
                  </li>
                  <li class="float_right">
                     <?php echo form_open("$search_form",array('id'=>'search_form')); ?>
                     <input type="text"  placeholder="Search..." name ='search' id='search'/>
                     </form>
                  </li>
               </ul>
            </div>
            <div id="table_holder">
               <?php echo $manage_table; ?>
            </div>
            <div id="feedback_bar"></div>
            </article>
         </section>
         <!-- End content -->
      </div>
     