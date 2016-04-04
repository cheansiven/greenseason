<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Comment Management - New comment</title>
	<?php include_once('application/views/admin/header.php'); ?>

    <link href="<?php echo base_url();?>public/css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>public/js/jquery-ui-1.10.3.custom.min.js"></script>

    <link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.datepick.css">
    <script src="<?php echo base_url();?>public/js/jquery.datepick.js"></script>
    
    <script type="text/javascript">

        $(function() {
            $( "#_tabs" ).tabs();
        });


        $(document).ready(function(){

            $('#untilDatepicker').datepick();

            $('#commentForm').submit(function(){

                if(validateName() && validateEmail())
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

            function validateEmail(){
                if($('#email').val() == ""){
                    $('#email').addClass("error");
                    $('#emailError').toggle();
                    $('#emailError').show();
                    return false;
                }
                //if it's valid
                else{
                    $('#email').removeClass("error");
                    $('#emailError').toggle();
                    $('#emailError').hide();
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
				<li><a href="<?php echo site_url("admin/comments/");?>">Dashboard</a></li>
				<li><a href="<?php echo site_url("admin/comments/add");?>" class="active-tab dashboard-tab">Add new comment</a></li>
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
                <?php echo form_open_multipart('admin/comments/store', 'id="commentForm" name="commentForm"'); ?>

                    <div id="_tabs" style="float:left; width:100%;">
                        <ul>
                            <li><a href="#tabs-1">Info</a></li>
                        </ul>
                        <div id="tabs-1">

                            <div class="half-size-column fl">
                            <?php echo validation_errors(); ?>
                                <!--<form action="#">-->
                                <p>
                                    <?php
                                    echo '<br><span class="label">Active </span>';
                                    echo form_checkbox('active','1',true);
                                    ?>
                                </p>

                                <fieldset id="category_type">
                                    <?php
                                    echo form_label('Stars: ', 'star');

                                    $option_type = array(
                                        '' => "",
                                        '1' => "★",
                                        '2' => "★★",
                                        '3' => "★★★",
                                        '4' => "★★★★",
                                        '5' => "★★★★★"
                                    );

                                    echo form_dropdown('rate', $option_type, "", 'id="rate"');
                                    ?>
                                </fieldset>

                                <fieldset>

                                    <p>
                                        <?php

                                        echo form_label('Name: ', 'name');
                                        echo form_input('name','', 'id="name" class="round default-width-input" autofocus');

                                        ?>
                                    </p>
                                    <p id="nameError">Please enter name!</p>


                                </fieldset>

                                <fieldset>

                                    <p>
                                        <?php

                                          echo form_label('Email: ', 'email');
                                          echo form_input('email','', 'id="email" class="round default-width-input" autofocus');

                                        ?>
                                    </p>
                                    <p id="emailError">Please enter email!</p>


                                </fieldset>
                                <fieldset>

                                    <p>
                                        <?php

                                        echo form_label('Comment Date: ', 'comment-date');
                                        echo form_input('create_date','', 'id="untilDatepicker" class="round default-width-input" autofocus readonly="readonly"');

                                        ?>
                                    </p>
                                    <p id="emailError">Please enter email!</p>


                                </fieldset>

                                <!--</form>-->
                            </div> <!-- end half-size-column fl-->

                            <div class="half-size-column fr">
                                <!--<form action="#">-->

                                    <fieldset>

                                        <p>
                                            <?php

                                            echo form_label('Comment: ', 'comment');
                                            echo form_textarea('comment','', 'id="comment" class="round full-width-textarea" autofocus');

                                            ?>
                                        </p>

                                    </fieldset>

                                <!--</form>-->
                            </div> <!-- end half-size-column fr -->
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