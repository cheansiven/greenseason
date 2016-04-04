<?php $this->load->view('sejour/header');?>
		
	<div class="page-content container">
		<div class="row">
        
        <?php 
		if ($itineraries != false){
			foreach($itineraries as $itinerary){
			?>
            <article class="parent-toggle">
				<div class="well well-sm">
					<div class="header">
						<div class="title">
                        <?php 
						if ($itinerary->image != '')
							echo '<img src="'.base_url('upload/tours/itinerary/'.$itinerary->image).'" alt="'.$itinerary->title.'">';
						else echo '<img src="'.base_url('public/images/90x70.png').'" alt="'.$itinerary->title.'">';
							
						?>
							 Day <?php echo $itinerary->day.' : '.$itinerary->title;?>

							<a href="#" class="pull-right btn-toggle"><span class="icon-open"></span></a>
						</div>
					</div>

					<div class="content-muted content-toggle">
						<div class="col-md-12">
							<p><?php echo $itinerary->description;?></p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
 
				<div class="wrap-form">
					<form class="form-horizontal form-tour-multi" id="<?php echo $itinerary->day?>">
						<div class="form-group">
							<label class="col-sm-3 control-label"><span class="glyphicon glyphicon-envelope"></span> Email me this tour</label>
							<div class="col-sm-6">
								<input type="text" name="email" class="form-control">
							</div>
							<div class="col-sm-3">
								<button type="submit" class="btn btn-default">Go</button>
							</div>
						</div>
					</form>

					<div class="collapse message-success" id="message-success_<?php echo $itinerary->day;?>"></div>
				</div>
				
			</article> <!-- /article -->
            <?php	
			}	
		}
		
		?>
			
			
			
		</div>
	</div>

<?php $this->load->view('sejour/footer');?> 