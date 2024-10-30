
(function() {
    tinymce.PluginManager.add('mybutton', function( editor, url ) {
        editor.addButton( 'mybutton', {
            text: tinyMCE_object.button_name,
            icon: false,
            onclick: function() {
				
				
                editor.windowManager.open( {
                    title: tinyMCE_object.button_title,
                    body: [
                       
                        {
                            type   : 'container',
                            name   : 'container',
                            label  : '[bs-faqs-list]',
                       },
                       
                    ],
                    onsubmit: function( e ) {
                        editor.insertContent( '[bs-faqs-list]');
                    }
                });
            },
        });
    });
 
})();




