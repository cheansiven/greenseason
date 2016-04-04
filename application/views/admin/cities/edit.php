<?php include_once('application/views/admin/header.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
   
  $('#cityForm').submit(function(){
  		
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
    <a href="<?php echo site_url("admin/cities/");?>" class="btn btn-default">Dashboard</a>
    <a href="#" class="btn btn-primary">Edit city</a>
</div>

<div id="content" class="container">
  <div class="page-full-width cf">
    <div> <!-- class="side-content fr" -->
      
      <div class="content-module">
        <div class="content-module-heading cf">
          <h3 class="fl">Form Elements</h3>
        </div>
        <!-- end content-module-heading -->
        
        <div class="content-module-main cf"> <?php echo form_open_multipart('admin/cities/update', 'id="cityForm" class="form-horizontal" name="cityForm"'); ?>
          <div class="half-size-column fl"> 
            <?php echo validation_errors(); ?>
            <!--<form action="#">-->
            
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">City Name:</label>
              <div class="col-sm-10">
                <?php echo form_input('name',$city->name, 'id="name" class="round form-control default-width-input" autofocus'); ?>
                <p id="nameError">Please enter city name!</p>
              </div>
            </div>
            <div class="form-group">
              <label for="country" class="col-sm-2 control-label">Country:</label>
              <div class="col-sm-10">
                <?php echo form_dropdown('country', $country, $city->country_id, 'id="country" class="form-control"'); ?>
                <p id="countryError">Please select country!</p>
              </div>
            </div>
            <div class="form-group">
              <label for="country" class="col-sm-2 control-label">City attractiveness:</label>
              <div class="col-sm-10">
                <?php echo form_dropdown('attractiveness', $attractiveness, $city->attractiveness, 'id="attractiveness" class="form-control"'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="lat" class="col-sm-2 control-label">Lat:</label>
              <div class="col-sm-10">
                <?php echo form_input('lat',$city->lat, 'id="lat" class="round form-control default-width-input" autofocus'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="lon" class="col-sm-2 control-label">Lon:</label>
              <div class="col-sm-10">
                <?php echo form_input('lon',$city->lon, 'id="lon" class="round form-control default-width-input" autofocus'); ?>
              </div>
            </div>
              <?php if($city->images != '') {?>
              <p>
              	<img src="<?php echo base_url();?>upload/cities/<?php echo $city->images?>">
              </p>
              <?php } ?>
              <p>
                <?php
										
										  echo form_label('Image: ', 'image');
      									  echo form_upload('image','', 'id="image" class="round default-width-input" autofocus'); 
										  
									    ?>
               </p>


                <div class="meta-data" style="border-top: 1px solid #eeefef"><br />
                    <h1>Meta Data</h1>
                    <div class="form-group">
                      <label for="page_title" class="col-sm-2 control-label">Page Title:</label>
                      <div class="col-sm-10">
                        <?php echo form_input('page_title',$city->page_title, 'id="page_title" class="round form-control default-width-input" autofocus'); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="meta_description" class="col-sm-2 control-label">Page Description:</label>
                      <div class="col-sm-10">
                        <?php echo form_input('meta_description',$city->meta_description, 'id="meta_description" class="round form-control default-width-input" autofocus'); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="meta_keyword" class="col-sm-2 control-label">Page Keyword:</label>
                      <div class="col-sm-10">
                        <?php echo form_input('meta_keyword',$city->meta_keyword, 'id="meta_keyword" class="round form-control default-width-input" autofocus'); ?>
                      </div>
                    </div>
                </div>
            
            <!--</form>--> 
            
          </div>
          <!-- end half-size-column -->
          
          <div class="half-size-column fr"> 
            
            <!--<form action="#">-->
            
            <fieldset>
              <p>
                <?php 
										
										echo form_label('Brief description: ', 'intro'); 
                                        echo form_textarea('intro',$city->intro, 'id="intro" class="round full-width-textarea" autofocus'); 
										
										?>
              </p>
              <p>
                <?php 
										
										echo form_label('Description: ', 'description'); 
                                        echo form_textarea('description',$city->description, 'id="description" class="round full-width-textarea" autofocus'); 
										
										?>
              </p>
              
              <?php echo form_hidden('city_id',$city->id); echo form_hidden('imageold',$city->images, set_value('imageold')); ?>
              
            </fieldset>
            
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