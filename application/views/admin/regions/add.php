<?php include_once('application/views/admin/header.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
	
	
	$('#country').change(function(){
		if($('#country').val() != ''){
			$.ajax({ 
				 url: "<?echo base_url();?>admin/regions/getCities",
				data: {country_id: $(this).val()},
				type: "post",
				success: function(cities) //we're calling the response json array 'cities'
				  {
					  $('#region_country').remove();
				   $('#countryList').append('<div id="region_country"><p><label for="city">CITIES: </label></p></div>')
					 for (var id in cities) {
							$('#region_country').append('<p><input name="city[]" type="checkbox" value="'+id+'"/> ' + cities[id] + '</p>');
					 }
				   } //end success
			});
		}
		else $('#region_country').remove();
    });
	
	
	$('#regionForm').submit(function(){
		
		if(validateName() & validateCountry())
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
	
	function validateCountry(){ 
		if($('#country').val() == ""){
			$('#country').addClass("round error");
			$('#countryError').toggle();
			$('#countryError').show();
			return false;
		}
		//if it's valid
		else{
			$('#country').removeClass("error");
			$('#countryError').toggle();
			$('#countryError').hide();
			return true;
		}
	}
	
});
</script>

<!-- MAIN CONTENT -->
<div class="container">
    <a href="<?php echo site_url("admin/regions/");?>" class="btn btn-default">Dashboard</a>
    <a href="<?php echo site_url("admin/regions/add");?>" class="btn btn-primary">Add new region</a>
</div>

<div id="content" class="container">
  <div class="page-full-width cf">
    <div> <!-- class="side-content fr" -->
      
      <div class="content-module">
        <div class="content-module-heading cf">
          <h3 class="fl">Form Elements</h3>
        </div>
        <!-- end content-module-heading -->
        
        <div class="content-module-main cf"> <?php echo form_open_multipart('admin/regions/store','id="regionForm" class="form-horizontal" name="regionForm"'); ?>
          <div class="half-size-column fl">
          	<?php echo validation_errors(); ?> 
            <div class="form-group">
	            <label for="name" class="col-sm-2 control-label">Region Name:</label>
	            <div class="col-sm-10">
	            	<?php echo form_input('name','', 'id="name" class="round form-control default-width-input" autofocus'); ?>
	            	<p id="nameError">Please enter region name!</p>
	            </div>
	        </div>
	        <div class="col-sm-10 col-sm-offset-2">
	        	<div class="form-group">
			        <div class="checkbox">
						<label>
							<?php echo form_checkbox('highlight','1',false); ?> Hightlight
						</label>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
            <div id="countryList">
	            <div class="form-group">
		            <label for="country" class="col-sm-2 control-label">Country:</label>
		            <div class="col-sm-10">
		            	<?php echo form_dropdown('country', $country, '', 'id="country" class="form-control"'); ?>	
		            	<p id="countryError">Please choose country!</p>
		            </div>
		        </div>
            </div>
            <div class="form-group">
	            <label for="photo" class="col-sm-2 control-label">Image:</label>
	            <div class="col-sm-10">
	            	<?php echo form_upload('image','', 'id="image" class="round form-control default-width-input" autofocus'); ?>
	            </div>
	        </div>
          </div>
          
          <div class="half-size-column fr"> 

            <div class="form-group">
	            <label for="attractiveness" class="col-sm-2 control-label">Region attractiveness:</label>
	            <div class="col-sm-10">
	            	<?php echo form_dropdown('attractiveness', $attractiveness, set_value('attractiveness', '-----'), 'id="attractiveness" class="form-control"'); ?>
	            </div>
	        </div>
            <div class="form-group">
	            <label for="lat" class="col-sm-2 control-label">Lat:</label>
	            <div class="col-sm-10">
	            	<?php echo form_input('lat','', 'id="lat" class="round form-control default-width-input" autofocus'); ?>
	            </div>
	        </div>
            <div class="form-group">
	            <label for="lon" class="col-sm-2 control-label">Lon:</label>
	            <div class="col-sm-10">
	            	<?php echo form_input('lon','', 'id="lon" class="round form-control default-width-input" autofocus'); ?>
	            </div>
	        </div>
            
            <!--<form action="#">-->
            
            <fieldset>
              <p>
                <?php 
										
										echo form_label('Brief description: ', 'intro'); 
                                        echo form_textarea('intro','', 'id="intro" class="round full-width-textarea" autofocus'); 
										
										?>
              </p>
              <p>
                <?php 
										
										echo form_label('Description: ', 'description'); 
                                        echo form_textarea('description','', 'id="description" class="round full-width-textarea" autofocus'); 
										
										?>
              </p>
            <div class="container button-submit">
                <div class="text-uppercase text-center">
                    <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?>
                </div>
            </div>
            </fieldset>
            
            <!--</form>--> 
            
          </div>
          <!-- end half-size-column --> 
          
          <?php echo form_close(); ?> </div>
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