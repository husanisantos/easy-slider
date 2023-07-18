<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://husani.com.br
 * @since             1.0.0
 * @package           Easy_Slider
 *
 * @wordpress-plugin
 * Plugin Name:       Easy Slider
 * Plugin URI:        https://github.com/husanisantos/easy-slider
 * Description:       Just anhother banner or slider plugin for your images in a rotating and customized way
 * Version:           1.0.0
 * Author:            Husani Santos
 * Author URI:        https://husani.com.br
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       easy-slider
 * Domain Path:       /languages
 */

use App\Easy_Slider;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'EASY_SLIDER_VERSION', '1.0.0' );

/**
 * This is used to automatically load classes with composer
 */
require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

/**
 * Begins execution of the plugin.
 * 
 * @since    1.0.0
 */

new Easy_Slider;


