<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
  
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
         <article class="report-article" >
            <header class="major">
            </header>
            <!--     custom  content   -->
            <div id="page_title" >
               <?php echo $this->lang->line('reports_report_input'); ?>
            </div>
            <?php if(isset($error)) { echo "<div class='error_message'>".$error. "</div>"; } ?>
            <?php echo form_open( 'staff_reports/staff_details/',array( 'id'=>'report_form')); ?>
            <div class="field_row clearfix">
               <?php echo form_label($this->lang->line('reports_select_your_report').':', 'report_type',array('class'=>'required wide')); ?>
               <div class='form_field'>
                  <?php 
				   $options=array( ''=> 'select', 'all' => 'All Users', 'active' => 'Active Users', 'deactivated' => 'Deactivated Users', 'deleted' => 'Deleted Users', ); 
				   $js1 = 'id="report_type"  '; 
				  $selected_options=""; 
				  echo form_dropdown('report_type',$options, $selected_options, $js1); ?>
               </div>
            </div>
            <div  >
               <div class="field_row clearfix">
               </div>
            </div>
            <div class="field_row clearfix">
               <br>
               <br>
               <div class="field_row clearfix">
                  <div class='form_field' id="report_mode">
                  </div>
               </div>
               <br>
               <div id='report_sale_type'>
                  <input type="button" class="submit_button" onclick="submit_form()" value="Submit form">
               </div>
               <?php echo form_close(); ?>
               <script type="text/javascript" language="javascript">
    function submit_form() {
     var report_type = document.getElementById("report_type").value;
     if (report_type == "all") {
         $("#report_form").attr("action", window.location + "/user_all_report").submit();
     } else if (report_type == "active") {
         $("#report_form").attr("action", window.location + "/user_active_report").submit();
     } else if (report_type == "deactivated") {
         $("#report_form").attr("action", window.location + "/user_deactvated_report").submit();
         document.getElementById("report_form").submit();
     } else if (report_type == "deleted") {
         $("#report_form").attr("action", window.location + "/user_deleted_report").submit();
     } else {
         jAlert("Missing required field", 'Confirmation Dialog', function(r) {
         });
     }
 }
 
 
               </script>
               <div id="table_holder">
               </div>
               <div id="feedback_bar"></div>
         </article>
      </section>
      <!-- End content -->
      </div>
 
   </div>
   <!-- End wrapper -->
 