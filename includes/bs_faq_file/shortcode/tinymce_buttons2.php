
(function() {
    tinymce.PluginManager.add('mybutton2', function( editor, url ) {
        editor.addButton( 'mybutton2', {
            text: tinyMCE_object2.button_name2,
            icon: false,
            onclick: function() {
				
				
                editor.windowManager.open( {
                    title: tinyMCE_object2.button_title2,
                    body: [
                       
                        {
                            type   : 'container',
                            name   : 'container',
                            label  : "[bs-faqs category='Enter Your Category Name Here']",
                       },
                       
                    ],
                    onsubmit: function( e ) {
                        editor.insertContent( "[bs-faqs category='Enter Your Category Name Here']");
                    }
                });
            },
        });
    });
 
})();




