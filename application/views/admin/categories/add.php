<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tours Categories Management - New Category</title>
	<?php include_once('application/views/admin/header.php'); ?>

    <link href="<?php echo base_url();?>public/css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">

    <script src="<?php echo base_url();?>public/js/jquery-ui-1.10.3.custom.min.js"></script>

    <script ="text/javascript">

        $(function() {
            $( "#_tabs" ).tabs();
        });

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
				<li><a href="<?php echo site_url("admin/categories/add");?>" class="active-tab dashboard-tab">Add new catergory</a></li>
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

            <div class="content-module">
			    <?php echo form_open_multipart('admin/categories/store', 'id="categoryForm" name="categoryForm"'); ?>

                    <div id="_tabs" style="float:left; width:100%;">
                        <ul>
                            <li><a href="#tabs-1">Info</a></li>
                            <li><a href="#tabs-2">Meta</a></li>
                        </ul>
                        <div id="tabs-1">

                            <div class="half-size-column fl">
                            <?php echo validation_errors(); ?>
                                <!--<form action="#">-->

                                    <fieldset>

                                        <p>
                                            <!--<label for="simple-input">Simple input</label>
                                            <input type="text" id="simple-input" class="round default-width-input" />-->
                                            <?php

                                              echo form_label('Category Name: ', 'name');
                                              echo form_input('name','', 'id="name" class="round default-width-input" autofocus');

                                            ?>
                                        </p>
                                        <p>
                                            <?php

                                          //  echo form_label('Category Name [EN]: ', 'name_en');
                                          //  echo form_input('name_en','', 'id="name_en" class="round default-width-input" autofocus');

                                            ?>
                                        </p>
                                        <p>
                                        <?php
                                            echo '<br><span class="label">Hightlight </span>';
                                            echo form_checkbox('highlight','1',false);
                                        ?>
                                    </p>
                                        <p id="nameError">Please enter category name!</p>
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
                                            echo form_textarea('description','', 'id="description" class="round full-width-textarea" autofocus');

                                            ?>
                                        </p>
                                        <p>
                                            <?php

                                         //   echo form_label('Description [EN]: ', 'description_en');
                                         //   echo form_textarea('description_en','', 'id="description_en" class="round full-width-textarea" autofocus');

                                            ?>
                                        </p>

                                    </fieldset>

                                <!--</form>-->

                            </div> <!-- end half-size-column -->

                        </div>

                        <div id="tabs-2">
                            <p>
                                <?php
                                echo form_label('Meta title: ', 'meta_title').'<br>';
                                echo form_input('meta_title','', 'id="meta_title" class="round default-width-input" autofocus');
                                ?>
                            </p>
                            <p>
                                <?php
                              //  echo form_label('Meta title [EN]: ', 'meta_title_en').'<br>';
                               // echo form_input('meta_title_en','', 'id="meta_title_en" class="round default-width-input" autofocus');
                                ?>
                            </p>
                            <p>
                                <?php
                                echo form_label('URL: ', 'url').'<br>';
                                echo form_input('url','', 'id="url" class="round default-width-input" autofocus');
                                ?>
                            </p>
                            <p>
                                <?php
                              //  echo form_label('URL [EN]: ', 'url_en').'<br>';
                              //  echo form_input('url_en','', 'id="url_en" class="round default-width-input" autofocus');
                                ?>
                            </p>
                            <p>
                                <?php
                                echo form_label('Meta keyword: ', 'meta_keyword').'<br>';
                                echo form_input('meta_keyword','', 'id="meta_keyword" class="round default-width-input" autofocus');
                                ?>
                            </p>
                            <p>
                                <?php
                            //    echo form_label('Meta keyword [EN]: ', 'meta_keyword_en').'<br>';
                            //    echo form_input('meta_keyword_en','', 'id="meta_keyword_en" class="round default-width-input" autofocus');
                                ?>
                            </p>
                            <p>
                                <?php
                                echo form_label('Meta description: ', 'meta_description').'<br>';
                                echo form_textarea('meta_description','', 'id="meta_description" class="round" style="width:1000px;" autofocus');
                                ?>
                            </p>
                            <p>
                                <?php
                            //    echo form_label('Meta description [EN]: ', 'meta_description_en').'<br>';
                             //   echo form_input('meta_description_en','', 'id="meta_description_en" class="round" style="width:1000px;" autofocus');
                                ?>
                            </p>
                        </div>
                    </div>

                    <div style="clear:both;">
                        <div style="padding-top:20px;">
                            <?php echo form_submit('save', 'Save', 'class="round blue ic-right-arrow"'); ?>
                        </div>
                    </div>

                <?php echo form_close(); ?>

            </div><!-- end content-module -->

        </div><!-- end spage-full-width cf -->

    </div> <!-- end content -->


	
	<!-- FOOTER -->
	<?php include_once('application/views/admin/footer.php'); ?>
    <!-- end footer -->

</body>
</html>