
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div id="page_title">
            <?php  echo $this->lang->line("common_location");
            echo str_repeat('&nbsp;', 3);
            $title = ($location_id == -1) ? $this->lang->line("common_add") : $this->lang->line("common_edit");

            echo $title;?> 
        </div>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tachometer-alt"></i> <?php  echo $this->lang->line("common_home");?></a></li>
            <li class="active"><?php  echo $this->lang->line("common_companies");?></li>
            <li class="active"> <?php 
                echo $title;
            ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
    <?php
        echo form_open('companies/companies/addlocation' ,array('id'=>'add_location_form'));
    ?>
    <input type="hidden" id="location_id" name="location_id" value=<?php echo $location_id?>>
    <input type="hidden" id="emergency_locations" name="emergency_locations">

    <div class="row">
        <div class="col-lg-8 col-sm-8">        
            <div class="row">
                <div class="col-lg-6 col-sm-6">        
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('common_name').'*', 'location_name',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'location_name',
                            'class' => 'form-control',
                            'id'=>'location_name',
                            'value'=>$location_info->location_name));?>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('common_company').'*', 'company_id',array('class'=>'wide')); ?>
                        <?php 
                        $options = array();

                        foreach ($companies->result() as $data_row) {
                            $options[$data_row->company_id]  = $data_row->name ;
                        }
                        
                        $js = 'id="company_id" class="form-control" ';

                        echo form_dropdown('company_id', $options, $location_info->location_company_id, $js);
                        ?>
                    </div>
                    
                </div>
            </div>

            <!-- second row -->
            <div class="row">
                <div class="col-lg-6 col-sm-6">        
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('common_address'), 'location_address',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'location_address',
                            'class' => 'form-control',
                            'id'=>'location_address',
                            'value'=>$location_info->location_address));?>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6">        
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('common_address_2'), 'location_address2',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'location_address2',
                            'class' => 'form-control',
                            'id'=>'location_address2',
                            'value'=>$location_info->location_address2));?>
                    </div>
                </div>
            </div>

            <!-- third row -->
            <div class="row">
                <div class="col-lg-4 col-sm-4">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('profiles_city'), 'location_city',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'location_city',
                            'class' => 'form-control',
                            'id'=>'location_city',
                            'value'=>$location_info->location_city));?>
                    </div>
                    
                </div>

                <div class="col-lg-2 col-sm-2">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('profiles_state'), 'location_state',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'location_state',
                            'class' => 'form-control',
                            'id'=>'location_state',
                            'value'=>$location_info->location_state));?>
                    </div>
                    
                </div>

                <div class="col-lg-2 col-sm-2">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('profiles_zip'), 'location_zip',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'location_zip',
                            'class' => 'form-control',
                            'id'=>'location_zip',
                            'value'=>$location_info->location_zip));?>
                    </div>
                    
                </div>

                <div class="col-lg-2 col-sm-2">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('common_latitude'), 'latitude',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'latitude',
                            'class' => 'form-control',
                            'id'=>'latitude',
                            'value'=>$location_info->latitude));?>
                    </div>
                    
                </div>

                <div class="col-lg-2 col-sm-2">                
                    <div class='form-group'>
                    <?php echo form_label($this->lang->line('common_longitude'), 'longitude',array('class'=>'wide')); ?>
                        <?php echo form_input(array(
                            'name'=>'longitude',
                            'class' => 'form-control',
                            'id'=>'longitude',
                            'value'=>$location_info->longitude));?>
                    </div>
                    
                </div>

            </div>
            <!-- // assign users -->
            <div class="row">
                <div class="col-lg-3 col-sm-3">                
                  
                    <div class="form-group">
                        
                    <?php echo form_label($this->lang->line('common_assign_users'), 'location_city',array('class'=>'wide')); ?>
                        <div class="controls">
                            <select name="userids[]" multiple="multiple" id="userids" class="multiselect-ui form-control" >                              
                            <?php 
                            $options = array();
                            $selected = false;    
                            $selectedUsers = array();    
                            foreach ($assign_users->result() as $data_row ) {
                                array_push($selectedUsers, $data_row->user_id);
                            }
                            foreach ($companyusers->result() as $data_row) {
                                array_push($options, $data_row);//->user_id]  = $data_row->first_name.' '. $data_row->last_name;
                            }
                            foreach($options as $companyuser):?>                                              
                                <?php $selected = in_array($companyuser->user_id, $selectedUsers) ? " selected " : null;?>
                                    <option value="<?=$companyuser->user_id?>"
                                        <?=$selected?> ><?=$companyuser->first_name.' '.$companyuser->last_name?>
                                    </option>                              
                            <?php endforeach?>
                            </select>                                           
                        </div>
                    </div>  
                </div>
                
                <div class="col-lg-8 col-sm-8">
                    <div class='form-group'>
                    <?php
                    echo form_label('&nbsp', ' ',array('class'=>'wide'));
                    $js = 'class="form-control medium_button" data-toggle="modal" data-target="#myModal"';
                    echo form_button('add_emergency_location', $this->lang->line('common_add_emergency_location'), $js); ?>
                    
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <table id="dynamicTable1">
                        <tbody>

                            <tr>
                                <th id="locationname" style="display:none;">locationname</th>
                                <th id="locationtype" style="display:none;">locationtype</th>
                            </tr>

                            <?php
                            foreach ($emergency_list->result() as $data_row ) {
                                echo '<tr id="'.$data_row->emergency_id.'"><td><input type="text" id="name" class="normal-text" readonly value="'.$data_row->emergency_name.'"/></td>';
                                echo '<td><select class="normal-text" disabled>';
                                if ($data_row->emergency_type == 0) {
                                    echo '<option value="0" selected>Hospital</option>';
                                }else if ($data_row->emergency_type == 1) {
                                    echo '<option value="1" selected>Urgent Care</option>';
                                }else {
                                    echo '<option value="">Select type</option>';
                                }                         
                                echo '</select></td><td><a class="remove"><i class="fa fa-trash-alt"></i></a></td></tr>';
                            }

                            ?>
                        </tbody>
                    
                    </table>

                </div>

                <table class="samplerow" style="display:none">
                    <tr>
                    <td><input type="text" id="name" class='normal-text' readonly/></td>
                    <td><select class="normal-text" disabled>
                        <option value="">Select type</option>
                        <option value="0">Hospital</option>
                        <option value="1">Urgent Care</option>
                    </select></td>
                    <td><a class="remove"><i class="fa fa-trash-alt"></i></a></td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="col-lg-4 col-sm-4">                
            <!-- map -->
    <!-- <input id="lat" name="lat" val="40.713956" />Long:
    <input id="long" name="long" val="74.006653" /> -->

            <div id="map_canvas" style="width: 500px; height: 250px;"></div>
        </div>
                         

    </div>

    <div id="new_button">
    <?php
        $buttonTitle = ($location_id == -1) ? $this->lang->line('profiles_submit') : $this->lang->line('common_update');
        echo form_submit(array(
            'name'=>'submit',
            'id'=>'submit',
            'value'=> $buttonTitle,
            'class'=>'big_button float_left')
        );
        
    ?>

    

    </div>

</fieldset>
    <?php echo form_close();?>
    </section>
    <!-- /.content-wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title white-color" id="myModalLabel"><?php echo $this->lang->line('common_add_emergency_location') ?></h4>
                </div>
                <div class="modal-body">
            
                     <input type="hidden" id="location_id" name="location_id" value=<?php echo $location_id?>>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <input type="text" name="emergency_location_name" value="" class="form-control" id="emergency_location_name" placeholder="Select location">
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <select name="emergency_location_type" id="emergency_location_type" class="form-control valid ">
                                <option value="">Select type</option>
                                <option value="0">Hospital</option>
                                <option value="1">Urgent Care</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <input type="button" class='btn btn-primary' id="addrow" value="<?php echo $this->lang->line('common_add');?>" />
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</div>   
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaDN8V8fWdci23zVDWUZLIntbDvH6f-vE&callback=initialize"></script>
 -->
<script async defer src="https://maps.googleapis.com/maps/api/js?callback=initialize"></script>
<script type='text/javascript'>

    var map;
    var geocoder;

    function initialize() {
        geocoder = new google.maps.Geocoder();
        var myLatlng = new google.maps.LatLng(40.713956, -74.006653);

        var myOptions = {
            zoom: 8,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

        var marker = new google.maps.Marker({
            draggable: true,
            position: myLatlng,
            map: map,
            title: "Your location"
        });

        google.maps.event.addListener(marker, 'dragend', function (event) {

            codeLatLng(event.latLng);
            // document.getElementById("lat").value = event.latLng.lat();
            // document.getElementById("long").value = event.latLng.lng();
        });
    }

    function codeLatLng(latlng, title, imageURL) {
        var lat = latlng.lat();
        var lng = latlng.lng();
        var latlng = new google.maps.LatLng(lat, lng);
        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    document.getElementById("lat").value = results[1];
                    document.getElementById("long").value = results[0];
                    
                } else {
                    alert('No results found');
                }
            } else {
                alert('Geocoder failed due to: ' + status);
            }
        });
    }

    var csfrData = {};
    csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
    $(function() {
        // Attach csfr data token
        $.ajaxSetup({
            data: csfrData
        });
        $('#userids').multiselect({
            includeSelectAllOption: true
        });
    });

    $('#add_location_form').validate({
        submitHandler: function(form) {
            //the table object 
            var table = $("#dynamicTable1")[0];
            
            //display the results
            $("#emergency_locations").val(formToJSON(table));  

            $(form).ajaxSubmit({
                success: function(response) {
                    var str = response.message;
                    var success = response.success;
                    var res = str.replace(/\\n/g, "\n");
                    jAlert(res, 'Confirmation Dialog', function(r) {
                        window.history.back();

                    });
                },
                dataType: 'json'
            });
        },
        errorLabelContainer: "#error_message_box",
        wrapper: "li",
        rules: {
            location_name:
            {
                required:true,
                minlength: 3,
                maxlength: 250
            },
            
        },
        messages: {
            location_name:
            {
                required: "<?php echo $this->lang->line('common_fields_required_message'); ?>",
            },
            
        }
    });


    jQuery(document).ready(function() {
        var id = 0;
        jQuery("#addrow").click(function() {
            id++;           
            var locationname = $('#emergency_location_name').val();
            var emergency_location_type = $('#emergency_location_type').val();
            
            if (locationname == '' || emergency_location_type == '')
                return;
            var row = jQuery('.samplerow tr').clone(true);
            row.find("input:text").val(locationname);
            row.find("input:text").css({
                width: ((locationname.length+1) * 7) + 'px'
            });
            row.find("select").val(emergency_location_type);
            row.attr('id',id); 
            row.appendTo('#dynamicTable1');

            $('#emergency_location_name').val('')
            $('#emergency_location_type').val('')
            $('#myModal').modal('toggle');
            return false;
        });        
        
        $('.remove').on("click", function() {
            var self = this;
            $.confirm({
                title: '',
                content: 'Are you sure you want to delete this Emergency Location?',
                buttons: {
                    close: {
                        text: 'Close',
                        btnClass: 'medium_button',
                        action: function(){
                        }
                    },
                    confirm: {
                        text: 'Confirm',
                        btnClass: 'medium_button',
                        action: function(){
                            $(self).parents("tr").remove();
                        }
                    }
                    
                    
                }
            });

            
        });
    });


    function formToJSON(table){//begin function


        //array to hold the key name
        var keyName;
        
        //array to store the keyNames for the objects
        var keyNames = [];

        //array to store the objects
        var objectArray = [];
        

        //get the number of cols
        var numOfCols = table.rows[0].cells.length;

        //get the number of rows
        var numOfRows = table.rows.length;
        
        //add the opening [ array bracket
        objectArray.push("[");
        
        
        
        //loop through and get the propertyNames or keyNames
        for(var i = 0; i < numOfCols; i++){//begin for loop  
            
            //store the html of the table heading in the keyName variable
            keyName = table.rows[0].cells[i].innerHTML;
            
            //add the keyName to the keyNames array
            keyNames.push(keyName);
            
        }//end for loop
        
            
        
        //loop through rows
        for(var i = 1; i < numOfRows; i++){//begin outer for loop    
            
            //add the opening { object bracket
            objectArray.push("{\n");
                    
            for(var j=0; j < numOfCols; j++){//begin inner for loop   
                
                //extract the text from the input value in the table cell
                var inputValue = table.rows[i].cells[j].children[0].value;
                    
                //store the object keyNames and its values
                objectArray.push("\"" + keyNames[j] + "\":" + "\"" + inputValue + "\"");

                //if j less than the number of columns - 1(<-- accounting for 0 based arrays)
                if(j < (numOfCols - 1)){//begin if then
                
                    //add the , seperator
                    objectArray.push(",\n");
            
                }//end if then    
                
            }//end inner for loop
                
            //if i less than the number of rows - 1(<-- accounting for 0 based arrays)
            if(i < (numOfRows - 1)){//begin if then
            
            //add the closing } object bracket followed by a , separator
            objectArray.push("\n},\n");
            
        } else{
            
            //add the closing } object bracket
            objectArray.push("\n}");
            
            }//end if then else
        
        }//end outer for loop

        //add the closing ] array bracket
        objectArray.push("]");
        
        return objectArray.join("");
    
    
    }//end function

</script>