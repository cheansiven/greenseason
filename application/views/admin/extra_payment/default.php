<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Extra Payment Management</title>
	<?php include_once('application/views/admin/header.php'); ?>
</head>
<body>

	<!-- TOP BAR -->
	<div id="top-bar">
		
		<div class="page-full-width cf">

			<ul id="nav" class="fl">
				
                <li class="v-sep"><a href="<?php echo site_url("../");?>" class="round button dark ic-left-arrow image-left">Main</a></li>
				<?php include_once('application/views/admin/menu.php'); ?>
				
			</ul> <!-- end nav -->

		</div> <!-- end full-width -->	
	
	</div> <!-- end top-bar -->
	
	
	
	<!-- HEADER -->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
	
			<ul id="tabs" class="fl">
				<li><a href="<?php echo site_url("admin/extra_payments/");?>" class="active-tab dashboard-tab">Dashboard</a></li>
				<li><a href="<?php echo site_url("admin/extra_payments/add");?>">New extra payment</a></li>
			</ul> 
            <!-- end tabs -->
			
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 30px height. -->
			<?php include_once('application/views/admin/logo.php'); ?>
			
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="content-module">
			
				<div class="content-module-heading cf">
				
					<h3 class="fl">EXTRA PAYMENT</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				
				
				<div class="content-module-main">
									
					<p>Found <?php echo $num_results; ?> extra payments </p>
                    
					<table>
					
						<thead>
					
							<tr>

                                <th><a href="<?= base_url().'admin/extra_payments/index/order/id/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">ID</a> <i class="fa <?php if ($sort[5] == "id" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "id" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                                <th><a href="<?= base_url().'admin/extra_payments/index/order/name/sort/'.$sort[7].'/'.$this->uri->segment(8); ?>">Name</a> <i class="fa <?php if ($sort[5] == "name" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "name" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
								<th>Email</th>
                                <th>Amount</th>
                                <th>File No.</th>
                                <th>Payment</th>
                                <th>Expired</th>
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
						<?php date_default_timezone_set('Asia/Phnom_Penh');?>
			
							<?php foreach($quotations as $quotation): 
                            
                            echo '
							<tr>
								
								<td>'.$quotation->id.'</td>
								<td><a href="'.site_url("admin/extra_payments/edit?id=$quotation->id").'">'.$quotation->name.'</a></td>
								<td>'.$quotation->email.'</td>
								<td>'.$quotation->amount.'</td>
								<td>'.$quotation->file_num.'</td>
								<td>';
                                echo $quotation->payment == "1"?"Yes":"No";
								echo '</td>';
								if ($quotation->payment == 1) echo '<td>NO</td>';
								else {
									$datetime1 = new DateTime($quotation->date);
									$datetime2 = new DateTime(date("Y-m-d H:i:s"));
									$interval = $datetime1->diff($datetime2);
									$expire = $interval->format('%a');
									if ($expire > 1){
										echo '<td><a href="'.site_url("admin/extra_payments/activatePayment?id=".$quotation->id).'">ACTIVATE</a></td>';	
									} else echo '<td>NO</td>';
								}
								echo '<td>
									<a href="'.site_url("admin/extra_payments/edit?id=$quotation->id").'" class="table-actions-button ic-table-edit"></a>
									<a onClick="return window.confirm(\'Delete '.$quotation->name.'?\');" href="'.site_url("admin/extra_payments/delete?id=$quotation->id").'" class="table-actions-button ic-table-delete"></a>
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