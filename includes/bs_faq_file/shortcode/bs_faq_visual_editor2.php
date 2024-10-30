<?php

add_action( 'after_setup_theme', 'mytheme_theme_setup2' );
 
if ( ! function_exists( 'mytheme_theme_setup2' ) ) {
    function mytheme_theme_setup2() { 
		$showEditorHelper = (array)get_option('bs_faq_register_setting');
		$showEditorHelperValue = $showEditorHelper['show_editor_helper'];
		if($showEditorHelperValue):       
	   add_action( 'init', 'mytheme_buttons2' );
	   endif;
 
    }
}
 
/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'mytheme_buttons2' ) ) {
    function mytheme_buttons2() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }
 
        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }
 
        add_filter( 'mce_external_plugins', 'mytheme_add_buttons2' );
        add_filter( 'mce_buttons', 'mytheme_register_buttons2' );
    }
}
 
if ( ! function_exists( 'mytheme_add_buttons2' ) ) {
    function mytheme_add_buttons2( $plugin_array ) {
        $plugin_array['mybutton2'] = plugin_dir_url( __FILE__ ) . 'tinymce_buttons2.php';
        return $plugin_array;
    }
}
 
if ( ! function_exists( 'mytheme_register_buttons2' ) ) {
    function mytheme_register_buttons2( $buttons2 ) {
        array_push( $buttons2, 'mybutton2' );
        return $buttons2;
    }
}
 
add_action ( 'after_wp_tiny_mce', 'mytheme_tinymce_extra_vars2' );
 
if ( !function_exists( 'mytheme_tinymce_extra_vars2' ) ) {
	function mytheme_tinymce_extra_vars2() { ?>
		<script type="text/javascript">
			var tinyMCE_object2 = <?php echo json_encode(
				array(
					'button_name2' => esc_html__('BS FAQ Category Wise', 'mythemeslug'),
					'button_title2' => esc_html__('Insert BS FAQ Shortcode', 'mythemeslug'),
					
				)
				);
			?>;
		</script><?php
	}
}