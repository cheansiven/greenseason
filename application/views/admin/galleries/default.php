<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Image Management</title>
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
      <li><a href="<?php echo site_url("admin/galleries/");?>" class="active-tab dashboard-tab">Dashboard</a></li>
      <li><a href="<?php echo site_url("admin/galleries/add");?>">Add new image</a></li>
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
        <h3 class="fl">IMAGE</h3>
        <span class="fr expand-collapse-text">Click to collapse</span> <span class="fr expand-collapse-text initial-expand">Click to expand</span> </div>
      <!-- end content-module-heading -->
      
      <div class="content-module-main">
        <p>Found <?php echo $num_results; ?> Image(s) </p>
          <?= form_open_multipart('admin/galleries/ordering','id="regionForm" name="regionForm"'); ?>
        <table>
          <thead>
            <tr>
              
              <th>ID</th>
              <th>Title</th>
              <th>Category Name</th>
              <th>Alt</th>
              <th><input type="submit" name="order" value="Ordering"></th>
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
            <?php foreach($galleries as $value):

                echo '
                <tr>
                    <td>'.$value->id.'</td>
                    <td><a href="'.site_url("admin/galleries/edit?id=$value->id").'">'.$value->title.'</a></td>
                    <td>'.$value->category_name.'</td>
                    <td>'.$value->alt.'</td>';
                echo '<td>'.form_input('orders['.$value->id.']',$value->ordering, 'class="small-width-input" autofocus').'</td><td>';
                echo $value->active == '1'?'Yes':'No';
                echo '</td>
                    <td>
                        <a href="'.site_url("admin/galleries/edit?id=$value->id").'" class="table-actions-button ic-table-edit"></a>
                        <a onClick="return window.confirm(\'Delete '.$value->title.'?\');" href="'.site_url("admin/galleries/delete?id=$value->id").'" class="table-actions-button ic-table-delete"></a>
                    </td>
                </tr>
                ';

                endforeach; ?>
          </tbody>
          <?= form_close() ?>
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