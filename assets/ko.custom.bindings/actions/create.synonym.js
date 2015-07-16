ko.bindingHandlers.CreateSynonym = {
	init: function(element, valueAccessor, allBindingsAccessor, data, context){	
		var typed = false;		
		
		var options = valueAccessor();
		ko.utils.domData.set(element, "options", options);
	},
	
	
	update: function(element, valueAccessor, allBindings) {
        
		var opts = ko.utils.domData.get(element, 'options');
		var template = ['<div class=\'popover synonym-popover\' role=\'tooltip\'>',
						'<div class=\'arrow\'></div>',
						'<h3 class=\'popover-title\'></h3>',
						'<div class=\'popover-content p-0\' style=\'height: 150px\'>',
						'</div>',
						'</div>'].join('')	
		function getSelectedText() {
		  var text = "";
		  if (typeof window.getSelection != "undefined") {
			text = window.getSelection().toString();
		  } else if (typeof document.selection != "undefined" && document.selection.type == "Text") {
			text = document.selection.createRange().text;
		  }
		  return text;
		}

		function doSomethingWithSelectedText() {
		  var selectedText = getSelectedText();
		  
		  if (selectedText) {
			var html = $(this).html().trim();		
			 $(this).html(
				html.replace
					(
						new RegExp(selectedText, 'gi'), 
						[
						'<span title="Synonym for \'<i>' + selectedText + '</i>\'" class="synonym synonym-init"',
						'data-template="' + template + '"',
						'data-placement="top" data-html="true"',
						'data-text="' + selectedText + '"',
						'data-content="' + selectedText + '" data-toggle="popover"',
						'>' + selectedText + '</span>'
						].join('')
						   
					)
				);
		  } else {
			
		  };
		};

		element.onmouseup = doSomethingWithSelectedText;
		element.onkeyup = doSomethingWithSelectedText;
		
    }
}


