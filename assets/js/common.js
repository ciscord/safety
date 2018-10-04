/* Custom Js */

function get_dimensions() 
{
	var dims = {width:0,height:0};
	
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    dims.width = window.innerWidth;
    dims.height = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    dims.width = document.documentElement.clientWidth;
    dims.height = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    dims.width = document.body.clientWidth;
    dims.height = document.body.clientHeight;
  }
  
  return dims;
}

function set_feedback(text, classname, keep_displayed)
{
	if(text!='')
	{
		$('#feedback_bar').removeClass();
		$('#feedback_bar').addClass(classname);
		$('#feedback_bar').text(text);
		$('#feedback_bar').css('opacity','1');

		if(!keep_displayed)
		{
			$('#feedback_bar').fadeTo(5000, 1);
			$('#feedback_bar').fadeTo("fast",0);
		}
	}
	else
	{
		$('#feedback_bar').css('opacity','0');
	}
}

/* Manage tables */
function checkbox_click(event)
{
	event.stopPropagation();
	if($(event.target).attr('checked'))
	{
		$(event.target).parent().parent().find("td").addClass('selected').css("backgroundColor","");		
	}
	else
	{
		$(event.target).parent().parent().find("td").removeClass();		
	}
}

function enable_search(suggest_url,confirm_search_message)
{
	//Keep track of enable_email has been called
	if(!enable_search.enabled)
		enable_search.enabled=true;

	$('#search').click(function()
    {
    	$(this).attr('value','');
    });

    $("#search").autocomplete(suggest_url,{max:100,delay:10, selectFirst: false});
    $("#search").result(function(event, data, formatted)
    {
	
		do_search(true);
    });
    
	$('#search_form').submit(function(event)
	{
		event.preventDefault();

		if(get_selected_values().length >0)
		{
			if(!confirm(confirm_search_message))
				return;
		}
		do_search(true);
	});
}
enable_search.enabled=false;

function do_search(show_feedback,on_complete)
{

    //update_sortable_table();
	//If search is not enabled, don't do anything
	if(!enable_search.enabled)
		return;
		$("#pagging").html("");
        $("#search_clear").fadeIn(500);
             
		
	if(show_feedback)
		$('#spinner').show();
		
	$('#sortable_table tbody').load($('#search_form').attr('action'),{'search':$('#search').val()},function()
	{
		if(typeof on_complete=='function')
			on_complete();	
		$('#spinner').hide();
		//re-init elements in new table, as table tbody children were replaced
		tb_init('#sortable_table a.thickbox');
		update_sortable_table();	
		enable_row_selection();		
		$('#sortable_table tbody :checkbox').click(checkbox_click);
		$("#select_all").attr('checked',false);
		//
		$('#sortable_table td input[type="checkbox"]').after("<label for='checkbox'></label>");
	$('#sortable_table th input[type="checkbox"]').after("<label for='select_all'></label>");
	$('input[type="checkbox"]').addClass("filled-in");
		//
	});
}



function enable_checkboxes()
{
	$('#sortable_table tbody :checkbox').click(checkbox_click);
}



function enable_delete(confirm_message,none_selected_message)
{
	
	//Keep track of enable_delete has been called
	if(!enable_delete.enabled)
		enable_delete.enabled=true;
	
	$('#delete').click(function(event)
	{
		event.preventDefault();
		if($("#sortable_table tbody :checkbox:checked").length >0)
		{
		
		     jConfirm(confirm_message, 'Confirmation Dialog', function(r) {
			 if(r==true)
			 do_delete($("#delete").attr('href'));
           
           });

		}
		else
		{
			jAlert(none_selected_message);
		}
	});
}
enable_delete.enabled=false;

function enable_undo_delete(confirm_message,none_selected_message)
{
	
	//Keep track of undo_enable_delete has been called
	if(!enable_undo_delete.enabled)
		enable_undo_delete.enabled=true;
	
	$('#undo_delete').click(function(event)
	{
		event.preventDefault();
		if($("#sortable_table tbody :checkbox:checked").length >0)
		{
		
		     jConfirm(confirm_message, 'Confirmation Dialog', function(r) {
			 if(r==true)
			 do_delete($("#undo_delete").attr('href'));
           
           });

		}
		else
		{
			jAlert(none_selected_message);
		}
	});
}
enable_undo_delete.enabled=false;

function do_delete(url)
{

	//If delete is not enabled, don't do anything
	if(!enable_delete.enabled)
		return;
	
	var row_ids = get_selected_values();
	
	var selected_rows = get_selected_rows();
	$.post(url, { 'ids[]': row_ids },function(response)
	{
	 
		//delete was successful, remove checkbox rows
		if(response.success)
		{
			
			$(selected_rows).each(function(index, dom)
			{
				$(this).find("td").animate({backgroundColor:"green"},1200,"linear")
				.end().animate({opacity:0},1200,"linear",function()
				{
					$(this).remove();
					//Re-init sortable table as we removed a row
					update_sortable_table();
					
				});
			});	
			set_feedback(response.message,'success_message',false);	
		}
		else
		{
			set_feedback(response.message,'error_message',false);	
		}
		

	},"json");
}


function do_delete_with_reload(url)
{

	//If delete is not enabled, don't do anything
	if(!enable_delete.enabled)
		return;
	
	var row_ids = get_selected_values();
	var selected_rows = get_selected_rows();
	$.post(url, { 'ids[]': row_ids },function(response)
	{
	
		//delete was successful, remove checkbox rows
		if(response.success)
		{
			
			$(selected_rows).each(function(index, dom)
			{
				$(this).find("td").animate({backgroundColor:"green"},1200,"linear")
				.end().animate({opacity:0},1200,"linear",function()
				{
					$(this).remove();
					//Re-init sortable table as we removed a row
					update_sortable_table();
					
					
				});
			});	
			set_feedback(response.message,'success_message',false);	
			location.reload();
		}
		else
		{
		//alert(response);
			set_feedback(response.message,'error_message',false);	
			location.reload();
		}
		

	},"json");
	//});
}



function enable_select_all()
{
	//Keep track of enable_select_all has been called
	if(!enable_select_all.enabled)
		enable_select_all.enabled=true;

	$('#select_all').click(function()
	{
		if($(this).attr('checked'))
		{	
			$("#sortable_table tbody :checkbox:enabled").each(function()
			{
				$(this).attr('checked',true);
				$(this).parent().parent().find("td").addClass('selected').css("backgroundColor","");

			});
		}
		else
		{
			$("#sortable_table tbody :checkbox:enabled").each(function()
			{
				$(this).attr('checked',false);
				$(this).parent().parent().find("td").removeClass();				
			});    	
		}
	 });	
}

function enable_row_selection(rows)
{
	//Keep track of enable_row_selection has been called
	if(!enable_row_selection.enabled)
		enable_row_selection.enabled=true;
	
	if(typeof rows =="undefined")
		rows=$("#sortable_table tbody tr:not(.disabled_row)");
	
	rows.hover(
		function row_over()
		{
			$(this).find("td").addClass('over').css("backgroundColor","");
			$(this).css("cursor","pointer");
		},
		
		function row_out()
		{
			if(!$(this).find("td").hasClass("selected"))
			{
				$(this).find("td").removeClass();
			}
		}
	);
	
	rows.click(function row_click(event)
	{	

		var checkbox = $(this).find(":checkbox");
		checkbox.attr('checked',!checkbox.attr('checked'));

		if(checkbox.attr('checked'))
		{
			$(this).find("td").addClass('selected').css("backgroundColor","");
		}
		else
		{
			$(this).find("td").removeClass();
		}
	});
}
enable_row_selection.enabled=false;




function update_sortable_table()
{
	//let tablesorter know we changed <tbody> and then triger a resort
	$("#sortable_table").trigger("update");
	
	if(typeof $("#sortable_table")[0].config!="undefined")
	{
		var sorting = $("#sortable_table")[0].config.sortList; 		
		$("#sortable_table").trigger("sorton",[sorting]);
	}
}

function update_sortable_table2()
{
	//let tablesorter know we changed <tbody> and then triger a resort
	$("#sortable_table2").trigger("update");
	
	if(typeof $("#sortable_table2")[0].config!="undefined")
	{
		var sorting = $("#sortable_table2")[0].config.sortList; 		
		$("#sortable_table2").trigger("sorton",[sorting]);
	}
}

function update_row(row_id,url)
{
	$.post(url, { 'row_id': row_id },function(response)
	{ 
		//Replace previous row
		var row_to_update = $("#sortable_table tbody tr :checkbox[value="+row_id+"]").parent().parent();
		row_to_update.replaceWith(response);	
		reinit_row(row_id);
		hightlight_row(row_id);
	});
}

function reinit_row(checkbox_id)
{
	var new_checkbox = $("#sortable_table tbody tr :checkbox[value="+checkbox_id+"]");
	var new_row = new_checkbox.parent().parent();
	enable_row_selection(new_row);
	//Re-init some stuff as we replaced row
	update_sortable_table();
	tb_init(new_row.find("a.thickbox"));
	//re-enable e-mail
	new_checkbox.click(checkbox_click);	
}

function hightlight_row(checkbox_id)
{

	var new_checkbox = $("#sortable_table tbody tr :checkbox[value="+checkbox_id+"]");
	new_checkbox.after("<label for='checkbox'></label>");
	new_checkbox.addClass("filled-in");
	
	var new_row = new_checkbox.parent().parent();
   new_row.find("td").animate({opacity:"0"},"slow","linear")
		.animate({opacity:"0.5"},500)
		.animate({opacity:"1"},"slow","linear");
		 
 
}

function get_selected_values()
{
	var selected_values = new Array();
	$("#sortable_table tbody :checkbox:checked").each(function()
	{
		selected_values.push($(this).val());
	});
	return selected_values;
}
function get_selected_values2()
{
	var selected_values = new Array();
	$("#sortable_table2 tbody :checkbox:checked").each(function()
	{
		selected_values.push($(this).val());
	});
	return selected_values;
}
function get_unselected_values2()
{
var selected_values = new Array();
 unselected_values = "";
if($("#sortable_table2 tbody :checkbox:not(:checked)").length >0)
		{
		
	var unselected_values = new Array();
	$("#sortable_table2 tbody :checkbox:not(:checked)").each(function()
	{
		unselected_values.push($(this).val());
	});
	
	}
	return unselected_values;
}


function get_selected_rows() 
{ 
	var selected_rows = new Array(); 
	$("#sortable_table tbody :checkbox:checked").each(function() 
	{ 
		selected_rows.push($(this).parent().parent()); 
	}); 
	return selected_rows; 
}

function get_visible_checkbox_ids()
{
	var row_ids = new Array();
	$("#sortable_table tbody :checkbox").each(function()
	{
		row_ids.push($(this).val());
	});
	return row_ids;
}