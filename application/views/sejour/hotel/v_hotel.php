<?php $this->load->view('sejour/header');?>
    <script type="text/javascript">
        var location_id = <?php echo $location_id; ?>
    </script>
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

                <div class="col-xs-3">
                    <!--<div class="sidebar-left">-->
                    <?php $this->load->view('sejour/sidebar/sidebar-left');?>
                    <!--</div>-->
                </div>

                <div class="col-xs-9">
                    <div class="row">
                        <div id="blog-content" class="blog-content">

                            <div class="title-description"><p>RTR TOURS has hand-picked a series of properties in the Kingdom. We trust the properties listed herein will fulfill your highest expectations.&nbsp;&nbsp;</p></div>

                            <div id="responds">
                                <?php if (!empty($highest_hotel)) { foreach($highest_hotel as $row) : $url = explode(":", $row->website)[0]; $url = ($url != "http") ? "http://".trim($row->website) : trim($row->website); ?>
                                    <article class="blog-article-item">
                                        <header>
                                            <?php if (!$row->logo == "") { ?><img src="<?= base_url().'upload/hotels/'.$row->logo ?>" class="hotels-photo" /><?php } else { ?><img src="<?= base_url().'public/images/bgCategory.png' ?>" class="hotels-photo" /><?php } ?>
                                        </header>
                                        <section>
                                            <h2>
                                                <a href="<?php echo base_url().'hotel/'.$row->id.'/'.strtolower(url_title($row->name)).'.html'; ?>" class="btn-booking"><?= $row->name; ?></a>
                                            </h2>
                                            <div class="descriptions"><?php echo character_limiter(strip_tags($row->description),150); ?></div>
                                        </section>
                                        <div class="category-bottom text-uppercase">
                                            <p class="category-name pull-left"><?php echo $row->category_name; ?></p>
                                            <a href="<?php echo base_url().'hotel/'.$row->id.'/'.strtolower(url_title($row->name)).'.html'; ?>" class="btn-booking pull-right">Book this</a>
                                            <span class="icon-booking">&nbsp;</span>
                                        </div>
                                        <div class="mobile-menu-item text-uppercase">
                                            <a class="hotel-read-more" href="<?php echo base_url().'hotel/'.$row->id.'/'.strtolower(url_title($row->name)).'.html'; ?>">read more</a>
                                            <a class="hotel-booking" href="<?php echo base_url().'hotel/'.$row->id.'/'.strtolower(url_title($row->name)).'.html#booking'; ?>">book now</a>
                                        </div>
                                    </article>
                                <?php endforeach; } else { ?>
                                    <div class="error-404">
                                        <h2>No Hotels Found</h2>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                        <div class="clear"></div>

                        <!--Pagination-->
                        <?php $count = sizeof($highest_hotel); if($count == 12) { ?>
                            <div class="pagination <?php echo sizeof($highest_hotel); ?>">
                                <a id="load-more" class="" href="#"></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!--Form Booking Popup-->
                <?php $this->load->view('sejour/hotel/v_booking');?>

            </div><!-- .bodyContent -->
        </div>
        <div class="clear"></div>

    </div><!-- .bodyContent -->

</div>

<?php $this->load->view('sejour/footer');?>