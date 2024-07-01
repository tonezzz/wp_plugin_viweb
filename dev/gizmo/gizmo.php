<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://surf-thailand.com
 * @since             1.0.0
 * @package           Gizmo
 *
 * @wordpress-plugin
 * Plugin Name:       gizmo
 * Plugin URI:        https://thakarn.gizmo-thailand.com
 * Description:       Customization plugin for Ultimate Brand website.
 * Version:           1.0.0
 * Author:            Tony
 * Author URI:        https://surf-thailand.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gizmo
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
define( 'GIZMO_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gizmo-activator.php
 */
function activate_gizmo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gizmo-activator.php';
	Gizmo_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gizmo-deactivator.php
 */
function deactivate_gizmo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gizmo-deactivator.php';
	Gizmo_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gizmo' );
register_deactivation_hook( __FILE__, 'deactivate_gizmo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gizmo.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gizmo() {

	$plugin = new Gizmo();
	$plugin->run();

}
run_gizmo();

require plugin_dir_path( __FILE__ ) . '_sys/_wp_init.php';
