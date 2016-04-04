<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Tours Management - Edit tour</title>
<?php include_once('application/views/admin/header.php'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.datepick.css">
<link href="<?php echo base_url();?>public/css/jquery-ui-1.10.3.custom.min.css" rel="stylesheet">
	
<script src="<?php echo base_url();?>public/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo base_url();?>public/js/jquery.datepick.js"></script>
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

function showRegions(country)
{	
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



</head>
<body>


<div id="top-bar">
	<div class="page-full-width cf">
    	<ul id="nav" class="fl">
      		<li class="v-sep"><a href="<?php echo site_url("../");?>" class="round button dark ic-left-arrow image-left">Main</a></li>
      		<?php include_once('application/views/admin/menu.php'); ?>
    	</ul>
  	</div>
</div>
<div id="header-with-tabs">
	<div class="page-full-width cf">
    	<ul id="tabs" class="fl">
      		<li><a href="<?php echo site_url("admin/tours/");?>">Dashboard</a></li>
      		<li><a href="#" class="active-tab dashboard-tab">Edit tour</a></li>
    	</ul>
    	<?php include_once('application/views/admin/logo.php'); ?>
	</div>
</div>
<div id="content">
	<div class="page-full-width cf">
    	<div>
      		<div class="content-module">
        		
                <?php echo form_open_multipart('admin/tours/update', 'id="tourForm" name="tourForm"'); ?>
                
                	<div id="tour_tabs" style="float:left; width:100%;">
                        <ul>
                             <li><a href="#tabs-1">Info</a></li>
                            <li><a href="#tabs-2">Rate</a></li>
                            <li><a href="#tabs-3">Itinerary</a></li>
                            <li><a href="#tabs-4">Detail</a></li>
                            <li><a href="#tabs-5">Gallery</a></li>
                            <li><a href="#tabs-6">Meta</a></li>
                        </ul>
						<div id="tabs-1">
                            <div class="half-size-column fl"> 
                                <?php echo validation_errors(); ?>
                                 <p>
                                    <?php 
                                        echo '<br><span class="label">Active </span>';
										if ($tour->active == 1)
                                        	echo form_checkbox('active','1',true);
										else echo form_checkbox('active','1',false);
                                    ?>
                                </p>
                                <p>
                                    <?php 
                                    echo form_label('Tour Name: ', 'name');
                                    echo form_input('name',$tour->name, 'id="name" class="round default-width-input" autofocus');
                                    ?>
                                </p>
                                <p>
                                    <?php
                                   // echo form_label('Tour Name EN: ', 'name');
                                   // echo form_input('name_en',$tour->name_en, 'id="name_en" class="round default-width-input" autofocus');
                                    ?>
                                </p>
                                <p id="nameError">Please enter tour name</p>
                                <p>
                                    <?php
                                    echo form_label('Code: ', 'code');
                                    echo form_input('code',$tour->code, 'id="code" class="round default-width-input" autofocus');
                                    ?>
                                </p>
                                <p>
                                    <?php 
                                        echo '<br><span class="label">Best value </span>';
										if ($tour->best_value == 1)
                                        	echo form_checkbox('best_value','1',true);
										else echo form_checkbox('best_value','1',false);
                                    ?>
                                </p>
                                 <p>
                                    <?php 
                                        echo '<br><span class="label">Hightlight </span>';
										if ($tour->highlight == 1)
                                        	echo form_checkbox('highlight','1',true);
										else echo form_checkbox('highlight','1',false);
                                    ?>
                                </p>
                                <div id="countrylist">
                                    <?php
                                    echo '<p>'.form_label('Country: ', 'country').'</p>';
                                    $jsCountry = 'onClick="showRegions(this);"';
                                    foreach ($countries as $country){
                                        $countryChecked = 1;
                                        foreach ($tourCountries as $tourCountry) {
                                            if ($country['id'] == $tourCountry)
                                            {
                                                echo '<div id="country'.$country['id'].'"><p>'.form_checkbox('country[]',$country['id'],true, $jsCountry);
                                                echo $country['name'].'</p>';
                                                echo '<div id="region_country'.$country['id'].'" style="padding-left:30px;">';
                                                foreach($tourRegions[$tourCountry] as $id => $region)
                                                {
                                                    $regionChecked = 1;
                                                    foreach ($regions_id as $region_id){
                                                        if($id == $region_id){
                                                            echo '<div id="region'.$id.'"><p>'.form_checkbox('region[]',$id,true, 'onClick="showCities(this);"');
                                                            echo $region.'</p>';


                                                            echo '</div>';
                                                            $regionChecked = 2;
                                                            break;
                                                        }
                                                    }
                                                    if ($regionChecked == 1)
                                                    {
                                                        echo '<div id="region'.$id.'"><p>'.form_checkbox('region[]',$id,false, 'onClick="showCities(this);"');
                                                        echo $region.'</p></div>';
                                                    }
                                                }
                                                echo '</div></div>';
                                                $countryChecked = 2;
                                                break;
                                            }
                                        }
                                        if ($countryChecked == 1){
                                            echo '<div id="country'.$country['id'].'"><p>'.form_checkbox('country[]',$country['id'],false, $jsCountry);
                                            echo $country['name'].'</p></div>';
                                        }
                                    }
                                    ?>
                                </div>
                                 
                                 <p>
                                    <?php
                                    echo form_label('Arrival city: ', 'arrival_city');
                                    echo form_dropdown('arrival_city', $list_cities, $tour->arrival_city, 'id="arrival_city"');  
                                    ?>
                                </p>
                                <p>
                                    <?php		
                                    echo form_label('Departure city: ', 'departure_city');
                                    echo form_dropdown('departure_city', $list_cities, $tour->departure_city, 'id="departure_city"'); 
                                    ?>
                                </p>
                               
                                <p>
                                    <?php
                                    echo form_label('Number of days: ', 'num_days');
                                    echo form_input('num_days',$tour->num_days, 'id="num_days" class="round default-width-input" autofocus');
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo form_label('Number of nights: ', 'num_nights');
                                    echo form_input('num_nights',$tour->num_nights, 'id="num_nights" class="round default-width-input" autofocus');
                                    ?>
                                </p>
                                 <p>
                                    <?php
                                    echo form_label('Rates A (Rack rates): ', 'rate');
                                    echo form_input('rate',$tour->rate, 'id="rate" class="round default-width-input" autofocus');
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo form_label('Rates B (Promotional rate): ', 'promo_rate');
                                    echo form_input('promo_rate',$tour->promo_rate, 'id="promo_rate" class="round default-width-input" autofocus');
                                    ?>
                                </p>
                                
                                <p>
                                    <?php
                                    echo form_input('start',$tour->start, 'id="fromDatepicker" class="round default-width-input" autofocus readonly="readonly"');
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    echo form_input('end',$tour->end, 'id="untilDatepicker" class="round default-width-input" autofocus readonly="readonly"');
                                    ?>
                                </p>
                                 <p>
                                    <?php 
                                        echo 'Valid all year round: ';
										if ($tour->year_round == 1)
                                        	echo form_checkbox('year_round','1',true);
										else echo form_checkbox('year_round','1',false);
                                    ?>
                                </p>
                               		<?php if($tour->image != '') {?>
                                <p id="showimageold">
                                    <img src="<?php echo base_url();?>upload/tours/<?php echo $tour->image?>"><input type="button" value="Remove" onclick="deleteImage('imageold');">
                                </p>
                                  	<?php } ?>
                                <p>
                                    <?php		
                                    echo form_label('Main image: ', 'image');
                                    echo form_upload('image','', 'id="image" class="round default-width-input" autofocus'); 
                                    ?>
                                    <input type="hidden" name="imageold" value="<?php echo $tour->image?>" id="imageold">
                                </p>
                            </div>
                            <div class="half-size-column fr"> 
                                <p>
                                    <?php
                                    echo form_label('Types of tour: ', 'category');
                                    ?>
                                </p>
                                    <?php
                                    foreach ($categories as $category){
										$checked = 1;
										foreach ($tourCategories as $tourCategory){
											if ($category['id'] == $tourCategory['category_id']) {
                                        		echo '<p>'.form_checkbox('category[]',$category['id'],true, 'id="category"');
												echo $category['name'].'</p>';
												$checked = 2;
												break;
											} 
										}
										if ($checked == 1) {
											echo '<p>'.form_checkbox('category[]',$category['id'],false, 'id="category"');
											echo $category['name'].'</p>';	
										} 
									} ?> 
                                    
                                   <!-- 
                                <p>
                                    <?php
                                    echo form_label('Types of activity: ', 'activity');
                                    ?>
                                </p>
                                    <?php
                                    foreach ($activities as $activity){
										$checked = 1;
										foreach ($tourActivities as $tourActivity) {
											if ($tourActivity['tour_activity'] == $activity['id']) {
                                        		echo '<p>'.form_checkbox('activity[]',$activity['id'],true, 'id="activity"');
                                        		echo $activity['name'].'</p>'; 
												$checked = 2;
												break;
											}
											
										}
										if ($checked == 1) {
											echo '<p>'.form_checkbox('activity[]',$activity['id'],false, 'id="activity"');
                                        	echo $activity['name'].'</p>'; 	
										}
									}
									?> 
                                 -->
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
                        	
                            <table  cellpadding="0" cellspacing="0" style="width:650px !important">
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
                                            <td colspan="3"><hr><input type="hidden" name="updateRate" value="1"></td>
                                        </tr>
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
                                    <p>
                                        <?php
                                        echo form_label('Day: ', 'itinerary_day');
                                        echo form_number('itinerary_day'.$i, $itinerary['day'], 'id="itinerary_day" class="round default-width-input" autofocus');
                                        ?>
                                    </p>
                                    <p>
                                        <?php
                                       // echo form_label('Day EN: ', 'itinerary_day');
                                       // echo form_input('itinerary_day_en'.$i, $itinerary['day_en'], 'id="itinerary_day_en" class="round default-width-input" autofocus');
                                        ?>
                                    </p>
                                    <?php if($itinerary['image'] != '') {?>
                                      <p>
                                        <img src="<?php echo base_url();?>upload/tours/itinerary/<?php echo $itinerary['image']?>"><input type="button" value="Remove" onclick="deleteImage('itinerary_imgold<?php echo $i;?>');">
                                      </p>
                                      <?php } ?>
                                    <p>
                                        <?php		
                                        echo form_label('Image: ', 'itinerary_img'.$i);
                                        echo form_upload('itinerary_img'.$i,'', 'id="itinerary_img'.$i.'" class="round default-width-input" autofocus'); 
										echo '<input type="hidden" name="itinerary_imgold'.$i.'" id="itinerary_imgold'.$i.'" value="'.$itinerary['image'].'">';
                                        ?>
                                    </p>
                                    <p>
                                        <?php 
                                        echo form_label('Description: ', 'itinerary_desc'.$i); 
                                        echo form_textarea('itinerary_desc'.$i ,$itinerary['description'], 'id="itinerary_desc'.$i.'" class="round full-width-textarea" autofocus rows="20"'); 
                                        ?>
                                    </p>
                                    <p>
                                        <?php
                                       // echo form_label('Description EN: ', 'itinerary_desc'.$i);
                                      //  echo form_textarea('itinerary_desc_en'.$i ,$itinerary['description_en'], 'id="itinerary_desc_en'.$i.'" class="round full-width-textarea" autofocus rows="20"');
                                        ?>
                                    </p>

                                    <p>
                                        <?php
                                        echo form_label('Hotels: ');
                                        ?>
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
                                    </p>
                                    <p>
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
                                        }

                                        echo 'Country: ';

                                        foreach( $countries as $value )
                                            $option_countries[$value['id']] = $value['name'];
                                        echo form_dropdown('country_id_'.$i, $option_countries, '');

                                        echo " City: ";

                                        echo form_dropdown('city_id'.$i, $list_cities, $city_active, 'id="city_id'.$i.'"');

                                        echo " Hotel: ";

                                        $hotels = array();
                                        foreach( $getHotels AS $value )
                                            $hotels[$value->id] = $value->name;

                                        echo form_dropdown('hotel_id'.$i, $hotels, $hotel_active, 'id="hotel_id'.$i.'"');
                                    ?>
                                    
                                   <input type="hidden" value="<?php echo $i;?>" name="rows[]">
                                    <p><input type="button" value="Remove" onclick="removeRow('<?php echo $i;?>');"></p>
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
                            <p>
                                <?php

                                echo form_label('Meta title: ', 'meta_title').'<br>';
                                echo form_input('meta_title', $tour->meta_title, 'id="meta_title" class="round default-width-input" autofocus');

                                ?>
                            </p>
                            <p>
                                <?php

                              //  echo form_label('Meta title EN: ', 'meta_title').'<br>';
                              //  echo form_input('meta_title_en', $tour->meta_title_en, 'id="meta_title_en" class="round default-width-input" autofocus');

                                ?>
                            </p>
                            <p>
                                <?php

                                echo form_label('URL: ', 'url').'<br>';
                                echo form_input('url', $tour->url, 'id="url" class="round default-width-input" autofocus');

                                ?>
                            </p>
                            <p>
                                <?php

                             //   echo form_label('URL EN: ', 'url').'<br>';
                             //   echo form_input('url_en', $tour->url_en, 'id="url_en" class="round default-width-input" autofocus');

                                ?>
                            </p>
                            <p>
                                <?php

                                echo form_label('Meta keyword: ', 'meta_keyword').'<br>';
                                echo form_input('meta_keyword', $tour->meta_keyword, 'id="meta_keyword" class="round default-width-input" autofocus');

                                ?>
                            </p>
                            <p>
                                <?php

                             //   echo form_label('Meta keyword EN: ', 'meta_keyword').'<br>';
                             //   echo form_input('meta_keyword_en', $tour->meta_keyword_en, 'id="meta_keyword_en" class="round default-width-input" autofocus');

                                ?>
                            </p>
                            <p>
                                <?php

                                echo form_label('Meta description: ', 'meta_description').'<br>';
                                echo form_input('meta_description', $tour->meta_description, 'id="meta_description" class="round" style="width:1000px;" autofocus');

                                ?>
                            </p>
                            <p>
                                <?php

                           //     echo form_label('Meta description EN: ', 'meta_description').'<br>';
                           //     echo form_input('meta_description_en', $tour->meta_description_en, 'id="meta_description_en" class="round" style="width:1000px;" autofocus');

                                ?>
                            </p>
                        </div>
					</div>
          		<div style="clear:both;">
                <div style="padding-top:20px;">
                	 <?php echo form_hidden('tour_id',$tour->id);?>
                   	<?php echo form_submit('save', 'Save', 'class="round blue ic-right-arrow"'); ?>
                </div>
                <?php echo form_close(); ?> 
			</div>
		</div>
	</div>
</div>
<?php include_once('application/views/admin/footer.php'); ?>
</body>
</html>