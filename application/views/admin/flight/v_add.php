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
            <li><a href="" onclick="return false;" class="active-tab">Add new flight</a></li>
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
                    <form id="flight" action="<?= base_url()."admin/flight/store"; ?>" method="post" enctype="multipart/form-data">

                        <div class="pull-left">
                            <div class="wrap-preview">
                                <p>HIGHLITED CITIES WILL APPEAR AT THE TOP WITH A FLASHING SIGN</p>
                                <div class="preview">
                                    <input class="checkbox" type="checkbox" name="feature" value="0" />
                                    <label for="feature">HIGHLIGHT</label>
                                </div>
                            </div><br />

                            <div class="destination">
                                <p>MAIN DESTINATION</p>
                                <select name="flight_destination" class="required" >
                                    <option value="">Select destination</option>

                                    <?php foreach($destinations as $destination) : ?>
                                        <option value="<?= $destination->id ?>"><?= $destination->destination ?></option>
                                    <?php endforeach ?>

                                </select>
                                <div class="valid" style="color: red"></div>
                            </div><br />

                            <div class="city">
                                <p>CITY / TOWN</p>
                                <input type="text" name="city" size="50" class="required" />
                                <div class="valid" style="color: red"></div>
                            </div><br />

                            <div class="file_image">
                                <p>ADD IMAGE</p>
                                <input type="file" name="userfile" id="filePhoto" class="round default-width-input" />
                            </div><br />

                            <div class="details">
                                <p>DETAILS</p>
                                <textarea name="details"></textarea>
                                <div><small style="color: red">limit 140 characters</small></div>
                            </div><br />

                            <div class="price">
                                <p>PRICE</p>
                                <input type="text" name="price" size="20" placeholder="0.00" />
                            </div><br />
                        </div>

                        <div class="pull-right">
                            <div class="item-preview">
                                <article>
                                    <header>
                                        <div class="feature-image">
                                            <h2>SPECIAL OFFER</h2>
                                        </div>
                                        <img id="previewHolder" src="<?= base_url().'public/images/bgCategory.png' ?>" alt="Uploaded Image Preview Holder" width="251" >
                                    </header>
                                    <section>
                                        <h2></h2>
                                        <div class="detail"></div>
                                        <div class="price"></div>
                                    </section>

                                </article>
                            </div>
                        </div>

                        <div class="clear"></div><br /><br /><br />

                        <div class="published">
                            <input class="publish" type="checkbox" name="published" value="1" checked />
                            <label for="published">PUBLISHED</label>
                        </div>

                        <div class="pull-right">
                            <input type="submit" name="do" value="Save" class="round blue ic-right-arrow submit" />
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