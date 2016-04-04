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

    /*Top menu animation*/
    $('#main-menu-top').hide();
    $(window).scroll(function() {
        if($(this).scrollTop() > 220) {
            $('#main-menu-top').fadeIn(500);
        }
        else {
            $('#main-menu-top').fadeOut('fast');
        }
    });

    $(".cancel").click(function() {
        validator.resetForm();
    });

});
