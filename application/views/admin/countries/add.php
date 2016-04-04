<?php include_once('application/views/admin/header.php'); ?>

    <script type="text/javascript">
        $(document).ready(function(){

            $('#countryForm').submit(function(){

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
    <a href="<?php echo site_url("admin/countries/");?>" class="btn btn-default">Dashboard</a>
    <a href="<?php echo site_url("admin/countries/add");?>" class="btn btn-primary">Add new country</a>
</div>

<div id="content" class="container">
  <div class="page-full-width cf">
    <div> <!-- class="side-content fr" -->
      
      <div class="content-module">
        <div class="content-module-heading cf">
          <h3 class="fl">Form Elements</h3>
        </div>
        <!-- end content-module-heading -->
        
        <div class="content-module-main cf">
        <?php echo form_open_multipart('admin/countries/store', 'id="countryForm" name="CountryForm" class="form-horizontal"'); ?>
          <div class="half-size-column fl"> 
            <?php echo validation_errors(); ?>

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Country Name:</label>
                <div class="col-sm-10">
                  <?php echo form_input('name','', 'id="name" class="round form-control default-width-input" autofocus'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="url" class="col-sm-2 control-label">URL:</label>
                <div class="col-sm-10">
                  <?php echo form_input('url','', 'id="url" class="round form-control default-width-input" autofocus'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="meta_title" class="col-sm-2 control-label">Meta Title:</label>
                <div class="col-sm-10">
                  <?php echo form_input('meta_title','', 'id="meta_title" class="round form-control default-width-input" autofocus'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="meta_description" class="col-sm-2 control-label">Meta Description:</label>
                <div class="col-sm-10">
                  <?php echo form_input('meta_description','', 'id="meta_description" class="round form-control default-width-input" autofocus'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="meta_keyword" class="col-sm-2 control-label">Meta Keyword:</label>
                <div class="col-sm-10">
                  <?php echo form_input('meta_keyword','', 'id="meta_keyword" class="round form-control default-width-input" autofocus'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="meta_keyword" class="col-sm-2 control-label">Country Photo:</label>
                <div class="col-sm-10">
                  <?php echo form_upload('image','', 'id="image" class="round form-control default-width-input" autofocus'); ?>
                </div>
              </div>
            
            
          </div>
          <!-- end half-size-column -->
          
          <div class="half-size-column fr">
            
            <div class="form-group">
              <label for="description">Country Description:</label>
              <?php echo form_textarea('description','', 'id="description" class="round form-control default-width-input" autofocus').'<br />'; ?>
            </div>

            <div class="container button-submit">
              <div class="text-uppercase text-center">
                  <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?>
              </div>
            </div>
            
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
<!-- end footer -->

</body>
</html>