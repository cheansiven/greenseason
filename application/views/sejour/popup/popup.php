<style>
.close-reveal-modal {
	color: #000;
	cursor: pointer;
	font-size: 35px !important;
	line-height: 0.5;
	position: absolute;
	right: 11px;
	top: 20px;
}
</style>
<script type="text/javascript">


	function showModal() {
   	//alert("hello");
    
       $('#myModal').reveal();
       
       /*setTimeout(function(){
           $('#myModal').trigger('reveal:close');
       },5000); */
	   // 5 seconds
    
}    

	
	
</script>
<div id="myModal" class="reveal-modal">
  <div class="mainTitleRed"> <a class="close-reveal-modal">&#215;</a>
    <div class="titlePopup" id="titlePopup">property of the week</div>
  </div>
  <div class="wrapperPopup" style="margin-left:20px;">
    <div class="highlight" > <img class="border" src="<?php echo base_url();?>upload/properties/<?php echo $property->image?>" title="Real Estate Agency in Kep, Cambodia" alt="Real Estate Agency in Kep, Cambodia">
      <h1><?php echo $property->name;?></h1>
      <?php echo character_limiter(strip_tags($property->description), 300);?>
      <div class="price">
        <?php
			if ($property->transaction_id == 1) 
				echo '$'.number_format($property->asking_price);
			else echo '$'.$property->rate_low.'/day';
		?>
      </div>
    </div>
  </div>
  <div style="clear:both"></div>
  <div class="showme"><a href="<?php echo site_url('property-for-sale/'.$property->id).'/'.strtolower(url_title($property->name))?>">SHOW ME</a></div>
</div>
