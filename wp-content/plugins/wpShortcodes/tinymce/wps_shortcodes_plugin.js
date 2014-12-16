(function() {
	tinymce.PluginManager.add( 'wps_shortcodes_ed_button', function( editor, url ) {
		editor.addButton( 'wps_shortcodes_ed_button', {
			title: 'WP Shortcodes',
			type: 'menubutton',
			icon: 'icon wps-shortcodes-icon',
			menu: [
						
				/** Components **/
				{
					text: 'Components',
					menu: [

						/* Buttons */
						{
							text: 'Button',
							onclick: function() {
								editor.windowManager.open( {
									title: 'WP Shortcodes - Insert Button',
									body: [
									
									// Button Text
									{
										type: 'textbox',
										name: 'buttonText',
										label: 'Text',
										value: 'Button'
									},
									
									// Button URL
									{
										type: 'textbox',
										name: 'buttonUrl',
										label: 'URL',
										value: 'http://www.presslayer.com/'
									},
									
									// Button Link Target
									{
										type: 'listbox',
										name: 'buttonLinkTarget',
										label: 'Link Target',
										'values': [
											{text: 'Self', value: 'self'},
											{text: 'Blank', value: 'blank'}
										]
									},

									// Button Color
									{
										type: 'listbox',
										name: 'buttonColor',
										label: 'Color',
										'values': [
											{text: 'Blue', value: 'blue'},
											{text: 'Blue - Light', value: 'light_blue'},
											{text: 'Green', value: 'green'},
											{text: 'Red', value: 'red'},
											{text: 'Orange', value: 'orange'},
											{text: 'Yellow', value: 'yellow'},
											{text: 'Pink', value: 'pink'},
											{text: 'Purple', value: 'purple'},
											{text: 'White', value: 'white'},
											{text: 'Black', value: 'black'},
										]
									},
									
									// Button Size
									{
										type: 'listbox',
										name: 'buttonSize',
										label: 'Size',
										'values': [
											{text: 'Default', value: 'default'},
											{text: 'Small', value: 'small'},
											{text: 'Medium', value: 'medium'},
											{text: 'Large', value: 'large'}
										]
									},
									
									// Button Type
									{
										type: 'listbox',
										name: 'buttonType',
										label: 'Type',
										'values': [
											{text: 'Square', value: 'square'},
											{text: 'Rounded', value: 'rounded'},
										]
									},
									
									// Button Rel
									{
										type: 'listbox',
										name: 'buttonRel',
										label: 'Rel',
										'values': [
											{text: 'None', value: ''},
											{text: 'Nofollow', value: 'nofollow'}
										]
									},

									// Button Left Icon
									{
										type: 'textbox',
										name: 'buttonLeftIcon',
										label: 'Left Icon (FontAwesome class name)',
										value: ''
									},

									// Button Right Icon
									{
										type: 'textbox',
										name: 'buttonRightIcon',
										label: 'Right Icon (FontAwesome class name)',
										value: ''
									} ],
									onsubmit: function( e ) {
										editor.insertContent( '[wps_button url="' + e.data.buttonUrl + '" color="' + e.data.buttonColor + '" size="' + e.data.buttonSize + '" target="' + e.data.buttonLinkTarget + '" type="' + e.data.buttonType + '" rel="' + e.data.buttonRel + '" icon_left="' + e.data.buttonLeftIcon + '" icon_right="' + e.data.buttonRightIcon + '"]' + e.data.buttonText + '[/wps_button]');
									}
								});
							}
						}, // End button

						/* Info Boxes */
						{
							text: 'Info Box',
							onclick: function() {
								editor.windowManager.open( {
									title: 'WP Shortcodes - Insert Info Box',
									body: [

									// Box Type
									{
										type: 'listbox',
										name: 'boxType',
										label: 'Type',
										'values': [
											{text: 'Normal', value: 'normal'},
											{text: 'Info', value: 'info'},
											{text: 'Success', value: 'success'},
											{text: 'Note', value: 'note'},
											{text: 'Warning', value: 'warning'},
											{text: 'Danger', value: 'danger'}
										]
									},
									
									// Box Content
									{
										type: 'textbox',
										name: 'boxContent',
										label: 'Content',
										value: 'WordPress is web software you can use to create a beautiful website or blog.',
										multiline: true,
										minWidth: 300,
										minHeight: 100
									}],
									onsubmit: function( e ) {
										editor.insertContent( '[wps_info_box type="' + e.data.boxType + '"]' + e.data.boxContent + '[/wps_info_box]' );
									}
								});
							}
						}, // End boxes


						/* Highlight */
						{
							text: 'Highlight',
							onclick: function() {
								editor.windowManager.open( {
									title: 'WP Shortcodes - Insert Highlight',
									body: [

									// Highlight Color
									{
										type: 'listbox',
										name: 'highlightColor',
										label: 'Size',
										'values': [
											{text: 'Blue', value: 'blue'},
											{text: 'Orange', value: 'orange'},
											{text: 'Yellow', value: 'yellow'},
											{text: 'Green', value: 'green'},
											{text: 'Red', value: 'red'},
											{text: 'Pink', value: 'pink'},
											{text: 'Purple', value: 'purple'}
										]
									},

									// Highlight Content
									{
										type: 'textbox', 
										name: 'highlightContent', 
										label: 'Highlighted Text',
										value: 'sample text'
									}],
									onsubmit: function( e ) {
										editor.insertContent( '[wps_highlight color="' + e.data.highlightColor + '"]' + e.data.highlightContent + '[/wps_highlight]');
									}
								});
							}
						}, // End highlights


						/* Google Map */
						{
							text: 'Google Map',
							onclick: function() {
								editor.windowManager.open( {
									title: 'WP Shortcodes - Insert Google Map',
									body: [

									// Google Map Title
									{
										type: 'textbox',
										name: 'gmapTitle',
										label: 'Title',
										value: 'Welcome To San Jose'
									},

									// Google Map Location
									{
										type: 'textbox',
										name: 'gmapLocation',
										label: 'Location',
										value: 'San Jose, California'
									},

									// Google Map Height
									{
										type: 'textbox',
										name: 'gmapHeight',
										label: 'Height',
										value: '300'
									},

									// Google Map Zoom
									{
										type: 'textbox',
										name: 'gmapZoom',
										label: 'Zoom',
										value: '15'
									}

									],
									onsubmit: function( e ) {
										editor.insertContent( '[wps_googlemap title="' + e.data.gmapTitle + '" location="' + e.data.gmapLocation + '" height="' + e.data.gmapHeight + '" zoom="' + e.data.gmapZoom + '"]');
									}
								});
							}
						}, // End GoogleMaps
					]
				}, // End Elements Section


				/** Interactive Start **/
				{
				text: 'Interactive',
				menu: [

						/* Accordion */
						{
							text: 'Accordion',
							onclick: function() {
								editor.insertContent( '[wps_accordiongroup]<br />[wps_accordion title="Accordion 1"] Example Content #1 [/wps_accordion]<br />[wps_accordion title="Accordion 2"] Example Content #2 [/wps_accordion]<br />[wps_accordion title="Accordion 3"] Example Content #3 [/wps_accordion]<br />[/wps_accordiongroup]');
							}
						}, // End accordion

						/* Tabs */
						{
							text: 'Tabs',
							onclick: function() {
								editor.insertContent( '[wps_tabgroup]<br />[wps_tab id="t1" title="Tab 1"] Example Content #1 [/wps_tab]<br />[wps_tab id="t2" title="Tab 2"] Example Content #2 [/wps_tab]<br />[wps_tab id="t3" title="Tab 3"] Example Content #3 [/wps_tab]<br />[/wps_tabgroup]');
							}
						}, // End tabs
						
						/* Toggle */
						{
							text: 'Toggle',
							onclick: function() {
								editor.windowManager.open( {
									title: 'WP Shortcodes - Insert Toggle',
									body: [

									// Toggle Title
									{
										type: 'textbox',
										name: 'toggleTitle',
										label: 'Title',
										value: 'Toggle Title'
									},

									// Toggle State
									{
										type: 'listbox',
										name: 'toggleState',
										label: 'State',
										'values': [
											{text: 'Open', value: 'open'},
											{text: 'Closed', value: 'closed'}
										]
									},
									
									// Toggle Content
									{
										type: 'textbox',
										name: 'toggleContent',
										label: 'Content',
										value: 'Your content goes here.',
										multiline: true,
										minWidth: 300,
										minHeight: 100
									}
									
									],
									onsubmit: function( e ) {
										editor.insertContent( '[wps_toggle title="' + e.data.toggleTitle + '" state="' + e.data.toggleState + '"]'+ e.data.toggleContent +'[/wps_toggle]');
									}
								});
							}
						} // End toggle
						
					]
				}, // End Interactive section
				
				/* Columns */
				{
					text: 'Columns',
					onclick: function() {
						editor.windowManager.open( {
							title: 'WP Shortcodes - Insert Column',
							body: [

							// Column Title
							{
								type: 'textbox',
								name: 'columnTitle',
								label: 'Title',
								value: ''
							},

							// Column Type
							{
								type: 'listbox',
								name: 'columnType',
								label: 'Type',
								'values': [
									{text: '1/1', value: 'full'},	   
									{text: '1/2', value: 'half'},
									{text: '1/2 last', value: 'half_last'},
									{text: '1/4', value: 'quarter'},
									{text: '1/4 last', value: 'quarter_last'},
									{text: '3/4', value: 'three_quarters'},
									{text: '3/4 last', value: 'three_quarters_last'},
								]
							},

							// Column Content
							{
								type: 'textbox',
								name: 'columnContent',
								label: 'Content',
								value: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.',
								multiline: true,
								minWidth: 300,
								minHeight: 100
							} ],
							onsubmit: function( e ) {
								editor.insertContent( '[wps_column title="' + e.data.columnTitle + '" type="' + e.data.columnType + '"]<br />' + e.data.columnContent + '<br />[/wps_column]');
							}
						});
					}
				}, // End columns
				
				/* Liquid Box */
				{
					text: 'Liquid Box',
					onclick: function() {
						editor.insertContent( '[wps_lqbox] Content... [/wps_lqbox]');
					}
				}, // End Liquid Box

			]
		});
	});
})();