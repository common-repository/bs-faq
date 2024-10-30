<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://bipulsarkar.com/
 * @since             1.0.0
 * @package           Bs_faq_plugin
 *
 * @wordpress-plugin
 * Plugin Name:       BS FAQ Plugin
 * Plugin URI:        http://bipulsarkar.com/wpplugin/bsfaqplugin
 * Description:       Quick and Easy way to add FAQs
 * Version:           1.0.0
 * Author:            Bipul Sarkar
 * Author URI:        http://bipulsarkar.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bs_faq_plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BS_FAQ_Plugin', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bs_faq_plugin-activator.php
 */
function activate_bs_faq_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bs_faq_plugin-activator.php';
	Bs_faq_plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bs_faq_plugin-deactivator.php
 */
function deactivate_bs_faq_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bs_faq_plugin-deactivator.php';
	Bs_faq_plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bs_faq_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_bs_faq_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bs_faq_plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bs_faq_plugin() {

	$plugin = new Bs_faq_plugin();
	$plugin->run();

}
run_bs_faq_plugin();
