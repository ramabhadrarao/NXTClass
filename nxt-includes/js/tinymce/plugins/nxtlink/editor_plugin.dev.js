(function() {
	tinymce.create('tinymce.plugins.nxtLink', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			var disabled = true;

			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('nxt_Link', function() {
				if ( disabled )
					return;
				ed.windowManager.open({
					id : 'nxt-link',
					width : 480,
					height : "auto",
					nxtDialog : true,
					title : ed.getLang('advlink.link_desc')
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('link', {
				title : ed.getLang('advanced.link_desc'),
				cmd : 'nxt_Link'
			});

			ed.addShortcut('alt+shift+a', ed.getLang('advanced.link_desc'), 'nxt_Link');

			ed.onNodeChange.add(function(ed, cm, n, co) {
				disabled = co && n.nodeName != 'A';
			});
		},
		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'NXTClass Link Dialog',
				author : 'NXTClass',
				authorurl : 'http://opensource.nxtclass.tk',
				infourl : '',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('nxtlink', tinymce.plugins.nxtLink);
})();