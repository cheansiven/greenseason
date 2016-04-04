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
                            <div id="blog-content" class="blog-content tour-country-package">

                                <?php foreach($list_country as $country) : ?>
                                <div class="flag-countries">
                                    <div class="boxs">
                                        <a href="<?php echo base_url('tour-country/'.$country->url); ?>">
                                            <img src="<?php echo base_url('upload/country').'/'.$country->image; ?>" />
                                            <p class="text-capitalize"><?php echo $country->name ?></p>
                                        </a>
                                    </div>
                                </div>
                                <?php endforeach ?>


                                <div class="clearfix"></div>
                                <div id="cambodia">
                                    <div class="pull-left flag-bottom">
                                        <img src="<?php echo base_url('public/images/flag-khmer.jpg'); ?>" width="125" />
                                    </div>
                                    <div class="pull-left flag-bottom">
                                        <p class="text-center">for tour and travel arrangements in Cambodia,<br /> please visit this page.</p>
                                    </div>
                                    <div class="pull-left flag-bottom no-margin">
                                        <a class="text-uppercase btn-visit-cambodia" href="<?php echo base_url('tour-country/cambodia.html') ?>">Visit Cambodia</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
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
