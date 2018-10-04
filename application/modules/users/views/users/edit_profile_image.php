
  <div id="qunit"></div>
  <div id="qunit-fixture"></div>
  
  <h1 class="center"><?php echo $this->lang->line("profiles_avatar");  ?></h1>
		  
  <div class="container">
      <img id="image"  src="<?php
$image_name=$user_info->profile_image;
$default_image_name="default.png";
$upload_path=site_url("uploads");
if($image_name!="")
 echo $upload_path."/".$image_name;
else
echo $upload_path."/".$default_image_name;?>?<?php echo time(); //to prevent browser image caching ?>" alt="Avatar">
  </div>

		                                      
      
	    <div class="col-md-12 docs-buttons center">
        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" title="Zoom In">
              <span class="fa fa-search-plus"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" title="Zoom Out">
              <span class="fa fa-search-minus"></span>
            </span>
          </button>
        </div>
		
		        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
            <span class="docs-tooltip" data-toggle="tooltip" title="Rotate Left">
              <span class="fa fa-rotate-left"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
            <span class="docs-tooltip" data-toggle="tooltip" title="Rotate Right">
              <span class="fa fa-rotate-right"></span>
            </span>
          </button>
        </div>
		
		<div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
            <span class="docs-tooltip" data-toggle="tooltip" title="Flip Horizontal">
              <span class="fa fa-arrows-h"></span>
            </span>
          </button>
          <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
            <span class="docs-tooltip" data-toggle="tooltip" title="Flip Vertical">
              <span class="fa fa-arrows-v"></span>
            </span>
          </button>
        </div>

   

        <div class="btn-group">
          <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
            <span class="docs-tooltip" data-toggle="tooltip" title="Reset">
              <span class="fa fa-refresh"></span>
            </span>
          </button>
        </div>
		
		
        </div>
 
  <div class="col-md-12 center">
    <div class="btn-group">
      <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
            <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
            <span class="docs-tooltip" data-toggle="tooltip" title="Upload image file">
              <span class="fa fa-upload"></span>
            </span>
          </label>
		  
		       
		  
		  </div> 

   <div class="btn-group btn-group-crop  save"  >
          <button type="button" class="btn btn-primary" data-method="getCroppedCanvas" id="profile_pic_save"  >
            <span class="docs-tooltip" data-toggle="tooltip" id="profile_pic_save_text" title="Save">
              <?php echo $this->lang->line('common_save'); ?>
            </span>
          </button>
         
   </div>		  
		  </div>  
		  
		  
 
  <script>
   $(document).ready(function() {
	   
	 
	 
 
$("#profile_pic_save").on("click", function() {
	

	  document.getElementById("profile_pic_save_text").innerHTML  = "Loading";
      document.getElementById("profile_pic_save").disabled = true;
	  var $image = $('#image');
	  var result = $image.cropper("getCroppedCanvas","", "");
	 

 var post_data = {
        'HTTP_RAW_POST_DATA': result.toDataURL('image/png'),
        '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
    };

	 $.ajax({
    type: 'POST',
    url: '<?php echo site_url('users/users/save_profile_pic')."/".$user_id;?>',
	contentType: "application/json; charset=utf-8",
     data: result.toDataURL('image/png')   ,
    success: function(response){
		  jAlert(response.message, 'Confirmation Dialog', function(r) {
                         tb_remove();
                     });
        
     },
                 dataType: 'json'
});

  
  
  });
    $(function () {
		
      var $image = $('#image');
	
      $image.cropper({
		  minCropBoxHeight: 150,
		  cropBoxResizable: true,
		    autoCropArea: 0.75,
 
		dragMode: 'move',
        built: function () {
			var cropper = $image.data('cropper');
            var options = cropper.options;
	        options["viewMode"] = 3;   
            var aspectRatio = 1 / 1;
			cropper.setAspectRatio(aspectRatio);
            assert.equal(options.aspectRatio, aspectRatio);
  
      
        },

      });
	  
	  
	  
	   // Import image
	
  var $inputImage = $('#inputImage');
  var URL = window.URL || window.webkitURL;
  var blobURL;

  if (URL) {
    $inputImage.change(function () {
      var files = this.files;
      var file;

      if (!$image.data('cropper')) {
        return;
      }

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          blobURL = URL.createObjectURL(file);
          $image.one('built.cropper', function () {

            // Revoke when load complete
            URL.revokeObjectURL(blobURL);
          }).cropper('reset').cropper('replace', blobURL);
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });
  } else {
    $inputImage.prop('disabled', true).parent().addClass('disabled');
  }
    });
	
	  // Methods
	    var $image = $('#image');
  $('.docs-buttons').on('click', '[data-method]', function () {
    var $this = $(this);
    var data = $this.data();
    var $target;
    var result;

    if ($this.prop('disabled') || $this.hasClass('disabled')) {
      return;
    }

    if ($image.data('cropper') && data.method) {
      data = $.extend({}, data); // Clone a new one

      if (typeof data.target !== 'undefined') {
        $target = $(data.target);

        if (typeof data.option === 'undefined') {
          try {
            data.option = JSON.parse($target.val());
          } catch (e) {
            console.log(e.message);
          }
        }
      }

      if (data.method === 'rotate') {
        $image.cropper('clear');
      }

      result = $image.cropper(data.method, data.option, data.secondOption);

      if (data.method === 'rotate') {
        $image.cropper('crop');
      }

      switch (data.method) {
        case 'scaleX':
        case 'scaleY':
          $(this).data('option', -data.option);
          break;

        case 'getCroppedCanvas':
          if (result) {

            // Bootstrap's Modal
            $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

            if (!$download.hasClass('disabled')) {
              $download.attr('href', result.toDataURL('image/jpeg'));
            }
          }

          break;
      }

      if ($.isPlainObject(result) && $target) {
        try {
          $target.val(JSON.stringify(result));
        } catch (e) {
          console.log(e.message);
        }
      }

    }
  });

	
	 });
  </script>
  