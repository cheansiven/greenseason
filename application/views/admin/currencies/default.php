<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tour Services Management</title>
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
				<li><a href=""<?php echo site_url("admin/currencies/");?>"" class="active-tab dashboard-tab">Dashboard</a></li>
				<li><a href="<?php echo site_url("admin/currencies/add");?>">Add new currency</a></li>
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
				
					<h3 class="fl">CURRENCIES</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				
				
				<div class="content-module-main">
									
					<p>Found <?php echo $num_results; ?> Currencies </p>
                    
					<table>
					
						<thead>
					
							<tr>
								
								<th>ID</th>
								<th>Symbol</th>
                                <th>Description</th>
								
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
						
							<?php foreach($results as $value):
                            
                            echo '
							<tr>
								
								<td>'.$value->id.'</td>
								<td><a href="'.site_url("admin/currencies/edit?id=$value->id").'">'.$value->name.'</a></td>
								<td>'.$value->description.'</td>';
                                if( $value->id == 1)
                                    echo '<td><a href="'.site_url("admin/currencies/edit?id=$value->id").'" class="table-actions-button ic-table-edit"></a></td>';
                                else
                                    echo '<td>
                                        <a href="'.site_url("admin/currencies/edit?id=$value->id").'" class="table-actions-button ic-table-edit"></a>
                                        <a onClick="return window.confirm(\'Delete '.$value->name.'?\');" href="'.site_url("admin/currencies/delete?id=$value->id").'" class="table-actions-button ic-table-delete"></a>
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