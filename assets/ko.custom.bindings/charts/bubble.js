ko.bindingHandlers.DXBubble = {
	init: function(element, valueAccessor, allBindingsAccessor, data, context){	
		var typed = false;		
		
		var options = valueAccessor();
        var newValueAccessor = function() {
            return function() {
                options.action.apply(data, options.params);
            };
        };
	
		var dataSource = [
			{ 	af0: 'Jan', t0: 'Indie @ Jan', vf0: 36, sf0: 5,
				af1: 'Jan', t1: 'Drama @ Jan', vf1: 45, sf1: 6,
				af2: 'Jan', t2: 'Action/Adventure @ Jan', vf2: 35, sf2: 9,
				af3: 'Jan', t3: 'Spy @ Jan', vf3: 34, sf3: 11			
			},			
			
			{ 	af0: 'Feb', t0: 'Indie @ Feb', vf0: 18, sf0: 3,
				af1: 'Feb', t1: 'Drama @ Feb', vf1: 45, sf1: 6 },
			
			{ 	
				af0: 'Mar', t0: 'Indie @ Mar', vf0: 18, sf0: 3,
				af2: 'Mar', t2: 'Action/Adventure @ Mar', vf2: 35, sf2: 9,
				af3: 'Mar', t3: 'Spy @ Mar', vf3: 34, sf3: 11},
				
			{ 	
				af0: 'Apr', t0: 'Indie @ Apr', vf0: 18, sf0: 3,
				af3: 'Apr', t3: 'Spy @ Apr', vf3: 22, sf3: 12,
				af10: 'Apr', t10: "Children's @ Apr", vf10: 35, sf10: 11
				},
			{ 	
				af0: 'May', t0: 'Indie @ May', vf0: 18, sf0: 3,
				af4: 'May', t4: 'Disaster @ May', vf4: 67, sf4: 4 },
				
			{ 	
				af0: 'Jun', t0: 'Indie @ Jun', vf0: 18, sf0: 3,
				af5: 'Jun', t5: 'Adult @ Jun', vf5: 56, sf5: 18},
				
			{ 	
				af0: 'Jul', t0: 'Indie @ Jul', vf0: 18, sf0: 3,
				af6: 'Jul', t6: 'Suspense @ Jul', vf6: 32, sf6: 6 },
			
			{ 	af0: 'Aug', t0: 'Indie @ Aug', vf0: 65, sf0: 7,
				af7: 'Aug', t7: 'War @ Aug', vf7: 66, sf7: 8
				},			
			
			{ 	af0: 'Sep', t0: 'Indie @ Sep', vf0: 67, sf0: 10,
				af6: 'Sep', t6: 'Suspense @ Sep', vf6: 34, sf6: 13,
				af8: 'Sep', t8: 'Murder @ Sep', vf8: 54, sf8: 14 },
			
			{ 	af0: 'Oct', t0: 'Indie @ Oct', vf0: 76, sf0: 15,
				af9: 'Oct', t9: 'Mystery @ Oct', vf9: 76, sf9: 2},
			
			
			{ 	af0: 'Nov', t0: 'Indie @ Nov', vf0: 56, sf0: 11,
				af10: 'Nov', t10: "Children's @ Nov", vf10: 38, sf10: 12 },
			
			
			{ 	af0: 'Dec', t0: 'Indie @ Dec', vf0: 49, sf0: 14,
				af11: 'Dec', t11: 'Musical @ Dec', vf11: 60, sf11: 7 }
			
			
			
			
			
			];
		
		jQuery(element).dxChart({
			palette: options.palette,
			dataSource: dataSource,			
			//tooltip: options.toolTip,	
			//rotated: options.rotated,	
			//equalBarWidth: options.equalBarWidth,
			 commonSeriesSettings: {
				type: 'bubble',
				//argumentField: "date",
			},
			argumentAxis: {
				//title: 'Popularity By Month (2013)'
				//label: { format: 'monthAndYear' },
				//valueMarginsEnabled: false
			},
			valueAxis: {
				title: 'Popularity',
				label: { format: '' },
				position: 'right'
			},
			series:  [
			{ name: 'Indie', 	argumentField: 'af0', valueField: 'vf0', sizeField: 'sf0', tagField: 't0'  },
			{ name: 'Drama',	argumentField: 'af1', valueField: 'vf1', sizeField: 'sf1', tagField: 't1'},
			{ name: 'Action/Adventure', argumentField: 'af2', valueField: 'vf2', sizeField: 'sf2', tagField: 't2' },
			{ name: 'Spy', 		argumentField: 'af3', valueField: 'vf3', sizeField: 'sf3', tagField: 't3'},
			{ name: 'Disaster', argumentField: 'af4', valueField: 'vf4', sizeField: 'sf4', tagField: 't4'},
			{ name: 'Adult', 	argumentField: 'af5', valueField: 'vf5', sizeField: 'sf5', tagField: 't5'},
			{ name: 'Suspense', argumentField: 'af6', valueField: 'vf6', sizeField: 'sf6', tagField: 't6'},
			{ name: 'War', 		argumentField: 'af7', valueField: 'vf7', sizeField: 'sf7', tagField: 't7'},
			{ name: 'Murder', 	argumentField: 'af8', valueField: 'vf8', sizeField: 'sf8', tagField: 't8'},
			{ name: 'Mystery', 	argumentField: 'af9', valueField: 'vf9', sizeField: 'sf9', tagField: 't9'},
			{ name: 'Chilren\'s', argumentField: 'af10', valueField: 'vf10', sizeField: 'sf10', tagField: 't10'},
			{ name: 'Musical', 	argumentField: 'af11', valueField: 'vf11', sizeField: 'sf11', tagField: 't11',}
			
			],
			legend: { 
				//position: 'inside',
				horizontalAlignment: 'left', 
				verticalAlignment: 'top',
				rowCount: 12,
				rowItemSpacing: 0,
				customizeText: function () {
					var cont = (this.seriesName.length >= 18)? '...' : '';
					return (this.seriesName).substring(0, 18) + cont;
				}
			},
			tooltip: {
				enabled: true,
				format: 'largeNumber',
				font: {
					size: 14,
				},
				customizeText: function (pointInfo) {
					console.log(pointInfo)
					return pointInfo.point.tag + '<br/>' + pointInfo.size + ' Sub-Categories' + '<br/>Popularity = ' + pointInfo.valueText
				}
			}
			
		});
		
		


		
		//jQuery(element).dxChart({});		
	},
	update: function(element, valueAccessor, allBindings) {
        // First get the latest data that we're bound to
        var value = valueAccessor();
		/**
		var chrt = jQuery(element).dxChart('instance');
		 chrt.option({
			dataSource: value.dataSource || []
			});**/
		
		
    }
}


