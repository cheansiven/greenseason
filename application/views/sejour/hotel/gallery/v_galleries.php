<?php $this->load->view('sejour/header');?>

<!--
  -- Body
  -->
<div id="body">

    <div class="bodyTop">
        <div class="content">
            <h2 class="mainTitle">LA GALERIE </h2>

            <div class="mainText">
                <div class="textDesc">
                    <?= $results[0]->category_description; ?>
                </div>
                <div class="clear"></div>

            </div><!-- end .mainText -->

        </div>
    </div>

    <?php $this->load->view('sejour/main-menu');?>

    <div class="bodyContent">

        <div class="bodyContentLeft">

            <?php $this->load->view('sejour/gallery/v_gallery_categories');?>
            <?php $this->load->view('sejour/ads/v_ads2');?>
            <?php $this->load->view('sejour/ads/v_ads-commentaires');?>

        </div>

        <div class="bodyContentRight" id="galleries">

        <?php $num_articles = sizeof($results);?>
        <?php if( $num_articles > 0 ) : ?>

            <div id="masonry" class="galleries">
                <?php
                $i = 1;

                foreach ($results as $value)
                {
                    ?>
                    <div class="subBoxContent">
                        <h3><?= $value->title ?></h3>
                        <a href="<?= base_url()?>upload/galleries/<?=$value->image?>" rel="prettyPhoto[gallery1]" title="<?=$value->description?>">
                            <img src="<?= base_url()?>upload/galleries/thumbs/thumb_<?=$value->image?>" alt="<?=$value->alt?>" title="<?=$value->title?>" />
                        </a>
                    </div>
                    <?php
                    $i++;
                } // foreach?>

            </div><!-- #masonry -->
            <div class="clear"></div>
        <?php endif; ?>
    </div>

    </div><!-- .bodyContent -->
    <div class="clear"></div>

</div>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/prettyPhoto.css">
    <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function(){

            $("area[rel^='prettyPhoto']").prettyPhoto();
            $(".galleries:first a[rel^='prettyPhoto']").prettyPhoto
            ({
                animation_speed:'fast',
                lideshow:3000,
                autoplay_slideshow: true,
                show_title: true
            });
            $(".subBoxContent:gt(0) a[rel^='prettyPhoto']").prettyPhoto
            ({
                animation_speed:'fast',
                slideshow:10000,
                hideflash: true
            });

        });
    </script>

<?php $this->load->view('sejour/footer');?>