<?php $this->load->view('sejour/header');?>
    <script type="text/javascript">
        var location_id = <?php echo $id; ?>
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
    <div id="wrap-single-page" class="col-md-12">

        <div id="content" class="col-xs-8">
            <div class="pull-left title">
                <h1><?php echo $hotels->name ?></h1>
                <h3 class="region"><?php echo $hotels->city_name ?></h3>

                <div class="hotel-single-paginate">
                    <a class="pull-left text-default" href="<?php echo base_url('selection-and-hotel-directory-cambodia.html') ?>"><span>&#60;</span> go back to list</a>
                    <?php if(!empty($next_rows)) : ?>
                    <a class="pull-right text-default" href="<?php echo base_url().'hotel/'.$next_rows->id.'/'.url_title(strtolower($next_rows->name)).'.html'; ?>">view next property <span>&#62;</span></a>
                    <?php endif ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div id="detail-hotel-logo" class="photo">
                <img src="<?php echo base_url().'upload/hotels/'.$hotels->logo ?>" />
            </div>
            <div class="clear"></div>

            <div class="descriptions">
                <h3>Hotel Description </h3>
                <hr />
                <p><?php echo $hotels->description ?></p>

                <h3>Our review </h3>
                <hr />
                <!--<pre>
                    <?php /*print_r($next_rows) */?>
                </pre>-->
                <p><?php echo $hotels->review ?></p></p>

                <h3>Amenities </h3>
                <hr />
                <p><?php echo $hotels->leisure ?></p>

                <h3>Location </h3>
                <hr />
                <p><?php echo $hotels->location ?></p>
            </div>
        </div>
        <a name="booking"></a>
        <div id="sidebar-hotel" class="col-xs-4">
            <div class="row">
                <div class="sidebar-hotel-title">
                    <p>Book your hotel with us to ensure you get the best possible rate and or an upgrade</p>
                    <img src="<?php echo base_url().'public/images/star.png' ?>" />
                </div>
                <?php if($this->session->flashdata('message')) { ?>
                <div id="sent-mail-success" class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Thank you!
                    <?php /*print_r($this->session->flashdata('message')['name']); */?>
                    </strong> We have well received your booking request for the <?php echo date('F d, Y'); ?>. We are now checking the availabilities for these dates.
                </div>
                <?php } ?>
                <?php /*if($this->session->flashdata('message') == 1) { */?><!--
                    <div id="sent-mail-success" class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Well done!by [lname] [fname]</strong>  in the successful message on the website after the booking has been sent.
                    </div>
                --><?php /*} */?>
                <div id="form-booking">
                    <div class="wrap-form pt20">
                        <h3>BOOK THIS HOTEL</h3>
                        <hr />
                        <?php echo form_open('', array('class' => 'form-inline', 'id' => 'from-booking')); ?>

                        <input id="hotel-title" type="hidden" name="input-title" value="<?php echo $hotels->name ?>" />

                        <div class="col-md-12 text-center">
                            <div class="form-group pb10 btn-radio pl0">
                                <label for="mr" class="radio-inline">
                                    <input id="mr" type="radio" name="title" value="Mr" required checked> Mr
                                </label>
                                <label for="mrs" class="radio-inline">
                                    <input id="mrs" type="radio" name="title" value="Mrs"> Mrs
                                </label>
                                <label for="ms" class="radio-inline">
                                    <input id="ms" type="radio" name="title" value="Ms"> Ms
                                </label>
                            </div>
                        </div>

                        <div class="mb5">

                            <label for="lname">Last Name*</label><br />
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="" required>

                            <label for="fname">First Name*</label><br />
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="" required>



                            <label for="email">Email*</label><br />
                            <input type="text" class="form-control" id="email" name="email" placeholder="" required>

                            <label for="phone">Telephone*</label><br />
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>

                        </div>

                        <div class="pb15">
                            <div class="row">
                                <div class="form-group col-xs-6">
                                    <label for="checkin">Arrival Date*</label><br />
                                    <input type="text" class="form-control datepicker" name="checkin" id="checkin" placeholder="" required>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="checkout">Departure Date*</label><br />
                                    <input type="text" class="form-control datepicker" name="checkout" id="checkout" placeholder="" required>
                                </div>
                            </div>
                        </div>

                        <div class="pb15">
                            <div class="row">
                                <div class="form-group col-xs-4 pr0">
                                    <label for="adults">Number of adults</label>
                                    <select id="adults" name="num-adult" class="SlectBox dropdown">
                                        <option selected value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>

                                <div class="form-group col-xs-4 pr0 pl5">
                                    <label for="children">Number of Children</label>
                                    <select name="num-child" id="children" class="SlectBox dropdown">
                                        <option value="">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="form-group col-xs-4 pr0">
                                    <label for="infant">Number of infant</label>
                                    <select name="num-infant" id="infant" class="SlectBox dropdown">
                                        <option value="">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12 pb15 btn-radio pl0 text-center">
                            <label for="single" class="radio-inline">
                                <input type="radio" id="single" name="room-type" value="Single" required checked> Single
                            </label>
                            <label for="double" class="radio-inline">
                                <input type="radio" id="double" name="room-type" value="Double"> Double
                            </label>
                            <label for="twin" class="radio-inline">
                                <input type="radio" id="twin" name="room-type" value="Twin"> Twin
                            </label>
                            <label for="room-type" class="error"></label>
                        </div>
                        <div class="text-center pb15">
                            <label for="children">Number of Rooms</label>
                            <select name="num-room" class="SlectBox dropdown">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="row">
                            <input type="submit" class="btn btn-danger" name="submit" value="SEND" /><br />
                        </div>
                        <div class="clear"></div>
                        <div class="btn-booking-bottom">
                            <!--<input type="button" value="CANCEL" class="close-reveal-modal" />-->
                            <input type="reset" value="RESET" class="" />
                            <div class="clear"></div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    </div>
    <div class="clear"></div>

    </div><!-- .bodyContent -->


    <script>
        $(document).ready(function() {
            $('button').click(function() {
                $('#sent-mail-success').fadeOut('slow');
            });

            setTimeout(function() {
                $('#sent-mail-success').fadeOut('slow');
            }, 12000);
        });
    </script>
<?php $this->load->view('sejour/footer');?>