
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>
               <?php  echo $this->lang->line("module_dashboards");  ?> 
            </h1>
         </section>
         <!-- Main content -->
         <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
               <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                     <div class="inner">
                        <h3><?php echo $total_users; ?></h3>
                        <p><?php  echo $this->lang->line("dashboard_total_users");  ?></p>
                     </div>
                     <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                     </div>
                     <a  href="<?php echo site_url("reports/user_reports/user_all_report"); ?>"  class="small-box-footer"><?php  echo $this->lang->line("dashboard_more_info");  ?> <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                     <div class="inner">
                        <h3><?php echo $active_users; ?></h3>
                        <p><?php  echo $this->lang->line("dashboard_active_users");  ?></p>
                     </div>
                     <div class="icon">
                        <i class="ion-person-stalker"></i>
                     </div>
                     <a  href="<?php echo site_url("reports/user_reports/user_active_report"); ?>" class="small-box-footer"><?php  echo $this->lang->line("dashboard_more_info");  ?> <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                     <div class="inner">
                        <h3><?php echo $deactive_users; ?></h3>
                        <p><?php  echo $this->lang->line("dashboard_deactivated_users");  ?></p>
                     </div>
                     <div class="icon">
                        <i class="ion-locked"></i>
                     </div>
                     <a href="<?php echo site_url("reports/user_reports/user_deactvated_report"); ?>" class="small-box-footer"><?php  echo $this->lang->line("dashboard_more_info");  ?> <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red">
                     <div class="inner">
                        <h3><?php echo $deleted_users; ?></h3>
                        <p><?php  echo $this->lang->line("dashboard_deleted_users");  ?></p>
                     </div>
                     <div class="icon">
                        <i class="ion ion-trash-a"></i>
                     </div>
                     <a  href="<?php echo site_url("reports/user_reports/user_deleted_report"); ?>" class="small-box-footer"><?php  echo $this->lang->line("dashboard_more_info");  ?> <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
               <!-- Left col -->
               <section class="col-lg-7 connectedSortable">
                  <!-- Custom tabs (Charts with tabs)-->
                  <div class="nav-tabs-custom">
                     <!-- Tabs within a box -->
                     <ul class="nav nav-tabs pull-right">
                        <li class="pull-left header"><i class="fa fa-inbox"></i> Users</li>
                     </ul>
                     <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="revenue-chart"  ></div>
                        <div class="chart tab-pane" id="sales-chart"  ></div>
                     </div>
                  </div>
                  <!-- /.nav-tabs-custom -->
                  <!-- TO DO List -->
                  <div class="box box-primary">
                     <div class="box-header">
                        <i class="ion ion-clipboard"></i>
                        <h3 class="box-title">Month Summary</h3>
                     </div>
                     <!-- /.box-header -->
                     <div class="box-body">
                        <ul class="todo-list">
                           <li>
                              <!-- drag handle -->
                              <span class="handle">
                              <i class="fa fa-ellipsis-v"></i>
                              <i class="fa fa-ellipsis-v"></i>
                              </span>
                              <!-- todo text -->
                              <h4 class="text-center"> Total registration in month </h4>
                              <!-- Emphasis label -->
                              <h1 class="text-center "> <?php echo $total_reg_for_month; ?> </h1>
                              <!-- General tools such as edit or delete-->
                           </li>
                        </ul>
                     </div>
                     <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                  <!-- Calendar -->
                  <div class="box box-solid bg-green-gradient">
                     <div class="box-header">
                        <i class="fa fa-calendar"></i>
                        <h3 class="box-title">Calendar</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                           <!-- button with a dropdown -->
                           <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                           <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        <!-- /. tools -->
                     </div>
                     <!-- /.box-header -->
                     <div class="box-body no-padding">
                        <!--The calendar -->
                        <div id="calendar" ></div>
                     </div>
                     <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
               </section>
               <!-- /.Left col -->
               <!-- right col (We are only adding the ID to make the widgets sortable)-->
               <section class="col-lg-5 connectedSortable">
                  <!-- Map box -->
                  <div class="box box-solid bg-light-blue-gradient">
                     <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                           <button class="btn btn-primary btn-sm pull-right map-button" data-widget="collapse" data-toggle="tooltip" title="Collapse" ><i class="fa fa-minus"></i></button>
                        </div>
                        <!-- /. tools -->
                        <i class="fa fa-map-marker"></i>
                        <h3 class="box-title">
                           Users by Country
                        </h3>
                     </div>
                     <div class="box-body">
                        <div id="world-map"  ></div>
                     </div>
                     <!-- /.box-body-->
                     <div class="box-footer no-border">
                        <div class="row">
                           <div class="col-xs-12 text-center users-country-list" >
                              <div class="knob-label">
                                 <h5>Users From</h5>
                                 <?php echo $country_name; ?>
                              </div>
                           </div>
                           <!-- ./col -->
                        </div>
                        <!-- /.row -->
                     </div>
                  </div>
                  <!-- /.box -->
                  <!-- solid sales graph -->
                  <div class="box box-solid bg-teal-gradient">
				   <div class="box-header">
                  <i class="fa fa-th"></i>
                  <h3 class="box-title">Active Users</h3>
                  <div class="box-tools pull-right">
                    <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                     <div class="box-body border-radius-none">
                        <div class="chart" id="line-chart"  ></div>
                     </div>
                     <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
               </section>
               <!-- right col -->
            </div>
            <!-- /.row (main row) -->
         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
           <!-- end content-wrapper -->
   
 
   <!-- ./wrapper -->
 
   <!-- Morris.js charts -->
   <script src="<?php echo base_url();?>assets/adminlte/dist/js/raphael-min.js"></script>
   <script src="<?php echo base_url();?>assets/adminlte/plugins/morris/morris.min.js"></script>
   <!-- Sparkline -->
   <script src="<?php echo base_url();?>assets/adminlte/plugins/sparkline/jquery.sparkline.min.js"></script>
   <!-- jvectormap -->
   <script src="<?php echo base_url();?>assets/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
   <script src="<?php echo base_url();?>assets/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
   <!-- jQuery Knob Chart -->
   <script src="<?php echo base_url();?>assets/adminlte/plugins/knob/jquery.knob.js"></script>
   <!-- daterangepicker -->
   <script src="<?php echo base_url();?>assets/adminlte/dist/js/moment.min.js"></script>
   <script src="<?php echo base_url();?>assets/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
   <!-- datepicker -->
   <script src="<?php echo base_url();?>assets/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
   <!-- Bootstrap WYSIHTML5 -->
   <script src="<?php echo base_url();?>assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
   <!-- Slimscroll -->
   <script src="<?php echo base_url();?>assets/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>

   <?php //  $this->load->view("partial/footer_links"); ?>

<script type='text/javascript'>
   $(document).ready(function()
   {
       "use strict";
   	var myvalues = [2  ];
       $('#sparkline-1').sparkline(myvalues, {
       type: 'line',
       lineColor: '#92c1dc',
       fillColor: "#ebf4f9",
       height: '50',
       width: '320'
     });
     var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
   
   	   /*  ------ Total registration graph --- Morris.js Charts ----- */
     var area = new Morris.Area({
       element: 'revenue-chart',
       resize: true,
       data: [
   	
   	  <?php
      $cmonth=date("m");  ;$cyear=date("Y"); 
      for ($i=$cmonth;$i>0;$i--) {
          $i = sprintf("%02d", $i);
       $dates=$cyear."-".$i;
       $regForMonth=$this->Dashboard->totalRegForMonth($dates);
       echo "{y: '".$dates."', item1: ".$regForMonth."},";
      }
      ?>
   
       ],
       xkey: 'y',
   	xLabelFormat: function (y) { return months[y.getMonth()]; },
       ykeys: ['item1'],
       labels: ['Registration'],
       lineColors: ['#A0E0A9', '#3c8dbc'],
       hideHover: 'auto'
     });
     	  /*------ Active user graph-------- */
     var line = new Morris.Line({
       element: 'line-chart',
       resize: true,
       data: [
         <?php
      $cmonth=date("m");  ;$cyear=date("Y"); 
      for ($i=$cmonth;$i>0;$i--) {
       $i = sprintf("%02d", $i);
       $dates=$cyear."-".$i;
       $activeUsersForMonth=$this->Dashboard->totalActiveUsersForMonth($dates);
       echo "{y: '".$dates."', item1: ".$activeUsersForMonth."},";
      }
      ?>
       ],
       xkey: 'y',
   	xLabelFormat: function (y) { return months[y.getMonth()]; },
       ykeys: ['item1'],
       labels: ['Active Users'],
       lineColors: ['#efefef'],
       lineWidth: 2,
       hideHover: 'auto',
       gridTextColor: "#fff",
       gridStrokeWidth: 0.4,
       pointSize: 4,
       pointStrokeColors: ["#efefef"],
       gridLineColor: "#efefef",
       gridTextFamily: "Open Sans",
       gridTextSize: 10
     });
     
       var visitorsData = {
   		
           <?php
      $rows=$this->Dashboard->userbyCountry();
      foreach ($rows->result() as $row) {
          echo "'".$counts=$row->country_code."': ". $counts=$row->counts." ,";
      }	
         ?> 
     };
     /* ------ World map ----*/
     $('#world-map').vectorMap({
       map: 'world_mill_en',
       backgroundColor: "transparent",
       regionStyle: {
         initial: {
           fill: '#e4e4e4',
           "fill-opacity": 1,
           stroke: 'none',
           "stroke-width": 0,
           "stroke-opacity": 1
         }
       },
       series: {
         regions: [{
             values: visitorsData,
             scale: ["#92c1dc", "#ebf4f9"],
             normalizeFunction: 'polynomial'
           }]
       },
       onRegionLabelShow: function (e, el, code) {
         if (typeof visitorsData[code] != "undefined")
           el.html(el.html() + ': ' + visitorsData[code] + ' registrations');
       }
     });
	 
	   //The Calender
  $("#calendar").datepicker();
   
     });
   
</script>

 