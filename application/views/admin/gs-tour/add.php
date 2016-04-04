<?php include_once('application/views/admin/header.php'); ?>
   
     <script type="text/javascript">
        var base_url = "<?php echo base_url() ?>";
        $(function() {
            $( "#tour_tabs" ).tabs();
			
        });
    
   
	var rowDate = 0;
	
	function removeDate(rnum) {
jQuery('#date_'+rnum).remove();
}

	
	
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

	
	function addDate() {
	
var newRow = '<tr id="date_'+rowDate+'"><td><div class="col-sm-2"><div class="form-group"><label for="fromDatepicker_'+rowDate+'" class="col-xs-3 control-label">from</label><div class="col-xs-9"><input type="text" name="from_'+rowDate+'" onfocus="selectDate('+rowDate+');" class="round form-control default-width-input" id="fromDatepicker_'+rowDate+'" autofocus readonly="readonly"></div></div></div><div class="col-sm-2"><div class="form-group"><label for="untilDatepicker_'+rowDate+'" class="col-xs-3 control-label">to</label><div class="col-xs-9"><input type="text" name="to_'+rowDate+'" class="round form-control default-width-input" id="untilDatepicker_'+rowDate+'" autofocus readonly="readonly"></div></div></div><div class="col-sm-2"><div class="form-group"><label for="date_rate_'+rowDate+'" class="col-xs-3 control-label"><div class="row text-left">RATE</div></label><div class="col-xs-9"><input type="text" name="date_rate_'+rowDate+'" class="form-control" id="date_rate_'+rowDate+'"></div></div></div><div class="col-sm-3"><div class="form-group"><label for="date_extra_single_'+rowDate+'" class="col-xs-6 control-label">EXTRA SINGLE</label><div class="col-xs-6"><input type="text" name="date_extra_single_'+rowDate+'" class="form-control" id="date_extra_single_'+rowDate+'"></div></div></div><div class="col-sm-2"><div class="row"><div class="form-group"><select name="status'+rowDate+'" id="status'+rowDate+'" class="form-control"><?php foreach ($list_status as $id=>$name) echo '<option value="'.$id.'">'.$name.'</option>';?></select></div></div></div><div class="col-sm-1"><div class="pull-right"><a href="#" onclick="removeDate('+rowDate+');"><span class="text-danger fa fa-close"></span></a></div></div><div class="clearfix"></div><input type="hidden" value="'+rowDate+'" name="rowsDate[]"></td></tr>';	
jQuery('#listDate').append(newRow);
rowDate ++;
}

function tourType(type){
	if (type == 0){
			$( "#tour_tabs" ).tabs( "disable", 1 );
	}
	else {
		$( "#tour_tabs" ).tabs( "enable", 1 );
	}
	
}

	
       $(document).ready(function(){
            
			

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


        var rowNum = 0;

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


<div class="container">
    <a href="<?php echo site_url('admin');?>" class="btn btn-default">Main</a>
    <a href="<?php echo site_url("admin/tour_gs/");?>" class="btn btn-default">Dashboard</a>
    <a href="<?php echo site_url("admin/tour_gs/add");?>" class="btn btn-primary">Add new tour</a>
</div>

<?php echo form_open_multipart('admin/tour_gs/store', 'id="tourForm" name="tourForm" class="form form-horizontal"'); ?>

<div class="input-field-top container text-uppercase">
    <div class="col-md-8 input-fields">
        <div class="form-group">
            <label for="name" class="col-xs-2 control-label text-left">Tour name</label>
            <div class="col-xs-10">
                <?php echo form_input('name','', 'id="name" class="round form-control default-width-input" autofocus required'); ?>
            </div>
        </div>
    </div>
<div class="col-md-4">
    <div class="form-group">
      <label for="code" class="col-xs-3 control-label">Tour ID</label>
      <div class="col-xs-9"> <?php echo form_input('code','', 'id="code" class="round form-control default-width-input" autofocus required'); ?> </div>
    </div>
  </div>    <div class="clearfix"></div>

    <div class="col-md-1">
        <div class="form-group text-right">
            <label class="control-label">Length</label>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="email" class="col-xs-3 control-label">days</label>
            <div class="col-xs-9">
                <select id="num_days" class="form-control" name="num_days">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="email" class="col-xs-3 control-label">nights</label>
            <div class="col-xs-9">
                <select id="num_nights" class="form-control" name="num_nights">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group form-group-departure">
            <div class="radio">
                <label class="radio-inline">
                    <input type="radio" name="group_departure" id="taylorMmadeTravel" value="0" onclick="tourType(0);">
                    Taylor-made travel
                </label>
                <label class="radio-inline">
                    <input type="radio" name="group_departure" id="groupDeparture" value="1"  checked onclick="tourType(1);">
                    Group departure
                </label>
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
    
</div> <!-- /.input-field-top container -->
 

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
        <div id="tabs-1">
            <?php echo form_textarea('intro','', 'id="intro" rows="9" class="round form-control full-width-textarea" autofocus'); ?>
        </div> <!-- /.tabs 1 -->
        <div id="tabsDate">
        
        <table id="listDate" class="table list-date"><tbody>
        </tbody>
        </table>
       
             <div class="text-center">
                            <button class="btn btn-primary" type="button" onclick="addDate();">add more date</button>
                        </div>
        </div> <!-- /#tabsDate -->

        <div id="tabs-3">

            <div id="itinerary">

               

               
            </div>

            <div style="text-align:center;">
                <button type="button" class="btn btn-primary" onclick="addRow(this.form);">add more days</button>
            </div>
        </div> <!-- /.tabs 3 -->

        <div id="tabsCountries">
            <table class="table">
                <tbody>
                    
                    <tr><td>
                        <div class="form-group">
                         <div class="col-xs-2">
                                <div class="checkbox">
                                    <label>
                                        COUNTRIES
                                    </label>
                                </div>
                            </div>
                         <div class="col-xs-2">
                        <?php
                         foreach ($countries as $country):
                echo '<div class="checkbox"> <label>'.form_checkbox('country[]',$country['id'],false);
                echo ' '.$country['name'].'</label></div>'; ?>
            <?php endforeach ?>
						
                      </div>  
                           
                          
                        </div>
                    </td></tr>
                </tbody>
            </table>
        </div> <!-- /#tabsCountries -->

        <div id="tabs-6" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
            <div class="form-group">
                <label for="meta_title" class="col-sm-2 control-label">Meta title:</label>
                <div class="col-sm-10">
                    <?php echo form_input('meta_title','', 'id="meta_title" class="round form-control default-width-input" autofocus'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="url" class="col-sm-2 control-label">URL</label>
                <div class="col-sm-10">
                    <?php echo form_input('url','', 'id="url" class="round form-control default-width-input" autofocus'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="meta_keyword" class="col-sm-2 control-label">Meta keyword</label>
                <div class="col-sm-10">
                    <?php echo form_input('meta_keyword','', 'id="meta_keyword" class="round form-control default-width-input" autofocus'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="meta_description" class="col-sm-2 control-label">Meta description:</label>
                <div class="col-sm-10">
                    <?php echo form_input('meta_description','', 'id="meta_description" class="round form-control" autofocus'); ?>
                </div>
            </div>
        </div> <!-- /.tabs 6 -->
    </div> <!-- /.container -->

</div> <!-- /#tour_tabs .wrap-tabas -->

<div class="container button-submit">
    <div class="pull-right text-uppercase text-center">
        <?php echo form_submit('save', 'Save', 'class="round btn btn-warning blue ic-right-arrow"'); ?>
    </div>
</div>

<?php echo form_close(); ?>

<?php include_once('application/views/admin/footer.php'); ?>