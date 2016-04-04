<?php include_once('application/views/admin/header.php'); ?> 

<!-- MAIN CONTENT -->
<div class="container">
  <a href=""<?php echo site_url("admin/activities/");?>"" class="btn btn-default active-tab dashboard-tab">Dashboard</a>
  <a href=""<?php echo site_url("admin/activities/add");?>"" class="btn btn-primary active-tab dashboard-tab">Add new activity</a>
</div>

<div id="content" class="container">
  <div class="page-full-width cf">
    <div class="content-module">
      <div class="content-module-heading cf">
        <h3 class="fl">ACTIVITY<?= isset($page_name) ? " [".$page_name."]" : "" ?></h3>
      </div>
      <!-- end content-module-heading -->
      
      <div class="content-module-main">
        <a href="#">Found <span class="badge"><?php echo $num_results; ?></span></a>
        <table class="table">
          <thead>
            <tr>
              
              <th>ID</th>
              <th>Name</th>
              <th>Description</th>
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
            <?php foreach($activities as $activity):

                $active = $activity->status ? "Yes" : "No";

                $descriptions = "";
                $descs = @unserialize($activity->description);

                if ($activity->description === 'b:0;' || $descs !== false)
                {
                    foreach( $descs as $key=> $value )
                    {
                        if( $key != "id" )
                            $descriptions .= $key.": ".$value."<br />";
                    }
                    $descriptions = substr($descriptions, 0, -6);
                }
                echo '
                <tr>
                    <td>'.$activity->id.'</td>
                    <td><a href="#">'.$activity->name.'</a></td>
                    <td>'.$descriptions.'</td>
                    <td>'.$active.'</td>
                    <td><a onClick="return window.confirm(\'Delete '.$activity->id.'?\');" href="'.site_url("admin/activities/delete?id=$activity->id").'" class="table-actions-button ic-table-delete"></a>
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