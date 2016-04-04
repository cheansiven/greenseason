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
      <div class="bodyContent layout-booking">
        <div class="col-xs-4">
          <!--<div class="sidebar-left">-->
          <article class="blog-tours-item layout-tour-package">
            <section>
              <h2><?php echo $tours->name ?></h2>
              <div class="descriptions">
                <div class="image">
                  <?php if ($tours->image) { ?>
                  <img src="<?php echo base_url().'upload/tours/'.$tours->image ?>" class="hotels-photo" />
                  <?php } else { ?>
                  <img src="<?php echo base_url().'public/images/bgCategory.png' ?>" class="hotels-photo" />
                  <?php } ?>
                </div>
                <?php echo character_limiter($tours->intro,100) ?> </div>
              <!--<div class="footer"><a href="#" target="_blank">visit website</a> </div>-->
            </section>
          </article>
            <?php if($message = $this->session->flashdata('message')) { 
				if ($message['success']){ ?>
                <div id="sent-mail-success" class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Thank you!
                        <?php /*print_r($this->session->flashdata('message')['name']); */?>
                    </strong> We have well received your booking request for the <?php echo date('F d, Y'); ?>. We are now checking the availabilities for these dates.
                </div>
            <?php } else{ ?>
				<div id="sent-mail-success" class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>We are sorry!</strong> but there is an error in submitting the form. Please try again.
                </div>
			<?php } } ?>
          <div class="layout-tour-booking">
            <h2>Book This Tour Now</h2>
            <?php echo form_open('', array('class' => 'form-inline', 'id' => 'from-booking')); ?>
             <input id="hotel-title" type="hidden" name="input-title" value="<?php echo $tours->name ?>" />
            <div class="form-group col-md-12 pb10 btn-radio pl0">
              <label for="mr" class="radio-inline">
                <input id="mr" type="radio" name="title" value="Mr" required checked>
                Mr </label>
              <label for="mrs" class="radio-inline">
                <input id="mrs" type="radio" name="title" value="Mrs">
                Mrs </label>
              <label for="ms" class="radio-inline">
                <input id="ms" type="radio" name="title" value="Ms">
                Ms </label>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 mb5">
              <div class="row">
                <div class="form-group col-xs-12 pr0">
                  <label for="lname">Last Name *</label>
                  <br />
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 mb5">
              <div class="row">
                <div class="form-group col-xs-12 pr0">
                  <label for="fname">First Name *</label>
                  <br />
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="clearfix"></div>
            <div class="col-md-12 mb5">
              <div class="row">
                <div class="form-group col-xs-12 pr0">
                  <label for="email">Your email</label>
                  <br />
                  <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 mb5">
              <div class="row">
                <div class="form-group col-xs-12 pr0">
                  <label for="phone">Telephone</label>
                  <br />
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 pb15">
              <div class="row date-booking">
                <div class="form-group col-xs-6 pr0">
                  <label for="arrival_date">Arrival Date</label>
                  <br />
                  <input type="text" class="form-control datepicker" name="arrival_date" id="arrival_date" placeholder="" required>
                </div>
                <div class="form-group col-xs-6 pr0">
                  <label for="departure_date">Departure Date</label>
                  <br />
                  <input type="text" class="form-control datepicker" name="departure_date" id="departure_date" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 pb15">
              <div class="row">
                <div class="form-group col-xs-12 pr0">
                  <label for="adults">Number of adults</label>
                  <select id="adults" name="num-adult" class="SlectBox dropdown">
                    <option selected value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 pb15">
              <div class="row">
                <div class="form-group col-xs-12 pr0">
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
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 pb15">
              <div class="row">
                <div class="form-group col-xs-12 pr0">
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
            <div class="clearfix"></div>
            <div class="">
              <input type="submit" class="pull-right btnsubmit btn btn-danger mt10" name="submit" value="SEND" />
              <br />
              <div class="clear"></div>
              <div class="pull-right btn-booking-bottom">
                <!--<input type="button" value="CANCEL" class="close-reveal-modal" />-->
                <input type="reset" value="RESET" class="" />
              </div>
            </div>
            <div class="clearfix"></div>
            <?php echo form_close(); ?> </div>
          <!--</div>-->
        </div>
        <div class="col-xs-8">
          <div class="row">
            <div class="content-article">
              <div id="blog-article">
                <?php foreach($itineraries as $value) : ?>
                <div class="item-masonry tour-itinerary" style="background:#FFF">
                  <div class="blog-title">
                    <h2>Day <?php echo $value['day'] ?></h2>
                  </div>
                  <div class="item-photo">
                    <?php if ($value['image']) echo '<img src="'.base_url().'upload/tours/itinerary/'.$value['image'].'" />'; ?>
                  </div>
                  <?php echo $value['description'] ?> </div>
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
<script>
	$(document).ready(function() {
		$('#blog-article').masonry({
			columnWidth: 0,
			"gutter": 10,
			itemSelector: ".item-masonry"
		});
        $('button').click(function() {
            $('#sent-mail-success').fadeOut('slow');
        });

        setTimeout(function() {
            $('#sent-mail-success').fadeOut('slow');
        }, 12000);
	});
</script>