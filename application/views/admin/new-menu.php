<nav class="nav">
    <div class="container-fluid">
        <div class="row main-menu">
            <ul class="col-sm-11 nav navbar-nav text-uppercase main-menu-bg">

                <li><a href="<?php echo site_url("admin/promotions");?>">Promotions</a></li>
                <li>
                    <a href="<?php echo site_url("admin/activities");?>">Activity</a>
                </li>
                <li>
                    <a href="<?php echo site_url("admin/countries");?>">County</a>
                </li>
                <li>
                    <a href="<?php echo site_url("admin/articles");?>">Article</a>
                </li>
                <li>
                    <a href="<?php echo site_url("admin/hotels");?>">Hotel</a>
                </li>
                <li><a href="<?php /*echo site_url("admin/temples");*/?>">Temple</a></li>
                <li><a href="<?php echo site_url("admin/tours");?>">Tours</a>
                </li>
                <li><a href="<?php echo site_url("admin/flight");?>">Flight</a></li>
                <li class="active"><a href="<?php echo site_url("admin/tour_gs");?>">GreenSeason Tour</a></li>

            </ul>
            <ul class="col-sm-1">
                <div class="row pull-right">
                    <li>
                        <a href="#">
                            <img src="<?php echo base_url('public/images/admin/logout.jpg') ?>">
                            <span>Logout</span>
                        </a>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</nav>