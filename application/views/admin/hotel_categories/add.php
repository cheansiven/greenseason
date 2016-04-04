<?php include_once('application/views/admin/header.php'); ?>
    
<script type="text/javascript">
	$(document).ready(function(){

		$('#categoryForm').submit(function(){
			
			if(validateName())
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
		
		
		
	});
</script>

<!-- MAIN CONTENT -->
<div class="container">
    <a href="<?php echo site_url("admin/hotel_categories/");?>" class="btn btn-default">Dashboard</a>
    <a href="<?php echo site_url("admin/hotel_categories/add");?>" class="btn btn-primary">Add new catergory</a>
</div>
<div id="content" class="container">
	<div class="page-full-width cf">
		<div> <!-- class="side-content fr" -->
			<div class="content-module">
				<div class="content-module-heading cf">
					<h3 class="fl">Form Elements</h3>
				</div> <!-- end content-module-heading -->
				
				
				<div class="content-module-main cf">
				<?php echo form_open_multipart('admin/hotel_categories/store', 'id="categoryForm" class="form form-horizontal" name="categoryForm"'); ?>
					<div class="half-size-column fl">
					<?php echo validation_errors(); ?>
						<!--<form action="#">-->
						
						<div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Category Name:</label>
                            <div class="col-sm-10">
                                <?php echo form_input('name','', 'id="name" class="round form-control default-width-input" autofocus'); ?>
                                <p id="nameError">Please enter category name!</p>
                            </div>
                        </div>
						<div class="form-group">
                            <label for="photo" class="col-sm-2 control-label">Image:</label>
                            <div class="col-sm-10">
                                <?php echo form_upload('image','', 'id="image" class="round form-control default-width-input" autofocus');  ?>		
                                <em>You can add a hint or a small description here.</em>
                            </div>
                        </div>
					
					</div> <!-- end half-size-column -->
					
					<div class="half-size-column fr">
						<div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Description:</label>
                            <div class="col-sm-10">
                                <?php echo form_textarea('description','', 'id="description" class="round form-control full-width-textarea" autofocus'); ?>
                            </div>
                        </div>
					</div> <!-- end half-size-column -->
                	<div class="container button-submit">
		                <div class="text-uppercase text-center">
		                    <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?>
		                </div>
		            </div>
                <?php echo form_close(); ?>
                
				
                
				</div> <!-- end content-module-main -->
            
            
				
			</div> <!-- end content-module -->

		</div>
	
		</div> <!-- end side-content -->
	
	</div> <!-- end full-width -->
		
</div> <!-- end content -->

<?php include_once('application/views/admin/footer.php'); ?>