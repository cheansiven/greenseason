<?php include_once('application/views/admin/header.php'); ?>

<script ="text/javascript">
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

        /*function validateCategory(){
            if($('#type').val() == ""){
                $('#type').addClass("round error");
                $('#categoryError').toggle();
                $('#categoryError').show();
                return false;
            }
            //if it's valid
            else{
                $('#type').removeClass("error");
                $('#categoryError').toggle();
                $('#categoryError').hide();
                return true;
            }
        }*/

    });
</script>

<!-- MAIN CONTENT -->
<div class="container">
    <a href="<?php echo site_url("admin/article_categories/");?>" class="btn btn-default">Dashboard</a>
    <a href="#" class="btn btn-primary">Edit category</a>
</div>
	<div id="content" class="container">
		<div class="page-full-width cf">
			<div> <!-- class="side-content fr" -->
				<div class="content-module">
					<div class="content-module-heading cf">
						<h3 class="fl">Form Elements [ Article Category ]</h3>
					</div> <!-- end content-module-heading -->
					
					
					<div class="content-module-main cf">
					<?php echo form_open_multipart('admin/article_categories/update', 'id="categoryForm" class="form form-horizontal" name="categoryForm"'); ?>
						<div class="half-size-column fl">
						<?php echo validation_errors(); ?>

							<div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <?php echo form_checkbox('active',1, $category->active == 1 ? true : false); ?> Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ordering" class="col-sm-2 control-label">Ordering</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('ordering',$category->ordering, 'id="ordering" class="round form-control small-width-input" autofocus'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Category Name</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('name',$category->name, 'id="name" class="round form-control default-width-input" autofocus'); ?>
                                    <p id="nameError">Please enter category name!</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Category Type</label>
                                <div id="category_type" class="col-sm-10">
                                    <?php
                                        $option_type = array(
                                            '' => "-- Please Select --",
                                            '2' => "Extra Block",
                                            '1' => "Slide Content Block",
                                        );

                                        echo form_dropdown('type', $option_type, $category->type, 'id="type" class="form-control"');
                                        ?>
                                </div>
                                <p id="categoryError">Please choose category type!</p>
                            </div>
							<?php if($category->image != '') {?>
                                  <div>
                                    <img src="<?php echo base_url();?>upload/articles/categories/<?php echo $category->image?>">
                                  </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="photo" class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-10">
                                    <?php echo form_upload('image','', 'id="image" class="round form-control default-width-input" autofocus'); ?>
                                    <em>You can add a hint or a small description here.</em>
                                </div>
                            </div>
							
							<!--</form>-->
						
						</div> <!-- end half-size-column -->
						
						<div class="half-size-column fr">
						
							<!--<form action="#">-->
							
								<fieldset>
								
									<div class="form-group">
	                                    <label for="description" class="col-sm-2 control-label">Description</label>
	                                    <div class="col-sm-10">
	                                        <?php echo form_textarea('description',$category->description, 'id="description" class="round form-control full-width-textarea" autofocus'); ?>
	                                    </div>
	                                </div>

                                    <?php 
									echo form_hidden('id',$category->id, set_value('id'));
									echo form_hidden('imageold',$category->image, set_value('imageold')); 
									?>
							
							<!--</form>-->
							
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