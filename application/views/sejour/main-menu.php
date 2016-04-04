<div class="logo pull-left default-padding">
  <header>
    <a href="<?php echo base_url() ?>"><img class="desktop" src="<?php echo base_url('public/images/logo.jpg') ?>"></a>
    <a href="<?php echo base_url() ?>"><img class="mobile" src="<?php echo base_url('public/images/logo-mobile.png') ?>"></a>
  </header>
</div>

<div id="navigation" class="container pull-right">
  <div class="desktop">
    <div class="top">
      <a href="#">CONTACT US</a>
      <a href="#">+856 333 333</a>
      <a href="#">info@greenseasontravel.com</a>
      <a class="pull-right social" href="#">
        <img src="<?php echo base_url('public/images/social-media.png') ?>">
      </a>
      <div class=" clearfix"></div>
    </div>
    <nav>
      <ul id="main-menu" class="clearfix">
        <li class="text-middle"><a href="<?php echo base_url('about.html') ?>">ABOUT US</a></li>
        <!-- <li id="menu_destination" class="text-middle"><a href="#">DESTINATIONS</a></li> -->
        <li><a href="<?php echo base_url('tour-group.html') ?>">GROUP DEPARTURES</a></li>
        <li id="menu_destination"><a href="#">TAILOR MADE TRAVEL</a></li>
        <li><a href="#">RESPONSIBLE POLICY</a></li>
        <li><a href="#">SPECIAL<br /> OFFER</a></li>
      </ul>
    </nav>
  </div>

  <!-- Sub Slider of Destination Menu -->
  <div id="destinationFlag" class="container">
    <ul>
      <?php foreach ($list_countries as $country) : ?>
      <li>
        <div class="sub-destination-menu">
          <!-- <img src="http://placehold.it/55x35"> -->
          <a href="<?php echo base_url('country-tailored-made-travels/'.$country->url.'.html');?>">
          <img src="<?php echo base_url('upload/country/'.$country->image) ?>" width="55">
          <p><?php echo $country->name ?></p>
          </a>
        </div>

      </li>
    <?php endforeach ?>
    </ul>
  </div>

  <!-- On Mobile -->
  <div class="mobile">
    <nav id="main-menu" class="cleafix">
      <ul class="pull-left">
        <li class="text-middle"><a href="">ABOUT US</a></li>
        <li class="text-middle"><a href="">DESTINATION</a></li>
        <li class="text-middle"><a href="">CONTACT US</a></li>
      </ul>
      <ul class="pull-right">
        <li><a href="">TAILOR MADETRAVEL</a></li>
        <li><a href="">GROUP DEPARTURES</a></li>
        <li><a href="">RESPONSIBLE POLICY</a></li>
      </ul>
    </nav>
  </div>
</div>