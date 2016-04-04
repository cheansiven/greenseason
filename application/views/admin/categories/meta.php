<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Category Management - Edit tour</title>
<?php include_once('application/views/admin/header.php'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.datepick.css">
<link href="<?php echo base_url();?>public/css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">
	
<script src="<?php echo base_url();?>public/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.datepick.js"></script>


</head>
<body>


<div id="top-bar">
	<div class="page-full-width cf">
    	<ul id="nav" class="fl">
      		<li class="v-sep"><a href="<?php echo site_url("../");?>" class="round button dark ic-left-arrow image-left">Main</a></li>
      		<?php include_once('application/views/admin/menu.php'); ?>
    	</ul>
  	</div>
</div>
<div id="header-with-tabs">
	<div class="page-full-width cf">
    	<ul id="tabs" class="fl">
      		<li><a href="<?php echo site_url("admin/categories/");?>">Dashboard</a></li>
      		<li><a href="#" class="active-tab dashboard-tab">Edit category meta data</a></li>
    	</ul>
    	<?php include_once('application/views/admin/logo.php'); ?>
	</div>
</div>
<div id="content">
		
		<div class="page-full-width cf">

			<div> <!-- class="side-content fr" -->
			
				
				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">Form Elements</h3>
						
					</div> <!-- end content-module-heading -->
					
					
					<div class="content-module-main cf">
					<?php echo form_open_multipart('admin/categories/updateMeta'); ?>
						<div class="half-size-column fl">
						
								<fieldset>
								
									<p>

                                        <?php
										
										  echo form_label('Meta title: ', 'meta_title').'<br>';
										  echo form_input('meta_title',$meta->meta_title, 'id="meta_title" class="round default-width-input" autofocus');
										  
									    ?>
									</p>
                                    <p>

                                        <?php

                                    //   echo form_label('Meta title [EN]: ', 'meta_title_en').'<br>';
                                    //    echo form_input('meta_title_en',$meta->meta_title_en, 'id="meta_title_en" class="round default-width-input" autofocus');

                                        ?>
                                    </p>
                                    <p>

                                        <?php

                                        echo form_label('URL: ', 'url').'<br>';
                                        echo form_input('url',$meta->url, 'id="url" class="round default-width-input" autofocus');

                                        ?>
                                    </p>
                                    <p>

                                        <?php

                                     //  echo form_label('URL [EN]: ', 'url_en').'<br>';
                                     //   echo form_input('url_en',$meta->url_en, 'id="url_en" class="round default-width-input" autofocus');

                                        ?>
                                    </p>
                                    <p>

                                        <?php
										
										  echo form_label('Meta keyword: ', 'meta_keyword').'<br>';
										  echo form_input('meta_keyword',$meta->meta_keyword, 'id="meta_keyword" class="round default-width-input" autofocus');
										  
									    ?>
									</p>
                                    <p>

                                        <?php

                                     //   echo form_label('Meta keyword [EN]: ', 'meta_keyword_en').'<br>';
                                     //   echo form_input('meta_keyword_en',$meta->meta_keyword_en, 'id="meta_keyword_en" class="round default-width-input" autofocus');

                                        ?>
                                    </p>
                                    <p>

                                        <?php
										
										  echo form_label('Meta description: ', 'meta_description').'<br>';
										  echo form_input('meta_description',$meta->meta_description, 'id="meta_description" class="round" style="width:1000px;" autofocus');
										  
									    ?>
									</p>
                                    <p>

                                        <?php

                                       // echo form_label('Meta description [EN]: ', 'meta_description_en').'<br>';
                                     //   echo form_input('meta_description_en',$meta->meta_description_en, 'id="meta_description_en" class="round" style="width:1000px;" autofocus');

                                        ?>
                                    </p>
									<?php 
									echo form_hidden('id',$meta->id, set_value('id'));
									echo form_submit('save', 'Save', 'class="round blue ic-right-arrow"'); 
									?>

								</fieldset>
							
							<!--</form>-->
						
						</div> <!-- end half-size-column -->
						
						<div class="half-size-column fr">
						
							<!--<form action="#">-->
							
								<fieldset>
								
									<p>
          
									</p>

                                    
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
<?php include_once('application/views/admin/footer.php'); ?>
</body>
</html>