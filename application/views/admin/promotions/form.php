<?php include_once('application/views/admin/header.php'); ?>
<script type="text/javascript">
      $(document).ready(function(){
      	$('#promotionsForm').submit(function(){
      		if(validateName())
      			return true;
      		else
      			return false;
      	});
      	function validateName(){
      		
      		if($('#name').val() == "" || $('#name').val()==null){
      			$('#name').addClass("error");
      			$('#cityError').toggle();
      			$('#cityError').show();
      			return false;
      		}
      		//if it's valid
      		else{
      			$('#name').removeClass("error");
      			$('#cityError').toggle();
      			$('#cityError').hide();
      			return true;
      		}
      	}
      });	
</script>

<!-- MAIN CONTENT -->
<div class="container">
  <a href="<?php echo site_url("admin/promotions/");?>" class="btn btn-default active-tab dashboard-tab">Dashboard</a></li>
  <a href="#" class="btn btn-primary">Promotion</a>
</div>

<div id="content" class="container">
  <div class="page-full-width cf">
    <!-- end side-menu -->
    
    <div> <!-- class="side-content fr" -->
      <div class="content-module">
        <div class="content-module-heading cf">
          <h3 class="fl">Form Elements</h3>
          </div>
        <!-- end content-module-heading -->
        
        <div class="content-module-main cf"> <?php echo form_open_multipart('admin/promotions/store', 'id="promotionsForm" name="promotionsForm"'); ?>
          <div class="half-size-column fl"> 
            <?php echo validation_errors(); ?>
            <!--<form action="#">-->
            
            <div class="form-group">
              <label for="name">name</label>
              <?php echo form_input('name', (empty($promotion))?'':$promotion->name, 'id="name" class="form-control"'); ?>
              <p id="cityError">Please input name!</p>  
            </div>            
            <div class="form-group">
              <?php
      				  echo form_label('Image: ', 'photo');
      				  echo form_upload('image','', 'id="image" class="round form-control default-width-input" autofocus'); 
      				  echo form_hidden('id',!empty($promotion)?$promotion->id:'', set_value('id'));
      				?>
            </div>
            <div class="checkbox">
              <div class="activity-checkbox">
                <?php $chk = (empty($promotion))?'1':($promotion->status)?true:false; ?>
                <label>
                  <?php echo form_checkbox('status', 1, $chk); ?> Published
                </label>
              </div>
            </div>

            <div class="container button-submit">
                <div class="text-uppercase text-center">
                    <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?>
                </div>
            </div> 
            
          </div>
          <!-- end half-size-column -->          
          <div class="half-size-column fr">             
            <!--<form action="#">-->
            
            <fieldset>             
             <?php if(!empty($promotion) && $promotion->image) {?>
              <p><img src="<?php echo base_url();?>upload/promotions/<?php echo $promotion->image?>" width="500"></p>
              <?php } ?>
            </fieldset>
            
            <!--</form>--> 
            
          </div>
          <!-- end half-size-column --> 
          
          <?php echo form_close(); ?>  </div>
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