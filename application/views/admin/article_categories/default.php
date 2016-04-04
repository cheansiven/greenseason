<?php include_once('application/views/admin/header.php'); ?>
	
<!-- MAIN CONTENT -->
<div class="container">
  <a href=""<?php echo site_url("admin/article_categories/");?>"" class="btn btn-default active-tab dashboard-tab">Dashboard</a>
  <a href="<?php echo site_url("admin/article_categories/add");?>" class="btn btn-primary">Add new catergory</a>
</div>

<div id="content" class="container">
	<div class="page-full-width cf">
		<div class="content-module">

			<div class="content-module-heading cf">
				<h3 class="fl">ARTICLE CATEGORY</h3>
			</div> <!-- end content-module-heading -->
			
			
			<div class="content-module-main">
			<a href="#">Found <span class="badge"><?php echo $num_results; ?></span></a>
                <?= form_open_multipart('admin/article_categories/ordering','id="regionForm" name="regionForm"'); ?>
				<table class="table">
				
					<thead>
				
						<tr>

                            <th><a href="<?= base_url().'admin/article_categories/index/order/id/sort/'.$sort[7].'/'.$this->uri->segment(7); ?>">ID</a> <i class="fa <?php if ($sort[5] == "id" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "id" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                            <th><a href="<?= base_url().'admin/article_categories/index/order/name/sort/'.$sort[7].'/'.$this->uri->segment(7); ?>">Name</a> <i class="fa <?php if ($sort[5] == "name" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "name" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>

                            <th>Type</th>
                            <!--<th><input type="submit" name="order" value="Ordering"></th>-->
                            <th>Active</th>
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

                            $type = "";
                            if( $category->type == 1 )
                                $type = "Slide Content Block";
                            elseif ( $category->type == 2 )
                                $type = "Extra Block";
                        
                        echo '
						<tr>
							
							<td>'.$category->id.'</td>
							<td><a href="'.site_url("admin/article_categories/edit?id=$category->id").'">'.$category->name.'</a></td>
							
							<td>'.$type.'</td>';
                        /*echo '<td>'.form_input('orders['.$category->id.']',$category->ordering, 'class="small-width-input" autofocus').'</td><td>';*/
                        echo '<td>';
                        echo $category->active == '1'?'Yes':'No';
                        echo '</td>
                            <td><a href="'.site_url("admin/article_categories/meta?id=$category->id").'">Edit</a></td>
							<td>
								<a href="'.site_url("admin/article_categories/edit?id=$category->id").'" class="table-actions-button ic-table-edit text-primary fa fa-pencil-square-o"></a>
								<a onClick="return window.confirm(\'Delete '.$category->name.'?\');" href="'.site_url("admin/article_categories/delete?id=$category->id").'" class="table-actions-button ic-table-delete text-danger fa fa-trash-o"></a>
							</td>
						</tr>
						';
						
                        endforeach; ?>	
					</tbody>
					
				</table>
                <?= form_close();?>

			</div> <!-- end content-module-main -->
		
		</div> <!-- end content-module -->
	
	</div> <!-- end full-width -->
		
</div> <!-- end content -->
	
	
	
<!-- FOOTER -->
<?php include_once('application/views/admin/footer.php'); ?>
<!-- end footer -->