/**
 * Javascript added to the Visual Editor (TinyMCE)
 *
 * @source: https://www.gavick.com/magazine/adding-your-own-buttons-in-tinymce-4-editor.html#tc-section-4 
 * @since 2014.05.02
 */

(function() {
    tinymce.PluginManager.add( 'sosg_mce_button', function( editor, url ) {
        editor.addButton( 'sosg_mce_button', {
            title: 'SO Simple Gallery',
            icon: 'icon dashicons-images-alt2',
            onclick: function() {
                editor.insertContent( '[so-simple-gallery id=""]' );
            }
        });
    });
})();