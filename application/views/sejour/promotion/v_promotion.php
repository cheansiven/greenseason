<!DOCTYPE HTML>
<html lang="en">
<head>
    <link rel="icon" href="<?= base_url().'public/images/favicon.ico' ?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= base_url().'public/images/favicon.ico' ?>" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="<?= $this->meta_keywords ?>" />
    <meta name="title" content="<?= $this->meta_title ?>" />
    <meta name="description" content="<?= $this->meta_description ?>" />
    <meta name="uri-translation" content="on" />
    <title>
        <?= $this->meta_title ?>
    </title>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- call file bootstrap style -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/bgstretcher.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/main.css" />

    <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/js/bgstretcher.js"></script>


    <style>
    
    	@font-face{
	    font-family: 'MyriadProBoldCondensed';
	    src: url('/public/fonts/MyriadProBoldCondensed.eot');
	    src: local('MyriadProBoldCondensed'), url('/public/fonts/MyriadProBoldCondensed.woff') format('woff'), url('/public/fonts/MyriadProBoldCondensed.ttf') format('truetype');
	}

        /*Promotion Blog CSS*/
        #wrap-promotion-blog {
            min-height: 100%;
            background: rgba(0,0,0, 0.4);
            border: 1px solid #111;
        }
        #wrap-promotion-blog .header-blog {
            margin-top: 50px;
        }
        #wrap-promotion-blog .header-blog h1.slogans {
            font-size: 43px;
            font-weight: bold;
            text-align: center;
            margin: 75px 0 75px 0;
            font-family: Verdana, sans-serif !important;
        }
        #wrap-promotion-blog .header-blog p.description {
            font-family: 'Century Gothic';
            font-size: 17px;
            width: 96%;
            text-align: center;
            margin: 5px auto;
        }
        #wrap-promotion-blog .blog-info {
            margin: 52px 0 100px;
        }
        #blog-info .circle-round .items-round:first-child {
            margin-left: 15px;
        }
        #blog-info .circle-round .items-round {
            display: inline-block;
            width: 100%;
            max-width: 225px;
            height: 217px;
            background-color: #E2D6E2;
            color: #000;
            border-radius: 50%;
            text-align: center;
            padding: 0;
            margin: 0px 70px;
        }
        #blog-info .circle-round .items-round:last-child {
            margin-right: 0;
        }
        #blog-info .circle-round .items-round p {
            font-size: 23px;
            font-weight: bold;
            line-height: 1.3;
            letter-spacing: 1.8;
            color: #362D35;
        }
        .download, .phone, .email {
            position: relative;
        }
        .download p {
            position: absolute;
            left: 33px;
            bottom: 67px;
        }
        #blog-info .circle-round .phone p {
            position: absolute;
            left: 33px;
            bottom: 65px;
            font-size: 29px;
        }
        .email p {
            position: absolute;
            left: 0px;
            bottom: 71px;
            width: 100%;
        }
        .text-image-promotion img {
            width: 100%;
            max-width: 1030px;
            margin: 0 auto;
        }
        .sendmail-promotion {
            background-color: #D8B4D5;
        }
        .sendmail-promotion .form-inline {
            background: rgba(0,0,0, 0.2);
            padding: 10px;
        }
        .sendmail-promotion .form-inline label {
            font-family: 'Myriad Pro' !important;
            color: #EFE7EE;
            font-size: 19px !important;
            font-weight: normal !important;
            margin-bottom: 0px !important;
            margin-right: 45px;
            vertical-align: middle;
        }
        .sendmail-promotion .form-inline .input-field {
            width: 75%;
            margin-left: 89px;
        }
        .sendmail-promotion .form-inline .input-field input {
            width: 64%;
            padding: 3px 5px;
            font-size: 16px;
            font-style: italic;
            color: #ccc;
            border: 1px solid #666;
        }
        .sendmail-promotion .form-inline .btn-submit {
            width: 15%;
        }
        .sendmail-promotion .form-inline .form-group input[type="submit"] {
            font-family: 'Myriad Pro' !important;
            text-transform: uppercase;
            font-size: 19px !important;
            background: none;
            border-radius: 0px;
            border: #ad88ad;
            width: 100%;
            color: #EFE7EE;
            padding: 2px 0;
            position: relative;
            left: 0;
        }
        .list-cities ul {
            list-style-type: none;
            padding: 35px 20px;
        }
        .list-cities li {
            display: inline-block;
            width: 100%;
            max-width: 476px;
            margin-bottom: 10px;
        }
        .list-cities li .media-body {
            vertical-align: middle;
            padding-left: 25px;
        }
        .list-cities li .media-body .media-heading {
            color: #FFFFFF;
            font-weight: bold;
            font-size: 28px;
            font-family: 'MyriadProBoldCondensed' !important;
        }


    </style>

    <?php
    $_SERVER['DOCUMENT_ROOT'];
    $directory = "public/images/background/promotion/";
    //echo $_SERVER['DOCUMENT_ROOT'];;
    $imgs = glob($directory . "*.jpg");
    shuffle($imgs);

    $img = $imgs[0];
    $width = 1920;
    $height= 1020;

    ?>
    <script type="text/javascript">
        function setScreenImage(){
            width = $( window ).width();
            if(width>=768){
                var $bodyPage = $('body');
                if($bodyPage.hasClass('bg-page-slider')) {
                    $('body.bg-page-slider').bgStretcher({
                        images: [
                            '<?php echo base_url().$img;?>'
                        ],
                        imageWidth: <?php echo $width;?>,
                        imageHeight: <?php echo $height;?>,
                        slideDirection: 'N',
                        slideShowSpeed: 1400,
                        transitionEffect: 'fade',
                        sequenceMode: 'normal',
                        buttonPrev: '#prev',
                        buttonNext: '#next',
                        pagination: '#nav',
                        anchoring: 'center top',
                        anchoringImg: 'center top'
                    }); // End Slideshow
                }
            }
        }
        $(window).resize(function() {
            setScreenImage();
        });
        $(document).ready(function(){
            setScreenImage();
			
			//check email before submitting
			$('form').submit(function(){
				if ($('#email').val() == '') { alert('Please enter your email address'); return false; }
				return true;
			});
        });
    </script>
    <?php include('application/views/sejour/analyticstracking.php'); ?>
</head>

<body <?= isset($page_name) ? ( $page_name == "galleries" ? "class='gallery-bgstratcher'" : "class='bg-page-slider'" ) : "";?>>

    <div id="wrap-promotion-blog" class="container">
        <div class="header-blog text-center">
            <img src="<?php echo base_url('public/images/logo-promotion.png'); ?>" /><br />
            <h1 class="text-uppercase slogans">DISCOVER THE ESSENCE OF AMERICA</h1>
            <p class="description">Spend and enjoy 12 wonderful days in the “Land of the Free”. Discover or revisit some of america’s main iconic venues, from Hollywood in Los Angeles to the Statue of Liberty in New York City. Fill your camera with exciting memories from the most surprising and overwhelming nation in the world. RTR will take care of everything for your from Visa application to ordering breakfast. Visit America with a Tour Operator that has specialized with this unique destination, making RTR the expert when it comes to traveling to the USA. We have established all the right contacts abroad and with the US Embassy in Phnom Penh, we have negotiated with the most reliable airline companies and have developed an efficient and sophisticated network. Trust RTR when it comes to traveling to the USA</p>
        </div>
        <div id="blog-info" class="blog-info">
            <div class="circle-round">
                <div class="items-round download">
                    <p>DOWNLOAD <br /> PROGRAMME</p>
                </div>
                <div class="items-round phone">
                    <p>CALL US <br /> 012 471847</p>
                </div>
                <div class="items-round email">
                    <p>EMAIL US <br /> info@rtr-tours.com</p>
                </div>
            </div>
        </div>
        <div id="text-image-promotion" class="row text-image-promotion">
            <div class="image-promote">
                <img src="<?php echo base_url('public/images/text-image-promotion.png'); ?>" width="100%" />
            </div>
            <div class="sendmail-promotion">
                <form class="form form-inline" action="<?php echo base_url('send-email') ?>" method="post">
                    <div class="form-group input-field">
                        <label>CLAIM YOUR $100 NOW</label>
                        <input id="email" type="email" name="email" placeholder="email address"/>
                    </div>
                    <div class="form-group btn-submit">
                        <input type="submit" value="send me" name="submit" />
                    </div>
                </form>
            </div>
        </div>
        <div class="list-cities">
            <ul>
                <li>
                    <div class="media">
                        <div class="media-left media-middle">
                            <img class="media-object" src="/public/images/promotion/newyorkcity.jpg" alt="...">
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading">NEW YORK CITY</h2>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="media">
                        <div class="media-left media-middle">
                            <img class="media-object" src="/public/images/promotion/losangeles.jpg" alt="...">
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading">LOS ANGELES</h2>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="media">
                        <div class="media-left media-middle">
                            <img class="media-object" src="/public/images/promotion/baltimore.jpg" alt="...">
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading">BALITOMRE</h2>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="media">
                        <div class="media-left media-middle">
                            <img class="media-object" src="/public/images/promotion/washington-1.jpg" alt="...">
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading">WASHINGTON DC</h2>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="media">
                        <div class="media-left media-middle">
                            <img class="media-object" src="/public/images/promotion/lasvegas.jpg" alt="...">
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading">LAS VEGAS</h2>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>