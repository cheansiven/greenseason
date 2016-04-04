<?php include_once('application/views/admin/header.php'); ?>

<script type="text/javascript">

    $(function() {
        $( "#tour_tabs" ).tabs();
    });

$(document).ready(function(){
 
	
	$('#country').change(function(){
        $.ajax({ 
             url: "<?= base_url();?>admin/hotels/getCities",
            data: {country_id: $(this).val()},
            type: "post",
            success: function(cities) //we're calling the response json array 'cities'
              {
               $('#city').empty();
                 for (var id in cities) {
                        $('#city').append($('<option />', {
                            value: id,
                            text: cities[id]
                        }));
                 }
               } //end success
        });
    });
	
	
	$('#hotelForm').submit(function(){
		
		if(validateName() & validateCity() & validateCategory())
			return true
		else
			return false;
	});
	
	function validateName(){
		if($('#name').val() == ""){
			$('#name').addClass("error");
			$('#nameError').toggle();
			$('#nameError').show();
			return false;
		}
		//if it's valid
		else{
			$('#name').removeClass("error");
			$('#nameError').toggle();
			$('#nameError').hide();
			return true;
		}
	}
	
	function validateCity(){ 
		if($('#city').val() == ""){
			$('#city').addClass("round form-control error");
			$('#cityError').toggle();
			$('#cityError').show();
			return false;
		}
		//if it's valid
		else{
			$('#city').removeClass("error");
			$('#cityError').toggle();
			$('#cityError').hide();
			return true;
		}
	}
	
	function validateCategory(){ 
		
		if($('#category :checkbox:checked').length > 0) {
			$('#category').removeClass("error");
			$('#categoryError').toggle();
			$('#categoryError').hide();
			return true;
		}
		//if it's valid
		else{
			$('#category').addClass("round form-control error");
			$('#categoryError').toggle();
			$('#categoryError').show();
			return false;
		}
	}
	
	
});
</script>

<!-- MAIN CONTENT -->
<div class="container">
    <a href="<?php echo site_url("admin/hotels/");?>" class="btn btn-default">Dashboard</a>
    <a href="<?php echo site_url("admin/hotels/add");?>" class="btn btn-primary">Add new hotel</a>
</div>

<div id="content">
    <div class="page-full-width cf">
    <div> <!-- class="side-content fr" -->

        <div class="content-module">

            <?php echo form_open_multipart('admin/hotels/store', 'id="hotelForm" class="form form-horizontal" name="hotelForm"'); ?>

              <div id="tour_tabs" class="wrap-tabs">
                  <div class="menu-tabs">
                      <ul class="container">
                        <li><a href="#tabs-1">Info</a></li>
                        <li><a href="#tabs-2">Meta</a></li>
                    </ul>
                  </div>

                  <div class="container content-tabs">
                    <div id="tabs-1">
                      <div class="half-size-column fl"> 
                        <?php echo validation_errors(); ?>
                        <!--<form action="#">-->
                        
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Hotel Name:</label>
                            <div class="col-sm-10">
                                <?php echo form_input('name','', 'id="name" class="round form-control default-width-input" autofocus'); ?>
                                <p id="nameError">Please enter hotel name!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <?php echo form_checkbox('published',1 , false); ?> Published?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category" class="col-sm-2 control-label">Hotel Category:</label>
                            <div id="category" class="col-sm-10">
                                <?php foreach ($categories as $category): ?>
                                <div class="checkbox">
                                  <label>
                                <?php echo form_checkbox('category[]',$category['id'],false) . ' ' . $category['name']; ?>
                                  </label>
                                </div>
                                <?php endforeach ?>
                                <p id="categoryError">Please choose hotel category!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country" class="col-sm-2 control-label">Country:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_dropdown('country', $country, '', 'id="country" class="form-control"'); ?>
                                <p id="categoryError">Please choose article category!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-2 control-label">City:</label>
                            <div id="category" class="col-sm-10">
                                <select name="city" id="city" class="form-control">
                                  <option value="">-- Please select --</option>
                                </select>
                                <p id="cityError">Please choose city!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="website" class="col-sm-2 control-label">Website:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_input('website','', 'id="website" class="round form-control default-width-input" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="logo" class="col-sm-2 control-label">Logo:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_upload('logo','', 'id="logo" class="round form-control default-width-input" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Hotel description:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_textarea('description','', 'id="description" class="round form-control full-width-textarea" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-sm-2 control-label">Image:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_upload('image','', 'id="image" class="round form-control default-width-input" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="review" class="col-sm-2 control-label">Review:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_textarea('review','', 'id="review" class="round form-control full-width-textarea" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="review_image" class="col-sm-2 control-label">Image:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_upload('review_image','', 'id="review_image" class="round form-control default-width-input" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location" class="col-sm-2 control-label">Location:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_textarea('location','', 'id="location" class="round form-control full-width-textarea" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location_image" class="col-sm-2 control-label">Image:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_upload('location_image','', 'id="location_image" class="round form-control default-width-input" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rooms" class="col-sm-2 control-label">Rooms:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_textarea('rooms','', 'id="rooms" class="round form-control full-width-textarea" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rooms_image" class="col-sm-2 control-label">Image:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_upload('rooms_image','', 'id="rooms_image" class="round form-control default-width-input" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dining" class="col-sm-2 control-label">Dining:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_textarea('dining','', 'id="dining" class="round form-control full-width-textarea" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dining_image" class="col-sm-2 control-label">Image:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_upload('dining_image','', 'id="dining_image" class="round form-control default-width-input" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="leisure" class="col-sm-2 control-label">Leisure:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_textarea('leisure','', 'id="leisure" class="round form-control full-width-textarea" autofocus'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="leisure_image" class="col-sm-2 control-label">Image:</label>
                            <div id="category" class="col-sm-10">
                                <?php echo form_upload('leisure_image','', 'id="leisure_image" class="round form-control default-width-input" autofocus'); ?>
                            </div>
                        </div>

                      </div>
                    </div> <!-- /.tabs-1 -->
                    <div id="tabs-2">
                        <p>

                            <?php

                            echo form_label('Meta title: ', 'meta_title').'<br>';
                            echo form_input('meta_title','', 'id="meta_title" class="round form-control default-width-input" autofocus');

                            ?>
                        </p>
                        <p>

                            <?php

                         //   echo form_label('Meta title [EN]: ', 'meta_title_en').'<br>';
                         //   echo form_input('meta_title_en','', 'id="meta_title_en" class="round form-control default-width-input" autofocus');

                            ?>
                        </p>
                        <p>

                            <?php

                            echo form_label('URL: ', 'url').'<br>';
                            echo form_input('url','', 'id="url" class="round form-control default-width-input" autofocus');

                            ?>
                        </p>
                        <p>

                            <?php

                         //   echo form_label('URL [EN]: ', 'url_en').'<br>';
                         //   echo form_input('url_en','', 'id="url_en" class="round form-control default-width-input" autofocus');

                            ?>
                        </p>
                        <p>

                            <?php

                            echo form_label('Meta keyword: ', 'meta_keyword').'<br>';
                            echo form_input('meta_keyword','', 'id="meta_keyword" class="round form-control default-width-input" autofocus');

                            ?>
                        </p>
                        <p>

                            <?php

                            echo form_label('Meta keyword [EN]: ', 'meta_keyword_en').'<br>';
                            echo form_input('meta_keyword_en','', 'id="meta_keyword_en" class="round form-control default-width-input" autofocus');

                            ?>
                        </p>
                        <p>

                            <?php

                            echo form_label('Meta description: ', 'meta_description').'<br>';
                            echo form_input('meta_description','', 'id="meta_description" class="round form-control" autofocus');

                            ?>
                        </p>                    </div>
                </div>
                <div class="container button-submit">
                    <div class="text-uppercase text-center">
                        <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?>
                    </div>
                </div>

            <?php echo form_close(); ?>
        </div>
        <!-- end content-module -->
    </div>
    <!-- end side-content -->
    </div>
    <!-- end full-width -->
</div>
<!-- end content -->

<!-- FOOTER -->
<?php include_once('application/views/admin/footer.php'); ?>
<!-- end footer -->

</body>
</html>