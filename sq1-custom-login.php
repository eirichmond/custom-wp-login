<?php

/**
 *
 * @link              http://squareonemd.co.uk
 * @since             1.0.0
 * @package           SQ1_Custom_Login
 *
 * @wordpress-plugin
 * Plugin Name:       SQ1 Custom Page Login
 * Plugin URI:        http://squareonemd.co.uk/
 * Description:       This changes the appearance of the login page.
 * Version:           1.0.0
 * Author:            Elliott Richmond Square One
 * Author URI:        http://squareonemd.co.uk/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sq1-custom-login
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sq1-custom-login-activator.php
 */
function activate_sq1_custom_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sq1-custom-login-activator.php';
	SQ1_Custom_Login_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sq1-custom-login-deactivator.php
 */
function deactivate_sq1_custom_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sq1-custom-login-deactivator.php';
	SQ1_Custom_Login_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sq1_custom_name' );
register_deactivation_hook( __FILE__, 'deactivate_sq1_custom_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sq1-custom-login.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sq1_custom_name() {

	$plugin = new SQ1_Custom_Login();
	$plugin->run();

}
run_sq1_custom_name();
