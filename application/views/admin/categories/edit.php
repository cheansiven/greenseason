<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tours Categories Management - Edit category</title>
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
    
</head>
<body>

	<!-- TOP BAR -->
	<div id="top-bar">
		
		<div class="page-full-width cf">

			<ul id="nav" class="fl">
				
                <li class="v-sep"><a href="<?php echo site_url("../");?>" class="round button dark ic-left-arrow image-left">Main</a></li>
				<?php include_once('application/views/admin/menu.php'); ?>
				
			</ul> <!-- end nav -->

		</div> <!-- end full-width -->	
	
	</div> <!-- end top-bar -->
	
	
	
	<!-- HEADER -->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
	
			<ul id="tabs" class="fl">
				<li><a href="<?php echo site_url("admin/categories/");?>">Dashboard</a></li>
				<li><a href="#" class="active-tab dashboard-tab">Edit category</a></li>
			</ul> 
            <!-- end tabs -->
			
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 30px height. -->
			<?php include_once('application/views/admin/logo.php'); ?>
			
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">
			
			<div> <!-- class="side-content fr" -->
			
				
				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">Form Elements</h3>
						<span class="fr expand-collapse-text">Click to collapse</span>
						<span class="fr expand-collapse-text initial-expand">Click to expand</span>
					
					</div> <!-- end content-module-heading -->
					
					
					<div class="content-module-main cf">
					<?php echo form_open_multipart('admin/categories/update', 'id="categoryForm" name="categoryForm"'); ?>
						<div class="half-size-column fl">
						<?php echo validation_errors(); ?>
							<!--<form action="#">-->
							
								<fieldset>
								
									<p>
										<!--<label for="simple-input">Simple input</label>
										<input type="text" id="simple-input" class="round default-width-input" />-->
                                        <?php
										
										  echo form_label('Category Name: ', 'name');
										  echo form_input('name',$category->name, 'id="name" class="round default-width-input" autofocus');
										  
									    ?>
									</p>
                                    <p>
                                        <?php

                                      //  echo form_label('Category Name [EN]: ', 'name_en');
                                       // echo form_input('name_en',$category->name_en, 'id="name_en" class="round default-width-input" autofocus');

                                        ?>
                                    </p>
                                     <p>
                                    <?php 
                                        echo '<br><span class="label">Hightlight </span>';
										if ($category->highlight == 1)
                                        	echo form_checkbox('highlight','1',true);
										else echo form_checkbox('highlight','1',false);
                                    ?>
                                </p>
									<p id="nameError">Please enter category name!</p>
                                    
                                     <?php if($category->image != '') {?>
                                <p>
                                <br><img src="<?php echo base_url();?>upload/categories/<?php echo $category->image?>">
                                </p>
                                <?php } ?>
									<p>
                                    	<?php
										
										  echo form_label('Image: ', 'photo');
      									  echo form_upload('image','', 'id="image" class="round default-width-input" autofocus'); 
										  
									    ?>		
                                        <em>You can add a hint or a small description here.</em>				
									</p>

								</fieldset>
							
							<!--</form>-->
						
						</div> <!-- end half-size-column -->
						
						<div class="half-size-column fr">
						
							<!--<form action="#">-->
							
								<fieldset>
								
									<p>
                                        <?php 
										
										echo form_label('Description: ', 'description'); 
                                        echo form_textarea('description',$category->description, 'id="description" class="round full-width-textarea" autofocus'); 
										
										?>
									</p>
                                    <p>
                                        <?php

                                      //  echo form_label('Description [EN]: ', 'description_en');
                                      //  echo form_textarea('description_en',$category->description_en, 'id="description_en" class="round full-width-textarea" autofocus');

                                        ?>
                                    </p>

                                    <?php 
									echo form_hidden('id',$category->id, set_value('id'));
									echo form_hidden('imageold',$category->image, set_value('imageold'));
									echo form_submit('save', 'Save', 'class="round blue ic-right-arrow"'); 
									?>
								</fieldset>
							
							<!--</form>-->
							
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