/**
 * editor_plugin_src.js
 *
 * Copyright 2009, Moxiecode Systems AB
 * Released under LGPL License.
 *
 * License: http://tinymce.moxiecode.com/license
 * Contributing: http://tinymce.moxiecode.com/contributing
 */

(function() {
	tinymce.create('tinymce.plugins.nxtDialogs', {
		init : function(ed, url) {
			tinymce.create('tinymce.nxtWindowManager:tinymce.InlineWindowManager', {
				nxtWindowManager : function(ed) {
					this.parent(ed);
				},

				open : function(f, p) {
					var t = this, element;

					if ( ! f.nxtDialog )
						return this.parent( f, p );
					else if ( ! f.id )
						return;

					element = jQuery('#' + f.id);
					if ( ! element.length )
						return;

					t.features = f;
					t.params = p;
					t.onOpen.dispatch(t, f, p);
					t.element = t.windows[ f.id ] = element;

					// Store selection
					t.bookmark = t.editor.selection.getBookmark(1);

					// Create the dialog if necessary
					if ( ! element.data('nxtdialog') ) {
						element.nxtdialog({
							title: f.title,
							width: f.width,
							height: f.height,
							modal: true,
							dialogClass: 'nxt-dialog',
							zIndex: 300000
						});
					}

					element.nxtdialog('open');
				},
				close : function() {
					if ( ! this.features.nxtDialog )
						return this.parent.apply( this, arguments );

					this.element.nxtdialog('close');
				}
			});

			// Replace window manager
			ed.onBeforeRenderUI.add(function() {
				ed.windowManager = new tinymce.nxtWindowManager(ed);
			});
		},

		getInfo : function() {
			return {
				longname : 'nxtDialogs',
				author : 'NXTClass',
				authorurl : 'http://opensource.nxtclass.tk',
				infourl : 'http://opensource.nxtclass.tk',
				version : '0.1'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('nxtdialogs', tinymce.plugins.nxtDialogs);
})();
