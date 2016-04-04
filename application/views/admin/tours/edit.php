
<?php include_once('application/views/admin/header.php'); ?>
<script>
	$(function() {
		$( "#tour_tabs" ).tabs();
	});
	</script>
<script type="text/javascript">
    $(document).ready(function(){
    	$('#fromDatepicker').datepick({
    		minDate: 0,
    		onSelect: function() { 
    		var nextDate = $('#fromDatepicker').val();
    		var nextDay = nextDate.substring(0, 2);
    		nextDay = parseInt(nextDate) + 1;
    		nextDay = nextDay.toString();
    		if (nextDay.length < 2) nextDay = "0" + nextDay;
    			nextDate = nextDay + nextDate.substring(2);
    			$('#untilDatepicker').datepick('option', 'minDate', nextDate);
    			$('#untilDatepicker').val(nextDate);
    		} 
    	});
    	
    	$('#untilDatepicker').datepick({minDate: 0});
    	
    	
    	$('#tourForm').submit(function(){
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
    		
    	});
    });

    function showRegions(country) {	
    	/*if (country.checked){
    		
    		$.ajax({ 
                 url: "<?php echo base_url();?>admin/tours/getRegions",
                data: {country_id: $(country).val()},
                type: "post",
                success: function(regions) //we're calling the response json array 'cities'
                  {
                   $('#country'+$(country).val()).append('<div id="region_country'+$(country).val()+'" style="padding-left:30px;"></div>')
                     for (var id in regions) {
                            $('#region_country'+$(country).val()).append('<div id="region'+id+'"><p><input name="region[]" type="checkbox" value="'+id+'"/> ' + regions[id] + '</p></div>');
                     }
                   } //end success
            });
    		
    	} else $('#region_country'+$(country).val()).remove();*/
    }


    var rowNum = <?php echo count($itineraries)?>;
    function addRow(frm) {
    rowNum ++;

        var row = '' +
            '<div id="itinerary'+rowNum+'">' +
            '<p><label for="itinerary_day'+rowNum+'">Day: </label><input type="text" autofocus="" class="round default-width-input" value="" name="itinerary_day'+rowNum+'" id="itinerary_day'+rowNum+'"></p>' +
            '<p><label for="itinerary_day_en'+rowNum+'">Day EN: </label><input type="text" autofocus="" class="round default-width-input" value="" name="itinerary_day_en'+rowNum+'" id="itinerary_day_en'+rowNum+'"></p>' +
            '<p><label for="itinerary_img'+rowNum+'">Image: </label><input type="file" autofocus="" class="round default-width-input" value="" name="itinerary_img'+rowNum+'" id="itinerary_img'+rowNum+'"></p>' +
            '<p><label for="itinerary_desc'+rowNum+'">Description: </label><textarea autofocus="" class="round full-width-textarea" id="itinerary_desc'+rowNum+'" rows="10" cols="40" name="itinerary_desc'+rowNum+'"></textarea></p>' +
            '<p><label for="itinerary_desc_en'+rowNum+'">Description EN: </label><textarea autofocus="" class="round full-width-textarea" id="itinerary_desc_en'+rowNum+'" rows="10" cols="40" name="itinerary_desc_en'+rowNum+'"></textarea></p>' +
            '<p><?php echo form_label('Hotels: ');?></p>' +
            '<div id="script'+rowNum+'"></div>' +
            'Country: ' +
            '<select id="country_id_'+ rowNum +'" name="country_id_'+ rowNum +'">'+
            '<?php foreach( $countries as $value ):?><option value="<?=$value['id']?>"><?=$value['name']?></option><?php endforeach;?>' +
            '</select>' +
            'City: ' +
            '<select id="city_id'+ rowNum +'" name="city_id'+ rowNum +'">'+
            '<?php foreach( $list_cities as $key => $value ):?><option value="<?=$key?>"><?=$value?></option><?php endforeach;?>' +
            '</select>' +
            'Hotel: ' +
            '<select id="hotel_id'+ rowNum +'" name="hotel_id'+ rowNum +'"><option></option></select>' +
            '<p><input type="button" value="Remove" onclick="removeRow('+rowNum+');"></p>' +
            '<input type="hidden" value="'+rowNum+'" name="rows[]"><hr></div>';

        jQuery('#itinerary').append(row);

        var script = document.createElement( 'script' );
        script.type = 'text/javascript';
        script.innerHTML = ''+
            '$(document).ready(function(){' +
            '$("#city_id'+rowNum+'").change(function(){' +
            '$.ajax({' +
            'url: "<?= base_url(); ?>admin/hotels/getHotelsByCity/" + $(this).val(),' +
            'data: {city_id'+rowNum+': $(this).val()},' +
            'type: "POST",' +
            'contentType: "application/json; charset=utf-8",' +
            'dataType: "json",' +
            'success: function (data) {' +
            '$("#hotel_id'+rowNum+'").get(0).options.length = 0;' +
            '$("#hotel_id'+rowNum+'").get(0).options[0] = new Option("-- Please Select --", "");' +
            '$.each(data, function (name, id){' +
            'n = $("#hotel_id'+rowNum+'").get(0).options.length;' +
            '$("#hotel_id'+rowNum+'").get(0).options[n] = new Option(id, name);' +
            '});' +
            ' }' +
            '});' +
            '});' +
            '});';

        jQuery('#script'+rowNum).append(script);

    tinyMCE.init({
            selector: "#itinerary_desc"+rowNum
    });
    //add tinymce to this
    tinyMCE.execCommand("mceAddControl", false, 'description'+rowNum);

    }

    function removeRow(rnum) {
    jQuery('#itinerary'+rnum).remove();
    }

    var rowImage = <?php echo count($tourGalleries);?>;
    function addImage(frm) {
    rowImage ++;

    var newRow = '<div id="gallery'+rowImage+'"><p><input type="file" autofocus="" class="round default-width-input" id="gallery'+rowImage+'" value="" name="gallery[]"></p><p><input type="button" value="Remove" onclick="removeImage('+rowImage+');"></p><hr></div>';
    jQuery('#gallery').append(newRow);

    }

    function removeImage(rnum) {
    jQuery('#gallery'+rnum).remove();
    }

    function deleteImage(image) {
    	$("#"+image).val('');
    	$("#show"+image).remove();
    }

</script>

<!-- MAIN CONTENT -->
<div class="container">
    <a href="<?php echo site_url("admin/tours/");?>" class="btn btn-default">Dashboard</a>
    <a href="#" class="btn btn-primary">Edit tour</a>
</div>

<div id="content">
	<div class="page-full-width cf">
    	<div>
      		<div class="content-module">
                <?php echo form_open_multipart('admin/tours/update', 'id="tourForm" class="form form-horizontal" name="tourForm"'); ?>
                <div id="tour_tabs" class="wrap-tabs">
                    <div id="tour_tabs" class="menu-tabs">
                        <ul class="container">
                             <li><a href="#tabs-1">Info</a></li>
                            <li><a href="#tabs-2">Rate</a></li>
                            <li><a href="#tabs-3">Itinerary</a></li>
                            <li><a href="#tabs-4">Detail</a></li>
                            <li><a href="#tabs-5">Gallery</a></li>
                            <li class="pull-right"><a href="#tabs-6">Meta</a></li>
                        </ul>
                    </div>
                    <div class="container content-tabs">
    					<div id="tabs-1">
                            <div class="half-size-column fl col-sm-8"> 
                                <?php echo validation_errors(); ?>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <div class="checkbox">
                                            <label>
                                                <?php if ($tour->active == 1)
                                                        echo form_checkbox('active','1',true);
                                                    else echo form_checkbox('active','1',false);
                                                ?> Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Tour Name:</label>
                                    <div class="col-sm-5">
                                        <?php echo form_input('name',$tour->name, 'id="name" class="round form-control default-width-input" autofocus'); ?>
                                        <p id="nameError">Please enter tour name</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="code" class="col-sm-3 control-label">Code:</label>
                                    <div class="col-sm-5">
                                        <?php echo form_input('code',$tour->code, 'id="code" class="round form-control default-width-input" autofocus'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <div class="checkbox">
                                            <label>
                                                <?php
                                                    if ($tour->best_value == 1)
                                                        echo form_checkbox('best_value','1',true);
                                                    else echo form_checkbox('best_value','1',false);
                                                ?> Best value
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <?php 
                                                    if ($tour->highlight == 1)
                                                        echo form_checkbox('highlight','1',true);
                                                    else echo form_checkbox('highlight','1',false);
                                                ?> Hightlight
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="countrylist" class="form-group">
                                    <div class="checkbox">
                                        <label for="country" class="col-sm-3 control-label">Country:</label>
                                        <div class="col-sm-5">
                                            <?php $jsCountry = 'onClick="showRegions(this);"'; foreach ($countries as $country){ ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php $countryChecked = 1;
                                                foreach ($tourCountries as $tourCountry) {
                                                    if ($country['id'] == $tourCountry)
                                                    {
                                                        echo form_checkbox('country[]',$country['id'],true, $jsCountry);
                                                        echo $country['name'];
                                                        $countryChecked = 2;
                                                        break;
                                                    }
                                                }
                                                if ($countryChecked == 1){
                                                    echo '<div id="country'.$country['id'].'">'.form_checkbox('country[]',$country['id'],false, $jsCountry);
                                                    echo $country['name'].'</div>';
                                                } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="arrival_city" class="col-sm-3 control-label">Arrival city:</label>
                                    <div class="col-sm-5">
                                        <?php echo form_dropdown('arrival_city', $list_cities, $tour->arrival_city, 'id="arrival_city" class="form-control"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="departure_city" class="col-sm-3 control-label">Departure city:</label>
                                    <div class="col-sm-5">
                                        <?php echo form_dropdown('departure_city', $list_cities, $tour->departure_city, 'id="departure_city" class="form-control"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="departure_city" class="col-sm-3 control-label">Departure city:</label>
                                    <div class="col-sm-5">
                                        <?php echo form_dropdown('departure_city', $list_cities, $tour->departure_city, 'id="departure_city" class="form-control"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="num_days" class="col-sm-3 control-label">Number of days:</label>
                                    <div class="col-sm-5">
                                        <?php echo form_input('num_days',$tour->num_days, 'id="num_days" class="round form-control default-width-input" autofocus'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="num_nights" class="col-sm-3 control-label">Number of nights:</label>
                                    <div class="col-sm-5">
                                        <?php echo form_input('num_nights',$tour->num_nights, 'id="num_nights" class="round form-control default-width-input" autofocus'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="rate" class="col-sm-3 control-label">Rates A (Rack rates):</label>
                                    <div class="col-sm-5">
                                        <?php echo form_input('rate',$tour->rate, 'id="rate" class="round form-control default-width-input" autofocus'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="promo_rate" class="col-sm-3 control-label">Rates B (Promotional rate):</label>
                                    <div class="col-sm-5">
                                        <?php echo form_input('promo_rate',$tour->promo_rate, 'id="promo_rate" class="round form-control default-width-input" autofocus'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fromDatepicker" class="col-sm-3 control-label">Valid from month:</label>
                                    <div class="col-sm-5">
                                        <?php echo form_input('start', $tour->start, 'id="fromDatepicker" class="round form-control default-width-input" autofocus readonly="readonly"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="untilDatepicker" class="col-sm-3 control-label">Valid until month:</label>
                                    <div class="col-sm-5">
                                        <?php echo form_input('end',$tour->end, 'id="untilDatepicker" class="round form-control default-width-input" autofocus readonly="readonly"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <div class="checkbox">
                                            <label>
                                                <?php 
                                                    if ($tour->year_round == 1)
                                                        echo form_checkbox('year_round','1',true);
                                                    else echo form_checkbox('year_round','1',false);
                                                ?> Valid all year round
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-sm-3 control-label">Main image:</label>
                                    <div class="col-sm-5">
                                        <?php if($tour->image != '') {?>
                                        <div id="showimageold" style="margin-bottom: 15px;">
                                            <img src="<?php echo base_url();?>upload/tours/<?php echo $tour->image?>" vspace="10">
                                            <input type="button" value="Remove" onclick="deleteImage('imageold');">
                                        </div>
                                        <?php } ?>
                                        <?php echo form_upload('image','', 'id="image" class="round default-width-input" autofocus'); ?>
                                        <input type="hidden" name="imageold" value="<?php echo $tour->image?>" id="imageold">
                                    </div>
                                </div>
                            </div>
                            <div class="half-size-column fr col-sm-4"> 
                                <p>
                                    <?php
                                    echo form_label('Types of tour: ', 'category');
                                    ?>
                                </p>
                                <div class="form-group">
                                    <?php foreach ($categories as $category){ $checked = 1; ?>
                                    <div class="checkbox">
                                        <label>
                                            <?php foreach ($tourCategories as $tourCategory){
                                                if ($category['id'] == $tourCategory['category_id']) {
                                                    echo form_checkbox('category[]',$category['id'],true, 'id="category"');
                                                    echo $category['name'];
                                                    $checked = 2;
                                                    break;
                                                } 
                                            }
                                            if ($checked == 1) {
                                                echo form_checkbox('category[]',$category['id'],false, 'id="category"');
                                                echo $category['name'];  
                                            } ?>
                                        </label>
                                    </div>
                                    <?php } ?>
                                </div>
                                    
    									
    								
                                    
                                 <p>
                                    <?php
                                    echo form_label('Primary mode of transportation: ', 'transport');
                                    ?>
                                </p>
                                    <?php
                                    foreach ($transports as $transport){
    									$checked == 1;
    									foreach ($tourTransports as $tourTransport) {
    										if ($transport['id'] == $tourTransport['transport_id']) {
                                        		echo '<p>'.form_checkbox('transport[]',$transport['id'],true, 'id="transport"');
                                        		echo $transport['name'].'</p>';
    											$checked = 2;
    											break;
    										}
    									}
    									if ($checked == 1){
    										echo '<p>'.form_checkbox('transport[]',$transport['id'],false, 'id="transport"');
                                        	echo $transport['name'].'</p>';	
    									}
    								} ?> 
                                <p>
                                    <?php
                                    echo form_label('Tour guides available in: ', 'langauge');
                                    ?>
                                </p>
                                    <?php
                                    foreach ($languages as $language){
    									$checked = 1;
    									foreach ($tourLanguages as $tourLanguage){
    										if ($language['id'] == $tourLanguage['language_id'])
    										{
                                        		echo '<p>'.form_checkbox('languages[]',$language['id'],true, 'id="language"');
                                        		echo $language['name'].'</p>'; 
    											$checked = 2;
    											break;
    										}
    									}
    									if ($checked ==1){
    										echo '<p>'.form_checkbox('languages[]',$language['id'],false, 'id="language"');
                                        	echo $language['name'].'</p>'; 
    									}
    								}
    								?>
                                <p>
                                    <?php
                                    echo form_label('Services: ');
                                    ?>
                                </p>
                                <?php
                                foreach ($services as $service){
                                    $checked = 1;
                                    foreach ($itineraryServices[$itineraries[0]['id']] as $itineraryService){
                                        if ($service['id'] == $itineraryService['service_id'])
                                        {
                                            echo '<p>'.form_checkbox('service0[]',$service['id'],true);
                                            echo $service['name'].'</p>';
                                            $checked = 2;
                                            break;
                                        }
                                    }
                                    if ($checked ==1){
                                        echo '<p>'.form_checkbox('service0[]',$service['id'],false);
                                        echo $service['name'].'</p>';
                                    }
                                }
                                ?>
                            </div>
     					</div>
                        <div id="tabs-2">
                        	
                            <table class="table"  cellpadding="0" cellspacing="0">
                            	<tr>
                                	<td style="width:150px !important"></td>
                                	<td width="200">NORMAL</td>
                                    <td width="200">LAST MINUTE</td>
                                </tr>
                                <?php
    								if (count($tourRates) > 0 ){
    									foreach($tourRates as $rate){
    										echo '<tr><td>'.$rate['person'].' PERSON <input type="hidden" name="person['.$rate['id'].']" value="'.$rate['person'].'"></td>';
    										echo '<td>'.form_input('rate['.$rate['id'].']',$rate['rate'], 'class="round small-width-input" autofocus').'</td>';
    										echo '<td>'.form_input('promo_rate['.$rate['id'].']',$rate['promo_rate'], 'class="round small-width-input" autofocus').'</td></tr>';
    									}	
    									
    									?>
                                         <tr>
                                            <td>
                                                SINGLE EXTRA
                                            </td>
                                             <td>
                                                <?php echo form_input('single_extra_rate',$singleExtraRate->rate, 'id="single_extra_rate" class="round small-width-input" autofocus');?>
                                            </td>
                                            <td>
                                                <?php echo form_input('single_extra_promo_rate',$singleExtraRate->promo_rate, 'id="single_extra_promo_rate" class="round small-width-input" autofocus');?>
                                            </td>
                                        </tr>
                                   
                                    <?php echo '<input type="hidden" name="updateRate" value="1">' ?>
                                    <?php echo form_hidden('single_extra_id',$singleExtraRate->id, 'class="round small-width-input" autofocus');?>
                                
                                        <?php
    								} else {
    								?>
                                    	<tr>
                                            <td>
                                                1 PERSON
                                            </td>
                                            <td>
                                                <?php echo form_input('rate[]','', 'id="rate1" class="round small-width-input" autofocus');?>
                                            </td>
                                            <td>
                                                <?php echo form_input('promo_rate[]','', 'id="promo_rate1" class="round small-width-input" autofocus');?>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                2 PERSONS
                                            </td>
                                             <td>
                                                <?php echo form_input('rate[]','', 'id="rate2" class="round small-width-input" autofocus');?>
                                            </td>
                                            <td>
                                                <?php echo form_input('promo_rate[]','', 'id="promo_rate2" class="round small-width-input" autofocus');?>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                3 PERSONS
                                            </td>
                                             <td>
                                                <?php echo form_input('rate[]','', 'id="rate3" class="round small-width-input" autofocus');?>
                                            </td>
                                            <td>
                                                <?php echo form_input('promo_rate[]','', 'id="promo_rate3" class="round small-width-input" autofocus');?>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                4 PERSONS
                                            </td>
                                             <td>
                                                <?php echo form_input('rate[]','', 'id="rate4" class="round small-width-input" autofocus');?>
                                            </td>
                                            <td>
                                                <?php echo form_input('promo_rate[]','', 'id="promo_rate4" class="round small-width-input" autofocus');?>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                5 PERSONS
                                            </td>
                                             <td>
                                                <?php echo form_input('rate[]','', 'id="rate5" class="round small-width-input" autofocus');?>
                                            </td>
                                            <td>
                                                <?php echo form_input('promo_rate[]','', 'id="promo_rate5" class="round small-width-input" autofocus');?>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                6 PERSONS
                                            </td>
                                             <td>
                                                <?php echo form_input('rate[]','', 'id="rate6" class="round small-width-input" autofocus');?>
                                            </td>
                                            <td>
                                                <?php echo form_input('promo_rate[]','', 'id="promo_rate6" class="round small-width-input" autofocus');?>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                7 PERSONS
                                            </td>
                                             <td>
                                                <?php echo form_input('rate[]','', 'id="rate7" class="round small-width-input" autofocus');?>
                                            </td>
                                            <td>
                                                <?php echo form_input('promo_rate[]','', 'id="promo_rate7" class="round small-width-input" autofocus');?>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                8 PERSONS
                                            </td>
                                             <td>
                                                <?php echo form_input('rate[]','', 'id="rate8" class="round small-width-input" autofocus');?>
                                            </td>
                                            <td>
                                                <?php echo form_input('promo_rate[]','', 'id="promo_rate8" class="round small-width-input" autofocus');?>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                9 PERSONS
                                            </td>
                                             <td>
                                                <?php echo form_input('rate[]','', 'id="rate9" class="round small-width-input" autofocus');?>
                                            </td>
                                            <td>
                                                <?php echo form_input('promo_rate[]','', 'id="promo_rate9" class="round small-width-input" autofocus');?>
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                                10 PERSONS
                                            </td>
                                             <td>
                                                <?php echo form_input('rate[]','', 'id="rate10" class="round small-width-input" autofocus');?>
                                            </td>
                                            <td>
                                                <?php echo form_input('promo_rate[]','', 'id="promo_rate10" class="round small-width-input" autofocus');?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><hr><input type="hidden" name="updateRate" value="0"></td>
                                        </tr>
                                         <tr>
                                            <td>
                                                SINGLE EXTRA
                                            </td>
                                             <td>
                                                <?php echo form_input('single_extra_rate','', 'id="single_extra_rate" class="round small-width-input" autofocus');?>
                                            </td>
                                            <td>
                                                <?php echo form_input('single_extra_promo_rate','', 'id="single_extra_promo_rate" class="round small-width-input" autofocus');?>
                                            </td>
                                        </tr>
                                    <?php	
    								}
                                	
    							?>
                                 </table>
                        </div>
                    	<div id="tabs-3">
                        	<div id="itinerary">
                            <?php
    							$i = 0;
                            	foreach($itineraries as $itinerary){
    						?>
                            	<div id="itinerary<?php echo $i;?>">
                                <div class="col-xs-7">
                                    <div class="form-group">
                                        <label>Day:</label>
                                        <?php echo form_number('itinerary_day'.$i, $itinerary['day'], 'id="itinerary_day" class="round form-control default-width-input" autofocus'); ?>
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="form-group">
                                        <label>Image:</label>
                                        <?php if($itinerary['image'] != '') {?>
                                        <img src="<?php echo base_url();?>upload/tours/itinerary/<?php echo $itinerary['image']?>"><input type="button" value="Remove" onclick="deleteImage('itinerary_imgold<?php echo $i;?>');">
                                        <?php } ?>
                                        <?php       
                                        echo form_upload('itinerary_img'.$i,'', 'id="itinerary_img'.$i.'" class="round form-control default-width-input" autofocus'); 
                                        echo '<input type="hidden" name="itinerary_imgold'.$i.'" id="itinerary_imgold'.$i.'" value="'.$itinerary['image'].'">';
                                        ?>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label>Description:</label>
                                        <?php echo form_textarea('itinerary_desc'.$i ,$itinerary['description'], 'id="itinerary_desc'.$i.'" class="round form-control full-width-textarea" autofocus rows="20"'); ?>
                                    </div>
                                </div>
                                    
                                    <script type="text/javascript">
                                        $(document).ready(function(){

                                            // Hotel
                                            $('#city_id<?=$i?>').change(function(){
                                                $.ajax({
                                                    url: "<?= base_url(); ?>admin/hotels/getHotelsByCity/" + $(this).val(),
                                                    data: {city_id<?=$i?>: $(this).val()},
                                                    type: 'POST',
                                                    contentType: "application/json; charset=utf-8",
                                                    dataType: "json",
                                                    success: function (data) {
                                                        $("#hotel_id<?=$i?>").get(0).options.length = 0;
                                                        $("#hotel_id<?=$i?>").get(0).options[0] = new Option("-- Please Select --", "");
                                                        // This expects data in "option 1" format, a dictionary.
                                                        $.each(data, function (name, id){
                                                            n = $("#hotel_id<?=$i?>").get(0).options.length;
                                                            $("#hotel_id<?=$i?>").get(0).options[n] = new Option(id, name);
                                                        });
                                                    }
                                                });
                                            });
                                        });

                                    </script>
                                    
                                    
                                        <?php
                                        if( sizeof($itineraryHotels[$itinerary['id']])>0 )
                                        {
                                            $getHotels  = $this->hotel->getHotelsByCityID($itineraryHotels[$itinerary['id']][0]['city_id']);
                                            $city_active = sizeof($itineraryHotels[$itinerary['id']])>0 ? $itineraryHotels[$itinerary['id']][0]['city_id'] : "";
                                            $hotel_active = sizeof($itineraryHotels[$itinerary['id']])>0 ? $itineraryHotels[$itinerary['id']][0]['city_id'] : "";
                                        }
                                        else
                                        {
                                            $getHotels = array();
                                            $city_active = "";
                                            $hotel_active = "";
                                        } ?>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="country_id">Country</label>
                                            <?php foreach( $countries as $value )
                                                $option_countries[$value['id']] = $value['name'];
                                            echo form_dropdown('country_id_'.$i, $option_countries, '', 'class="form-control"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="country_id">City</label>
                                            <?php echo form_dropdown('city_id'.$i, $list_cities, $city_active, 'id="city_id'.$i.'" class="form-control"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="country_id">Hotel</label>
                                            <?php $hotels = array();
                                                foreach( $getHotels AS $value )
                                                $hotels[$value->id] = $value->name;
                                                echo form_dropdown('hotel_id'.$i, $hotels, $hotel_active, 'id="hotel_id'.$i.'" class="form-control"');
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" value="<?php echo $i;?>" name="rows[]">
                                    <input type="button" value="Remove" onclick="removeRow('<?php echo $i;?>');"></p>
                                   <hr>
                               </div>
                               <?php
    							$i++;
    							}
    						?>

                            </div>
                            
                            
                        	 <p>
                                	<input onclick="addRow(this.form);" type="button" value="Add itinerary" />
                                </p>
                            
                        </div>
    					<div id="tabs-4">
                        	<p>
                             	<?php 
                                echo form_label('Overview: ', 'intro');
                                echo form_textarea('intro',$tour->intro, 'id="intro" class="round full-width-textarea" autofocus'); 
                                ?>
                           	</p>
                            <p>
                                <?php
                               // echo form_label('Overview EN: ', 'intro');
                               // echo form_textarea('intro_en',$tour->intro_en, 'id="intro_en" class="round full-width-textarea" autofocus');
                                ?>
                            </p>
                            <p>
                            	<?php 
                                echo form_label('Description: ', 'description');
                                echo form_textarea('description',$tour->description, 'id="description" class="round full-width-textarea" autofocus rows="20"');
                                ?>
                            </p>
                            <p>
                                <?php
                               // echo form_label('Description EN: ', 'description');
                               // echo form_textarea('description_en',$tour->description_en, 'id="description_en" class="round full-width-textarea" autofocus rows="20"');
                                ?>
                            </p>
                        </div>
                        <div id="tabs-5">
                        	<div id="gallery">
                            	<?php 
    							$i = 0;
    							foreach ($tourGalleries as $tourGallery)
    							{ 
    								?>
                                    <div id="gallery<?php echo $i;?>">
                                    	<p>
                                    		<img src="<?php echo base_url();?>upload/tours/gallery/<?php echo $tourGallery['image']?>">
                                   		</p>
                                        <p>
                                            <?php		
    										echo form_hidden('galleryOld[]', $tourGallery['image']);
                                            ?>
                                        </p>
                                        <p><input type="button" value="Remove" onclick="removeImage(<?php echo $i;?>);"></p>
                                        <hr>
                                    </div>
                                <?php 
    								$i++;
    							}
    							
    							?>
                                
                            	<p>
                            		<?php
                                	echo form_upload('gallery[]','', 'id="gallery" class="round default-width-input" autofocus'); 
    								?>
                            	</p>
                                <hr>
                            </div>
                           
                            <p>
                            	<input onclick="addImage(this.form);" type="button" value="Add image" />
                            </p>
                        </div>
                        <div id="tabs-6" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
                            <div class="form-group">
                                <?php

                                echo form_label('Meta title: ', 'meta_title').'<br>';
                                echo form_input('meta_title', $tour->meta_title, 'id="meta_title" class="round form-control default-width-input" autofocus');

                                ?>
                            </div>
                            <div class="form-group">
                                <?php

                                echo form_label('URL: ', 'url').'<br>';
                                echo form_input('url', $tour->url, 'id="url" class="round form-control default-width-input" autofocus');

                                ?>
                            </div>
                            <div class="form-group">
                                <?php

                                echo form_label('Meta keyword: ', 'meta_keyword').'<br>';
                                echo form_input('meta_keyword', $tour->meta_keyword, 'id="meta_keyword" class="round form-control default-width-input" autofocus');

                                ?>
                            </div>
                            <div class="form-group">
                                <?php

                                echo form_label('Meta description: ', 'meta_description').'<br>';
                                echo form_input('meta_description', $tour->meta_description, 'id="meta_description" class="round form-control" autofocus');

                                ?>
                            </div>
                        </div>
					</div>
                </div>
                	 <?php echo form_hidden('tour_id',$tour->id);?>
       
                    <div class="container button-submit">
                        <div class="text-uppercase text-center">
                            <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?>
                        </div>
                    </div>

                <?php echo form_close(); ?> 
			</div>
		</div>
	</div>
</div>
<?php include_once('application/views/admin/footer.php'); ?>
