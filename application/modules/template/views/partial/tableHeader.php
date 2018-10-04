<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script src="<?php echo base_url();?>assets/js/jquery.form.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
<script src="<?php echo base_url();?>assets/js/jquery.tablesorter.min.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
<script src="<?php echo base_url();?>assets/js/jquery.autocomplete.js" type="text/javascript" language="javascript" charset="UTF-8"></script>

<script src="<?php echo base_url();?>assets/js/thickbox.js" type="text/javascript" language="javascript" charset="UTF-8"></script>
<script src="<?php echo base_url();?>assets/js/common.js" type="text/javascript" language="javascript" charset="UTF-8"></script>

<script>
$(document).ready(function()
{
	$('#sortable_table td input[type="checkbox"]').after("<label for='checkbox'></label>");
	$('#sortable_table th input[type="checkbox"]').after("<label for='select_all'></label>");
	$('input[type="checkbox"]').addClass("filled-in");
});
</script>