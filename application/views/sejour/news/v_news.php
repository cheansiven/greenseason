<!--Wordpress Intergration-->
<?php
define('WP_USE_THEMES', false);
require('./blog/wp-blog-header.php');

$this->load->view('sejour/header');?>
<div id="body">
    <div class="blog-hotel">

        <!--Form Booking Popup-->
        <?php //$this->load->view('sejour/tour-package/v_booking');?>
        <div class="sidebar-left">&nbsp;</div>
        <div class="blog-page-menu">
            <?php $this->load->view('sejour/main-menu');?>
        </div>
        <div class="clear"></div>

        <div class="col-md-12">
            <div class="bodyContent layout-booking">
                <div class="col-xs-3">
                    <!--<div class="sidebar-left">-->
                    <?php $this->load->view('sejour/sidebar/sidebar-left');?>
                    <!--</div>-->
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                </div>

                <div class="col-xs-9">
                    <div class="row">
                        <div class="content-article">
                            <div id="blog-article">

                                <?php query_posts( array( 'post_type' => 'post' ) ); while ( have_posts() ) : the_post(); ?>

                                        <div class="item-masonry">
                                            <div class="blog-title"><h2><?php the_title(); ?></h2></div>
                                            <div class="item-photo">
                                                <?php if(get_post_thumbnail_id($post->ID)) the_post_thumbnail('medium'); ?>
                                            </div>
                                            <?php the_content(); ?>
                                        </div>

                                <?php endwhile; wp_reset_query(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .bodyContent -->
            <div class="clear"></div>
            <div class="pagination">
                <p> </p>
            </div>
        </div>
    </div>
    <!-- .bodyContent -->
</div>
<script>
    $(document).ready(function() {
        /*$('#blog-article').masonry({
         columnWidth: 0,
         "gutter": 10,
         itemSelector: ".item-masonry"
         });*/
        var $container = $('#blog-article').masonry();
        // layout Masonry again after all images have loaded
        $container.imagesLoaded( function() {
            $container.masonry({
                columnWidth: 0,
                "gutter": 10,
                itemSelector: ".item-masonry"
            });
        });
        $('button').click(function() {
            $('#sent-mail-success').fadeOut('slow');
        });

        setTimeout(function() {
            $('#sent-mail-success').fadeOut('slow');
        }, 12000);
    });
</script>
<?php $this->load->view('sejour/footer');?>