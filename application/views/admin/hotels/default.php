<?php include_once('application/views/admin/header.php'); ?>

<!-- MAIN CONTENT -->
<div class="container">
    <a href="<?php echo site_url("admin/hotels/");?>" class="btn btn-default">Dashboard</a>
    <a href="<?php echo site_url("admin/hotels/add");?>" class="btn btn-primary">Add new hotel</a>
</div>

<div id="content" class="container">
  <div class="page-full-width cf">
    <div class="content-module">
      <div class="content-module-heading cf">
        <h3 class="fl">HOTEL</h3>
      </div>
      <!-- end content-module-heading -->
      
      <div class="content-module-main">
        <a href="#">Found <span class="badge"><?php echo $num_results; ?></span></a>
        <table id="sort-table" class="table">
          <thead>
            <tr>
                <th><a href="<?= base_url().'admin/hotels/index/order/id/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">ID</a> <i class="fa <?php if ($sort[5] == "id" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "id" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                <th><a href="<?= base_url().'admin/hotels/index/order/name/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">Name</a> <i class="fa <?php if ($sort[5] == "name" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "name" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                <!--  <th>Name [EN]</th>-->
                <th><a href="<?= base_url().'admin/hotels/index/order/city/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">City</a> <i class="fa <?php if ($sort[5] == "city" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "city" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
              <th>Meta Data</th>
              <th>Published</th>
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
            <?php foreach($hotels as $hotel):

                            echo '
							<tr>

								<td>'.$hotel->id.'</td>
								<td><a href="'.site_url("admin/hotels/edit?id=$hotel->id").'">'.$hotel->name.'</a></td>
								<td>'.$hotel->city.'</td>
								<td><a href="'.site_url("admin/hotels/meta?id=$hotel->id").'">Edit</a></td>
								<td><input type="checkbox" disabled '.($hotel->published == '1'? 'checked':'').' /></td>
								<td>
									<a href="'.site_url("admin/hotels/edit?id=$hotel->id").'" class="table-actions-button ic-table-edit text-primary fa fa-pencil-square-o"></a>
									<a onClick="return window.confirm(\'Delete '.$hotel->name.'?\');" href="'.site_url("admin/hotels/delete?id=$hotel->id").'" class="table-actions-button ic-table-delete text-danger fa fa-trash-o"></a>
								</td>
							</tr>
							';

                            endforeach; ?>
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