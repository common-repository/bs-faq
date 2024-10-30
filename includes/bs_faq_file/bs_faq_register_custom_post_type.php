<?php 
/**
* 	custom post type
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Bs_faq_custom_post
{
	
	public function __construct()
	{
		add_action('init', array($this,'register_bs_faq_custom_post_type') );
	}
function register_bs_faq_custom_post_type(){
  register_post_type( 'bs_faq',
		array(
		'labels' => array(
		'name' => __('BS FAQ','bs_faq_plugin'),
		'singular_name' => __('BS FAQ','bs_faq_plugin'),
		'add_new' => __('Add New','bs_faq_plugin'),
		'add_new_item' =>__( 'Add New FAQ','bs_faq_plugin'),
		'edit' => __('Edit','bs_faq_plugin'),
		'edit_item' => __('Edit FAQ','bs_faq_plugin'),
		'new_item' => __('New FAQ Review','bs_faq_plugin'),
		'view' => __('View','bs_faq_plugin'),
		'view_item' => __('View FAQ','bs_faq_plugin'),
		'search_items' => __('Search','bs_faq_plugin'),
		'not_found' => __('No FAQ found','bs_faq_plugin'),
		'not_found_in_trash' =>__('No FAQ found in Trash','bs_faq_plugin'),
		'parent' => __('Parent FAQ','bs_faq_plugin')
		),
		'public' => true,
		'menu_position' => 20,
		'supports' =>
		array( 'title', 'editor', 'comments',
		'thumbnail','page-attributes'),
		'taxonomies' => array( '' ),
		'menu_icon' =>
		  plugins_url( 'bs_faq_icon.png', __FILE__ ),
		'has_archive' => true,
		'exclude_from_search' => true
		
		)
    );
	
register_taxonomy(
		'bs_faq_type',
		'bs_faq',
		array(
		'labels'			 => array('name' => 'Category'),
		'add_new_item'		 => __('Add New Category','bs_faq_plugin'),
		'new_item_name'		 => __('New Category Name','bs_faq_plugin'),
		//'show_ui' 			 => true,
		//'show_tagcloud'		 => false,
		'separate_items_with_commas' => __( 'Separate FAQ','bs_faq_plugin'),		
		'show_in_quick_edit' => true,
		'hierarchical'		 => true,
		//'show_admin_column' => true,
		)
		);
		
		
register_taxonomy(
		'bs_faq_tag',
		'bs_faq',
		array(
		'labels'			 => array('name' => 'Tags'),
		
		'separate_items_with_commas' => __( 'Separate TAG','bs_faq_plugin'),		
		'show_in_quick_edit' => false,
		'hierarchical'		 => false,
		
		)
		);
		
		
  }
  
  
}

new Bs_faq_custom_post();
?>