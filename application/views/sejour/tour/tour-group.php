<?php $this->load->view('sejour/header');?>
		
	<div class="page-content container tour-group">
		<div id="listTourGroup" class="row">
<?php
if ($tours != false){
	
	foreach ($tours as $tour){
	?>
    <article>
				<div class="well well-sm">
					<div class="header">
						<div class="title text-uppercase">
							<?php echo $tour->code.' : '.$tour->name;?>
							<a data-ajax="false" href="<?php echo base_url('group-departures/'.strtolower(url_title($tour->url)).'.html');?>" class="pull-right tour-group-date"><?php echo $tour->num_days.' days '.$tour->num_nights.' nights';?></a>
						</div>
					</div>

					<div class="content-tour">
						<div class="col-md-4">
							<?php
                            if ($tour->image != '')
								echo '<img src="'.base_url('upload/tours/'.$tour->image).'">';
							else echo '<img src="'.base_url('public/images/353x190.png').'">';
							?>
						</div>
						<div class="col-md-8">
							<?php echo $tour->intro;?>
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="btn-intinerary-tour">
						<a href="<?php echo base_url('group-departures/'.strtolower(url_title($tour->url)).'.html');?>">discover intinerary</a>
						<a id="btnShowDetail_<?php echo $tour->id;?>" href="#" class="btn-tour-group-toggle">Check all the dates </a>
						
					</div>

					<!-- <div class="book-aside">
						<a href="#"><img src="<?php echo base_url('public/images/tour-group-book-side.png') ?>"></a>
					</div> -->
				</div>

				<div id="articleDate_<?php echo $tour->id;?>" class="well well-sm article-date">
					<div id="tourGroupDetail_<?php echo $tour->id;?>" class="tour-group-detail">
						<!--
                        <div class="header">
							<h3 class="text-uppercase">
								<img src="http://placehold.it/150x100" alt="..."> CRUISE TWO RIVERS
								<a class="btn btn-view-itinerary">View itinerary</a>
							</p>
						</div>
						-->
						<ul class="content-tour booking">
                        <?php
                        if ($tour->dates != false){
							$dates = $tour->dates;
							foreach ($dates as $date){
								echo '<li class="col-md-4"><a href="#myPopup" data-rel="popup"><div class="box-date">';
								echo $date->from_date_a.' - '.$date->to_date_a.'<br /> <span>USD '.$date->rate.'</span>';
                                echo '<div class="tour_status status_'.$date->status_id.'"><div class="tour_status_text">'.$date->status.'</div></div>';
								echo '</div></a></li>';
							}	
						}
						?>
                        <!--
							
							<div class="col-md-4">
								
								
								<div class="box-date box-date-book">
									<a id="btnBooking_<?php echo $tour->id;?>" href="#">Book this tour</a>
								</div>
								
							</div>-->
							<div class="clearfix"></div>
							
						</ul>
                        <div class="btn-overview"><a id="btnCloseDetail_<?php echo $tour->id;?>" href="#" class="btn-tour-group-toggle">Overview</a></div>
					</div>
					<div class="col-xs-8 col-xs-offset-2 form-tour-group">
						<form class="form-horizontal" onsubmit='return tourGroupForm(<?php echo $tour->id;?>)'>
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">Your Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" id="name">
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">eMail</label>
								<div class="col-sm-10">
									<input type="text" class="form-control email-type" name="email">
								</div>
							</div>
							<div class="form-group">
								<label for="phone" class="col-sm-2 control-label">Telephone</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="phone" id="phone">
								</div>
							</div>
							<div class="form-group">
								<label for="description" class="col-sm-2 control-label">Description</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="description" id="description">
								</div>
							</div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-default">Sign in</button>
									<a id="btnCloseForm_<?php echo $tour->id;?>" href="#" class="form_close btn btn-default">Close</a>
								</div>
							</div>
						</form>

						<div class="message-success">
							<p>Your email has been send successful.</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</article>
    <?php	
	}	
}

?>

			 <div data-role="main" class="ui-content">
    

    <div data-role="popup" id="myPopup" class="ui-content" style="width:700px;" data-dismissible="false" data-transition="pop">
     <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-left">Close</a>
     <form class="form-horizontal" onsubmit='return tourGroupForm(<?php echo $tour->id;?>)'>
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">Your Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" id="name">
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">eMail</label>
								<div class="col-sm-5">
									<input type="text" class="form-control email-type" name="email">
								</div>
                                <label for="guest" class="col-sm-2 control-label">Guest</label>
                                <div class="col-sm-3">
									<input type="text" class="form-control" name="guest" id="guest">
								</div>
							</div>
						
						
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-3">
									<button type="submit" class="btn btn-default">SEND</button>
									
								</div>
							</div>
						</form>
    </div>
  </div>
			
		</div>
	</div>

<?php $this->load->view('sejour/footer');?> 