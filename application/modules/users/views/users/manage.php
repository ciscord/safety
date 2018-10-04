<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<script type="text/javascript">
   $(document).ready(function() 
   { 
       var csfrData = {};
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
       enable_search('<?php echo site_url("$controller_path/suggest")?>','<?php echo $this->lang->line("common_confirm_search")?>');
       enable_delete('<?php echo $this->lang->line("profiles_confirm_delete")?>','<?php echo $this->lang->line("profiles_none_selected")?>');
   	
   
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
   				7: { sorter: false},
   				8: { sorter: false} 
   			} 
   
   		}); 
   	}
   }
   
   function post_person_form_submit(response)
   {
   
   	if(!response.success)
   	{
   		//Error on saving
   	}
   	else
   	{
   	tb_remove();
   		//This is an update, just update one row
   		if(jQuery.inArray(response.user_id,get_visible_checkbox_ids()) != -1)
   		{
   		
   			update_row(response.user_id,'<?php echo site_url("$controller_path/get_row")?>');
			setTimeout(function(){ init_table_sorting(); }, 500);
   			set_feedback(response.message,'success_message',false);	
   			
   		}
   		else //refresh entire table
   		{
   				set_feedback(response.message,'success_message',false);	
                   location.reload();				
   		}
   	}
   }
</script>
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
               <div id="title" class="float_left"><?php echo $this->lang->line('common_list_of').' '.$this->lang->line('module_'.$controller_name); ?></div>
               <div id="new_button">
                  <?php echo anchor("$controller_path/view/-1/width:$form_width",
                     "<div class='big_button float_left'><span>".$this->lang->line('profiles_new')."</span></div>",
                     array('class'=>'thickbox none','title'=>$this->lang->line($controller_name.'_new')));
                     ?>
               </div>
            </div>
            <div id="pagging">
               <?php echo $this->pagination->create_links();?>
            </div>
            <div id="table_action_header">
               <ul>
                  <li class="float_left"><span><?php echo anchor("$controller_path/delete",$this->lang->line("icon_delete")." ".$this->lang->line("common_delete"),array('id'=>'delete')); ?></span></li>
                  <li   class="float_right">
                     <?php
                        echo "<span  id='search_clear' >".anchor("$controller_path/index","Clear Search")."</span>";
                        ?>
                  </li>
                  <li class="float_right">
                   
 
                     <?php echo form_open("$controller_path/search",array('id'=>'search_form')); ?>
                     <input type="text"  placeholder=" Search..." name ='search' id='search'/>
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
         <!-- end content -->
      </div>
  