<?php
/**
 *
 * A collection of Custom Post Types and Widgets, suitable for tour agencies and tour operators. Compatible with and extends "Tour & Activity Operator Plugin for TourCMS".
 *
 * @package   Tour Agency
 * @author    Cormac Bracken <cormac@redhotlemon.com>
 * @license   GPL-2.0+
 * @link      http://redhotlemon.com
 * @copyright 2014 Red Hot Lemon
 *
 * @wordpress-plugin
 * Plugin Name:       Tour Agency
 * Plugin URI:        http://redhotlemon.com/plugins/tour-agency
 * Description:       A collection of Custom Post Types and Widgets, suitable for tour agencies and tour operators.
 * Version:           1.0.0
 * Author:            Cormac Bracken
 * Author URI:        http://redhotlemon.com
 * Text Domain:       tour-agency
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/CormacBracken/tour-agency-wp-plugin
 */

 
include( plugin_dir_path( __FILE__ ) . 'tour-itinerary-widget.php' );
include( plugin_dir_path( __FILE__ ) . 'tour-booking-widget.php' );

function load_widgets () {
	register_widget( "Tour_Itinerary" );
	register_widget( "Tour_Booking");
}

add_action( 'widgets_init', 'load_widgets' );
