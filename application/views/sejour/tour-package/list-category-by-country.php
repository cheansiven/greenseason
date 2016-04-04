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
                                <p class="country-title text-uppercase">Welcome to <?php echo $country[0]->name; ?>
                                    <img class="pull-right" src="<?php echo base_url('upload/country/'.$country[0]->image) ?>" width="50" />
                                </p>
                            </div>
                            <div id="blog-content" class="blog-content">
                                <?php foreach($tour_categories as $row) : ?>
                                    <article class="blog-article-item">
                                        <header>
                                            <?php if (!$row['image'] == "") { ?>
                                                <img src="<?php echo base_url().'upload/categories/'.$row['image'] ?>"/>
                                            <?php } else { ?>
                                                <img src="<?php echo base_url().'public/images/bgCategory.png' ?>"/>
                                            <?php } ?>
                                        </header>
                                        <section>
                                            <h2><a href="<?php echo base_url('tour-country/'.$row['country_name'].'/'.strtolower($row['id']).'/'.$row['url'].'.html') ?>">
                                                    <?php echo $row['name'] ?>
                                                </a></h2>
                                            <div class="descriptions">
                                                <?php echo character_limiter(strip_tags($row['description']), 250) ?>
                                            </div>
                                            <p class="count_packages">Number of packages: <?php echo $row['count_tour']; ?></p>
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
