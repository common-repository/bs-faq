<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://bipulsarkar.com/
 * @since      1.0.0
 *
 * @package    Bs_faq_plugin
 * @subpackage Bs_faq_plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Bs_faq_plugin
 * @subpackage Bs_faq_plugin/includes
 * @author     Bipul Sarkar <bipulsarkar7@gmail.com>
 */
class Bs_faq_plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'bs_faq_plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
