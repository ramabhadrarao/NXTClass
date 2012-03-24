/**
 * Javascript calls for editor screens
 */

jQuery('#new-course-content label').hide();
jQuery('input[name="course[title]"]').inputHint();
jQuery('input[name="assignment[title]"]').inputHint();
jQuery('input[name="assignment[due_date]"]').inputHint();
jQuery('input[name="response[title]"]').inputHint();
jQuery('input[name="lecture[title]"]').inputHint();
jQuery('input[name="lecture[order]"]').inputHint();

// Distraction free writing compatibility
jQuery(function($) {
    // Try to check for content_id, nxt-fullscreen fails here
    $("#nxt-fullscreen-body").one("mousemove", function(){
        var content_elem = document.getElementById( fullscreen.settings.editor_id );
        var editor_mode = $(content_elem).is(':hidden') ? 'tinymce' : 'html';
        fullscreen.switchmode(editor_mode);
    });
    
    // Delete the loader, it won't load anyway
    $('#nxt-fullscreen-save img').remove();
    
    // Make word counts work
    $(document).triggerHandler('nxtcountwords', [ $(edCanvas).val() ] );
});

// Rewrite editor_plugin.js to make it usable outside nxt-admin
/**
 * nxt Fullscreen TinyMCE plugin
 *
 * Contains code from Moxiecode Systems AB released under LGPL License http://tinymce.moxiecode.com/license
 */
jQuery(document).ready(function() {
    tinymce.PluginManager.onAdd.add(function(a, b){
        if ( b == 'nxtfullscreen' )
            return false;     
    });
    tinymce.create('tinymce.plugins.nxtFullscreenPlugin', {

        init : function(ed, url) {
            var t = this, oldHeight = 0, s = {}, DOM = tinymce.DOM, resized = false;

            // Register commands
            ed.addCommand('nxtFullScreenClose', function() {
                // this removes the editor, content has to be saved first with tinyMCE.execCommand('nxtFullScreenSave');
                if ( ed.getParam('nxt_fullscreen_is_enabled') ) {
                    DOM.win.setTimeout(function() {
                        tinyMCE.remove(ed);
                        DOM.remove('nxt_mce_fullscreen_parent');
                        tinyMCE.settings = tinyMCE.oldSettings; // Restore old settings
                    }, 10);
                }
            });

            ed.addCommand('nxtFullScreenSave', function() {
                var ed = tinyMCE.get('nxt_mce_fullscreen'), edd;

                ed.focus();
                edd = tinyMCE.get( ed.getParam('nxt_fullscreen_editor_id') );

                edd.setContent( ed.getContent({format : 'raw'}), {format : 'raw'} );
            });

            ed.addCommand('nxtFullScreenInit', function() {
                var d, b, fsed;

                ed = (tinyMCE.editors.length > 0) ? tinyMCE.editors[0] : tinymce.get('content');
                d = ed.getDoc();
                b = d.body;

                tinyMCE.oldSettings = tinyMCE.settings; // Store old settings

                tinymce.each(ed.settings, function(v, n) {
                    s[n] = v;
                });

                s.id = 'nxt_mce_fullscreen';
                s.nxt_fullscreen_is_enabled = true;
                s.nxt_fullscreen_editor_id = ed.id;
                s.theme_advanced_resizing = false;
                s.theme_advanced_statusbar_location = 'none';
                s.content_css = s.content_css ? s.content_css + ',' + s.nxt_fullscreen_content_css : s.nxt_fullscreen_content_css;
                s.height = tinymce.isIE ? b.scrollHeight : b.offsetHeight;

                tinymce.each(ed.getParam('nxt_fullscreen_settings'), function(v, k) {
                    s[k] = v;
                });

                fsed = new tinymce.Editor('nxt_mce_fullscreen', s);
                fsed.onInit.add(function(edd) {
                    var DOM = tinymce.DOM, buttons = DOM.select('a.mceButton', DOM.get('nxt-fullscreen-buttons'));

                    if ( !ed.isHidden() )
                        edd.setContent( ed.getContent() );
                    else
                        edd.setContent( switchEditors.nxtautop( edd.getElement().value ) );

                    setTimeout(function(){ // add last
                        edd.onNodeChange.add(function(ed, cm, e){
                            tinymce.each(buttons, function(c) {
                                var btn, cls;

                                if ( btn = DOM.get( 'nxt_mce_fullscreen_' + c.id.substr(6) ) ) {
                                    cls = btn.className;

                                    if ( cls )
                                        c.className = cls;
                                }
                            });
                        });
                    }, 1000);

                    edd.dom.addClass(edd.getBody(), 'nxt-fullscreen-editor');
                    edd.focus();
                });

                fsed.render();

                if ( 'undefined' != fullscreen ) {
                    fsed.dom.bind( fsed.dom.doc, 'mousemove', function(e){
                        fullscreen.bounder( 'showToolbar', 'hideToolbar', 2000, e );
                    });
                }
            });

            // Register buttons
            if ( 'undefined' != fullscreen ) {
                ed.addButton('nxt_fullscreen', {
                    title : 'fullscreen.desc',
                    onclick : function(){ fullscreen.on(); }
                });
            }

            // END fullscreen
//----------------------------------------------------------------
            // START autoresize

            if ( ed.getParam('fullscreen_is_enabled') || !ed.getParam('nxt_fullscreen_is_enabled') )
                return;

            /**
             * This method gets executed each time the editor needs to resize.
             */
            function resize() {

                if ( resized )
                    return;

                var d = ed.getDoc(), DOM = tinymce.DOM, resizeHeight, myHeight;

                // Get height differently depending on the browser used
                if ( tinymce.isIE )
                    myHeight = d.body.scrollHeight;
                else
                    myHeight = d.documentElement.offsetHeight;

                // Don't make it smaller than 300px
                resizeHeight = (myHeight > 300) ? myHeight : 300;

                // Resize content element
                if ( oldHeight != resizeHeight ) {
                    oldHeight = resizeHeight;
                    resized = true;
                    setTimeout(function(){ resized = false; }, 100);

                    DOM.setStyle(DOM.get(ed.id + '_ifr'), 'height', resizeHeight + 'px');
                }
            };

            // Add appropriate listeners for resizing content area
            ed.onInit.add(function(ed, l) {
                ed.onChange.add(resize);
                ed.onSetContent.add(resize);
                ed.onPaste.add(resize);
                ed.onKeyUp.add(resize);
                ed.onPostRender.add(resize);

                ed.getBody().style.overflowY = "hidden";
            });

            if (ed.getParam('autoresize_on_init', true)) {
                ed.onLoadContent.add(function(ed, l) {
                    // Because the content area resizes when its content CSS loads,
                    // and we can't easily add a listener to its onload event,
                    // we'll just trigger a resize after a short loading period
                    setTimeout(function() {
                        resize();
                    }, 1200);
                });
            }

            // Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
            ed.addCommand('nxtAutoResize', resize);
        },

        getInfo : function() {
            return {
                longname : 'nxt Fullscreen',
                author : 'NXTClass',
                authorurl : 'http://nxtclass.org',
                infourl : '',
                version : '1.0'
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('nxtfullscreenFixed', tinymce.plugins.nxtFullscreenPlugin);
});