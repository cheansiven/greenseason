<?php include_once('application/views/admin/header.php'); ?>
	
<!-- MAIN CONTENT -->
<div class="container">
    <a href="<?php echo site_url("admin/hotel_categories/");?>" class="btn btn-default">Dashboard</a>
    <a href="<?php echo site_url("admin/hotel_categories/add");?>" class="btn btn-primary">Add new category</a>
</div>
	<div id="content" class="container">
		<div class="page-full-width cf">
			<div class="content-module">
				<div class="content-module-heading cf">
					<h3 class="fl">CATEGORY</h3>
				</div> <!-- end content-module-heading -->
				
				
				<div class="content-module-main">
									
					<a href="#">Found <span class="badge"><?php echo $num_results; ?></span></a>
                    
					<table class="table">
					
						<thead>
					
							<tr>
                                <th><a href="<?= base_url().'admin/hotel_categories/index/order/id/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">ID</a> <i class="fa <?php if ($sort[5] == "id" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "id" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                                <th><a href="<?= base_url().'admin/hotel_categories/index/order/name/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">Name</a> <i class="fa <?php if ($sort[5] == "name" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "name" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                             <!--    <th>Name [EN]</th>-->
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
								<td><a href="'.site_url("admin/hotel_categories/edit?id=$category->id").'">'.$category->name.'</a></td>
								<td>
									<a href="'.site_url("admin/hotel_categories/edit?id=$category->id").'" class="table-actions-button ic-table-edit text-primary fa fa-pencil-square-o"></a>
									<a onClick="return window.confirm(\'Delete '.$category->name.'?\');" href="'.site_url("admin/hotel_categories/delete?id=$category->id").'" class="table-actions-button ic-table-delete text-danger fa fa-trash"></a>
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