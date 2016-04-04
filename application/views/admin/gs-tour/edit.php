<?php include_once('application/views/admin/header.php'); ?>
<script type="text/javascript">
	$(function() {
		$( "#tour_tabs" ).tabs();
	});
	
	function selectDate(id){
		 $('#fromDatepicker_'+id).datepicker({
                minDate: 0,
				dateFormat: "dd M yy",
                onSelect: function() {
                    var nextDate = $('#fromDatepicker_'+id).val();
                    var nextDay = nextDate.substring(0, 2);
                    //nextDay = parseInt(nextDate) + 1;
                    //nextDay = nextDay.toString();
                    //if (nextDay.length < 2) nextDay = "0" + nextDay;
                    //nextDate = nextDay + nextDate.substring(2);
                    $('#untilDatepicker_'+id).datepicker('option', 'minDate', nextDate);
                    $('#untilDatepicker_'+id).val(nextDate);
                }
            });
			
			$('#fromDatepicker_'+id).datepicker('show');
			
			$('#untilDatepicker_'+id).datepicker({minDate: 0, dateFormat: "dd M yy"});
			
}
	





$(document).ready(function(){
	
	
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


var rowDate = <?php echo count($tourPackages)?>;

function addDate() {
	
var newRow = '<tr id="date_'+rowDate+'"><td><div class="col-sm-2"><div class="form-group"><label for="fromDatepicker_'+rowDate+'" class="col-xs-3 control-label">from</label><div class="col-xs-9"><input type="text" name="from_'+rowDate+'" onfocus="selectDate('+rowDate+');" class="round form-control default-width-input" id="fromDatepicker_'+rowDate+'" autofocus readonly="readonly"></div></div></div><div class="col-sm-2"><div class="form-group"><label for="untilDatepicker_'+rowDate+'" class="col-xs-3 control-label">to</label><div class="col-xs-9"><input type="text" name="to_'+rowDate+'" class="round form-control default-width-input" id="untilDatepicker_'+rowDate+'" autofocus readonly="readonly"></div></div></div><div class="col-sm-2"><div class="form-group"><label for="date_rate_'+rowDate+'" class="col-xs-3 control-label"><div class="row text-left">RATE</div></label><div class="col-xs-9"><input type="text" name="date_rate_'+rowDate+'" class="form-control" id="date_rate_'+rowDate+'"></div></div></div><div class="col-sm-3"><div class="form-group"><label for="date_extra_single_'+rowDate+'" class="col-xs-6 control-label">EXTRA SINGLE</label><div class="col-xs-6"><input type="text" name="date_extra_single_'+rowDate+'" class="form-control" id="date_extra_single_'+rowDate+'"></div></div></div><div class="col-sm-2"><div class="row"><div class="form-group"><select name="status'+rowDate+'" id="status'+rowDate+'" class="form-control"><?php foreach ($list_status as $id=>$name) echo '<option value="'.$id.'">'.$name.'</option>';?></select></div></div></div><div class="col-sm-1"><div class="pull-right"><a href="#" onclick="removeDate('+rowDate+');"><span class="text-danger fa fa-close"></span></a></div></div><div class="clearfix"></div><input type="hidden" value="'+rowDate+'" name="rowsDate[]"></td></tr>';	
jQuery('#listDate').append(newRow);
rowDate ++;
}


	function removeDate(rnum) {
jQuery('#date_'+rnum).remove();
}

var rowNum = <?php echo count($itineraries)?>;
function addRow(frm) {
rowNum ++;

    var row = '' +
                '<div id="itinerary'+rowNum+'">' +
                '<div class="col-xs-5"><div class="form-group"><label for="itinerary_day'+rowNum+'" class="col-sm-3 control-label">day</label><div class="col-sm-5"><input type="number" min="1" autofocus="" class="round form-control default-width-input" value="" name="itinerary_day'+rowNum+'" id="itinerary_day'+rowNum+'"></div></div></div>' +
                '<div class="col-xs-7"> <div class="form-group"><div> <div class="col-sm-3"></div><label for="itinerary_img'+rowNum+'" class="col-sm-2 control-label">Image: </label><div class="col-sm-7"><div class="row"><input type="file" autofocus="" class="round form-control default-width-input" value="" name="itinerary_img'+rowNum+'" id="itinerary_img'+rowNum+'"></div></div></div></div></div><div class="clearfix"></div><div class="col-xs-7"><div class="form-group"><label for="itinerary_title" class="col-sm-2 control-label">Title: </label><div class="col-sm-10"><input type="text" autofocus="" class="round form-control default-width-input" id="itinerary_title'+rowNum+'" value="" name="itinerary_title'+rowNum+'"></div></div></div><div class="clearfix"></div>' +
                '<div class="form-group"><div class="col-sm-11 col-sm-offset-1 pd-left-43"><textarea autofocus="" class="round form-control full-width-textarea" id="itinerary_desc'+rowNum+'" rows="10" cols="40" name="itinerary_desc'+rowNum+'"></textarea><br><input type="button" value="Remove" onclick="removeRow('+rowNum+');"></div></div><input type="hidden" value="'+rowNum+'" name="rows[]"><hr></div>';
    jQuery('#itinerary').append(row);

   
tinyMCE.init({
        selector: "#itinerary_desc"+rowNum
});
//add tinymce to this
tinyMCE.execCommand("mceAddControl", false, 'description'+rowNum);

}

function removeRow(rnum) {
jQuery('#itinerary'+rnum).remove();
}



</script>

<div class="container"> <a href="<?php echo site_url('admin');?>" class="btn btn-default">Main</a> <a href="<?php echo site_url("admin/tour_gs/");?>" class="btn btn-default">Dashboard</a> <a href="#" class="btn btn-primary">Edit tour</a> </div>
<?php 
$options = array(
  ''    => 'Please select...',
  '1'   => 1,
  '2'   => 2,
  '3'   => 3,
  '4'   => 4,
  '5'   => 5
);
?>
<?php echo form_open_multipart('admin/tour_gs/update', 'id="tourForm" class="form form-horizontal" name="tourForm"'); ?>
<div class="input-field-top container text-uppercase">
  <div class="col-md-8 input-fields">
    <div class="form-group">
      <label for="name" class="col-xs-2 control-label text-left">Tour name</label>
      <div class="col-xs-10"> <?php echo form_input('name',$tour->name, 'id="name" class="round form-control default-width-input" autofocus required'); ?> </div>
    </div>
  </div>
 
  <div class="col-md-4">
    <div class="form-group">
      <label for="code" class="col-xs-3 control-label">Tour ID</label>
      <div class="col-xs-9"> <?php echo form_input('code',$tour->code, 'id="code" class="round form-control default-width-input" autofocus required'); ?> </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-md-1">
    <div class="form-group text-right">
      <label class="control-label">Length</label>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="num_days" class="col-xs-3 control-label">days</label>
      <div class="col-xs-9"> <?php echo form_dropdown('num_days', $options, $tour->num_days, 'id="num_days" class="form-control"'); ?> </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <label for="num_nights" class="col-xs-3 control-label">nights</label>
      <div class="col-xs-9"> <?php echo form_dropdown('num_nights', $options, $tour->num_nights, 'id="num_nights" class="form-control"'); ?> </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="radio" name="group_departure" id="taylorMmadeTravel" value="0" <?php echo ($tour->tour_type == 0 ? 'checked' : '')?>>
          Taylor-made travel </label>
      </div>
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="radio" name="group_departure" id="groupDeparture" value="1" <?php echo ($tour->tour_type == 1 ? 'checked' : '')?>>
          Group departure </label>
      </div>
    </div>
  </div>
  <div style="clear:both;"></div>
    <div class="col-md-8 input-fields">
        <div class="form-group">
            <label for="image" class="col-xs-2 control-label text-left">Image: </label>
            <div class="col-xs-10">
                <?php echo form_upload('image','', 'id="image" class="round form-control default-width-input" autofocus'); ?>
            </div>
        </div>
    </div>
    <?php
    if ($tour->image != ''){
		?>
        <div style="clear:both;"></div>
    <div class="col-md-8 input-fields">
        <div class="form-group" style="padding-left:15px;">
           <img src="<?php echo base_url('upload/tours/'.$tour->image);?>" width="150px"/>
             <input type="hidden" name="imageold" value="<?php echo $tour->image?>" id="imageold">
        </div>
    </div>
        <?php
	}
	?>
</div>
<!-- /.input-field-top container -->

<div id="tour_tabs" class="wrap-tabs">
<div class="menu-tabs">
  <ul class="container">
    <li><a href="#tabs-1">Overview</a></li>
    <li><a href="#tabsDate">Date</a></li>
    <li><a href="#tabs-3">Itinerary</a></li>
    <li><a href="#tabsCountries">Countries</a></li>
    <li class="pull-right"><a href="#tabs-6">Meta</a></li>
  </ul>
</div>
<div class="container content-tabs">
  <div id="tabs-1"> <?php echo form_textarea('intro',$tour->intro, 'id="intro" rows="9" class="round form-control full-width-textarea" autofocus'); ?> </div>
  <!-- /.tabs 1 -->
  <div id="tabsDate">
    
    <?php $i = 0;?>
      <table id="listDate" class="table list-date">
        <tbody>
        <?php
		if ($tourPackages != false){
        foreach ($tourPackages as $package){
		?>
          <tr id="date_<?php echo $i;?>">
            <td><div class="col-sm-2">
                <div class="form-group">
                  <label for="fromDatepicker_<?php echo $i;?>" class="col-xs-3 control-label">from</label>
                  <div class="col-xs-9">
                    <input type="text" name="from_<?php echo $i;?>" onfocus="selectDate(<?php echo $i;?>);" class="round form-control default-width-input" id="fromDatepicker_<?php echo $i;?>" autofocus readonly="readonly" value="<?php echo $package->from_date?>">
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="untilDatepicker_<?php echo $i;?>" class="col-xs-3 control-label">to</label>
                  <div class="col-xs-9">
                    <input type="text" name="to_<?php echo $i;?>" value="<?php echo $package->to_date?>" class="round form-control default-width-input" id="untilDatepicker_<?php echo $i;?>" autofocus readonly="readonly">
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="date_rate_<?php echo $i;?>" class="col-xs-3 control-label">
                  <div class="row text-left">RATE</div>
                  </label>
                  <div class="col-xs-9">
                    <input type="text" value="<?php echo $package->rate;?>" name="date_rate_<?php echo $i;?>" class="form-control" id="date_rate_<?php echo $i;?>">
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="date_extra_single_<?php echo $i;?>" class="col-xs-6 control-label">EXTRA SINGLE</label>
                  <div class="col-xs-6">
                    <input type="text" value="<?php echo $package->extra_single?>" name="date_extra_single_<?php echo $i;?>" class="form-control" id="date_extra_single_<?php echo $i;?>">
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="row">
                  <div class="form-group">
                   <?php echo form_dropdown('status'.$i, $list_status,$package->status_id, 'id="status"'.$i.' class="form-control"');?>
                  </div>
                </div>
              </div>
              <div class="col-sm-1">
                <div class="pull-right"><a href="#" onclick="removeDate(<?php echo $i;?>);"><span class="text-danger fa fa-close"></span></a></div>
              </div>
              <div class="clearfix"></div>
              <input type="hidden" value="<?php echo $i;?>" name="rowsDate[]"></td>
          </tr>
          <?php
		  $i++;
		}
		}
		  ?>
        </tbody>
      </table>
      <div class="text-center">
                            <button class="btn btn-primary" type="button" onclick="addDate();">add more date</button>
                        </div>
    </div>
    <!-- /#tabsDate -->
    
    <div id="tabs-3">
      <div id="itinerary">
        <?php $i = 0; foreach($itineraries as $itinerary) : ?>
        <div id="itinerary<?php echo $i;?>">
          <div class="col-xs-5">
            <div class="form-group">
              <label for="itinerary_day" class="col-sm-3 control-label">day</label>
              <div class="col-sm-5"> <?php echo form_number('itinerary_day'.$i,$itinerary['day'], 'id="itinerary_day'.$i.'" class="round form-control default-width-input" autofocus'); ?> </div>
            </div>
          </div>
          <div class="col-xs-7">
            <div class="form-group">
              <div>
               <div class="col-sm-3">
              <?php if ($itinerary['image'] != '')
			  	echo '<img src="'.base_url('upload/tours/itinerary/'.$itinerary['image']).'" width="100px;">';
			  ?>
              </div>
               <div class="col-sm-2">
                <label for="itinerary_img" class="control-label">New image:</label>
                </div>
                <div class="col-sm-6">
                  <div class="row">
                    <?php
                                            // echo form_upload('itinerary_img'.$i,'', 'id="itinerary_img'.$i.'" class="round form-control default-width-input" autofocus'); 
                                            echo form_upload('itinerary_img'.$i,'', 'id="itinerary_img'.$i.'" class="round form-control default-width-input" autofocus'); 
                                            echo '<input type="hidden" name="itinerary_imgold'.$i.'" id="itinerary_imgold'.$i.'" value="'.$itinerary['image'].'">';
                                        ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
            <div class="col-xs-7">
           <div class="form-group">
          
           
              <label for="itinerary_title" class="col-sm-2 control-label">Title: </label>
              <div class="col-sm-10">
           <?php echo form_input('itinerary_title'.$i,$itinerary['title'], 'id="itinerary_title'.$i.'" class="round form-control default-width-input" autofocus '); ?></div>
          </div>
           </div>
          <div class="clearfix"></div>
        
          <div class="form-group">
            <div class="col-sm-11 col-sm-offset-1 pd-left-43"> <?php echo form_textarea('itinerary_desc'.$i ,$itinerary['description'], 'id="itinerary_desc'.$i.'" class="round form-control full-width-textarea" autofocus'); ?> 
            <br><input type="button" value="Remove" onclick="removeRow(<?php echo $i;?>);">
            </div>
          </div>
         
          <input type="hidden" value="<?php echo $i;?>" name="rows[]">
          <hr>
        </div>
        <?php $i++; endforeach ?>
      </div>
      <div style="text-align:center">
        <button type="button" class="btn btn-primary" onclick="addRow(this.form);">add more days</button>
      </div>
    </div>
    <!-- /.tabs 3 -->
    
    <div id="tabsCountries">
      <table class="table">
        <tbody>
          
          <tr>
            <td> <div class="form-group">
                         <div class="col-xs-2">
                                <div class="checkbox">
                                    <label>
                                        COUNTRIES
                                    </label>
                                </div>
                            </div>
                         <div class="col-xs-2">
                        <?php
                        foreach ($countries as $country){
										$countryChecked = 1;
										foreach ($tourCountries as $tourCountry) {
											if ($country['id'] == $tourCountry)
											{
												echo '<div class="checkbox"><label>'.form_checkbox('country[]',$country['id'],true);
												echo ' '.$country['name'].'</label></div>';
												$countryChecked = 2;
												break;
											}
										}
										if ($countryChecked == 1){
											echo '<div class="checkbox"><label>'.form_checkbox('country[]',$country['id'],false);
											echo ' '.$country['name'].'</label></div>';
										}
									}
                                    ?>
						
                      </div>  
                           
                          
                        </div></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /#tabsCountries -->
    
    <div id="tabs-6" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
      <div class="form-group">
        <label for="meta_title" class="col-sm-2 control-label">Meta title:</label>
        <div class="col-sm-10"> <?php echo form_input('meta_title',$tour->meta_title, 'id="meta_title" class="round form-control default-width-input" autofocus'); ?> </div>
      </div>
      <div class="form-group">
        <label for="url" class="col-sm-2 control-label">URL</label>
        <div class="col-sm-10"> <?php echo form_input('url',$tour->url, 'id="url" class="round form-control default-width-input" autofocus'); ?> </div>
      </div>
      <div class="form-group">
        <label for="meta_keyword" class="col-sm-2 control-label">Meta keyword</label>
        <div class="col-sm-10"> <?php echo form_input('meta_keyword',$tour->meta_keyword, 'id="meta_keyword" class="round form-control default-width-input" autofocus'); ?> </div>
      </div>
      <div class="form-group">
        <label for="meta_description" class="col-sm-2 control-label">Meta description:</label>
        <div class="col-sm-10"> <?php echo form_input('meta_description',$tour->meta_description, 'id="meta_description" class="round form-control" autofocus'); ?> </div>
      </div>
    </div>
    <!-- /.tabs 6 --> 
  </div>
  <!-- /.container --> 
</div>
<!-- /#tour_tabs .wrap-tabas -->

<div class="container button-submit">
  <div class="pull-right text-uppercase text-center"> <?php echo form_hidden('tour_id',$tour->id);?> <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?> </div>
</div>
<?php echo form_close(); ?>
<?php include_once('application/views/admin/footer.php'); ?>
