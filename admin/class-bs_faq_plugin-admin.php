<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://bipulsarkar.com/
 * @since      1.0.0
 *
 * @package    Bs_faq_plugin
 * @subpackage Bs_faq_plugin/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bs_faq_plugin
 * @subpackage Bs_faq_plugin/admin
 * @author     Bipul Sarkar <bipulsarkar7@gmail.com>
 */
class Bs_faq_plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;


		add_filter( 'manage_edit-bs_faq_columns',array($this,'bs_faq_add_columns' ));
		add_action( 'manage_posts_custom_column',array($this,'bs_faq_populate_columns' ));

		add_action( 'restrict_manage_posts',array( $this,'bs_faq_category_filter_list') );
		add_filter( 'parse_query', array($this,'bs_faq_category_filter_result' ) );	

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bs_faq_plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bs_faq_plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bs_faq_plugin-admin.css', array(), $this->version, 'all' );


	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bs_faq_plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bs_faq_plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bs_faq_plugin-admin.js', array( 'jquery' ), $this->version, false );

	}



	/*
	 * Add Custom Column in dashboard	
	 */


	function bs_faq_add_columns( $columns ) 
		{
			$columns['display_name'] = 'Display Name';	
			$columns['bs_faq_type'] = 'Category';
			$columns['bs_faq_tag'] = 'Tags';
			$columns['bs_faq_shortcode'] = 'Shortcode';
			unset( $columns['comments'] );
			return $columns;
		}



	/*
	 * Populate custom column with value
	 */

	function bs_faq_populate_columns( $column ) {
		
		if ( 'display_name' == $column ) 
			{
				$display_name = esc_html( get_post_meta( get_the_ID(),'display_name',true ) );
				echo $display_name;
			}

		elseif ( 'bs_faq_type' == $column ) {

				$faq_cateogry = wp_get_post_terms( get_the_ID(),'bs_faq_type' );
					if ( $faq_cateogry) 
						{
							 foreach($faq_cateogry as $type )
								 {
								 	echo $type->name; echo "<br>";
								 }					
						} 

					else {						
							echo "Category Not Assign";
						}

		}
		
		
		elseif ( 'bs_faq_tag' == $column ) {

				$faq_tag = wp_get_post_terms( get_the_ID(),'bs_faq_tag' );
					if ( $faq_tag) 
						{
							 foreach($faq_tag as $tag )
								 {
								 	echo $tag->name;echo " <br>";
								 }					
						} 

					else {						
							echo "Tag Not Assign";
						}

		}
		
		elseif('bs_faq_shortcode' == $column){
			
			$post_status = get_post_status(get_the_ID());
			
			if($post_status == 'publish'):

			$post_id = get_the_ID();
			echo "[bs-faq id='" . $post_id . "']";	
			
			endif;
			
		}
	}



	/*
	 * Add category list for filter in dashboard
	 */

	function bs_faq_category_filter_list() 
		{
			$screen = get_current_screen();
			global $wp_query;
			
			if ( 'bs_faq' == $screen->post_type ) 
				{
			
					wp_dropdown_categories( array(
					'show_option_all' 			=> 'Show All Category',
					'taxonomy' 					=> 'bs_faq_type',
					'name' 						=> 'bs_faq_type',
					'orderby' 					=> 'name',
					'selected' 					=>
					( isset( $wp_query->query['bs_faq_type'])
					? $wp_query->query['bs_faq_type'] : ''
					),
					'hierarchical' 				=> false,
					'depth' 					=> 3,
					'show_count' 				=> false,
					'hide_empty' 				=> true,
					) );
				}
		}



	/*
	 * filtering result with category in dashboard
	 */

	function bs_faq_category_filter_result( $query ) 

			{
				$qv = &$query->query_vars;
				if ( isset( $qv['bs_faq_type'] ) &&
				!empty( $qv['bs_faq_type'] ) &&is_numeric( $qv['bs_faq_type'] ) ) 
					{
						$term = get_term_by( 'id', $qv['bs_faq_type'],'bs_faq_type' );
						$qv['bs_faq_type'] = $term->slug;
					}
			}



}














