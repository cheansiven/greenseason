<?php include_once('application/views/admin/header.php'); ?>

<!-- MAIN CONTENT -->
<div class="container">
  <a href="<?php echo site_url("admin/tours/");?>" class="btn btn-default">Dashboard</a>
  <a href="<?php echo site_url("admin/tours/add");?>" class="btn btn-primary">Add new tour</a>

  <h2 class="fl">Tours</h2>
  <a href="#">Tour(s) <span class="badge"><?php echo $num_results; ?></span></a>

  <table class="table table-striped">
  <thead>
  <tr>
    <th><a href="<?= base_url().'admin/tours/index/order/id/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">ID</a> <i class="fa <?php if ($sort[5] == "id" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "id" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
    <th><a href="<?= base_url().'admin/tours/index/order/name/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">Name</a> <i class="fa <?php if ($sort[5] == "name" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "name" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
    <!--  <th>Name EN</th>-->
    <th>Code</th>
    <th>Highlight</th>
    <th>Active</th>
    <th>Meta Data</th>
    <th>Actions</th>
  </tr>
  </thead>
  <tfoot>
    <tr>
      <td colspan="7" class="table-footer"><?php if (strlen($links)): ?>Pages: <?php echo $links; ?><?php endif; ?></td>
    </tr>
  </tfoot>
  <tbody>
    <?php 
    foreach($tours as $tour): 

    echo '
    <tr>
      <td>'.$tour->id.'</td>
      <td><a href="'.site_url("admin/tours/edit?id=$tour->id").'">'.$tour->name.'</a></td>
      <td>'.$tour->code.'</td><td>';
      echo $tour->highlight == '1'?'Yes':'No';
      echo '</td><td>';
      echo $tour->active == '1'?'Yes':'No';
      echo '</td><td>';
      echo '<a href="'.site_url("admin/tours/meta?id=$tour->id").'">Edit</a>';
      echo '</td><td>
      <a href="'.site_url("admin/tours/edit?id=$tour->id").'" class="fa fa-pencil-square-o"></a>
      <a onClick="return window.confirm(\'Delete '.$tour->name.'?\');" href="'.site_url("admin/tours/delete?id=$tour->id").'" class="text-danger fa fa-trash-o"></a>
      </td>
    </tr>
    ';

    endforeach; ?>
  </tbody>
  </table>
</div>

<?php include_once('application/views/admin/footer.php'); ?>