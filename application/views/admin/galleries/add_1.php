<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Gallery Management - New gallery</title>
    <?php include_once('application/views/admin/header.php'); ?>

    <link href="<?php echo base_url();?>public/css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">

    <script src="<?php echo base_url();?>public/js/jquery-ui-1.10.3.custom.min.js"></script>

    <script type="text/javascript">

        $(function() {
            $( "#_tabs" ).tabs();
        });

        $(document).ready(function(){

            $('#galleryForm').submit(function(){

                if(validateTitle() & validateCategory())
                    return true
                else
                    return false;
            });

            function validateTitle(){
                if($('#title').val() == ""){
                    $('#title').addClass("error");
                    $('#titleError').toggle();
                    $('#titleError').show();
                    return false;
                }
                //if it's valid
                else{
                    $('#title').removeClass("error");
                    $('#titleError').toggle();
                    $('#titleError').hide();
                    return true;
                }
            }

            function validateCategory(){
                if($('#category_id').val() == ""){
                    $('#category_id').addClass("round error");
                    $('#categoryError').toggle();
                    $('#categoryError').show();
                    return false;
                }
                //if it's valid
                else{
                    $('#category_id').removeClass("error");
                    $('#categoryError').toggle();
                    $('#categoryError').hide();
                    return true;
                }
            }

            //Enter number only
            jQuery('.numbersOnly').keyup(function () {
                this.value = this.value.replace(/[^0-9\.]/g,'');
            });
        });

        /* Add  New Gallery   */



    </script>

</head>

<body>
<!-- TOP BAR -->
<div id="top-bar">
  <div class="page-full-width cf">
    <ul id="nav" class="fl">
      <li class="v-sep"><a href="<?php echo site_url("../");?>" class="round button dark ic-left-arrow image-left">Main</a></li>
      <?php include_once('application/views/admin/menu.php'); ?>
    </ul>
    <!-- end nav --> 
    
  </div>
  <!-- end full-width --> 
  
</div>
<!-- end top-bar --> 

<!-- HEADER -->
<div id="header-with-tabs">
  <div class="page-full-width cf">
    <ul id="tabs" class="fl">
      <li><a href="<?php echo site_url("admin/galleries/");?>">Dashboard</a></li>
      <li><a href="<?php echo site_url("admin/galleries/add");?>" class="active-tab dashboard-tab">Add new <ar></ar>gallery</a></li>
    </ul>
    <!-- end tabs --> 
    
    <!-- Change this image to your own company's logo --> 
    <!-- The logo will automatically be resized to 30px height. -->
    <?php include_once('application/views/admin/logo.php'); ?>
  </div>
  <!-- end full-width --> 
  
</div>
<!-- end header --> 

<!-- MAIN CONTENT -->
<div id="content">
    <div class="page-full-width cf">
    <div> <!-- class="side-content fr" -->

        <div class="content-module">

            <?php echo form_open_multipart('admin/galleries/store', 'id="galleryForm" title="galleryForm"'); ?>

                <div id="_tabs" style="float:left; width:100%;">
                    <ul>
                        <li><a href="#tabs-1">Info</a></li>
                    </ul>
                    <div id="tabs-1">
                        <?php echo validation_errors(); ?>
                        <div id="gallery">

                            <p>
                                <?php
                                echo '<br><span class="label">Active </span>';
                                echo form_checkbox('active','1',true);
                                ?>
                            </p>
                            <p>
                                <?php
                                echo form_label('Ordering: ', 'ordering');
                                echo form_input('ordering','', 'id="ordering" class="round small-width-input numbersOnly" autofocus');
                                ?>
                            </p>
                            <fieldset>
                                <p>
                                    <?php
                                        echo form_label('Gallery Title: ', 'title');
                                        echo form_input('title','', 'id="title" class="round default-width-input" autofocus');
                                    ?>
                                </p>
                                <p id="titleError">Please enter gallery title!</p>

                                <p>
                                    <?php
                                    echo form_label('alt: ', 'alt');
                                    echo form_input('alt','', 'id="alt" class="round default-width-input" autofocus');
                                    ?>
                                </p>

                                <p>
                                    <?php
                                        echo form_label('Gallery Category: ', 'category');
                                    ?>
                                </p>

                                <fieldset id="category">
                                <?php
                                    $option_category = array("" => "-- Please Select --");
                                    foreach ($categories as $category)
                                    {
                                        $option_category[$category['id']] = $category['name'];
                                    }

                                    echo form_dropdown('category_id', $option_category, "", 'id="category_id"');
                                ?>
                                </fieldset>

                                <p id="categoryError">Please choose gallery category!</p>

                                <p>
                                    <?php
                                    echo form_label('Image: ', 'image');
                                    echo form_upload('image','', 'id="image" class="round default-width-input" autofocus');
                                    ?>
                                </p>

                            </fieldset>

                            <fieldset>
                                <p>
                                    <?php
                                    echo form_label('Gallery description: ', 'description');
                                    echo form_textarea('description','', 'id="description" class="round full-width-textarea" autofocus');
                                    ?>
                                </p>
                            </fieldset>
                        </div>
                        <!-- end half-size-column fl-->

                        <hr />
                        <p>
                            <input onclick="addRow(this.form);" type="button" value="Add Gallery" />
                        </p>
                    </div>

                </div>


                <div style="clear:both;">
                    <div style="padding-top:20px;">
                        <?php echo form_submit('save', 'Save', 'class="round blue ic-right-arrow"'); ?>
                    </div>
                </div>

            <?php echo form_close(); ?>
        </div>
        <!-- end content-module -->
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