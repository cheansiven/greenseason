<?php $this->load->view('sejour/header');?>
		
	<div class="page-content container tour-group">
		<div id="listTourGroup" class="row">
			<?php
			
            if ($tours != false){
				foreach ($tours as $tour)
				{
				?>
                <article>
				<div class="well well-sm">
					<div class="header">
						<div class="title text-uppercase">
							<?php echo $tour->code.' : '.$tour->name;?>
							<a href="<?php echo base_url('tailored-made-travels/'.strtolower(url_title($tour->url)).'.html');?>" class="pull-right tour-group-date"><?php echo $tour->num_days.' days '.$tour->num_nights.' nights';?></a>
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
							<p><?php echo $tour->intro;?></p>
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="btn-intinerary-tour text-center">
						<a href="<?php echo base_url('tailored-made-travels/'.strtolower(url_title($tour->url)).'.html');?>">discover intinerary</a>
					</div>

					<div class="book-aside">
						<a href="#"><img src="<?php echo base_url('public/images/tour-group-book-side.png') ?>"></a>
					</div>
				</div>
			</article>
			
                <?php	
				}	
			}
			?>
			
		

		</div>
	</div>

<?php $this->load->view('sejour/footer');?> 