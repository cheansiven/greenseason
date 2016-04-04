<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Flight Management</title>
    <?php include_once('application/views/admin/header.php'); ?>
</head>
<body>

<!-- TOP BAR -->
<div id="top-bar">
    <div class="page-full-width cf">
        <ul id="nav" class="fl">
            <li class="v-sep"><a href="<?php echo site_url("../");?>" class="round button dark ic-left-arrow image-left">Main</a></li>
            <?php include_once('application/views/admin/menu.php'); ?>
        </ul>
        <!-- end nav -->

    </div>
    <!-- end full-width -->

</div>
<!-- end top-bar -->

<!-- HEADER -->
<div id="header-with-tabs">
    <div class="page-full-width cf">
        <ul id="tabs" class="fl">
            <li><a href="<?php echo site_url("admin/flight/");?>" class="dashboard-tab">Dashboard</a></li>
            <li><a href="" onclick="return false;" class="active-tab">Update category</a></li>
        </ul>
        <!-- end tabs -->

        <!-- Change this image to your own company's logo -->
        <!-- The logo will automatically be resized to 30px height. -->
        <?php include_once('application/views/admin/logo.php'); ?> </div>
    <!-- end full-width -->

</div>
<!-- end header -->

<!-- MAIN CONTENT -->
<div id="content">
    <div class="page-full-width cf">
        <div class="content-module">

            <!-- end content-module-heading -->

            <div class="content-module-main">
                <div class="content-module-main">
                    <!--<h1>FLIGHT</h1>-->
                    <form id="flight" action="<?= base_url()."admin/flight_categories/do_update/".$get_flight_by_id[0]->id; ?>" method="post" enctype="multipart/form-data">

                        <div class="equalHeight pull-left">
                            <div class="destination">
                                <p>MAIN DESTINATION</p>
                                <input type="text" name="flight_destination" value="<?= $get_flight_by_id[0]->destination ?>" size="50" />
                            </div><br />

                            <?php if (!empty($get_flight_by_id[0]->image)) { ?>
                            <div class="file_image">
                                <img src="<?= base_url()."upload/flights/categories/".$get_flight_by_id[0]->image ?>" width="251">
                                <p>ADD IMAGE</p>
                                <input type="file" name="userfile" id="image" class="round default-width-input" />
                            </div>
                            <?php } else { ?>
                                <div class="file_image">
                                    <p>ADD IMAGE</p>
                                    <input type="file" name="userfile" id="image" class="round default-width-input" />
                                </div>
                            <?php } ?><br />

                            <div class="published">
                                <?php
                                if ($get_flight_by_id[0]->published == true) echo '<input class="publish" type="checkbox" name="published" value="1" checked/>';
                                else { echo '<input class="publish" type="checkbox" name="published" value="0" />'; }
                                ?>

                                <label for="published">PUBLISHED</label>
                            </div>
                        </div>

                        <div class="equalHeight pull-right">
                            <h2>META</h2>
                            <div class="page-title">
                                <p>PAGE TITLE</p>
                                <input type="text" name="page_title" value="<?= $get_flight_by_id[0]->page_title ?>" size="50" />
                            </div>
                            <div class="meta-destination">
                                <p>META DESCRIPTION</p>
                                <input type="text" name="meta_description" value="<?= $get_flight_by_id[0]->meta_description ?>" size="50" />
                            </div>
                            <div class="meta-keywords">
                                <p>META KEYWORDS</p>
                                <input type="text" name="meta_keywords" value="<?= $get_flight_by_id[0]->meta_keyword ?>" size="50" />
                            </div><br />

                            <div class="btn-submit">
                                <input type="submit" name="do" value="Save" class="round blue ic-right-arrow" />
                            </div>
                        </div>
                        <div class="clear"></div>

                    </form>
                </div>
            </div>
            <!-- end content-module-main -->

        </div>
        <!-- end content-module -->

    </div>
    <!-- end full-width -->

</div>
<!-- end content -->

<!-- FOOTER -->
<?php include_once('application/views/admin/footer.php'); ?>
<!-- end footer -->

</body>
</html>