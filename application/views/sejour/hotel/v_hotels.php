<?php $this->load->view('sejour/header');?>

<!--
  -- Body
  -->
<div id="body">

    <?php $this->load->view('sejour/main-menu');?>

    <div class="bodyContent">

        <div class="content">

            <div class="mainTitle">
                <?= $hotels[0]->city_name ?>
            </div><!-- end .mainTitle -->
            <div class="mainText">
                <div class="textDesc">

                    <?php
                    if ($hotels[0]->city_images != "")
                        echo '<img src="'.base_url().'upload/cities/'.$hotels[0]->city_images.'" align="left" />';
                    ?>
                    <?php echo '<div>'.$hotels[0]->city_intro.'</div>';?>
                </div>
                <div class="clear"></div>

            </div><!-- end .mainText -->

        </div>

        <div class="bodyContentLeft">

            <?php $this->load->view('sejour/v_extra-contents');?>
            <?php $this->load->view('sejour/v_tour_categories');?>
            <?php $this->load->view('sejour/ads/v_ads2');?>
            <?php $this->load->view('sejour/ads/v_ads-commentaires');?>

        </div>

        <div id="masonry" class="bodyContentRight">

        <?php $num_hotels = sizeof($hotels);?>
        <?php if( $num_hotels > 0 ) : ?>

            <?php
            $i = 1;
            foreach ($hotels as $value)
            {
                ?>
                <div class="subBoxContent borderLink">

                    <div class="day h22"></div>
                    <h2 class="mainTitle">
                        <?= $value->name ?>
                    </h2>

                    <div class="descriptions">
                        <h3><?= $value->category_hotel_name ?></h3>

                        <?php
                        if ($value->image != '')
                            echo '<img src="'.base_url().'upload/tours/'.$value->image.'" align="left" />';

                        echo $value->description;
                        ?>
                    </div>

                    <?php if( $value->website != "" ) : ?>
                    <a href="<?= $value->website ?>" target="_blank">
                        <div class="link">
                            <span><?= lang("label_visit_our_site") ?></span>
                            <img src="<?php echo base_url();?>public/images/icon-next-01.png" class="fright pr10">

                        </div>
                    </a>
                    <?php endif; ?>

                </div>
                <?php
                $i++;
            } // foreach?>

        <?php endif; ?>
    </div>

    </div><!-- .bodyContent -->
    <div class="clear"></div>

</div>

<?php $this->load->view('sejour/footer');?>