<script>

		





		/**
		function confirmDialog( url, message){
			message = typeof message == 'undefined' ?  'Are you sure you want to do this?' : message;
			if(confirm(message))
			{
				window.location.href=url;
			}	
		}
		
		$('#search-options').collapse('hide');			
		$('.dropdown-menu.search-options *').on('click', function(e){ 
			e.stopPropagation();				
			$(this).closest('dropdown').toggleClass('open');			
		} );
		**/
		
			
		$(document).ready(function() {
		
			
		
		
			$('body').on('hidden.bs.modal', '.modal:not(.modal-static)', function () {
			  ko.cleanNode(this);
				$(this).removeData('bs.modal')
				.find(".modal-content")
				.html('<div class="modal-body"><div class="text-center has-spinner active"><span class="spinner"><i class="fa fa-spinner fa-spin"></i></span></div></div>');
			});
			$(".checkbox-all").on("change", function()
			{
				var checked = $(this).prop("checked");

				$(this).closest(".checkbox-group")
					.first()
					.find("input[type=checkbox]")
					.prop("checked", checked);
			});
		
		
		
			$("body").tooltip({ selector: '[data-toggle=tooltip]' });
							
			$('body').on('click', '#floating-tool', function () {	
				if (!$(this).hasClass("open")) {
				  $(this).animate({"right": "250px"});
				  $('#floating-tool-content').animate({"right": "0"});
				  $(this).addClass("open");
				} else {
				  $(this).animate({"right": "0"});
				  $('#floating-tool-content').animate({"right": "-250px"});
				  $(this).removeClass("open");
				}
			});
			
			
			var originalLeave = $.fn.popover.Constructor.prototype.leave;
			$.fn.popover.Constructor.prototype.leave = function(obj){
			  var self = obj instanceof this.constructor ?
				obj : $(obj.currentTarget)[this.type](this.getDelegateOptions()).data('bs.' + this.type)
			  var container, timeout;
			  originalLeave.call(this, obj);
			  if(obj.currentTarget) {
				//console.log($(obj.currentTarget))
				container = $('body .popover:last-child');
				timeout = self.timeout;
				container.one('mouseenter', function(){
				  //We entered the actual popover – call off the dogs
				  clearTimeout(timeout);
				  //Let's monitor popover content instead
				  container.one('mouseleave', function(){
					$.fn.popover.Constructor.prototype.leave.call(self, self);
				  });
				})
			  }
			};
			$('body').popover({ selector: '[data-toggle="popover"]', container: 'body', trigger: 'click hover', delay: {show: 50, hide: 400}});
			
			$(document).on('show.bs.popover', '.synonym-init', function(e){
				var popover = $(this).data('bs.popover');
				var content = popover.options.text;
				var _this = this;			
				$.ajax({
					url: '<?=base_url('synonyms')?>',
					type: 'POST',
					data: {
						text: content
					},
					beforeSend: function(){ 
						$(_this).attr('data-content', 'Loading...');
						popover.setContent();
						popover.$tip.addClass(popover.options.placement)
					},
					success: function(data){
						$(_this).attr('data-content', data);
						popover.setContent();
						popover.$tip.addClass(popover.options.placement);
					}			
				})
			})	
			
			/**
			var $wrap   = $('#collapse-add-widget-scroll').parent();
			var options = {
					horizontal: 1,
					itemNav: 'basic',
					smart: 1,
					activateOn: 'click',
					mouseDragging: 1,
					touchDragging: 1,
					releaseSwing: 1,
					startAt: 0,
					scrollBar: $wrap.find('.scrollbar'),
					scrollBy: 1,
					//pagesBar: $wrap.find('.pages'),
					activatePageOn: 'click',
					speed: 300,
					elasticBounds: 1,
					easing: 'easeOutExpo',
					dragHandle: 1,
					dynamicHandle: 1,
					clickBar: 1,
				};
				$('#collapse-add-widget-scroll').sly(options);**/
			
			
			
			$( ".widget-expand" ).on('click', function() {
				if($(this).hasClass('widget-expanded')){
					$(this)
					.closest('.removable-widget')
					.removeClass('removable-widget-expanded')
					.fullScreen(false);
					$(this)
					.removeClass('widget-expanded')
					.html('<i class="ion-android-expand"></i>');
				}else{
					$(this)
					.closest('.removable-widget')
					.addClass('removable-widget-expanded')
					.fullScreen(true);
					$(this)
					.addClass('widget-expanded')
					.html('<i class="ion-android-contract"></i>');
				}
			  
			});
				
		});
		
		
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