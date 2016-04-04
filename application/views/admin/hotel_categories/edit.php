<?php include_once('application/views/admin/header.php'); ?>
	
<!-- MAIN CONTENT -->
<div class="container">
    <a href="<?php echo site_url("admin/hotel_categories/");?>" class="btn btn-default">Dashboard</a>
    <a href="<?php echo site_url("admin/hotel_categories/add");?>" class="btn btn-primary">Edit catergory</a>
</div>
	<div id="content" class="container">
		<div class="page-full-width cf">
			<div> <!-- class="side-content fr" -->
				<div class="content-module">
					<div class="content-module-heading cf">
						<h3 class="fl">Form Elements</h3>
					</div> <!-- end content-module-heading -->
					
					<div class="content-module-main cf">
					<?php echo form_open_multipart('admin/hotel_categories/update', 'id="categoryForm" class="form form-horizontal" name="categoryForm"'); ?>
						<div class="half-size-column fl">
						<?php echo validation_errors(); ?>

							<div class="form-group">
	                            <label for="name" class="col-sm-2 control-label">Category Name:</label>
	                            <div class="col-sm-10">
	                                <?php echo form_input('name',$category->name, 'id="name" class="round form-control default-width-input" autofocus'); ?>
	                                <p id="nameError">Please enter category name!</p>
	                            </div>
	                        </div>
							<div class="form-group">
	                            <label for="photo" class="col-sm-2 control-label">Image:</label>
	                            <div class="col-sm-10">
	                            	<?php if($category->image != '') {?>
	                                <img src="<?php echo base_url();?>upload/hotels/categories/<?php echo $category->image?>">
	                                <?php } ?>
	                                <?php echo form_upload('image','', 'id="image" class="round default-width-input" autofocus'); ?>
                                    <em>You can add a hint or a small description here.</em>
	                            </div>
	                        </div>
						
						</div> <!-- end half-size-column -->
						
						<div class="half-size-column fr">

							<div class="form-group">
	                            <label for="description" class="col-sm-2 control-label">Description:</label>
	                            <div class="col-sm-10">
	                                <?php echo form_textarea('description',$category->description, 'id="description" class="round full-width-textarea" autofocus'); ?>
	                            </div>
	                        </div>

	                        <?php 
							echo form_hidden('id',$category->id, set_value('id'));
							echo form_hidden('imageold',$category->image, set_value('imageold'));
							?>
							
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
	
	
	
	<!-- FOOTER -->
	<?php include_once('application/views/admin/footer.php'); ?>
    <!-- end footer -->

</body>
</html>