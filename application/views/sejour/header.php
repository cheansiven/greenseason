<!DOCTYPE HTML>
<html lang="en-US">
<head>
<link rel="icon" href="<?= base_url().'public/images/favicon.ico' ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?= base_url().'public/images/favicon.ico' ?>" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?= $this->meta_keywords ?>" />
<meta name="title" content="<?= $this->meta_title ?>" />
<meta name="description" content="<?= $this->meta_description ?>" /> 
<meta name="uri-translation" content="on" />
<title><?= $this->meta_title ?></title>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->



<script type="text/javascript"> var base_url = "<?php echo base_url() ?>"; </script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url('public/css/styles.css'); ?>">

</head>
<body>
<div id="wrapper">
  <div class="container-fluid">
    <div class="row">

      <!-- Start Header -->
      <div id="header" class="clearfix">
        <!-- Navigation -->
        <?php if($page_name == 'home' || $page_name == 'about') { 
          $this->load->view('sejour/main-menu');
        } else {  ?>

          <div class="header-custom">          
            <div class="col-md-3 menu-left">
              <div class="row">
                <div class="pull-left">
                  <a class="back-menu" href="<?php echo base_url() ?>"><span class="glyphicon glyphicon-home"></span> HOME</a>
                  <img src="<?php echo base_url('public/images/logo-sm.png') ?>" alt="greanseason">
                </div>
                <?php if(isset($page_title)) { ?>
                  <?php if(!$page_name == "tour-group" || !$page_name == "tailored-made-travels") { ?>
                    <div class="category-header">
                      <span class="text-underline">Category:</span> <span>CRUISES</span><br />
                      <span class="text-underline">Destination:</span> <span>Thailand</span>
                    </div>
                  <?php } ?>
                <?php } ?>
              </div>
            </div> <!-- /.col-md-3 -->

            <div class="col-md-6"> <h1 class="page-title"><?php echo (isset($page_title))? $page_title : 'CRUISES' ?></h1> </div> <!-- /.col-md-6 -->

            <div class="col-md-3 menu-right">
              <?php if(isset($page_title)) { ?>
                <?php if(!$page_name == "tour-group" || !$page_name == "tailored-made-travels") { ?>
                  <div class="day-date-header">16 days - 15 nights</div>
                <?php } ?>
              <?php } else { ?>
              <a href="#">Destination:</a> THAILAND <img src="<?php echo base_url('public/images/flag-thailand.png') ?>" alt="flag" width="46">
              <?php } ?>
            </div> <!-- /.col-md-3 -->

            <div class="clearfix"></div>
          </div>
          <?php if(!$page_name == "tour-group" || !$page_name == "tailored-made-travels") { ?>
          <div class="book-this-tour"><span class="glyphicon glyphicon-star"></span> book this tour <span class="glyphicon glyphicon-star"></span></div>
          <?php } ?>
          

          <?php } ?>
      </div>

      <!-- Start Container -->
      <div id="post" class="container">
        
          

      