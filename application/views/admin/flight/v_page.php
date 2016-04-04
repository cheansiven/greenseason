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
            <li><a href="<?php echo site_url("admin/flight/");?>" class="active-tab dashboard-tab">Dashboard</a></li>
            <li><a href="<?php echo site_url("admin/flight/add");?>">Add new flight</a></li>
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
            <div class="content-module-heading cf">
                <h3 class="fl">FLIGHT</h3>
                <span class="fr expand-collapse-text">Click to collapse</span> <span class="fr expand-collapse-text initial-expand">Click to expand</span> </div>
            <!-- end content-module-heading -->

            <div class="content-module-main">
                <!--<p>Found 0 article(s) </p>-->
                <p>Found <?php echo $num_results; ?> flight(s) </p>
                <?= form_open_multipart('admin/articles/ordering','id="regionForm" name="regionForm"'); ?>
                <table>
                    <thead>
                    <tr>
                        <th><a href="<?= base_url().'admin/flight/index/order/id/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">ID</a> <i class="fa <?php if ($sort[5] == "id" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "id" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                        <th><a href="<?= base_url().'admin/flight/index/order/city/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">city</a> <i class="fa <?php if ($sort[5] == "city" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "city" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                        <th><a href="<?= base_url().'admin/flight/index/order/destination/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">destination</a> <i class="fa <?php if ($sort[5] == "destination" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "destination" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                        <th>Detail</th>
                        <th><a href="<?= base_url().'admin/flight/index/order/price/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">price</a> <i class="fa <?php if ($sort[5] == "price" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "price" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                        <th><a href="<?= base_url().'admin/flight/index/order/create_at/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">create_at</a> <i class="fa <?php if ($sort[5] == "create_at" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "create_at" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                        <th><a href="<?= base_url().'admin/flight/index/order/author/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">author</a> <i class="fa <?php if ($sort[5] == "author" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "author" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <td colspan="5" class="table-footer"><?php if (strlen($links)): ?>
                                Pages: <?php echo $links; ?>
                            <?php endif; ?></td>
                    </tr>
                    </tfoot>

                    <tbody>
                    <?php foreach($flight as $row) : $date = date_create($row->create_at); ?>
                    <tr>
                        <td><?= $row->id ?></td>
                        <td><a href="<?php echo site_url("admin/flight/update/".$row->id);?>"><?= strtoupper($row->city)?></a></td>
                        <td><?= strtoupper($row->destination)?></td>
                        <?php if(!empty($row->details)) echo "<td>".word_limiter($row->details, 7)."</td>"; else { echo "<td></td>"; } ?>
                        <?php if(!empty($row->price)) echo "<td>$ ".$row->price."</td>"; else { echo "<td></td>"; } ?>
                        <td><?= date_format($date, 'D m, Y'); ?></td>
                        <td>
                            <?= $row->fname ?>
                        </td>
                        <td><?php if ($row->published < "1") { echo "No"; } else { echo "Yes"; } ?> </td>
                        <td>
                            <a href="<?php echo site_url("admin/flight/update/".$row->id);?>" class="table-actions-button ic-table-edit"></a>
                            <a href="<?php echo site_url("admin/flight/delete/".$row->id);?>" onclick="return confirm('Are you sure?')" class="table-actions-button ic-table-delete"></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    </tbody>

                </table>
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