<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Article Management - New article</title>
    <?php include_once('application/views/admin/header.php'); ?>

    <link href="<?php echo base_url();?>public/css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">

    <script src="<?php echo base_url();?>public/js/jquery-ui-1.10.3.custom.min.js"></script>

    <script type="text/javascript">

        $(function() {
            $( "#_tabs" ).tabs();
        });

        $(document).ready(function(){

            $('#articleForm').submit(function(){

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
            <li><a href="<?php echo site_url("admin/contact/");?>">Dashboard</a></li>
            <li><a href="#" class="active-tab dashboard-tab">Add new <ar></ar>contact</a></li>
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

                <?php echo form_open_multipart('admin/contact/do_update/'.$results->id, 'id="articleForm" title="articleForm"'); ?>

                <div style="margin-left: 20px; margin-top: 20px;">

                    <fieldset class="destination">
                        <?php
                        $option_category = array("" => "-- Please Select --");
                        foreach ($category_lists as $category)
                            $option_category[$category['id']] = $category['name'];
                        echo '<label for="name">Select category</label><br />';
                        echo form_dropdown('category_lists', $option_category, $results->tour_category_id);
                        ?>
                    </fieldset><br />

                    <div>
                        <label for="name">Title</label><br />
                        <input type="text" name="name" size="50" value="<?= $results->title ?>" />
                    </div><br />
                    <div>
                        <label for="email">E-mail</label><br />
                        <input type="text" name="email" size="50" value="<?= $results->email ?>" />
                    </div><br />
                    <div>
                        <label for="phone">Phone number</label><br />
                        <input type="text" name="phone" size="50" value="<?= $results->phone ?>" />
                    </div><br />
                    <div>
                        <?php
                        $image = $results->image;
                        echo $image = (empty($image)) ? "" : "<img src='".base_url()."upload/contact/".$results->image."' width='100' style='border-radius: 50%' /><br /><br />";
                        ?>
                        <!--<img src="<?/*= base_url().$image */?>" width="100" style="border-radius: 50%" /><br /><br />-->
                        <input type="file" name="userfile" /><br />
                        <input type="hidden" name="old_image" value="<?= $results->image ?>" />
                        <small>Brows your icon</small>
                    </div><br />
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