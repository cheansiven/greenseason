<?php $this->load->view('sejour/header');?>

<!--
      -- Body
      -->

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
            <div class="bodyContent">
                <div class="col-xs-3">
                    <!--<div class="sidebar-left">-->
                    <?php $this->load->view('sejour/sidebar/sidebar-left');?>
                    <!--</div>-->
                </div>
                <div class="col-xs-9">
                    <div class="row">
                        <div id="blog-content" class="blog-content">
                            <div class="title-description">
                                <p>We provide tickets and tour packages for all residents to destinations like Europe, USA and Asia. We have strong partnership</p>
                            </div>
                            <div id="blog-content" class="blog-content">
                                <?php foreach($tour_pacakges as $row) : ?>
                                    <article class="blog-article-item">
                                        <header>
                                            <?php if (!$row['image'] == "") { ?>
                                                <img src="<?= base_url().'upload/tours/'.$row['image'] ?>"/>
                                            <?php } else { ?>
                                                <img src="<?= base_url().'public/images/bgCategory.png' ?>"/>
                                            <?php } ?>
                                        </header>
                                        <section>
                                            <h2><a href="<?= site_url(strtolower('tour-and-packages-to-cambodia/'.$row['url'])).'.html'?>">
                                                    <?= $row['name'] ?>
                                                </a></h2>
                                            <div class="descriptions">
                                                <?= character_limiter(strip_tags($row['intro']), 250) ?>
                                            </div>
                                        </section>
                                    </article>
                                <?php endforeach ?>
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
<?php $this->load->view('sejour/footer');?>
