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

        </div><!-- .bodyContent -->
        <div class="clear"></div>


        <script>
            jQuery(function($){
                $('#blog-guides').masonry({
                    "gutter": 10,
                    itemSelector: ".item-masonry"
                });
            });
        </script>

        <div class="bodyContent">
            <div class="mainContent">
                <div id="blog-guides">

                <?php foreach($guide_article as $value) : ?>

                    <div class="item-masonry">
                        <div class="blog-title"><h2><?= $value->title ?></h2></div>
                        <div class="item-photo">
                            <?php if ($value->image != "") echo '<img src="'.base_url().'upload/articles/'.$value->image.'" />'; ?>
                        </div>
                        <?= $value->description ?>
                    </div>

                <?php endforeach ?>
                </div>
            </div>
            <div class="clear"></div>
        </div><!-- .bodyContent -->
        <div class="clear"></div>

    </div>

<?php $this->load->view('sejour/footer');?>