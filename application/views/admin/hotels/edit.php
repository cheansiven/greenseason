
<?php include_once('application/views/admin/header.php'); ?>
<script type="text/javascript">
$(document).ready(function(){

	$('#country').change(function(){
        $.ajax({ 
             url: "<?echo base_url();?>admin/hotels/getCities",
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
			$('#city').addClass("round error");
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
			$('#category').addClass("round error");
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
    <a href="#" class="btn btn-primary">Edit hotel</a>
</div>
<div id="content" class="container">
  <div class="page-full-width cf">
    <div> <!-- class="side-content fr" -->
      
      <div class="content-module">
        <div class="content-module-heading cf">
          <h3 class="fl">Form Elements</h3>
        </div>
        <!-- end content-module-heading -->
        
        <div class="content-module-main cf"> <?php echo form_open_multipart('admin/hotels/update', 'id="hotelForm" class="form form-horizontal" name="hotelForm"'); ?>
          <div class="half-size-column fl"> 
            <?php echo validation_errors(); ?>
            <!--<form action="#">-->
            
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Hotel Name:</label>
                <div class="col-sm-10">
                    <?php echo form_input('name',$hotel->name, 'id="name" class="round form-control default-width-input" autofocus'); ?>
                    <p id="nameError">Please enter hotel name!</p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <?php echo form_checkbox('published', 1 , ($hotel->published == '1')); ?> Published?
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="category" class="col-sm-2 control-label">Hotel Category:</label>
                <div id="category" class="col-sm-10">
                    <?php foreach ($categories as $category){ $checked = 1; ?>
                    <div class="checkbox">
                      <label>
                      <?php foreach ($hotelCategories as $hotelCategory) {
                        if($category['id'] == $hotelCategory['category_id']){
                          echo form_checkbox('category[]',$category['id'],true, 'id="category"');
                          
                            echo $category['name'];
                            $checked = 0;
                            break;
                        }
                      }

                      if($checked ==1) {
                        echo form_checkbox('category[]',$category['id'],false, 'id="category"');
                        echo $category['name']; 
                      }
                      echo '</label>
                      <p id="categoryError">Please choose hotel category!</p>
                    </div>';
                    } ?>
                </div>
            </div>
            <div class="form-group">
                <label for="country" class="col-sm-2 control-label">Country:</label>
                <div class="col-sm-10">
                    <?php echo form_dropdown('country', $country, $hotel->country_id, 'id="country" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">City:</label>
                <div class="col-sm-10">
                    <?php echo form_dropdown('city', $city, $hotel->city_id, 'id="city" class="form-control"'); ?>
                    <p id="cityError">Please choose city!</p>
                </div>
            </div>
            <div class="form-group">
                <label for="website" class="col-sm-2 control-label">Website:</label>
                <div class="col-sm-10">
                    <?php echo form_input('website',$hotel->website, 'id="website" class="round form-control default-width-input" autofocus'); ?>
                </div>
            </div>
            <div class="form-group">
              <label for="logo" class="col-sm-2 control-label">Logo:</label>
              <div class="col-sm-10">
              <?php
              if ($hotel->logo != '')
                  echo '<img src="'.base_url().'upload/hotels/'.$hotel->logo.'">';
                echo form_upload('logo','', 'id="logo" class="round form-control default-width-input" autofocus');

              ?>
              <input type="hidden"  name="logo_old" value="<?php echo $hotel->logo?>">
              </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-sm-2 control-label">Image:</label>
                <div class="col-sm-10">
                    <?php
                    if ($hotel->image != '')
                        echo '<img src="'.base_url().'upload/hotels/'.$hotel->image.'">';
                      echo form_upload('image','', 'id="image" class="round form-control default-width-input" autofocus');
                      echo form_hidden('image_old',$hotel->image, set_value('image_old'));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Hotel description:</label>
                <div class="col-sm-10">
                    <?php echo form_textarea('description',$hotel->description, 'id="description" class="round form-control full-width-textarea" autofocus'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="review" class="col-sm-2 control-label">Review:</label>
                <div class="col-sm-10">
                    <?php echo form_textarea('review',$hotel->review, 'id="review" class="round form-control full-width-textarea" autofocus'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="review_image" class="col-sm-2 control-label">Image:</label>
                <div class="col-sm-10">
                    <?php
                    if ($hotel->review_image != '')
                        echo '<img src="'.base_url().'upload/hotels/'.$hotel->review_image.'">';
                      echo form_upload('review_image','', 'id="review_image" class="round form-control default-width-input" autofocus');
                      echo form_hidden('review_image_old',$hotel->review_image, set_value('review_image_old'));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="location" class="col-sm-2 control-label">Location:</label>
                <div class="col-sm-10">
                    <?php echo form_textarea('location',$hotel->location, 'id="location" class="round form-control full-width-textarea" autofocus'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="location_image" class="col-sm-2 control-label">Image:</label>
                <div class="col-sm-10">
                    <?php
                    if ($hotel->location_image != '')
                        echo '<img src="'.base_url().'upload/hotels/'.$hotel->location_image.'">';
                        echo form_upload('location_image','', 'id="location_image" class="round form-control default-width-input" autofocus');
                        echo form_hidden('location_image_old',$hotel->location_image, set_value('location_image_old'));
                    ?>
                </div>
            </div>
            
            <!--</form>--> 
            
          </div>
          <!-- end half-size-column -->
          
          <div class="half-size-column fr"> 
            
            <!--<form action="#">-->
            <div class="form-group">
                <label for="rooms" class="col-sm-2 control-label">Rooms:</label>
                <div class="col-sm-10">
                    <?php echo form_textarea('rooms',$hotel->rooms, 'id="rooms" class="round form-control full-width-textarea" autofocus'); ?>
                </div>
            </div>
            <div class="form-group">
              <label for="rooms_image" class="col-sm-2 control-label">Image:</label>
                <div class="col-sm-10">
                    <?php
                    if ($hotel->rooms_image != '')
                        echo '<img src="'.base_url().'upload/hotels/'.$hotel->rooms_image.'">';
                      echo form_upload('rooms_image','', 'id="rooms_image" class="round form-control default-width-input" autofocus');
                       echo form_hidden('rooms_image_old',$hotel->rooms_image, set_value('rooms_image_old'));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="dining" class="col-sm-2 control-label">Dining:</label>
                <div class="col-sm-10">
                    <?php echo form_textarea('dining',$hotel->dining, 'id="dining" class="round form-control full-width-textarea" autofocus'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="dining_image" class="col-sm-2 control-label">Image:</label>
                <div class="col-sm-10">
                    <?php
                    if ($hotel->dining_image != '')
                      echo '<img src="'.base_url().'upload/hotels/'.$hotel->dining_image.'">';
                      echo form_upload('dining_image','', 'id="dining_image" class="round form-control default-width-input" autofocus'); 
                      echo form_hidden('dining_image_old',$hotel->dining_image, set_value('dining_image_old'));
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="leisure" class="col-sm-2 control-label">Leisure:</label>
                <div class="col-sm-10">
                    <?php echo form_textarea('leisure',$hotel->leisure, 'id="leisure" class="round form-control full-width-textarea" autofocus'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="leisure_image" class="col-sm-2 control-label">Image:</label>
                <div class="col-sm-10">
                    <?php
                    if ($hotel->leisure_image != '')
                        echo '<img src="'.base_url().'upload/hotels/'.$hotel->leisure_image.'">';
                      echo form_upload('leisure_image','', 'id="leisure_image" class="round form-control default-width-input" autofocus');
                      echo form_hidden('leisure_image_old',$hotel->leisure_image, set_value('leisure_image_old'));
                    ?>
                </div>
            </div>
              
              <?php echo form_hidden('hotel_id',$hotel->id); ?>

            
            <!--</form>--> 
            
          </div>
          <!-- end half-size-column --> 
            <div class="container button-submit">
                <div class="text-uppercase text-center">
                    <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?>
                </div>
            </div>
          <?php echo form_close(); ?> 
          
          </div>
        <!-- end content-module-main --> 
        
      </div>
      <!-- end content-module --> 
      
    </div>
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