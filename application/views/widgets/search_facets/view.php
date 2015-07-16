<?php 
/*
* @Title: Search Facets
* @Method: - 
* @icon: fa-list-alt
* @Description: Search facets for current search. Configure the view accordingly.
*/ 
?>


<?php
	$mode 	  			= $this->application->get_mode('search_mode');
	$facets				= $this->application->get_config('facets', 'search');
?>
<div class="box box-solid">
	<div class="box-header with-border handle <?=$is_mode_edit? 'cursor-move' : ''?>">
	  <h3 class="box-title">Facets</h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<div class="box-group">
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Sentiments</h3>
				  <div class="box-tools pull-right">
					<button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
				  </div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<div data-source="ajax" data-bind="FancyTree:{ checkbox: true }">
						<ul style="display: none;">
						<?php 
							foreach($facets as $key=>$facet):
						?>
							<li class="folder">
								<?=$facet['name']?>
								<?php 
									if(array_key_exists('children', $facet)):
								?>
									<ul style="display: none;">
										<?php 
											foreach($facet['children'] as $key=>$child):
										?>
											<li class="folder">
												<?=$child['name']?>
												<?php 
													if(array_key_exists('children', $child)):
												?>
													<ul style="display: none;">
														<?php 
															foreach($child['children'] as $key=>$kid):
														?>
															<li><?=$kid['name']?></li>
														
														<?php			
															endforeach;
														?>							
													</ul>
												<?php
													endif;						
												?>
											</li>
										
										<?php			
											endforeach;
										?>							
									</ul>
								<?php
									endif;						
								?>					
							</li>				
						<?php			
							endforeach;
						?>
						</ul>
					</div>
				</div><!-- /.box-body -->
			</div>
			<div class="box box-primary collapsed-box">
				<div class="box-header with-border">
				  <h3 class="box-title">People</h3>
				  <div class="box-tools pull-right">
					<button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-plus"></i></button>
				  </div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body" style="display: none;">
					<div class="dTree" data-bind="DTree:{
		  closeSameLevel: true, 
		  useCookie: true, 
		  }">
						<ul>
							<li><a href="#">Site</a></li>
							<li><a href="#">About the Web Site</a></li>
							<li><a href="#">Contact Us</a></li>
							<li><a href="#">Cars</a>
								<ul>
									<li><a href="#">Add New Brand</a></li>
									<li><a href="#">List All Brand</a></li>
									<li><a href="#">Mercedes - Benz</a>
										<ul>
											<li><a href="#">About the Mercedes - Benz</a></li>
											<li><a href="#">History</a></li>
											<li><a href="#">Series</a>
												<ul>
													<li><a href="#">A Series</a>
														<ul>
															<li><a href="#">A 140</a></li>
															<li><a href="#">A 150</a></li>
															<li><a href="#">A 180 CDI</a></li>
															<li><a href="#">A 200 CDI</a></li>
														</ul>
													</li>
													<li><a href="#">B Series</a>
														<ul>
															<li><a href="#">B 140</a></li>
															<li><a href="#">B 150</a></li>
															<li><a href="#">B 180 CDI</a></li>
															<li><a href="#">B Special Series</a>
																<ul>
																	<li><a href="#">B Extreme</a></li>
																	<li><a href="#">B Jumper</a></li>
																	<li><a href="#">B Raiden</a></li>
																	<li><a href="#">B Subzero</a></li>
																</ul>
															</li>
														</ul>
													</li>
													<li><a href="#">Concept Cars</a></li>
													<li><a href="#">Best Prototypes</a></li>
													<li><a href="#">List all other categories</a></li>
												</ul>
											</li>
											<li><a href="#">Custom Series</a></li>
											<li><a href="#">A+ Series for children</a></li>
											<li><a href="#">B+ Series for women</a></li>
										</ul>
									</li>
									<li><a href="#">Chevrolet</a></li>
									<li><a href="#">Saab Custom models</a></li>
									<li><a href="#">Fiat</a>
										<ul>
											<li><a href="#">Kartal SLX</a></li>
											<li><a href="#">Dogan 1.6 Turbo</a></li>
											<li><a href="#">Sahin</a></li>
											<li><a href="#">Dogan Gorunumlu Sahin</a>
												<ul>
													<li><a href="#">1.3 Motor</a></li>
													<li><a href="#">1.6 Motor</a></li>
													<li><a href="#">1.8 Motor</a></li>
													<li><a href="#">2.0 Motor</a></li>
												</ul>
											</li>
											<li><a href="#">Serce</a></li>
											<li><a href="#">Murat 131</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li><a href="#">Electronic Models</a></li>
							<li><a href="#">Real Estate</a></li>
							<li><a href="#">Bruce Lee</a></li>
							<li><a href="#">Graphics</a></li>
							<li><a href="#">Smart Phones</a>
								<ul>
									<li><a href="#">Apple</a></li>
									<li><a href="#">Samsung</a></li>
									<li><a href="#">LG</a></li>
									<li><a href="#">Sony</a></li>
									<li><a href="#">HTC</a></li>
									<li><a href="#">Samsung</a></li>
									<li><a href="#">Samsung</a></li>
									<li><a href="#">Other Models</a>
										<ul>
											<li><a href="#">First other model</a></li>
											<li><a href="#">Second other model</a></li>
										</ul>
									</li>
									<li><a href="#">Add New Model</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div><!-- /.box-body -->
			</div>
		
		
		
		</div>
	</div>
</div>