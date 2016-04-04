<?php include_once('application/views/admin/header.php'); ?>

<!-- MAIN CONTENT -->
<div class="container">
  <a href=""<?php echo site_url("admin/promotions/");?>"" class="btn btn-default active-tab dashboard-tab">Dashboard</a></li>
  <a href="<?php echo site_url("admin/promotions/form");?>" class="btn btn-primary">Add new promotion</a>
</div>

<div id="content" class="container">
  <div class="page-full-width cf">
    <div class="content-module">
      <div class="content-module-heading cf">
        <h3 class="fl">Promotions<?= isset($page_name) ? " [".$page_name."]" : "" ?></h3>
      </div>
      <!-- end content-module-heading -->
      
      <div class="content-module-main">
        <a href="#">Found <span class="badge"><?php echo $num_results; ?></span></a>
        <table class="table">
          <thead>
            <tr>
              
              <th>ID</th>
              <th>Name</th>
              <th>File Name</th>             
              <th>Active</th>
              <th>Action</th>
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
            <?php foreach($promotions as $promotion):
				$id = $promotion->id;
                $active = $promotion->status ? "Yes" : "No";
                echo '
                <tr>
                    <td>'.$promotion->id.'</td>
                    <td><a href="'.site_url("admin/promotions/form?id=$id").'">'.$promotion->name.'</a></td> 
					<td>'.$promotion->image.'</td>
                    <td>'.$active.'</td>
                    <td><a href="'.site_url("admin/promotions/form?id=$id").'" class="table-actions-button ic-table-edit"></a><a onClick="return window.confirm(\'Delete '.$promotion->id.'?\');" href="'.site_url("admin/promotions/delete?id=$promotion->id").'" class="table-actions-button ic-table-delete"></a>
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