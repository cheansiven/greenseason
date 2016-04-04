<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Country Management</title>
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

<!-- MAIN CONTENT -->
<div id="content">
    <div class="page-full-width cf">
        <div class="content-module">
            <div class="content-module-heading cf">
                <h3 class="fl">Contact</h3>
                <span class="fr expand-collapse-text">Click to collapse</span> <span class="fr expand-collapse-text initial-expand">Click to expand</span> </div>
            <!-- end content-module-heading -->

            <div class="content-module-main">
                <p>FOR HOTEL RESERVATION CONTACT</p>

                <form action="<?= base_url().'admin/contact/edit' ?>" method="post" enctype="multipart/form-data"><br />
                    <div>
                        <label for="name">Title</label><br />
                        <input type="text" name="name" size="50" value="<?php print_r($results[0]->title); ?>" placeholder="User name" />
                    </div><br />
                    <div>
                        <label for="email">E-mail</label><br />
                        <input type="text" name="email" value="<?php print_r($results[0]->email); ?>" size="50" placeholder="E-mail" />
                    </div><br />
                    <div>
                        <label for="phone">Phone number</label><br />
                        <input type="text" name="phone" size="50" value="<?php print_r($results[0]->phone); ?>" placeholder="Phone number" />
                    </div><br />
                    <div>
                        <img src="<?= base_url().'upload/contact/'.$results[0]->image ?>" /><br /><br />
                        <input type="file" name="userfile" /><br />
                        <small>Brows your icon</small>
                    </div><br />
                    <input type="submit" name="do" value="Update" />
                </form>
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