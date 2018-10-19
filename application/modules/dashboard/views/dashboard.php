
    <div class="content-wrapper">
         <!-- Content Header (Page header) -->
        <section class="content-header">
            <div id="page_title"><?php  echo $this->lang->line("module_dashboards");  ?> </div>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
        </section>

         <!-- Main content -->
         <section class="content">
            
            <div class="box box-info profile_form">
            <ul id="error_message_box"></ul>
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                      <div class="inner">
                          <h3><?php echo $total_companies; ?></h3>
                          <p><?php  echo $this->lang->line("dashboard_companies");  ?></p>
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
                          <h3><?php echo $total_admins; ?></h3>
                          <p><?php  echo $this->lang->line("dashboard_admins");  ?></p>
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
                          <p><?php  echo $this->lang->line("dashboard_locations");  ?></p>
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
                          <h3><?php echo $total_users; ?></h3>
                          <p><?php  echo $this->lang->line("dashboard_users");  ?></p>
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
                <h4><b>ADMIN USERS</b></h4>
                <div id="table_holder" class="table-responsive">
                  <?php echo $manage_table; ?>
                </div>
                <!-- right col -->
              </div>

              <div class="row">
                <!-- Left col -->
                <h4><b>COMPANIES</b></h4>
                <div id="table_holder" class="table-responsive">
                  <?php echo $manage_company_table; ?>
                </div>
                <!-- right col -->
              </div>

              <!-- /.row (main row) -->
            </div>
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

 