<?php include_once('application/views/admin/header.php'); ?>

<script type="text/javascript">
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

<!-- MAIN CONTENT -->
<div class="container">
    <a href="<?php echo site_url("admin/articles/");?>" class="btn btn-default">Dashboard</a>
    <a href="#" class="btn btn-primary">Edit article</a>
</div>

<div id="content" class="container">
  <div class="page-full-width cf">
    <div> <!-- class="side-content fr" -->
      
      <div class="content-module">
        <div class="content-module-heading cf">
            <h3 class="fl">Form Elements </h3>
        </div>
        <!-- end content-module-heading -->
        
        <div class="content-module-main cf">

            <?php echo form_open_multipart('admin/articles/update', 'id="articleForm" class="form-horizontal" name="articleForm"'); ?>
                <div class="half-size-column fl"> <?php echo validation_errors(); ?>

                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <div class="checkbox">
                            <label>
                                <?php echo form_checkbox('active',1, $article->active == 1 ? true : false); ?> Active
                            </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ordering" class="col-sm-2 control-label">Ordering:</label>
                        <div class="col-sm-10">
                            <?php echo form_input('ordering',$article->ordering, 'id="ordering" class="round form-control small-width-input" autofocus'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Article Title:</label>
                        <div class="col-sm-10">
                            <?php echo form_input('title', $article->title, 'id="title" class="round form-control default-width-input" autofocus'); ?>
                            <p id="titleError">Please enter article title!</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sub_title" class="col-sm-2 control-label">Sub Title:</label>
                        <div class="col-sm-10">
                            <?php echo form_input('sub_title', $article->sub_title, 'id="sub_title" class="round form-control default-width-input" autofocus'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category" class="col-sm-2 control-label">Article Category:</label>
                        <div id="category" class="col-sm-10">
                            <?php
                            $option_category = array("" => "-- Please Select --");
                            foreach ($categories as $category)
                                $option_category[$category['id']] = $category['name'];

                            echo form_dropdown('category_id', $option_category, $article->category_id, 'id="category_id"');
                            ?>
                            <p id="categoryError">Please choose article category!</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="website" class="col-sm-2 control-label">Website:</label>
                        <div class="col-sm-10">
                            <?php echo form_input('website', $article->website, 'id="website" class="round form-control default-width-input" autofocus'); ?>
                        </div>
                    </div>
                    <?php if($article->image != '') {?>
                        <img src="<?php echo base_url();?>upload/articles/<?php echo $article->image?>">
                    <?php } ?>
                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label">Image:</label>
                        <div class="col-sm-10">
                            <?php echo form_upload('image','', 'id="image" class="round form-control default-width-input" autofocus'); ?>
                        </div>
                    </div>
                </div>
                <!-- end half-size-column fl-->
                <div class="half-size-column fr">
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">Article description:</label>
                        <div class="col-sm-10">
                            <?php echo form_textarea('description', $article->description, 'id="description" class="round full-width-textarea" autofocus'); ?>
                        </div>
                    </div>
                </div>
                <!-- end half-size-column FR-->
            <?php echo form_hidden('article_id',$article->id); ?>
            <?php echo form_hidden('image_old',$article->image, set_value('image_old')); ?>
            <div class="container button-submit">
                <div class="text-uppercase text-center">
                    <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div> <!-- end content-module-main -->
      </div>
      <!-- end content-module --> 
      
    </div>
  </div> <!-- end side-content --> 
  
</div> <!-- end full-width -->

<?php include_once('application/views/admin/footer.php'); ?>
