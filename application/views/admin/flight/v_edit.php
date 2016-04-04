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
            <li><a href="" onclick="return false;" class="active-tab">Update flight</a></li>
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
                    <form id="flight" action="<?= base_url()."admin/flight/do_update/".$get_flight_by_id[0]->id; ?>" method="post" enctype="multipart/form-data">

                        <div class="pull-left">
                            <div class="wrap-preview">
                                <p>HIGHLITED CITIES WILL APPEAR AT THE TOP WITH A FLASHING SIGN</p>
                                <div class="preview">

                                    <?php if ($get_flight_by_id[0]->feature == true) { ?>
                                        <input class="checkbox" type="checkbox" name="feature" value="1" checked />
                                    <?php } else { ?>
                                        <input class="checkbox" type="checkbox" name="feature" value="0" />
                                    <?php } ?>
                                    <label for="feature">HIGHLIGHT</label>
                                </div>
                            </div><br />

                            <fieldset class="destination">
                                <?php
                                $option_category = array("" => "-- Please Select --");
                                foreach ($destinations as $category)
                                    $option_category[$category['id']] = $category['destination'];

                                echo form_dropdown('flight_destination', $option_category, $get_flight_by_id[0]->flight_category_id);
                                ?>
                            </fieldset>


                            <div class="city">
                                <p>CITY / TOWN</p>
                                <input type="text" name="city" size="50" value="<?= $get_flight_by_id[0]->city ?>" />
                            </div><br />

                            <?php if (!empty($get_flight_by_id[0]->image)) { ?>
                                <div class="file_image">
                                    <img src="<?= base_url()."upload/flights/".$get_flight_by_id[0]->image ?>" width="251">
                                    <p>ADD IMAGE</p>
                                    <input type="file" name="userfile" id="image" class="round default-width-input" />
                                </div>
                            <?php } else { ?>
                                <div class="file_image">
                                    <p>ADD IMAGE</p>
                                    <input type="file" name="userfile" id="image" class="round default-width-input" />
                                </div>
                            <?php } ?><br />

                            <div class="details">
                                <p>DETAILS</p>
                                <textarea name="details"><?= $get_flight_by_id[0]->details ?></textarea>
                                <div><small style="color: red">limit 140 characters</small></div>
                            </div><br />

                            <div class="price">
                                <p>PRICE</p>
                                <input type="text" name="price" size="20" placeholder="0.00" value="<?= $get_flight_by_id[0]->price ?>"/>
                            </div><br />
                        </div>

                        <div class="pull-right">
                            <div class="item-preview">
                                <article>
                                    <header>
                                        <div class="feature-image">
                                            <h2>SPECIAL OFFER</h2>
                                        </div>
                                        <img src="<?= base_url()."upload/flights/".$get_flight_by_id[0]->image ?>" width="251">
                                    </header>
                                    <section>
                                        <h2><?= $get_flight_by_id[0]->city ?></h2>
                                        <div class="destination"><?= $get_flight_by_id[0]->details ?></div>
                                        <div class="price">$ <?= $get_flight_by_id[0]->price ?></div>
                                    </section>

                                </article>
                            </div>
                        </div>

                        <div class="clear"></div><br />

                        <div class="published">
                            <?php
                            if ($get_flight_by_id[0]->published == true) echo '<input class="publish" type="checkbox" name="published" value="1" checked/>';
                            else { echo '<input class="publish" type="checkbox" name="published" value="0" />'; }
                            ?>

                            <label for="published">PUBLISHED</label>
                        </div>

                        <div class="pull-right">
                            <input type="submit" name="do" value="Save" class="round blue ic-right-arrow" />
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