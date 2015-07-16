ko.bindingHandlers.BootstrapPopover = {
	init: function(element, valueAccessor, allBindingsAccessor){	
		var typed = false;
		var options =  jQuery.extend(valueAccessor(), {
							onChange: function (cm) {
								typed = true;
								allBindingsAccessor().value(cm.getValue());
								typed = false;
							}
						});	
		
		
		ko.utils.domData.set(element, "options", options);		
	},
		
		
		
		
	update: function(element, valueAccessor, allBindingsAccessor, viewModel, bindingContext) {
		var opts = ko.utils.domData.get(element, 'options');
		var $root = bindingContext.$root;	
		
		$(element)
		.popover(opts)	/**	
		.on('show.bs.popover', function (e) {
		  var $this = $(this);
				// Currently hovering popover
				$this.data("hoveringPopover", true);
				// If it's still waiting to determine if it can be hovered, don't allow other handlers
				if ($this.data("waitingForPopoverTO")) {
					e.stopImmediatePropagation();
				}
		})
		.on('hide.bs.popover', function (e) {
		  var $this = $(this);

				// If timeout was reached, allow hide to occur
				if ($this.data("forceHidePopover")) {
					$this.data("forceHidePopover", false);
					return true;
				}

				// Prevent other `hide` handlers from executing
				e.stopImmediatePropagation();

				// Reset timeout checker
				clearTimeout($this.data("popoverTO"));

				// No longer hovering popover
				$this.data("hoveringPopover", false);

				// Flag for `show` event
				$this.data("waitingForPopoverTO", true);

				// In 1500ms, check to see if the popover is still not being hovered
				$this.data("popoverTO", setTimeout(function () {
					// If not being hovered, force the hide
					if (!$this.data("hoveringPopover")) {
						$this.data("forceHidePopover", true);
						$this.data("waitingForPopoverTO", false);
						$this.popover("hide");
					}
				}, 1500));

				// Stop default behavior
				return false;
		})	**/
		
	}
}



