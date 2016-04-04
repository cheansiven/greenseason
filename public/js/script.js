/**********************************************************************************

	Project Name: SimpleAdmin CMS Theme
	Project Description: A clean admin theme 
	File Name: script.js
	Author: Adi Purdila
	Author URI: http://www.adipurdila.com
	Version: 1.0.0
	
**********************************************************************************/


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#previewHolder').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    var winWidth = $('body').width();

	//Content boxes expand/collapse
	$(".initial-expand").hide();

	$("div.content-module-heading").click(function(){
		$(this).next("div.content-module-main").slideToggle();

		$(this).children(".expand-collapse-text").toggle();
	});

    /*Preview Box (admin)*/
    if ($('input.checkbox').prop( "checked" )) {
        $('.feature-image').show( "slide", { direction : 'right' }, 500);
    } else {
        $('.feature-image').hide( "slide", { direction : 'right' }, 500); }

    $('input.checkbox').change(function() {
        var checkbox = $(this);

        if(checkbox.prop( "checked" )) {
            checkbox.attr({
                value: "1",
                checked: true
            });
            $('.feature-image').show( "slide", {
                direction : 'right'
            }, 500);
        } else { checkbox.attr({
            value: "0",
            checked: false
        });
            $('.feature-image').hide( "slide", {
                direction : 'right'
            }, 500);
        }
    }).change();

    $('.city input').keyup(function(){
        $('.item-preview section h2').text(this.value);
    });

    $('.price input').keyup(function(){
        $('.item-preview .price').text("$ "+this.value);
    });

    //Photo preview.
    $("#filePhoto").change(function() {
        readURL(this);
    });

    /*Published*/
    $('input.publish').change(function() {
        var checkbox = $(this);

        if(checkbox.prop( "checked" )) {
            checkbox.attr({
                value: "1",
                checked: true
            });
        } else { checkbox.attr({
            value: "0",
            checked: false
            });
        }
    }).change();

    /*Form validation fields*/
    $('#flight input.submit').on('click', function() {
        var valid = true,
            message = '';

        $('.required').filter(function() {
            var $this = $(this);

            if(!$this.val()) {
                var inputName = $this.attr('name');
                valid = false;
                message += 'Field are required \n';
            }
        });

        if(!valid) {
            $("div.valid").text(message);
            return false;
        }
    });

    /*Popup Booking Hotel and Tour*/
    $('a.btn-booking').click(function(e) {
        var title = $(this).text();
        var itemParent =  $(this).closest('article[class^="blog-article-item"]');
        var getImage = itemParent.find("header img").attr('src');

        $('#myModal h3').text(title);
        $('#myModal img.get-photo').attr({src: getImage});
        $('#hotel-title').attr({value: title});
    });

    //Home page contact slider.
    $('#contact-container ul').cycle({
        fx:     'fade',
        speed:  'fast',
        timeout: 0,
        next:   '#next-contact'
    });

    /*jQuery Validation From*/
    // validate the form when it is submitted
    var validator = $("#from-booking").validate({
        errorPlacement: function(error, element) {
            // Append error within linked label
            $( element )
                .closest( "form" )
                .find( "label[for='" + element.attr( "id" ) + "']" )
                .append( error );
        },
        errorElement: "span",
        messages: {
            lname: {
                required: " required"
            },
            fname: {
                required: " required"
            },
            email: {
                required: " required"
            },
            phone: {
                required: " required"
            },
            arrival_date: {
                required: " required"
            },
            departure_date: {
                required: " required"
            },
            checkin: {
                required: " required"
            },
            checkout: {
                required: " required"
            }
        }
    });

    $(".cancel").click(function() {
        validator.resetForm();
    });
    $('div.btn-radio input').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'iradio_minimal-grey',
        increaseArea: '20%' // optional
    });

    $('.SlectBox').SumoSelect();

    $('#checkin').datepick({
        minDate: 0,
        onSelect: function() {
            var nextDate = $('#checkin').val();
            var nextDay = nextDate.substring(0, 2);
            nextDay = parseInt(nextDate) + 1;
            nextDay = nextDay.toString();
            if (nextDay.length < 2) nextDay = "0" + nextDay;
            nextDate = nextDay + nextDate.substring(2);
            $('#checkout').datepick('option', 'minDate', nextDate);
            $('#checkout').val(nextDate);
        }
    });

    $('#checkout').datepick({
        minDate: 0
    });

    $('input.datepicker').datepick({
        minDate: 0
    });

    setTimeout(function() {
        $('a.close-reveal-modal').trigger('click');
    }, 1500);

    /*Equal Tab*/
     /*var $tab = $("#slide-article-categories");
     var tabHeight = $tab.height();
     $tab.css('height', tabHeight + 14 + 'px');*/

    /*DropDown Menu Mobile*/
    $('button.dropdown-toggle').click(function() {
        $('ul.dropdown-menu').slideToggle('slow');
    });

    /*Ajax load data*/
    $('#load-more').click(function(index, value) {
        var myData = {
            offset: $('.blog-article-item').index() + 1,
            location_id: location_id
        }

        var _this = $(this);
        $(_this).attr('disabled', 'disabled');

        jQuery.ajax({
            type: "POST", // Post / Get method
            url: base_url+'/test.html', //Where form data is sent on submission
            dataType:"html", // Data type, HTML, json etc.
            data:myData, //Form variables
            success:function(response){
                /*alert(response);*/
                var article_count = $(response).find('article').length;
                //console.log(article_count );
                if(article_count < 9)
                    $(_this).hide();
                else
                    $(_this).removeAttr('disabled');

                $("#responds").append($(response).html());
                return false;
            },
            error:function (xhr, ajaxOptions, thrownError){
                console.log(thrownError);
            }
        });

        return false;
    });

    var btn = $('#load-more')

        .ajaxStart(function() {

            btn.parent().append('<span class="loading-image"></span>');

        }).ajaxStop(function() {

            btn.parent().find('.loading-image').remove();

        });

    if(winWidth >= 768)
    {
        $(window).scroll(function() {
            var scrollTop = $(this).scrollTop();

            if(scrollTop > 200)
            {
                $('#main-menu-top').fadeIn(500);
            }
            else {
                $('#main-menu-top').fadeOut('fast');
            }
        });
    }
});

$( window ).resize(function() {
    var resizeWin = $(this).width();

    //$( ".mobile-menu, .hamburger, .cross").attr('style', '');
});
