function destinationFunc(item)
{
	var itemTargetToDo = $('#destinationFlag');
	var itemOffset = $('#menu_destination').offset();

	$('#destinationFlag').css('paddingLeft', itemOffset.left / 2.1);

	item.toggleClass('active');
	if(item.hasClass('active'))
	{
		itemTargetToDo.slideDown({ duration: 1500, easing: "easeOutBack" });
		$('.blog-home').hide();
	} else {
		itemTargetToDo.slideUp({ duration: 1500, easing: "easeOutBack" });
		$('.blog-home').show();
	}
}
function subDestinationMenu(item)
{
	$('.detail').hide();
	var frm = item.parent();
	frm.find('.detail').toggleClass('open').show("slide", { direction: "left", easing: "easeOutBack" }, 1000);

}

/*
* ------ Tour Group Form Submit vie Ajax
*/
function tourGroupForm(frmID)
{
	var frm = $('#formTourGroup_'+frmID+ ' form');
	var msg = $('#formTourGroup_'+frmID+ ' .message-success');
	var frmEmail = frm.find('input.email-type');
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);

    if(!pattern.test(frmEmail.val()))
	{
		frmEmail.addClass('error');
		frmEmail.val('');
		frmEmail.attr('placeholder', 'please enter email address');
	} else {
		frmEmail.removeClass('error');

		$.ajax({
	        url: base_url+"sejour/TourGroupBooking",
			data: frm.serialize(),
	        type: "post",
	        success: function(result)
	        {
				msg.fadeIn('slow');
	        }
	    });
	}
	setTimeout(function(){ msg.fadeOut('slow') }, 4000);
	return false;
}

/*
* ------ Tour Validate Form
*/
function xday(frmID)
{

	/*var frm = $("#newsletter");
	var msg = "#msg_newsletter";
	
	jQuery(msg).empty();
	$(msg).append('<div class="msg_newsletter"><img class="text-center" src="'+base_url+'public/images/ajaxload.gif"></div>');
	 
  	$.ajax({
	  	
        url: base_url+"sejour/emailBonsPlans",
		data: frm.serialize(),
        type: "post",
        success: function(result)
        {
			jQuery(msg).empty();
           jQuery(msg).append(result);
		   jQuery(".wrap_newsletter").delay(3000).fadeOut();
        }
    });*/   
}

$(document).ready(function() {

	$('#menu_destination').click(function() {
		destinationFunc($(this));
	});
	$('.sub-destination-menu').click(function() {
		subDestinationMenu($(this));
	});

	/*
	* ------ Tour Toggle
	*/
	$('.btn-toggle').click(function(e) {
		var click = $(this).data('clicks');
		var icons = $(this).find('span');
		var itemToDo = $(this).parents('.parent-toggle').find('.content-toggle, .form-tour-multi');

		if (click) {
			icons.removeClass().addClass('icon-open');
			itemToDo.slideUp();
		} else {
			icons.removeClass().addClass('icon-close');
			itemToDo.slideDown();
		}

		$(this).data('clicks', !click);
		return false;
	});

	/*
	* ------ Tour Group Toggle
	*/
	
	
	$('.btn-tour-group-toggle').click(function(e) {
		var id = $(this).attr('id');
		var num = $(this).attr('id').split("_")[1];
       $('#articleDate_'+num).slideToggle('slow');
		
    });
	
	$('.showBooking').click(function(e) {
		$(this).addClass('active');
		
    });
	
	
	
	/*
	* ------ Tour Validate Form
	*/
	$('.form-tour-multi').submit(function() {
		var frm = $(this);
		var id = $(this).attr('id');
		var frmEmail = $(this).find('input');
		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		

		if(!pattern.test(frmEmail.val()))
		{
			frmEmail.addClass('error');
		} else {
			
			var msg = $('#message-success_'+id);
		msg.empty();
		msg.removeClass('collapse').append('<img src="'+base_url+ '/public/images/ajaxload.gif">');
			frmEmail.removeClass('error');
			$.ajax({
		        url: base_url+"sejour/singleTourEmailMulti",
				data: frm.serialize(),
		        type: "post",
		        success: function(result)
		        {
					msg.empty();
		        	msg.append('<p>'+result+'</p>');
		        }
		    });
		}
		setTimeout(function(){ msg.addClass('collapse') }, 5000);
		return false;
	});
});