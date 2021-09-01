<?php
/**
 * Plugin Name:       Softelements For Elementor
 * Plugin URI:        #
 * Description:       Additional highly customizable widgets for Elementor page builder
 * Version:           1.0.0
 * Author:            SoftHopper
 * Author URI:        https://www.softhopper.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       softelements-for-elementor
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
define( 'SOFTELEMENTS_VERSION', '1.0.0' );
define( 'SOFTELEMENTS_FILE', __FILE__ );
define( 'SOFTELEMENTS_DIR_PATH', plugin_dir_path( SOFTELEMENTS_FILE ) );
define( 'SOFTELEMENTS_DIR_URL', plugin_dir_url( SOFTELEMENTS_FILE ) );
define( 'SOFTELEMENTS_ASSETS', trailingslashit( SOFTELEMENTS_DIR_URL . 'assets' ) );
define( 'SOFTELEMENTS_REDIRECTION_FLAG', 'softelements_do_activation_direct' );
define( 'SOFTELEMENTS_MINIMUM_ELEMENTOR_VERSION', '2.9.0' );
define( 'SOFTELEMENTS_MINIMUM_PHP_VERSION', '5.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-softelements-for-elementor-activator.php
 */
function load_softelements_for_elementor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-softelements-for-elementor-activator.php';
	softelements_addon_loaders()->activate();
}
add_action( 'plugins_loaded', 'load_softelements_for_elementor' );

/**
 * Register actions that should run on activation
 *
 * @return void
 */
function activate_softelements_for_elementor() {
	add_option( SOFTELEMENTS_REDIRECTION_FLAG, true );
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-softelements-for-elementor-deactivator.php
 */
function deactivate_softelements_for_elementor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-softelements-for-elementor-deactivator.php';
	Softelements_For_Elementor_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_softelements_for_elementor' );
register_deactivation_hook( __FILE__, 'deactivate_softelements_for_elementor' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-softelements-for-elementor.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_softelements_for_elementor() {

	$plugin = new Softelements_For_Elementor();
	$plugin->run();

}
run_softelements_for_elementor();