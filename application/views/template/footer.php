<?php
	$template_url = base_url('assets/themes/lte/');
	$styles = $this->application->styles_setting();
	$settings = $this->application->general_setting();
?>	

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<div class="pull-right hidden-xs">
			  <?=element('title', $settings)?>
			</div>
			<!-- Default to the left --> 
			<strong>Copyright &copy; 2015 <a href="http://<?=element('copyright_link', $settings)?>" target="_blank"> <?=element('copyright', $settings)?> </a>.</strong> All rights reserved.
		</footer>
</div><!-- #wrapper -->
	<!--
	<script src="<?php echo base_url('assets/lib/eventemitter/EventEmitter.js'); ?>"></script>	
	<script src="<?php echo base_url('assets/lib/eventie/eventie.js'); ?>"></script>		
	<script src="<?php echo base_url('assets/lib/imagesloaded/js/imagesloaded.js'); ?>"></script>	-->
	
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
	<!--<script src="<?php echo base_url('assets/js/jquery-ui-1.10.4.custom.js'); ?>"></script>-->
	
	<script src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>	
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>	
	<script src="<?php echo base_url('assets/js/jquery.cookie.js'); ?>"></script>	
	<script src="<?php echo base_url('assets/js/lodash.js'); ?>"></script>	
	
		
	
	<script src="<?php echo base_url('assets/lib/knockout/knockout-3.3.0.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/moment/moment-with-locales.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/globalize/globalize.js'); ?>"></script>	
	<script src="<?php echo base_url('assets/js/dx.all.js'); ?>"></script>	
	
	
	
	
	
	<!-- librararies -->
	<script src="<?php echo base_url('assets/lib/d3/d3.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/d3/tag.cloud/d3.layout.cloud.js'); ?>"></script>	
	<script src="<?php echo base_url('assets/lib/magic.suggest/magicsuggest.js'); ?>"></script>
	
	
	<script src="<?php echo base_url('assets/lib/sigma/sigma.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/sigma/sigma.parseGexf.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/sigma/sigma.parseJson.js'); ?>"></script>
	
	
	<script src="<?php echo base_url('assets/lib/jquery.datatables/js/jquery.dataTables.min.js'); ?>"></script>	
	
	<script src="<?php echo base_url('assets/lib/jquery.datatables/extensions/Responsive/js/dataTables.responsive.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/jquery.datatables/plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
		
	
	
	
	
	
	<script src="<?php echo base_url('assets/lib/googlemap/theme.js'); ?>"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.9&sensor=false&libraries=drawing"></script>
	<script src="<?php echo base_url('assets/lib/googlemap/infobox.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/googlemap/markerwithlabel.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/map-icons/js/map-icons.js'); ?>"></script>
	
	
		
	
	<script src="<?php echo base_url('assets/lib/bootsidemenu/js/BootSideMenu.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/jquery.treegrid/js/jquery-treegrid.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/jquery.easytree/js/jquery-easytree.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/lib/dtree/js/dtree.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/fancytree/jquery.fancytree.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/fancytree/jquery.fancytree.persist.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/fancytree/jquery.fancytree.dnd.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/fancytree/jquery.fancytree.edit.js'); ?>"></script>	
	
	
	<script src="<?php echo base_url('assets/lib/scrolltofixed/jquery-scrolltofixed.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/lib/jquery.redirect/jquery.redirect.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/lib/bootstrap.iconpicker/js/fontawesome-iconpicker.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/bootstrap.daterangepicker/js/daterangepicker.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/lib/bootstrap.tokenfield/js/bootstrap-tokenfield.min.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/lib/bootstrap.colorpicker/js/bootstrap-colorpicker.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/bootstrap.select/js/bootstrap-select.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/bootstrap.select.ajax/js/ajax-bootstrap-select.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/bootstrap.tour/bootstrap-tour.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/bootstrap.slider/js/bootstrap-slider.js'); ?>"></script>		
	<!--<script src="<?php echo base_url('assets/lib/typeahead/bootstrap-typeahead.js'); ?>"></script>-->
	<script src="<?php echo base_url('assets/lib/bootstrap.typeahead/bootstrap.typeahead.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/bootstrap.switch/bootstrap-switch.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/bootstrap.notify/js/bootstrap-notify.min.js'); ?>"></script>	
	<script src="<?php echo base_url('assets/lib/bootstrap.wysihtml5/js/bootstrap3-wysihtml5.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/bootstrap.wysihtml5/js/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/bootstrap.jsPanel/jquery.jspanel.bs-1.4.0.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/jquery.confirm/js/jquery.confirm.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/jquery.fullscreen/js/jquery.fullscreen-min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/jquery.quicksearch/js/jquery.quicksearch.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/jquery.livesearch/js/jquery.livesearch.js'); ?>"></script>
	<!--<script src="<?php echo base_url('assets/lib/masonry/js/masonry.pkgd.js'); ?>"></script>-->
	<script src="<?php echo base_url('assets/lib/gridstack/js/gridstack.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/lib/jquery.jsonview/dist/jquery.jsonview.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/bootstrap.fileinput/js/fileinput.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/dropzone/dist/dropzone.js'); ?>"></script>
	
	
	
	
	<script src="<?php echo base_url('assets/lib/isotope/js/isotope.pkgd.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/isotope/layout-modes/fit-rows.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/isotope/layout-modes/masonry.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/isotope/layout-modes/vertical.js'); ?>"></script>
	
	<!--<script src="<?php echo base_url(''); ?>assets/lib/sly/sly.min.js"></script>-->
	
	<!--<script src="<?php echo base_url('assets/lib/jquery.anylist.scroller/js/jquery.als-1.7.min.js'); ?>"></script>-->
	<script src="<?php echo base_url('assets/lib/jquery.customscrollbar/js/jquery.customscrollbar.js'); ?>"></script>
	<script src="<?php echo base_url('assets/lib/nicescroll/jquery.nicescroll.min.js'); ?>"></script>
	<script src="<?=$template_url?>/js/app.min.js"></script>
	
	<!-- knockoutjs custom bindings -->
	<script src="<?php echo base_url('assets/ko.custom.bindings/jquery.draggable.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/jquery.sortable.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/jquery.droppable.js'); ?>"></script>	
	<script src="<?php echo base_url('assets/ko.custom.bindings/magicsuggest.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootstrap.typeahead.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootstrap.switch.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootstrap.slider.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootsidemenu.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootstrap.select.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootstrap.select.ajax.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootstrap.datetimepicker.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootstrap.daterangepicker.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootstrap.colorpicker.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootstrap.wysihtml5.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootstrap.iconpicker.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootstrap.tokenfield.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/jquery.confirm.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/jquery.datatable.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/bootstrap.fileinput.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/dropzone.js'); ?>"></script>
	
	<script src="<?php echo base_url('assets/ko.custom.bindings/nicescroll.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/d3.tagcloud.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/d3.circlepacking.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/jquery.treegrid.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/jquery.easytree.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/dtree.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/fancytree.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/scrolltofixed.js');?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/slimscroll.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/jquery.quicksearch.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/jquery.livesearch.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/masonry.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/gridstack.js'); ?>"></script>
	
	<!--<script src="<?php echo base_url('assets/ko.custom.bindings/jquery.anylist.scroller.js'); ?>"></script>-->
	<script src="<?php echo base_url('assets/ko.custom.bindings/jquery.customscrollbar.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/actions/create.synonym.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/jquery.jsonview.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/sigma.network.js'); ?>"></script>
	
	
	<script src="<?php echo base_url('assets/ko.custom.bindings/settings/settings.js'); ?>"></script>
	
	
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/basic.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/bargauge.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/bubble.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/circulargauge.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/geospatial.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/line.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/lineargauge.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/map.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/pie.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/sparkline.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/timeline.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/zooming.js'); ?>"></script>	
	<script src="<?php echo base_url('assets/ko.custom.bindings/charts/geospatial.js'); ?>"></script>
	
	<!-- knockoutjs models -->
	<script src="<?php echo base_url('assets/ko.models/app.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.models/sigma.network.js'); ?>"></script>
	<script src="<?php echo base_url('assets/ko.models/view.js'); ?>"></script>
	
	
	
	<?php 
		if(isset($js) && is_array($js)){
		
			foreach($js as $script):
				echo '<script src="' . base_url($script) . '"></script>';
			endforeach;
			
		}
	
	?>
	
	
	

	