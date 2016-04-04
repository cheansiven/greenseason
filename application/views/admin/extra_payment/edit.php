<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Extra Payment Management - Edit Extra Payment</title>
	<?php include_once('application/views/admin/header.php'); ?>
    
    <script type="text/javascript">
$(document).ready(function(){

$('#extraPaymentForm').submit(function(){
		if(validateName() & validateEmail() & validateAmount() & validateFile())
			return true
		else
			return false;
	});
	
	function validateName(){
		if($('#name').val() == ""){
			$('#name').addClass("error");
			$('#nameError').toggle();
			$('#nameError').show();
			return false;
		}
		//if it's valid
		else{
			$('#name').removeClass("error");
			$('#nameError').toggle();
			$('#nameError').hide();
			return true;
		}
	}
	
	function validateEmail(){
		if($('#email').val() == ""){
			$('#email').addClass("error");
			$('#emailError').toggle();
			$('#emailError').show();
			return false;
		}
		//if it's valid
		else{
			$('#email').removeClass("error");
			$('#emailError').toggle();
			$('#emailError').hide();
			return true;
		}
	}
	
	function validateAmount(){
		if($('#amount').val() == ""){
			$('#amount').addClass("error");
			$('#amountError').toggle();
			$('#amountError').show();
			return false;
		}
		//if it's valid
		else{
			$('#amount').removeClass("error");
			$('#amountError').toggle();
			$('#amountError').hide();
			return true;
		}
	}
	
	function validateFile(){
		if($('#file_num').val() == ""){
			$('#file_num').addClass("error");
			$('#file_numError').toggle();
			$('#file_numError').show();
			return false;
		}
		//if it's valid
		else{
			$('#file_num').removeClass("error");
			$('#file_numError').toggle();
			$('#file_numeError').hide();
			return true;
		}
	}
	
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
				<li><a href="<?php echo site_url("admin/extra_payments/");?>">Dashboard</a></li>
				<li><a href="#" class="active-tab dashboard-tab">Edit extra payment</a></li>
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
					
					<?php if ($extra_payment->payment == 1) $visible = 'readonly = true'; else $visible = ''?>
					<div class="content-module-main cf">
					<?php echo form_open_multipart('admin/extra_payments/update', 'id="extraPaymentForm" name="extraPaymentForm"'); ?>
						<div class="half-size-column fl">
							<!--<form action="#">-->
							
								<fieldset>
								
									<p>
										<!--<label for="simple-input">Simple input</label>
										<input type="text" id="simple-input" class="round default-width-input" />-->
                                        <?php
										
										  echo form_label('Name: ', 'name');
										  echo form_input('name',$extra_payment->name, ''.$visible.' id="name" class="round default-width-input" autofocus');
										  
									    ?>
									</p>
                                    <p id="nameError">Please enter Name!</p>
                                    <p>
										<!--<label for="simple-input">Simple input</label>
										<input type="text" id="simple-input" class="round default-width-input" />-->
                                        <?php
										
										  echo form_label('Email: ', 'email');
										  echo form_input('email',$extra_payment->email, ''.$visible.' id="email" class="round default-width-input" autofocus');
										  
									    ?>
									</p>
                                    <p id="nameError">Please enter email!</p>
                                     <p>
										<!--<label for="simple-input">Simple input</label>
										<input type="text" id="simple-input" class="round default-width-input" />-->
                                        <?php
										
										  echo form_label('Amount: ', 'amount');
										  echo form_input('amount',$extra_payment->amount, ''.$visible.' id="amount" class="round default-width-input" autofocus');
										  
									    ?>
									</p>
                                    <p id="nameError">Please enter amount!</p>
                                     <p>
										<!--<label for="simple-input">Simple input</label>
										<input type="text" id="simple-input" class="round default-width-input" />-->
                                        <?php
										
										  echo form_label('File/Quotation No.: ', 'file_num');
										  echo form_input('file_num',$extra_payment->file_num, ''.$visible.' id="file_num" class="round default-width-input" autofocus');
										  
									    ?>
									</p>
                                     <p id="file_numError">Please enter the file number!</p>
                                    <br>
                                   <p>PAYMENT LINK FOR CLIENT:</p>
									<?php echo base_url().'payment.html?hash='.$extra_payment->token;?>
                                    <br><br><br>
								</fieldset>
							
							<!--</form>-->
						  <?php 
						  	if ($extra_payment->payment == 1){
								  echo '<a href="'.site_url("admin/extra_payments/").'">BACK</a>';
							}else {
						  		echo form_submit('save', 'Save', 'class="round blue ic-right-arrow"'); 
							}
							?>
                          	
						</div> <!-- end half-size-column -->
						
						<input type="hidden" name="id" value="<?php echo $extra_payment->id?>">
                  
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