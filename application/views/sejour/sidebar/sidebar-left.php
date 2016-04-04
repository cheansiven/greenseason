<?php if ($page_name == "tour-package") { ?>

    <div class="menuBodyTitle">

        <h1><a href="<?= base_url().'tour-and-packages-to-cambodia.html' ?>">PACKAGES</a></h1>

    </div>

    <div class="tour-package-chinese">

        <a href="<?= base_url().'tour-and-packages-to-cambodia-in-chinese.html' ?>">中文版</a> <img src="<?= base_url().'public/images/Chinese_flag.jpg' ?>" width="20" />

    </div>

<?php } elseif ($page_name == "flight") { ?>

    <div class="menuBodyTitle">

        <h1><a href="<?=  site_url()."book-a-flight-with-rtr-agency.html"; ?>">FLIGHTS</a></h1>

    </div>

    <div class="menuRow">

        <ul id="sidebar-menu">

            <?php foreach($category as $row) { ?>

                <li id="sidebar-menu-<?= $row->id ?>" class="sidebar-menu <?php if ($menu_reference_id == $row->id) echo 'active'; ?>">

                    <a href="<?= base_url().'book-a-flight-with-rtr-agency/'.$row->id.'-'.strtolower(str_replace(' ', '-', trim($row->destination))).'.html'; ?>" ><?= $row->destination ?></a></li>

            <?php } ?>



        </ul>

    </div>



    <div class="dropdown menu-category pull-right">

        <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Flight categories

            <span class="caret"></span></button>

        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">

            <?php foreach($category as $row) { ?>

                <li id="sidebar-menu-<?= $row->id ?>" class="sidebar-menu <?php if ($menu_reference_id == $row->id) echo 'active'; ?>">

                    <a href="<?= base_url().'book-a-flight-with-rtr-agency/'.$row->id.'-'.strtolower(str_replace(' ', '-', trim($row->destination))).'.html'; ?>" ><?= $row->destination ?></a></li>

            <?php } ?>

        </ul>

    </div>

    <div class="clear"></div>

<?php } elseif (preg_match("#^Hotels(.*)$#i", $page_name))

//(strpos(strtolower($page_name), 'hotels') !== 0)

//($page_name == "Hotels in Cambodia" || $page_name == "Hotels in Phnom Penh" || $page_name == "Hotels in Siem reap") 

{ ?>

    <div class="menuBodyTitle"><h1><a href="<?= base_url().'selection-and-hotel-directory-cambodia.html' ?>"><?php echo $page_name ?></a></h1></div>

    <div class="menuRow">

        <ul id="sidebar-menu" class="sidebar-menu-hotel">



            <?php foreach($all_city as $row) { ?>

                <li id="sidebar-menu-<?= $row->id ?>" class="sidebar-menu <?php if ($menu_reference_id == $row->id) echo 'active'; ?>">

                    <!--<h2>-->

                    <a href="<?= base_url().'selection-and-hotel-directory-cambodia/'.$row->id.'-'.strtolower(str_replace(' ', '-', trim($row->name))).'.html'; ?>">

                        <?php echo $row->name ?>

                        <?php
                        if($row->count_hotel > 0) {
                            echo " : ". $row->count_hotel;
                        }
                        ?>
                        <span class="icon-arrow-right">&nbsp;</span>
                    </a>

                    <!--</h2>-->

                </li>

            <?php } ?>



        </ul>

    </div>



    <div class="dropdown menu-category pull-right">

        <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Hotel categories

            <span class="caret"></span></button>

        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">

            <?php foreach($all_city as $row) { ?>

                <li id="sidebar-menu-<?= $row->id ?>" class="sidebar-menu <?php if ($menu_reference_id == $row->id) echo 'active'; ?>"><a href="<?= base_url().'selection-and-hotel-directory-cambodia/'.$row->id.'-'.strtolower(str_replace(' ', '-', trim($row->name))).'.html'; ?>"><?= $row->name ?></a></li>

            <?php } ?>

        </ul>

    </div>

    <div class="clear"></div>

<?php } elseif ($page_name == "news") { ?>

    <div class="menuBodyTitle"><h1><a href="#"><?php echo $page_name ?></a></h1></div>

<?php } else{ ?>

    <div class="menuBodyTitle"><h1><a href="<?= base_url().$page_url ?>"><?= $page_name ?></a></h1></div>

    <div class="menuRow">

        <ul id="sidebar-menu">



            <?php if (isset($sub_menu) && count($sub_menu))

                foreach($sub_menu as $row) { ?>

                    <li id="sidebar-menu-<?= $row->id ?>" class="sidebar-menu <?php if ($menu_reference_id == $row->id) echo 'active'; ?>"><a href="<?= base_url().'selection-and-hotel-directory-cambodia/'.$row->id.'-'.strtolower(str_replace(' ', '-', trim($row->name))).'.html'; ?>"><?= $row->name ?></a></li>

                <?php } ?>

        </ul>

    </div>

<?php

}
if (count($contact_categories)){?>



    <div class="contact-sidebar">

        <h3>FOR RESERVATION OR INFORMATION, CONTACT</h3>

        <div>

            <?php foreach ($contact_categories as $row) { ?>

                <span class="contact-name"><?= $row->title; ?></span>

                <div class="contact-pic">

                    <img src="<?=  base_url().'upload/contact/'.$row->image ?>" width="50" height="50" />

                </div>

                <span class="contact-email"><?= $row->email; ?></span>

                <span class="contact-phone"><?= $row->phone; ?></span>

            <?php } ?>

        </div>

    </div>

<?php } ?>

<?php if (!empty($category_package_tour_menu)) { ?>
    <div id="tour-category" class="category-packages-menu">
        <p class="category-title text-uppercase text-center"><?php print_r($category_package_tour[0]['name']); ?></p>
        <div class="category-description text-right">
            <?php print_r(strip_tags($category_package_tour[0]['description']));  ?>
        </div>
        <div class="text-uppercase text-right">
            <p class="text-default">Other tour</p>
            <ul><?php foreach($category_package_tour_menu as $category_menu) { ?>

                    <li><a href="<?php echo base_url('tour-and-packages-to-cambodia/'.$category_menu->url.'.html') ?>"><span class="icon-arrow-right">&nbsp;</span> <?php echo $category_menu->name ?></a></li>

                <?php } ?></ul>
            <div class="clearfix"></div>
        </div>
    </div>
<?php } ?>

<?php if (!empty($list_country_offset)) { ?>
    <div class="list-country-tour-menu">
        <p>Other destination</p>
        <ul><?php foreach($list_country_offset as $country) { ?>

                <li><a href="<?php echo base_url('tour-country/'.$country->url) ?>"><img src="<?php echo base_url('upload/country/'.$country->image) ?>" width="50" /></a></li>

            <?php } ?></ul>
    </div>
<?php } ?>