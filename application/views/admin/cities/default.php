<?php include_once('application/views/admin/header.php'); ?> 

<!-- MAIN CONTENT -->
<div class="container">
  <a href=""<?php echo site_url("admin/cities/");?>"" class="btn btn-default active-tab dashboard-tab">Dashboard</a>
  <a href="<?php echo site_url("admin/cities/add");?>" class="btn btn-primary">Add new city</a>
</div>

<div id="content" class="container">
  <div class="page-full-width cf">
    <div class="content-module">
      <div class="content-module-heading cf">
        <h3 class="fl">CITY</h3>
      </div>
      <!-- end content-module-heading -->
      
      <div class="content-module-main">
        <a href="#">Found <span class="badge"><?php echo $num_results; ?></span></a>
        <table class="table">
          <thead>
            <tr>
              
              <th>ID</th>
              <th>Name</th>
              <th>Country</th>
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
            <?php foreach($cities as $city): 
                            
                            echo '
							<tr>
								
								<td>'.$city->id.'</td>
								<td><a href="'.site_url("admin/cities/edit?id=$city->id").'">'.$city->name.'</a></td>
								<td>'.$city->country.'</td>
								<td>
									<a href="'.site_url("admin/cities/edit?id=$city->id").'" class="table-actions-button ic-table-edit text-primary fa fa-pencil-square-o"></a>
									<a onClick="return window.confirm(\'Delete '.$city->name.'?\');" href="'.site_url("admin/cities/delete?id=$city->id").'" class="table-actions-button ic-table-delete text-danger fa fa-trash-o"></a>
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