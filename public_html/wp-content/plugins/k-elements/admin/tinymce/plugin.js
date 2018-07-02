(function ()
{
	// create kleoShortcodes plugin
	tinymce.create("tinymce.plugins.kleoShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("kleoPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				// load thickbox
				tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "kleo_button" )
			{
				var a = this;
				
				var btn = e.createSplitButton('kleo_button', {
					title: "Insert Shortcode",
					image: KleoShortcodes.plugin_folder +"/tinymce/images/icon.png",
					icons: false
				});

				btn.onRenderMenu.add(function (c, b)
				{
					var myShortcodes = KleoShortcodes.shortcodes;
					
					var currentCat = "";
					c=b.addMenu({title: "Content elements"});
					console.log(myShortcodes);
					
					for (var key in myShortcodes) {
						if (myShortcodes.hasOwnProperty(key)) {
							
							if(key != '' && key != currentCat) {
								currentCat = key;
								c=b.addMenu({title: currentCat.charAt(0).toUpperCase() + currentCat.slice(1)});
							}

							for (var subkey in myShortcodes[key]) {
								if (myShortcodes[key].hasOwnProperty(subkey)) {
									a.addImmediate(c, myShortcodes[key][subkey]['name'], myShortcodes[key][subkey]['code'] );
								}
							}
						}
					}
                       
				});
                
				return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("kleoPopup", false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		addImmediate: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		}
	});
	
	// add kleoShortcodes plugin
	tinymce.PluginManager.add("kleoShortcodes", tinymce.plugins.kleoShortcodes);
})();