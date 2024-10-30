<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://bipulsarkar.com/
 * @since      1.0.0
 *
 * @package    Bs_faq_plugin
 * @subpackage Bs_faq_plugin/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Bs_faq_plugin
 * @subpackage Bs_faq_plugin/includes
 * @author     Bipul Sarkar <bipulsarkar7@gmail.com>
 */
class Bs_faq_plugin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Bs_faq_plugin_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'bs_faq_plugin';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Bs_faq_plugin_Loader. Orchestrates the hooks of the plugin.
	 * - Bs_faq_plugin_i18n. Defines internationalization functionality.
	 * - Bs_faq_plugin_Admin. Defines all hooks for the admin area.
	 * - Bs_faq_plugin_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bs_faq_plugin-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bs_faq_plugin-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-bs_faq_plugin-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-bs_faq_plugin-public.php';


		/**
		 * Register bs-faq custom post type
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/bs_faq_register_custom_post_type.php';


		/**
		 * Meta Box
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/metabox/bs_faq_display_name_metabox.php';



		/**
		 * display custom post type with your metaBox
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/bs_faq_single_template.php';


        
         /**
		 * Recent Widget for FAQ
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/bs_faq_recent_widget.php';

		
		  /**
		 * add button in visual editor
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/shortcode/bs_faq_visual_editor1.php';
		
		  /**
		 * add button in visual editor for categoryWise
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/shortcode/bs_faq_visual_editor2.php';


		
		
		  /**
		 * Export Button in custom post type
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/bs_faq_export.php';
		
		

		/**
		 * import Button in custom post type
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/bs_faq_import_data.php';
		
		
		 /**
		 *  BS FAQ Settings Option
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/bs_faq_settings.php';
		
		
		
		
		  /**
		 * Info Submenu
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/bs_faq_info.php';
		
		
		
		/**
		 * BS FAQ List Shortcode
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/shortcode/bs_faq_list.php';
		
		/**
		 * BS FAQ List Shortcode CategoryWise
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/shortcode/bs_faq_list_categorywise.php';
		
		/**
		 * BS FAQ List Shortcode idwise
		 */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bs_faq_file/shortcode/bs_faq_list_idwise.php';
		
	

		$this->loader = new Bs_faq_plugin_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Bs_faq_plugin_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Bs_faq_plugin_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Bs_faq_plugin_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		

		//$this->loader->add_filter( 'manage_edit-bs_faq_sortable_columns', $plugin_admin, 'ch4_br_author_column_sortable' );

		
		

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Bs_faq_plugin_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );



	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Bs_faq_plugin_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
