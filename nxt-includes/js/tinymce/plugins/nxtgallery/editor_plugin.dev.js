
(function() {
	tinymce.create('tinymce.plugins.nxtGallery', {

		init : function(ed, url) {
			var t = this;

			t.url = url;
			t._createButtons();

			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('...');
			ed.addCommand('nxt_Gallery', function() {
				var el = ed.selection.getNode(), post_id, vp = tinymce.DOM.getVienxtort(),
					H = vp.h - 80, W = ( 640 < vp.w ) ? 640 : vp.w;

				if ( el.nodeName != 'IMG' ) return;
				if ( ed.dom.getAttrib(el, 'class').indexOf('nxtGallery') == -1 )	return;

				post_id = tinymce.DOM.get('post_ID').value;
				tb_show('', tinymce.documentBaseURL + '/media-upload.php?post_id='+post_id+'&tab=gallery&TB_iframe=true&width='+W+'&height='+H);

				tinymce.DOM.setStyle( ['TB_overlay','TB_window','TB_load'], 'z-index', '999999' );
			});

			ed.onMouseDown.add(function(ed, e) {
				if ( e.target.nodeName == 'IMG' && ed.dom.hasClass(e.target, 'nxtGallery') )
					ed.plugins.nxtclass._showButtons(e.target, 'nxt_gallerybtns');
			});

			ed.onBeforeSetContent.add(function(ed, o) {
				o.content = t._do_gallery(o.content);
			});

			ed.onPostProcess.add(function(ed, o) {
				if (o.get)
					o.content = t._get_gallery(o.content);
			});
		},

		_do_gallery : function(co) {
			return co.replace(/\[gallery([^\]]*)\]/g, function(a,b){
				return '<img src="'+tinymce.baseURL+'/plugins/nxtgallery/img/t.gif" class="nxtGallery mceItem" title="gallery'+tinymce.DOM.encode(b)+'" />';
			});
		},

		_get_gallery : function(co) {

			function getAttr(s, n) {
				n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s);
				return n ? tinymce.DOM.decode(n[1]) : '';
			};

			return co.replace(/(?:<p[^>]*>)*(<img[^>]+>)(?:<\/p>)*/g, function(a,im) {
				var cls = getAttr(im, 'class');

				if ( cls.indexOf('nxtGallery') != -1 )
					return '<p>['+tinymce.trim(getAttr(im, 'title'))+']</p>';

				return a;
			});
		},

		_createButtons : function() {
			var t = this, ed = tinyMCE.activeEditor, DOM = tinymce.DOM, editButton, dellButton;

			DOM.remove('nxt_gallerybtns');

			DOM.add(document.body, 'div', {
				id : 'nxt_gallerybtns',
				style : 'display:none;'
			});

			editButton = DOM.add('nxt_gallerybtns', 'img', {
				src : t.url+'/img/edit.png',
				id : 'nxt_editgallery',
				width : '24',
				height : '24',
				title : ed.getLang('nxtclass.editgallery')
			});

			tinymce.dom.Event.add(editButton, 'mousedown', function(e) {
				var ed = tinyMCE.activeEditor;
				ed.windowManager.bookmark = ed.selection.getBookmark('simple');
				ed.execCommand("nxt_Gallery");
			});

			dellButton = DOM.add('nxt_gallerybtns', 'img', {
				src : t.url+'/img/delete.png',
				id : 'nxt_delgallery',
				width : '24',
				height : '24',
				title : ed.getLang('nxtclass.delgallery')
			});

			tinymce.dom.Event.add(dellButton, 'mousedown', function(e) {
				var ed = tinyMCE.activeEditor, el = ed.selection.getNode();

				if ( el.nodeName == 'IMG' && ed.dom.hasClass(el, 'nxtGallery') ) {
					ed.dom.remove(el);

					ed.execCommand('mceRepaint');
					return false;
				}
			});
		},

		getInfo : function() {
			return {
				longname : 'Gallery Settings',
				author : 'NXTClass',
				authorurl : 'http://opensource.nxtclass.tk',
				infourl : '',
				version : "1.0"
			};
		}
	});

	tinymce.PluginManager.add('nxtgallery', tinymce.plugins.nxtGallery);
})();
