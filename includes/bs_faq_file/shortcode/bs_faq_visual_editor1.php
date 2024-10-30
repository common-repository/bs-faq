<?php

add_action( 'after_setup_theme', 'mytheme_theme_setup' );
 
if ( ! function_exists( 'mytheme_theme_setup' ) ) {
    function mytheme_theme_setup() {
		
		$showEditorHelper = (array)get_option('bs_faq_register_setting');
		$showEditorHelperValue = $showEditorHelper['show_editor_helper'];
		if($showEditorHelperValue): 
        add_action( 'init', 'mytheme_buttons' );
		endif;
 
    }
}
 
/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'mytheme_buttons' ) ) {
    function mytheme_buttons() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }
 
        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }
 
        add_filter( 'mce_external_plugins', 'mytheme_add_buttons' );
        add_filter( 'mce_buttons', 'mytheme_register_buttons' );
    }
}
 
if ( ! function_exists( 'mytheme_add_buttons' ) ) {
    function mytheme_add_buttons( $plugin_array ) {
        $plugin_array['mybutton'] = plugin_dir_url( __FILE__ ) . 'tinymce_buttons.php';
        return $plugin_array;
    }
}
 
if ( ! function_exists( 'mytheme_register_buttons' ) ) {
    function mytheme_register_buttons( $buttons ) {
        array_push( $buttons, 'mybutton' );
        return $buttons;
    }
}
 
add_action ( 'after_wp_tiny_mce', 'mytheme_tinymce_extra_vars' );
 
if ( !function_exists( 'mytheme_tinymce_extra_vars' ) ) {
	function mytheme_tinymce_extra_vars() { ?>
		<script type="text/javascript">
			var tinyMCE_object = <?php echo json_encode(
				array(
					'button_name' => esc_html__('BS FAQ List', 'mythemeslug'),
					'button_title' => esc_html__('Insert BS FAQ Shortcode', 'mythemeslug'),
					'image_title' => esc_html__('Image', 'mythemeslug'),
					'image_button_title' => esc_html__('Upload image', 'mythemeslug'),
				)
				);
			?>;
		</script><?php
	}
}