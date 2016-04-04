<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title> Image Management -Edit gallery</title>
    <?php include_once('application/views/admin/header.php'); ?>

    <script type="text/javascript">
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
      <li><a href="#" class="active-tab dashboard-tab">Edit image</a></li>
    </ul>
    <!-- end tabs --> 
    
    <!-- Change this image to your own company's logo --> 
    <!-- The logo will automatically be resized to 30px height. --> 
    <?php include_once('application/views/admin/logo.php'); ?> </div>
  <!-- end full-width --> 
  
</div>
<!-- end header --> 

<!-- MAIN CONTENT -->
<div id="content">
  <div class="page-full-width cf">
    <div> <!-- class="side-content fr" -->
      
      <div class="content-module">
        <div class="content-module-heading cf">
          <h3 class="fl">Form Elements </h3>
          <span class="fr expand-collapse-text">Click to collapse</span> <span class="fr expand-collapse-text initial-expand">Click to expand</span> </div>
        <!-- end content-module-heading -->
        
        <div class="content-module-main cf">

            <?php echo form_open_multipart('admin/galleries/update', 'id="galleryForm" name="galleryForm"'); ?>
                <div class="half-size-column fl"> <?php echo validation_errors(); ?>

                    <p>
                        <?php
                        echo '<br><span class="label">Active </span>';
                        echo form_checkbox('active',1, $gallery->active == 1 ? true : false);
                        ?>
                    </p>

                    <p>
                        <?php
                        echo form_label('Ordering: ', 'ordering');
                        echo form_input('ordering',$gallery->ordering, 'id="ordering" class="round small-width-input numbersOnly" autofocus');
                        ?>
                    </p>

                    <fieldset>
                        <p>
                            <?php
                            echo form_label('Image Title: ', 'title');
                            echo form_input('title', $gallery->title, 'id="title" class="round default-width-input" autofocus');
                            ?>
                        </p>
                        <p id="titleError">Please enter image title!</p>
                        
                        <p>
                            <?php
                            echo form_label('Image Category: ', 'category');
                            ?>
                        </p>

                        <fieldset id="category">
                            <?php
                            $option_category = array("" => "-- Please Select --");
                            foreach ($categories as $category)
                                $option_category[$category['id']] = $category['name'];

                            echo form_dropdown('category_id', $option_category, $gallery->category_id, 'id="category_id"');
                            ?>
                        </fieldset>

                        <p id="categoryError">Please choose image category!</p>

                        <p>
                            <?php
                            echo form_label('Alt: ', 'alt');
                            echo form_input('alt', $gallery->alt, 'id="alt" class="round default-width-input" autofocus');
                            ?>
                        </p>

                        <?php if($gallery->image != '') {?>
                            <p>
                                <img src="<?php echo base_url();?>upload/galleries/thumbs/thumb_<?php echo $gallery->image?>">
                            </p>
                        <?php } ?>
                        <p>
                            <?php
                            echo form_label('Image: ', 'image');
                            echo form_upload('image','', 'id="image" class="round default-width-input" autofocus');
                            ?>
                        </p>

                    </fieldset>
                </div>
                <!-- end half-size-column fl-->

                <div class="half-size-column fr">
                    <fieldset>
                        <p>
                            <?php
                            echo form_label('Image description: ', 'description');
                            echo form_textarea('description', $gallery->description, 'id="description" class="round full-width-textarea" autofocus');
                            ?>
                        </p>
                    </fieldset>
                </div>
                <!-- end half-size-column FR-->

                <div style="clear:both;">
                    <div style="padding-top:20px;">
                        <?php echo form_hidden('gallery_id',$gallery->id); ?>
                        <?php echo form_hidden('image_old',$gallery->image, set_value('image_old')); ?>
                        <?php echo form_submit('save', 'Save', 'class="round blue ic-right-arrow"'); ?>
                    </div>
                </div>

            <?php echo form_close(); ?>
          
          </div>
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