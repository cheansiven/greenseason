<?php $this->load->view('sejour/header');?>
<div id="body">
  <div class="blog-hotel">

    <div class="col-md-12">
      <div class="bodyContent">

          <div class="row">
            <div class="content-article">
              <div id="blog-article">
              <div class="text-right">
                  <img src="<?php echo base_url().'public/images/rtr-payment-page-mar15.png' ?>" style="margin-bottom: -1px; margin-right: -1px;"/>
              </div>
			  
			  <div class="wrap-form-pay">
				  <div class="item-masonry h315" style="max-width:100%">
					  <div class="title">
						<h2>DIRECT ONLINE PAYMENT</h2>
					  </div>
				   <?php if($state == 2) { ?>
							<?php 
								//echo form_open_multipart('sejour/payment', 'id="paymentForm" name="paymentForm"');
								echo form_open_multipart('request.html', 'id="paymentForm" name="paymentForm"');
							 ?>

							<input type="hidden" name="Title" value="PHP VPC 3-Party">

					   <!--<input type="hidden" name="virtualPaymentClientURL" size="63" value="https://migs-mtf.mastercard.com.au/vpcpay" maxlength="250">-->
					   <input type="hidden" name="virtualPaymentClientURL" size="65" value="https://migs-mtf.mastercard.com.au/vpcpay" maxlength="250"/>

							<input type="hidden" name="vpc_Version" value="1" size="20" maxlength="8">
							<input type="hidden" name="vpc_Command" value="pay" size="20" maxlength="16">

							<input type="hidden" name="vpc_AccessCode" value="6ABEEA1B" size="20" maxlength="8">

							<input type="hidden" name="vpc_Merchant" value="ITTEST" size="20" maxlength="16">

							<input type="hidden" name="vpc_OrderInfo" value="RTRToursExtraPayment" size="20" maxlength="34">
							<input type="hidden" name="vpc_Locale" value="en" size="20" maxlength="5">
							<input type="hidden" name="vpc_ReturnURL" size="63" value="<?php echo site_url('confirm.html?bid='.$extra_payment->id);?>" maxlength="250">
							<input type="hidden" name="vpc_Amount" id="vpc_Amount" value="<?php echo ($extra_payment->amount)*100?>" size="20" maxlength="10">
							<input type="hidden" name="token" value="<?php echo $extra_payment->token;?>">

							<?php

							date_default_timezone_set('Asia/Phnom_Penh');
							$ref = date("dmY-His").'-'.$extra_payment->id;
							echo '<input type="hidden" value="'.$ref.'" name="vpc_MerchTxnRef" size="20" maxlength="40">';
							?>


							<div class="titleName">
								<p>
									Dear Mr/Mrs/Ms : <?php echo $extra_payment->name;?>,<br />
									The amount due at this time is : <b>USD <?php echo $extra_payment->amount;?></b> <br />
									You will now be redirected to our Banking Partner (Cathay Bank) secured server for final payment procedure.
								</p>
							</div>

							<div class="btn-cancel-paynow">
								<input type="submit" value="PROCEED" class="btnBookTourSave" />
								<a href="<?php echo site_url('main.html');?>">CANCEL</a>
							</div>
							
							<?php echo form_close(); ?>
						<?php } else if ($state == -1){
							echo 'The payment is expired! Please contact administrator for the new link.';
						}
						else if ($state == -2){
							echo 'The payment is incorrect! Please contact the administrator for the correct link.';
						}
						else if ($state == 1){
							echo 'The payment is already paid!';
						}
						?>
				  </div>              
			  </div>              
              </div>
            </div>
          </div>

        <div class="clear"></div>
      </div>
      <!-- .bodyContent --> 
    </div>
    <div class="clear"></div>
    <div class="pagination">
      <p> </p>
    </div>
  </div>
  <!-- .bodyContent --> 
  
</div>
<?php $this->load->view('sejour/footer');?>