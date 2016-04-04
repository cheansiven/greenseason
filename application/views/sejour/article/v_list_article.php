<?php $this->load->view('sejour/header');?>

    <!--
      -- Body
      -->
    <div id="body">

        <div class="blog-hotel">

            <div class="sidebar-left">&nbsp;</div>
            <div class="blog-page-menu">
                <?php $this->load->view('sejour/main-menu');?>
            </div>
            <div class="clear"></div>

            <div class="col-md-12">


                <script>
                    $(document).ready(function() {
                            var $container = $('#blog-article');
		            // layout Masonry again after all images have loaded
		            $container.imagesLoaded( function() {
		                $container.masonry({
		                    columnWidth: 0,
		                    "gutter": 10,
		                    itemSelector: ".item-masonry"
		                });
		            });
                    });
                </script>

                <div class="bodyContent">

                    <div class="col-xs-3">
                        <!--<div class="sidebar-left">-->
                        <?php $this->load->view('sejour/sidebar/sidebar-left');?>
                        <!--</div>-->
                    </div>

                    <div class="col-xs-9">
                        <div class="row">
                            <div class="content-article">
                                <div id="blog-article">

                                    <?php
                                    if($page_name == "Outbound") {
                                        foreach($articles as $value) : ?>
                                            <div id="outbound-blog" class="item-masonry">
                                                <div class="blog-title"><h2><?= $value->title ?></h2></div>
                                                <div class="item-photo">
                                                    <?php if ($value->image != "") echo '<img src="'.base_url().'upload/articles/'.$value->image.'" />'; ?>
                                                </div>
                                                <?= $value->description ?>
                                            </div>

                                        <?php endforeach; } else { foreach($articles as $value) : ?>
                                        <div class="item-masonry">
                                            <div class="blog-title"><h2><?= $value->title ?></h2></div>
                                            <div class="item-photo">
                                                <?php if ($value->image != "") echo '<img src="'.base_url().'upload/articles/'.$value->image.'" />'; ?>
                                            </div>
                                            <?= $value->description ?>
                                        </div>

                                    <?php endforeach; } ?>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div><!-- .bodyContent -->
            </div>
            <div class="clear"></div>

            <div class="pagination">
                <p>

                </p>
            </div>

        </div><!-- .bodyContent -->

    </div>

<?php $this->load->view('sejour/footer');?>