<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Image Management - New image</title>
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
                    return true;
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

        /* Add  New Image   */
        var rowNum = 0;

        function addRow(frm) {

            rowNum ++;

            var i = rowNum+1;
            var row = '' +
                '<div id="gallery'+rowNum+'"><div class="clear"></div><hr />#' +i +
                    '<div id="script'+rowNum+'"></div>' +
                    '<div class="half-size-column fl">' +
                        '<p><?php echo '<br><span class="label">Active </span>'; echo form_checkbox("active'+rowNum+'",'1',true);?></p>' +
                        '<p><?php echo form_label('Ordering: ', 'ordering');echo form_input("ordering'+rowNum+'",'', "id=\"ordering'+rowNum+'\" class=\"round small-width-input numbersOnly\" autofocus");?></p>' +
                        '<p><?php echo form_label('Image Title: ', 'title'); echo form_input("title'+rowNum+'",'', "id=\"title'+rowNum+'\" class=\"round default-width-input\" autofocus");?></p><p id="titleError'+rowNum+'" style="display:none;color: #e77776;font-size: 12px;">Please enter image title!</p>' +
                        '<p><?php echo form_label('ALT: ', 'alt'); echo form_input("alt'+rowNum+'",'', "id=\"alt'+rowNum+'\" class=\"round default-width-input\" autofocus");?></p>' +
                        '<p><?php echo form_label('Image Category: ', 'category');?></p>' +
                        '<fieldset id="">'+
                        '<select id="category_id'+rowNum+'" name="category_id'+rowNum+'">' +
                                '<option value="">-- Please Select --</option>' +
                            '<?php foreach ($categories as $category) :?>' +
                                '<option value="<?=$category["id"]?>"><?=$category["name"] ?></option>' +
                            '<?php endforeach; ?>' +
                        '</select>' +
                        '</fieldset>' +
                        '<p id="categoryError'+rowNum+'" style="display:none;display:none;color: #e77776;font-size: 12px;">Please choose image category!</p>' +
                        '<p><?php echo form_label('Image: ', 'image'); echo form_upload("image'+rowNum+'",'',  "id=\"image'+rowNum+'\" class=\"round default-width-input\" autofocus" );?></p>'+
                        '</fieldset>' +
                        '<p><input type="button" value="Remove" onclick="removeRow('+rowNum+');" style="color:red;"></p>' +
                    '</div>' +
                    '<div class="half-size-column fr">' +
                        '<fieldset>'+
                            '<p><?php echo form_label('Image description: ', 'description'); echo form_textarea("description'+rowNum+'", "", "id=\"description'+rowNum+'\" class=\"round full-width-textarea\" autofocus");?></p>'+
                        '</fieldset>' +
                        '<input type="hidden" value="'+rowNum+'" name="rows[]"></div>'
                    '</div>' +
                '</div>';

            jQuery('#gallery').append(row);

            var script = document.createElement( 'script' );
            script.type = 'text/javascript';
            script.innerHTML = ''+
                '$(document).ready(function(){' +
                    '$("#galleryForm").submit(function(){' +
                        'if(validateTitle'+rowNum+'() & validateCategory'+rowNum+'()){' +
                            'return true;'+
                        '}else{' +
                            'return false;' +
                        '}' +
                    '});' +
                    'function validateCategory'+rowNum+'(){' +
                        'if($("#category_id'+rowNum+'").val() == ""){' +
                            '$("#category_id'+rowNum+'").addClass("error");' +
                            '$("#categoryError'+rowNum+'").toggle();' +
                            '$("#categoryError'+rowNum+'").show();' +
                            'return false;' +
                        '}' +
                        'else{' +
                            '$("#category_id'+rowNum+'").removeClass("error");' +
                            '$("#categoryError'+rowNum+'").toggle();' +
                            '$("#categoryError'+rowNum+'").hide();' +
                            'return true;' +
                        '}' +
                    '}' +
                    'function validateTitle'+rowNum+'(){' +
                        'if($("#title'+rowNum+'").val() == ""){' +
                            '$("#title'+rowNum+'").addClass("error");' +
                            '$("#titleError'+rowNum+'").toggle();' +
                            '$("#titleError'+rowNum+'").show();' +
                            'return false;' +
                        '}' +
                        'else{' +
                            '$("#title'+rowNum+'").removeClass("error");' +
                            '$("#titleError'+rowNum+'").toggle();' +
                            '$("#titleError'+rowNum+'").hide();' +
                            'return true;' +
                        '}' +
                    '}' +

                '});';

            jQuery('#script'+rowNum).append(script);

            tinyMCE.init({
                selector: "#description"+rowNum
            });

            //add tinymce to this
            tinyMCE.execCommand("mceAddControl", false, 'description'+rowNum);

        }

        function removeRow(rnum) {
            jQuery('#gallery'+rnum).remove();
        }

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
      <li><a href="<?php echo site_url("admin/galleries/add");?>" class="active-tab dashboard-tab">Add new <ar></ar>image</a></li>
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
                            <div class="half-size-column fl">

                                <p>
                                    <?php
                                    echo '<br><span class="label">Active </span>';
                                    echo form_checkbox('active0','1',true);
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo form_label('Ordering: ', 'ordering');
                                    echo form_input('ordering0','', 'id="ordering" class="round small-width-input numbersOnly" autofocus');
                                    ?>
                                </p>
                                <p>
                                    <?php
                                        echo form_label('Image Title: ', 'title');
                                        echo form_input('title0','', 'id="title" class="round default-width-input" autofocus');
                                    ?>
                                </p>
                                <p id="titleError">Please enter image title!</p>

                                <p>
                                    <?php
                                    echo form_label('alt: ', 'alt');
                                    echo form_input('alt0','', 'id="alt" class="round default-width-input" autofocus');
                                    ?>
                                </p>

                                <p>
                                    <?php
                                        echo form_label('Image Category: ', 'category');
                                    ?>
                                </p>

                                <fieldset id="category">
                                    <?php
                                        $option_category = array("" => "-- Please Select --");
                                        foreach ($categories as $category)
                                        {
                                            $option_category[$category['id']] = $category['name'];
                                        }

                                        echo form_dropdown('category_id0', $option_category, "", 'id="category_id"');
                                    ?>
                                    </fieldset>

                                    <p id="categoryError">Please choose image category!</p>

                                    <p>
                                        <?php
                                        echo form_label('Image: ', 'image');
                                        echo form_upload('image0','', 'id="image" class="round default-width-input" autofocus' );
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
                                        echo form_textarea('description0','', 'id="description" class="round full-width-textarea" autofocus');
                                        ?>
                                    </p>
                                </fieldset>
                                <input type="hidden" value="0" name="rows[]">
                            </div>
                            <!-- end half-size-column FR-->
                        </div>
                        <!-- end half-size-column fl-->
                        <div class="clear"></div>
                        <hr />
                        <p>
                            <input onclick="addRow(this.form);" type="button" value="Add Image" />
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