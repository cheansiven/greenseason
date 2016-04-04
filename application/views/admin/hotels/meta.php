<?php include_once('application/views/admin/header.php'); ?>

<!-- MAIN CONTENT -->
<div class="container">
    <a href="<?php echo site_url("admin/hotels/");?>" class="btn btn-default">Dashboard</a>
    <a href="<?php echo site_url("admin/hotels/add");?>" class="btn btn-primary">Edit meta</a>
</div>

<div id="content" class="container">
		
		<div class="page-full-width cf">

			<div> <!-- class="side-content fr" -->
			
				
				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">Form Elements</h3>
						
					</div> <!-- end content-module-heading -->
					
					
					<div class="content-module-main cf">
					<?php echo form_open_multipart('admin/hotels/updateMeta'); ?>
						<div class="half-size-column fl">
						
								<fieldset>
								
									<p>

                                        <?php
										
										  echo form_label('Meta title: ', 'meta_title').'<br>';
										  echo form_input('meta_title',$hotel->meta_title, 'id="meta_title" class="round form-control default-width-input" autofocus');
										  
									    ?>
									</p>
                                    <p>

                                        <?php

                                       // echo form_label('Meta title [EN]: ', 'meta_title_en').'<br>';
                                       // echo form_input('meta_title_en',$hotel->meta_title_en, 'id="meta_title_en" class="round form-control default-width-input" autofocus');

                                        ?>
                                    </p>
                                    <p>

                                        <?php
										
										  echo form_label('URL: ', 'url').'<br>';
										  echo form_input('url',$hotel->url, 'id="url" class="round form-control default-width-input" autofocus');
										  
									    ?>
									</p>
                                    <p>

                                    <?php

                                  //  echo form_label('URL [EN]: ', 'url_en').'<br>';
                                  //  echo form_input('url_en',$hotel->url_en, 'id="url_en" class="round form-control default-width-input" autofocus');

                                    ?>
                                    </p>
                                    <p>

                                        <?php
										
										  echo form_label('Meta keyword: ', 'meta_keyword').'<br>';
										  echo form_input('meta_keyword',$hotel->meta_keyword, 'id="meta_keyword" class="round form-control default-width-input" autofocus');
										  
									    ?>
									</p>
                                    <p>

                                        <?php

                                     //   echo form_label('Meta keyword [EN]: ', 'meta_keyword_en').'<br>';
                                      //  echo form_input('meta_keyword_en',$hotel->meta_keyword_en, 'id="meta_keyword_en" class="round form-control default-width-input" autofocus');

                                        ?>
                                    </p>
                                    <p>

                                        <?php

                                        echo form_label('Meta description: ', 'meta_description').'<br>';
                                        echo form_input('meta_description',$hotel->meta_description, 'id="meta_description" class="round form-control" autofocus');

                                        ?>
                                    </p>
                                    <p>

                                        <?php

                                      //  echo form_label('Meta description [EN]: ', 'meta_description_en').'<br>';
                                      //  echo form_input('meta_description_en',$hotel->meta_description_en, 'id="meta_description_en" class="round form-control" style="width:1000px;" autofocus');

                                        ?>
                                    </p>
									<?php echo form_hidden('id',$hotel->id, set_value('id')); ?>

								</fieldset>
							
							<!--</form>-->
						
						</div> <!-- end half-size-column -->

						<div class="container button-submit">
			                <div class="text-uppercase text-center">
			                    <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?>
			                </div>
			            </div>
                    
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