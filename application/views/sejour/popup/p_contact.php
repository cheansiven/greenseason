<link href='http://fonts.googleapis.com/css?family=Marck+Script' rel='stylesheet' type='text/css'>
<style>
#popUp {
	width: 700px;
	margin: 0 auto;
	position: relative;
}
#popUp .borderBox {
	background: none repeat scroll 0 0 #4d4d4d;
	bottom: 0;
	font-family: 'Marck Script', cursive;
	font-size: 20px;
	font-style: italic;
	left: 0;
	line-height: 1em;
	padding: 12px 0;
	
	margin: 1px;
	margin-top:20px;
	
	color: #FFF;
	border-top: 2px solid #909090;
	moz-border-radius: 0 0 5px 5px;
	-webkit-border-radius: 0 0 5px 5px;
	border-radius: 0 0 5px 5px;
	
}
#popUp .hightlight {
	color: #EF8B30;
}
.reveal-modal2 {
	font-size: 45px;
	font-family: 'Alegreya Sans SC';
	text-align: center;
	width: 100%;
	visibility: hidden;
	color: #666;
	line-height: 28px;
	background: #F2F2F2; /*#EF8B30;*/
	padding:10px 0 0 0;
	position: absolute;
	z-index: 101;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	-moz-box-shadow: 0 0 10px rgba(0,0,0,.4);
	-webkit-box-shadow: 0 0 10px rgba(0,0,0,.4);
	-box-shadow: 0 0 10px rgba(0,0,0,.4);
	
}
.reveal-modal2 img {
	margin: 0 0 10px;
}
.close-reveal-modal.close {
	color: #CC8373;
	cursor: pointer;
	font-size: 35px !important;
	line-height: 0px;
	position: absolute;
	right: 5px;
	top: 13px;
	color: #808080;
}

</style>
<script type="text/javascript">


	function showModal_contact() {

        $('#myModal').reveal();
        $('#popUp').animate({ scrollTop: 50 }, 'slow');
		
        //setTimeout(function(){
           //$('#myModal').trigger('reveal:close');
        //},8000); // 4 seconds
      
	}
	
	$(document).ready(function(){   
	
	
	var form = $("#discountForm");
	var email = $("#email");
	var email_info = $("#email_info");
	
	var email_val = "VOTRE ADRESSE EMAIL";
	
	 $("#email").focus(function() {
        if($(this).val() == $(this).data('default_val') || !$(this).data('default_val')) {
            $(this).data('default_val', $(this).val());
            $(this).val('');
        }
    });

		email.blur(validateEmail);

	
	function validateEmail(){
			//testing regular expression
			var a = email.val();
			var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})$/;
			//if it's valid email
			if(filter.test(a)){
				email.removeClass("error");
				return true;
			}
			//if it's NOT valid
			else{
				email.addClass("error");
				if(email.val() == email_val || email.val() == "")
					email.val(email_val);
				
				return false;
			}
		}
		
		form.submit(function(){
		if(validateEmail())
			return true
		else
			return false;
	});
	
	
	form.submit(function(e)
{
	if(validateEmail()) { 
		var postData = $(this).serializeArray();
		var formURL = $(this).attr("action");
		
		$.ajax(
		{
			url : formURL,
			type: "POST",
			data : postData,
			success:function(message)
			{
				if (message == 1){
					$('#formEmail').hide();
					$('#message').show();
				}
				else {
					$('.emailErr').show();	
				}
			}
		});
		e.preventDefault(); //STOP default action
		e.unbind(); //unbind. to stop multiple form submit.
	}
});
 

});
	
</script>

<div id="popUp">
  <div id="myModal" class="reveal-modal2">
    <div id="formEmail" style="padding:20px 0 0 0;">
      <div style="padding-bottom:5px;"> RECEVEZ NOS PROMOTIONS<br>
        <span style="font-size:24px;">POUR VOTRE PROCHAIN SÉJOUR AU CAMBODGE</span> </div>
      <?php echo form_open('sejour/sendEmailPromotion', 'id="discountForm" name="discountForm"'); ?>
      <input type="text" id="email" name="email" value="VOTRE ADRESSE EMAIL" style="width:400px; height:30px; font-size:12px; color:#999;"/>
      <br>
      <input type="submit" name="send" value="ENVOYER" style="cursor:pointer; border:0; background-color:#ef8b30; color:#fff; width:120px; height:30px; margin-top:12px; font-size:16px;"/>
      <?php echo form_close(); ?>
      <div class="emailErr" style="color:#900; font-family:'Century Gothic'; display:none; font-size:16px; padding-top:5px;">Invalid email format! Please try again!</div>
      <div class="borderBox" id="borderBox"> RTR-tour est un réceptif local, avec plus de <span style="color:#ef8b30">10 ans d’expérience</span><br>
        Gagnez en expertise ! </div>
      <a class="close-reveal-modal close">&#215;</a> </div>
  
  <div id="message" style="display:none;">
    <div style="font-size:24px;padding:50px 0 15px 0;">MERCI DE VOUS ÊTRE INSCRIT !</div>
   
    <a class="close-reveal-modal accueil">
    <input type="button" name="send" value="ACCUEIL" style="cursor:pointer; border:0; background-color:#ef8b30; color:#fff; width:120px; height:30px; margin-top:10px; font-size:16px; margin-bottom:55px;"/>
    </a>
    <div class="borderBox" id="borderBox"> Nous vous enverrons régulièrement des informations sur le Cambodge </div>
  </div>
</div>
</div>
