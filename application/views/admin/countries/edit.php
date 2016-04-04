<?php include_once('application/views/admin/header.php'); ?>

<!-- MAIN CONTENT -->
<div class="container">
    <a href="<?php echo site_url("admin/countries/");?>" class="btn btn-default">Dashboard</a>
    <a href="#" class="btn btn-primary">Edit country</a>
</div>

<div id="content" class="container">
		<div class="page-full-width cf">
			<div> <!-- class="side-content fr" -->
				<div class="content-module">
					<div class="content-module-heading cf">
						<h3 class="fl">Form Elements</h3>
					</div> <!-- end content-module-heading -->
					<div class="content-module-main cf">
					<?php echo form_open_multipart('admin/countries/update', 'class="form-horizontal"'); ?>
						<div class="half-size-column fl">
						<?php echo validation_errors(); ?>

						<div class="form-group">
			                <label for="name" class="col-sm-2 control-label">Country Name:</label>
			                <div class="col-sm-10">
			                  <?php echo form_input('name',$country->name, 'id="name" class="round form-control default-width-input" autofocus'); ?>
			                </div>
		                </div>
						<div class="form-group">
			                <label for="url" class="col-sm-2 control-label">URL:</label>
			                <div class="col-sm-10">
			                  <?php echo form_input('url',$country->url, 'id="url" class="round form-control default-width-input" autofocus'); ?>
			                </div>
		              	</div>
						<div class="form-group">
			                <label for="meta_title" class="col-sm-2 control-label">Meta Title:</label>
			                <div class="col-sm-10">
			                  <?php echo form_input('meta_title',$country->meta_title, 'id="meta_title" class="round form-control default-width-input" autofocus'); ?>
			                </div>
		              	</div>
						<div class="form-group">
			                <label for="meta_description" class="col-sm-2 control-label">Meta Description:</label>
			                <div class="col-sm-10">
			                  <?php echo form_input('meta_description',$country->meta_description, 'id="meta_description" class="round form-control default-width-input" autofocus'); ?>
			                </div>
		              	</div>
						<div class="form-group">
			                <label for="meta_keyword" class="col-sm-2 control-label">Meta Keyword:</label>
			                <div class="col-sm-10">
			                  <?php echo form_input('meta_keyword',$country->meta_keyword, 'id="meta_keyword" class="round form-control default-width-input" autofocus'); ?>
			                </div>
		              	</div>
						<div class="form-group">
			                <label for="meta_keyword" class="col-sm-2 control-label">Meta Keyword:</label>
			                <div class="col-sm-10">
			                  <?php echo form_input('meta_keyword',$country->meta_keyword, 'id="meta_keyword" class="round form-control default-width-input" autofocus'); ?>
			                </div>
		              	</div>

                        <?php if($country->image) { ?>
                        <div> <img src="<?php echo base_url('upload/country').'/'.$country->image ?>" /> </div>
                        <?php } ?>

						<div class="form-group">
			                <label for="image" class="col-sm-2 control-label">Country Photo:</label>
			                <div class="col-sm-10">
			                  <?php echo form_upload('image','', 'id="image" class="round form-control default-width-input" autofocus'); ?>
			                </div>
		              	</div>
							
							<!--</form>-->
						
						</div> <!-- end half-size-column -->
						
						<div class="half-size-column fr">

							<div class="form-group">
				                <label for="description" class="col-sm-2 control-label">Country Description:</label>
				                <div class="col-sm-10">
				                	<?php echo form_hidden('id',$country->id, set_value('id')); ?>
				                	<?php echo form_textarea('description',$country->description, 'id="description" class="round default-width-input" autofocus'); ?>
				                </div>
			              	</div>

			              	<div class="container button-submit">
				                <div class="text-uppercase text-center">
				                    <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?>
				                </div>
				            </div>
							
						</div> <!-- end half-size-column -->
                    
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