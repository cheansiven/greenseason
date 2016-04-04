<?php include_once('application/views/admin/header.php'); ?>

<!-- MAIN CONTENT -->
<div class="container">
  <a href="<?php echo site_url("admin/categories/");?>" class="btn btn-default active-tab dashboard-tab">Dashboard</a>
  <a href="<?php echo site_url("admin/categories/add");?>" class="btn btn-primary">Add new catergory</a>
</div>

	<div id="content" class="container">
		<div class="page-full-width cf">
			<div class="content-module">
				<div class="content-module-heading cf">
					<h3 class="fl">CATEGORY</h3>
				</div> <!-- end content-module-heading -->
				
				
				<div class="content-module-main">
									
					<p>Found <?php echo $num_results; ?> categories </p>
                    
					<table>
					
						<thead>
					
							<tr>
								
								<th>ID</th>
								<th>Name</th>
								<th>Highlight</th>
                                <th>Meta Data</th>
								<th>Actions</th>
							</tr>
						
						</thead>

						<tfoot>
						
							<tr>
							
								<td colspan="5" class="table-footer">
									
									<?php if (strlen($links)): ?>
                                 
                                    Pages: <?php echo $links; ?>
  
                                    <?php endif; ?>
                                    
								</td>
								
							</tr>
						
						</tfoot>
						
						<tbody>
						
							<?php foreach($categories as $category): 
                            
                            echo '
							<tr>
								
								<td>'.$category->id.'</td>
								<td><a href="'.site_url("admin/categories/edit?id=$category->id").'">'.$category->name.'</a></td>
								<td>';
                                echo $category->highlight == "1"?"Yes":"No";
                                echo '</td><td>
                                    <a href="'.site_url("admin/categories/meta?id=$category->id").'">Edit</a>';
								echo '</td><td>
									<a href="'.site_url("admin/categories/edit?id=$category->id").'" class="table-actions-button ic-table-edit"></a>
									<a onClick="return window.confirm(\'Delete '.$category->name.'?\');" href="'.site_url("admin/categories/delete?id=$category->id").'" class="table-actions-button ic-table-delete"></a>
								</td>
							</tr>
							';
							
                            endforeach; ?>	
						</tbody>
						
					</table>
					

				</div> <!-- end content-module-main -->
			
			</div> <!-- end content-module -->
		
		</div> <!-- end full-width -->
			
	</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<?php include_once('application/views/admin/footer.php'); ?>
    <!-- end footer -->

</body>
</html>