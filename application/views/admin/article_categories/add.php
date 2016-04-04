<?php include_once('application/views/admin/header.php'); ?>
    
    <script type="text/javascript">

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
    <a href="<?php echo site_url("admin/article_categories/add");?>" class="btn btn-primary">Add new category</a>
</div>

<div id="content">
    <div class="page-full-width cf">

        <div class="content-module">
            <?php echo form_open_multipart('admin/article_categories/store', 'id="categoryForm" class="form form-horizontal" name="categoryForm"'); ?>

                <div id="_tabs" class="wrap-tabs">
                    <div class="menu-tabs">
                        <ul class="container">
                            <li><a href="#tabs-1">Info</a></li>
                            <li><a href="#tabs-2">Meta</a></li>
                        </ul>
                    </div>
                    <div class="container content-tabs">
                        <div id="tabs-1">

                            <div class="half-size-column fl">
                            <?php echo validation_errors(); ?>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <?php echo form_checkbox('active','1',true); ?> Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ordering" class="col-sm-2 control-label">Ordering</label>
                                    <div class="col-sm-10">
                                        <?php echo form_input('ordering','', 'id="ordering" class="round form-control small-width-input" autofocus'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <?php echo form_input('name','', 'id="name" class="round form-control default-width-input" autofocus'); ?>
                                        <p id="nameError">Please enter category name!</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <?php echo form_input('name','', 'id="name" class="round form-control default-width-input" autofocus'); ?>
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

                                        echo form_dropdown('type', $option_type, "", 'id="type" class="form-control"');
                                        ?>
                                    </div>
                                    <p id="categoryError">Please choose category type!</p>
                                </div>
                                <div class="form-group">
                                    <label for="photo" class="col-sm-2 control-label">Image</label>
                                    <div class="col-sm-10">
                                        <?php echo form_upload('image','', 'id="image" class="round form-control default-width-input" autofocus'); ?>
                                        <em>You can add a hint or a small description here.</em>
                                    </div>
                                </div>

                                <!--</form>-->
                            </div> <!-- end half-size-column fl-->

                            <div class="half-size-column fr">
                                
                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <?php echo form_textarea('description','', 'id="description" class="round form-control full-width-textarea" autofocus'); ?>
                                    </div>
                                </div>
                                <!--</form>-->
                            </div> <!-- end half-size-column fr -->
                        </div> <!-- /.tabs-1 -->
                        <div id="tabs-2">
                            <div class="form-group">
                                <label for="meta_title" class="col-sm-2 control-label">Meta title</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('meta_title','', 'id="meta_title" class="round form-control default-width-input" autofocus'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url" class="col-sm-2 control-label">URL</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('url','', 'id="url" class="round form-control default-width-input" autofocus'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword" class="col-sm-2 control-label">Meta keyword</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('meta_keyword','', 'id="meta_keyword" class="round form-control default-width-input" autofocus'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="meta_description" class="col-sm-2 control-label">Meta description</label>
                                <div class="col-sm-10">
                                    <?php echo form_input('meta_description','', 'id="meta_description" class="round form-control" autofocus'); ?>
                                </div>
                            </div>
                        </div> <!-- /.tabs-2 -->
                    </div>
                </div>

                
                <div class="container button-submit">
                    <div class="text-uppercase text-center">
                        <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?>
                    </div>
                </div>

            <?php echo form_close(); ?>

        </div><!-- end content-module -->

	</div><!-- end spage-full-width cf -->
		
</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<?php include_once('application/views/admin/footer.php'); ?>
