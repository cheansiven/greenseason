<?php include_once('application/views/admin/header.php'); ?>

    <script>
        var base_url = "<?php echo base_url() ?>";
        $(function() {
            $( "#tour_tabs" ).tabs();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#fromDatepicker').datepicker({
                minDate: 0,
                onSelect: function() {
                    var nextDate = $('#fromDatepicker').val();
                    var nextDay = nextDate.substring(0, 2);
                    nextDay = parseInt(nextDate) + 1;
                    nextDay = nextDay.toString();
                    if (nextDay.length < 2) nextDay = "0" + nextDay;
                    nextDate = nextDay + nextDate.substring(2);
                    $('#untilDatepicker').datepicker('option', 'minDate', nextDate);
                    $('#untilDatepicker').val(nextDate);
                }
            });

            $('#untilDatepicker').datepicker({minDate: 0});


            $('#tourForm').submit(function(){

                if(validateName() && validateRegion())
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


        var rowNum = 0;

        function addRow() {

           rowNum ++;
            var orderIndex = rowNum+1;
            var row = '' +
                '<div id="itinerary'+rowNum+'">' +
                '<div class="col-xs-8"><div class="row"><div class="form-group"><label for="itinerary_day'+rowNum+'">day '+orderIndex+'</label><input type="text" autofocus="" class="round form-control default-width-input" value="" name="itinerary_day'+rowNum+'" id="itinerary_day'+rowNum+'"></div></div></div>' +
                '<div class="col-xs-5"> <div class="form-group"><div class="pull-right"><label for="itinerary_img'+rowNum+'" class="col-sm-3 control-label">Image: </label><div class="col-sm-9"><div class="row"><input type="file" autofocus="" class="round form-control default-width-input" value="" name="itinerary_img[]" id="itinerary_img'+rowNum+'"></div></div></div></div></div><div class="clearfix"></div>' +
                '<div class="form-group"><div class="col-sm-11 col-sm-offset-1 pd-left-43"><textarea autofocus="" class="round form-control full-width-textarea" id="itinerary_desc'+rowNum+'" rows="10" cols="40" name="itinerary_desc'+rowNum+'"></textarea></div></div>' +
                '<p><?php echo form_label('Hotels: ');?></p>' +
                '<div id="script'+rowNum+'"></div>' +
                'Country: ' +
                '<select id="country_id'+ rowNum +'" name="country_id'+ rowNum +'">'+
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
          //tinyMCE.execCommand("mceAddControl", false, 'description'+rowNum);

        }

        function removeRow(rnum) {
            jQuery('#itinerary'+rnum).remove();
        }

        var rowImage = 0;
        function addImage(frm) {
            rowImage ++;

            var newRow = '<div id="gallery'+rowImage+'"><p><input type="file" autofocus="" class="round default-width-input" id="gallery'+rowImage+'" value="" name="gallery[]"></p><p><input type="button" value="Remove" onclick="removeImage('+rowImage+');"></p><hr></div>';
            jQuery('#gallery').append(newRow);

        }

        function removeImage(rnum) {
            jQuery('#gallery'+rnum).remove();
        }

    </script>

<!-- MAIN CONTENT -->
<div class="container">
    <a href="<?php echo site_url("admin/tours/");?>" class="btn btn-default">Dashboard</a>
    <a href="<?php echo site_url("admin/tours/add");?>" class="btn btn-primary">Add new tour</a>
</div>

<?php echo form_open_multipart('admin/tours/store', 'id="tourForm" name="tourForm" class="form form-horizontal"'); ?>
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
            <div id="tabs-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
                <div class="half-size-column fl col-sm-8">
                    <?php echo validation_errors(); ?>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox('active','1',true); ?> Active
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Tour Name:</label>
                        <div class="col-sm-5">
                            <?php echo form_input('name','', 'id="name" class="round form-control default-width-input" autofocus'); ?>
                            <p id="nameError">Please enter tour name</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="code" class="col-sm-3 control-label">Code:</label>
                        <div class="col-sm-5">
                            <?php echo form_input('code','', 'id="code" class="round form-control default-width-input" autofocus'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox('best_value','1',false); ?> Best value
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox('highlight','1',false); ?> Hightlight
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="countrylist" class="form-group">
                        <div class="checkbox">
                            <label for="code" class="col-sm-3 control-label">Countries:</label>
                            <div class="col-sm-5">
                                <?php $jsCountry = 'onClick="showRegions(this);"'; foreach ($countries as $country): ?>
                                <div id="country<?php echo $country['id'] ?>">
                                    <label>
                                        <?php echo form_checkbox('country[]',$country['id'],false, $jsCountry) . ' '. $country['name']; ?>
                                    </label>
                                </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="arrival_city" class="col-sm-3 control-label">Arrival city:</label>
                        <div class="col-sm-5">
                            <?php echo form_dropdown('arrival_city', $list_cities, '', 'id="arrival_city" class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="departure_city" class="col-sm-3 control-label">Departure city:</label>
                        <div class="col-sm-5">
                            <?php echo form_dropdown('departure_city', $list_cities, '', 'id="departure_city" class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="num_days" class="col-sm-3 control-label">Number of days:</label>
                        <div class="col-sm-5">
                            <?php echo form_input('num_days','', 'id="num_days" class="round form-control default-width-input" autofocus'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="num_nights" class="col-sm-3 control-label">Number of nights:</label>
                        <div class="col-sm-5">
                            <?php echo form_input('num_nights','', 'id="num_nights" class="round form-control default-width-input" autofocus'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fromDatepicker" class="col-sm-3 control-label">Valid from month:</label>
                        <div class="col-sm-3">
                            <?php echo form_input('start', '', 'id="fromDatepicker" class="round form-control default-width-input" autofocus readonly="readonly"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="untilDatepicker" class="col-sm-3 control-label">Valid until month:</label>
                        <div class="col-sm-3">
                            <?php echo form_input('end','', 'id="untilDatepicker" class="round form-control default-width-input" autofocus readonly="readonly"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox('year_round','1',true); ?> Valid all year round
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-sm-3 control-label">Main image:</label>
                        <div class="col-sm-5">
                            <?php echo form_upload('image','', 'id="image" class="round form-control default-width-input" autofocus'); ?>
                        </div>
                    </div>

                </div>
                <div class="half-size-column fr col-sm-4">
                    <h4>Types of tour:</h4>

                    <div class="form-group">
                        <?php foreach ($categories as $category): ?>
                        <div class="checkbox">
                            <label>
                                <?php echo form_checkbox('category[]',$category['id'],false, 'id="category"') . ' ' . $category['name']; ?>
                            </label>
                        </div>
                        <?php endforeach ?>
                    </div>


                    <!--<p>
                                                <?php
                    echo form_label('Types of activity: ', 'activity');
                    ?>

                                                <?php
                    foreach ($activities as $activity):
                        echo '<p>'.form_checkbox('activity[]',$activity['id'],false, 'id="activity"');
                        echo $activity['name'].'</p>'; ?>
                                                <?php endforeach ?>
                                                 </p>-->
                    <p>
                        <?php
                        echo form_label('Primary mode of transportation: ', 'transport');
                        ?>
                    </p>
                    <?php
                    foreach ($transports as $transport):
                        echo '<p>'.form_checkbox('transport[]',$transport['id'],false, 'id="transport"');
                        echo $transport['name'].'</p>'; ?>
                    <?php endforeach ?>
                    <p>
                        <?php
                        echo form_label('Tour guides available in: ', 'langauge');
                        ?>
                    </p>
                    <?php
                    foreach ($languages as $language):
                        echo '<p>'.form_checkbox('languages[]',$language['id'],false, 'id="language"');
                        echo $language['name'].'</p>'; ?>
                    <?php endforeach ?>

                    <p>
                        <?php
                        echo form_label('Services: ');
                        ?>
                    </p>
                    <?php
                    foreach ($services as $service):
                        echo '<p>'.form_checkbox('service0[]',$service['id'],false);
                        echo $service['name'].'</p>'; ?>
                    <?php endforeach ?>


                </div>
            </div> <!-- /#tabs-1 -->
            <div id="tabs-2">

                <table class="table">
                    <thead>
                        <tr>
                            <th style="width:150px !important"></th>
                            <th width="200">NORMAL</th>
                            <th width="200">LAST MINUTE</th>
                        </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                    <tfoot>
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
                    </tfoot>
                </table>
            </div> <!-- /#tabs-2 -->
            <div id="tabs-3">

                <div id="itinerary">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="form-group">
                                <label for="itinerary_day">Day:</label>
                                <?php echo form_number('itinerary_day0','', 'id="itinerary_day" class="round form-control default-width-input" autofocus'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="itinerary_img" class="col-sm-2 control-label">Image:</label>
                                <?php echo form_upload('itinerary_img0','', 'id="itinerary_img0" class="round form-control default-width-input" autofocus'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <label for="itinerary_desc0">Description:</label>
                        <?php echo form_textarea('itinerary_desc0','', 'id="itinerary_desc0" class="round full-width-textarea" autofocus rows="9"'); ?>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('#city_id0').change(function(){
                                $.ajax({
                                    url: "<?= base_url(); ?>admin/hotels/getHotelsByCity/" + $(this).val(),
                                    data: {city_id0: $(this).val()},
                                    type: 'POST',
                                    contentType: "application/json; charset=utf-8",
                                    dataType: "json",
                                    success: function (data) {
                                        $("#hotel_id0").get(0).options.length = 0;
                                        $("#hotel_id0").get(0).options[0] = new Option("-- Please Select --", "");
                                        // This expects data in "option 1" format, a dictionary.
                                        $.each(data, function (name, id){
                                            n = $("#hotel_id0").get(0).options.length;
                                            $("#hotel_id0").get(0).options[n] = new Option(id, name);
                                        });
                                    }
                                });
                            });
                        });

                    </script>

                    <?php foreach( $countries as $value ) { $option_countries[$value['id']] = $value['name']; } ?>

                    <div class="col-sm-4">
                        <div class="row">
                            <div class="form-group">
                                <label for="country_id">Country</label>
                                <?php echo form_dropdown('country_id', $option_countries, '', 'id="country_id" class="form-control"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="city_id0">City</label>
                            <?php echo form_dropdown('city_id', $list_cities, '', 'id="city_id0" class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="form-group">
                                <label for="hotel_id0">Hotel</label>
                                <?php  echo form_dropdown('hotel_id0', array(), '', 'id="hotel_id0" class="form-control"'); ?>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" value="0" name="rows[]">

                </div>

                <p>
                    <input onclick="addRow(this.form);" type="button" value="Add itinerary" />
                </p>
            </div> <!-- /#tabs-3 -->
            <div id="tabs-4">
                <p>
                    <?php
                    echo form_label('Overview: ', 'intro');
                    echo form_textarea('intro','', 'id="intro" class="round full-width-textarea" autofocus');
                    ?>
                </p>
                <p>
                    <?php
                    //     echo form_label('Overview EN: ', 'intro');
                    //    echo form_textarea('intro_en','', 'id="intro_en" class="round full-width-textarea" autofocus');
                    ?>
                </p>
                <p>
                    <?php
                    //   echo form_label('Description: ', 'description');
                    //   echo form_textarea('description','', 'id="description" class="round full-width-textarea" autofocus rows="20"');
                    ?>
                </p>
                <p>
                    <?php
                    // echo form_label('Description EN: ', 'description');
                    // echo form_textarea('description_en','', 'id="description_en" class="round full-width-textarea" autofocus rows="20"');
                    ?>
                </p>
            </div> <!-- /#tabs-4 -->
            <div id="tabs-5">
                <div id="gallery">
                    <p>
                        <?php
                        echo form_label('Gallery: ', 'gallery');
                        echo form_upload('gallery[]','', 'id="gallery" class="round default-width-input" autofocus');
                        ?>
                    </p>
                    <hr>
                </div>

                <p>
                    <input onclick="addImage(this.form);" type="button" value="Add image" />
                </p>
            </div> <!-- /#tabs-5 -->
            <div id="tabs-6" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
                <p>
                    <?php

                    echo form_label('Meta title: ', 'meta_title').'<br>';
                    echo form_input('meta_title','', 'id="meta_title" class="round default-width-input" autofocus');

                    ?>
                </p>
                <p>
                    <?php

                    //  echo form_label('Meta title EN: ', 'meta_title').'<br>';
                    //  echo form_input('meta_title_en','', 'id="meta_title_en" class="round default-width-input" autofocus');

                    ?>
                </p>
                <p>
                    <?php

                    echo form_label('URL: ', 'url').'<br>';
                    echo form_input('url','', 'id="url" class="round default-width-input" autofocus');

                    ?>
                </p>
                <p>
                    <?php

                    //   echo form_label('URL EN: ', 'url').'<br>';
                    //   echo form_input('url_en','', 'id="url_en" class="round default-width-input" autofocus');

                    ?>
                </p>
                <p>
                    <?php

                    echo form_label('Meta keyword: ', 'meta_keyword').'<br>';
                    echo form_input('meta_keyword','', 'id="meta_keyword" class="round default-width-input" autofocus');

                    ?>
                </p>
                <p>
                    <?php

                    //   echo form_label('Meta keyword EN: ', 'meta_keyword').'<br>';
                    //   echo form_input('meta_keyword_en','', 'id="meta_keyword_en" class="round default-width-input" autofocus');

                    ?>
                </p>
                <p>
                    <?php

                    echo form_label('Meta description: ', 'meta_description').'<br>';
                    echo form_input('meta_description','', 'id="meta_description" class="round" style="width:1000px;" autofocus');

                    ?>
                </p>
                <p>
                    <?php

                    //     echo form_label('Meta description EN: ', 'meta_description').'<br>';
                    //     echo form_input('meta_description_en','', 'id="meta_description_en" class="round" style="width:1000px;" autofocus');

                    ?>
                </p>
            </div> <!-- /#tabs-6 -->

            <div style="clear:both;">
                <div style="padding-top:20px;">
                    <?php echo form_submit('save', 'Save', 'class="round blue ic-right-arrow"'); ?>
                </div>
            </div>
        </div> <!-- /.container .content-tabs -->
    </div> <!-- /#tour_tabs .wrap-tabs -->
<?php echo form_close(); ?>
<?php include_once('application/views/admin/footer.php'); ?>
