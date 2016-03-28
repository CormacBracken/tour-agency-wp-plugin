<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://redhotlemon.com
 * @since             1.0.0
 * @package           Tour_Agency
 *
 * @wordpress-plugin
 * Plugin Name:       Tour Agency
 * Plugin URI:        https://github.com/CormacBracken/tour-agency-wp-plugin
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Cormac Bracken
 * Author URI:        https://redhotlemon.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tour-agency
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tour-agency-activator.php
 */
function activate_tour_agency() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tour-agency-activator.php';
	Tour_Agency_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tour-agency-deactivator.php
 */
function deactivate_tour_agency() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tour-agency-deactivator.php';
	Tour_Agency_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tour_agency' );
register_deactivation_hook( __FILE__, 'deactivate_tour_agency' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tour-agency.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tour_agency() {

	$plugin = new Tour_Agency();
	$plugin->run();

}
run_tour_agency();
