		<div class="row">
		<div class="col-lg-12">
			<div id="footer">
				<hr>
				<div class="inner">
					
						<p class="right"><a href="#">Back to top</a></p>
						<p>
						</p>
				</div>
			</div>
		</div>
		</div>
	</div><!-- #container-fluid -->
	
	
	<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	
	<script src="<?php echo base_url(); ?>assets/lib/knockout/knockout-3.3.0.js"></script>
	<script src="<?php echo base_url(); ?>assets/lib/moment/moment.js"></script>
	<script src="<?php echo base_url(); ?>assets/lib/globalize/globalize.js"></script>	
	
	
	<!-- librararies -->
	<script src="<?php echo base_url(); ?>assets/lib/jquery.sortable/jquery-sortable-min.js"></script>
	<script src="<?php echo base_url(); ?>assets/lib/magic.suggest/magicsuggest.js"></script>
	<script src="<?php echo base_url(); ?>assets/lib/typeahead/bootstrap-typeahead.js"></script>
	<script src="<?php echo base_url(); ?>assets/lib/bootstrap.switch/bootstrap-switch.js"></script>
	<script src="<?php echo base_url(); ?>assets/lib/bootstrap.tour/bootstrap-tour.js"></script>
	<script src="<?php echo base_url(); ?>assets/lib/bootstrap.slider/js/bootstrap-slider.js"></script>
	
	<!-- knockoutjs custom bindings -->
	<script src="<?php echo base_url(); ?>assets/ko.custom.bindings/jquery.sortable.js"></script>
	<script src="<?php echo base_url(); ?>assets/ko.custom.bindings/magicsuggest.js"></script>
	<script src="<?php echo base_url(); ?>assets/ko.custom.bindings/typeahead.js"></script>
	<script src="<?php echo base_url(); ?>assets/ko.custom.bindings/bootstrap.switch.js"></script>
	<script src="<?php echo base_url(); ?>assets/ko.custom.bindings/bootstrap.slider.js"></script>
	
	<!-- knockoutjs models -->
	<script src="<?php echo base_url(); ?>assets/ko.models/search.model.js"></script>
	<script>
		$(document).ready(function() {
			$("body").tooltip({ selector: '[data-toggle=tooltip]' });
		});
		$('[data-toggle="popover"]').popover();
		
		
		
		
		
		
		// Instance the tour
		var tour = new Tour({
			keyboard: true,
			backdrop: true,
			backdropPadding: 0,
			template: "<div class='popover tour'>" +
						"<div class='arrow'></div>" +
						"<h3 class='popover-title bg-info'></h3>" +
						"<div class='popover-content'></div>" +
						"<div class='popover-navigation'>" +
							"<button class='btn btn-xs btn-info' data-role='prev'>« Prev</button>" +
							"<button class='btn btn-xs btn-info' data-role='next'>Next »</button>" +
							"<button class='btn btn-xs btn-danger' data-role='end'>End tour</button>" +
						"</div>" +	
					  "</div>"
			});

		
		 
			tour.addSteps([
			  {
				placement: 'bottom',
				element: "#main-navigation ul li:eq(0) a",
				title: "Dashboard",
				content: "<span class='label label-warning'>Navigate Pages with this Menu</span> Introduce new users to your product by walking them through it step by step."
			  },
			  {
				placement: 'bottom',
				element: "#main-navigation ul li:eq(1) a",
				title: "Settings",
				content: "<span class='label label-warning'>Navigate Pages with this Menu</span> Introduce new users to your product by walking them through it step by step."
			  },
			  {
				placement: 'bottom',
				element: "#main-navigation ul li:eq(2) a",
				title: "Tools",
				content: "<span class='label label-warning'>Navigate Pages with this Menu</span> Introduce new users to your product by walking them through it step by step."
			  },
			  {
				placement: 'bottom',
				element: "#user-profile-menu",
				title: "Access Your Personal Information",
				content: "<span class='label label-warning'>Navigate Pages with this Menu</span>  Easy is better, right? The tour is up and running with just a few options and steps."
			  }
			]);
		 
			// Initialize the tour
			tour.init();
		 
			// Start the tour
			tour.start();
		
	
	</script>
</body>
</html>
