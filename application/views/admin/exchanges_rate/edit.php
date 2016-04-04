<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tours Services Management - Edit currency</title>
	<?php include_once('application/views/admin/header.php'); ?>
    
    <script type="text/javascript">
$(document).ready(function(){

$('#ExchangeRateForm').submit(function(){
		if(validateName())
			return true
		else
			return false;
	});
	
});	

</script>
    
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
				<li><a href="<?php echo site_url("admin/exchanges_rate/");?>">Dashboard</a></li>
				<li><a href="#" class="active-tab dashboard-tab">Edit Exchange Rate</a></li>
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

			<div> <!-- class="side-content fr" -->

				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">Form Elements</h3>
						<span class="fr expand-collapse-text">Click to collapse</span>
						<span class="fr expand-collapse-text initial-expand">Click to expand</span>
					
					</div> <!-- end content-module-heading -->
					
					
					<div class="content-module-main cf">
					<?php echo form_open_multipart('admin/exchanges_rate/update', 'id="ExchangeRateForm" name=""'); ?>
						<div class="half-size-column fl">
							<!--<form action="#">-->
							
								<fieldset>
								    <?php foreach( $exchange_rate AS $value ) : ?>
									<p>
										1 Dollar =
                                        <?= form_input('rate['.$value->currency_id.']', $value->rate, 'id="name" class="round " autofocus'); ?>
                                        <?= strip_tags($value->currency_description) ?> (<?= $value->currency_name ?>)
									</p>

                                    <?php endforeach; ?>

								</fieldset>

							<!--</form>-->
						<br><?php echo form_submit('save', 'Save', 'class="round blue ic-right-arrow"'); ?>
						</div> <!-- end half-size-column -->
						
						 			
                    
                    <?php echo form_close(); ?>
                    
					
                    
					</div> <!-- end content-module-main -->
                
                
					
				</div> <!-- end content-module -->

			</div>
		
			</div> <!-- end side-content -->
		
		</div> <!-- end full-width -->
			
	</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<?php include_once('application/views/admin/footer.php'); ?>
    <!-- end footer -->

</body>
</html>