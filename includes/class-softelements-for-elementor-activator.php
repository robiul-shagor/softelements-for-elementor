<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.softhopper.net/
 * @since      1.0.0
 *
 * @package    Softelements_For_Elementor
 * @subpackage Softelements_For_Elementor/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Softelements_For_Elementor
 * @subpackage Softelements_For_Elementor/includes
 * @author     SoftHopper <admin@softhopper.net>
 */
class Softelements_For_Elementor_Activator {
	/**
	 * A reference to an instance of this class.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    object
	 */
	private static $instance = null;

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() {
		// Check for required PHP version
		if ( version_compare( PHP_VERSION, SOFTELEMENTS_MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( &$this, 'required_php_version_missing_notice' ) );
			return;
		}
	
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( &$this, 'elementor_missing_notice' ) );
			return;
		}
	
		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, SOFTELEMENTS_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( &$this, 'required_elementor_version_missing_notice') );
			return;
		}
	}

	/**
	 * Admin notice for required php version
	 *
	 * @return void
	 */

	public function required_php_version_missing_notice() {
		$notice = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'softelements-for-elementor' ),
			'<strong>' . esc_html__( 'softelements-for-elementor', 'softelements-for-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'softelements-for-elementor' ) . '</strong>',
			SOFTELEMENTS_MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
	}

	/**
	 * Admin notice for elementor if missing
	 *
	 * @return void
	 */
	public function elementor_missing_notice() {

		if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
			$notice_title = __( 'Activate Elementor', 'softelements-for-elementor' );
			$notice_url = wp_nonce_url( 'plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php' );
		} else {
			$notice_title = __( 'Install Elementor', 'softelements-for-elementor' );
			$notice_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
		}

		$notice = softelments_kses_intermediate( sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Elementor installation link */
			__( '%1$s requires %2$s to be installed and activated to function properly. %3$s', 'softelements-for-elementor' ),
			'<strong>' . __( 'Softelements For Elementor', 'softelements-for-elementor' ) . '</strong>',
			'<strong>' . __( 'Elementor', 'softelements-for-elementor' ) . '</strong>',
			'<a href="' . esc_url( $notice_url ) . '">' . $notice_title . '</a>'
		) );

		printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
	}


	/**
	 * Admin notice for required elementor version
	 *
	 * @return void
	 */
	public function required_elementor_version_missing_notice() {
		$notice = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'softelements-for-elementor' ),
			'<strong>' . esc_html__( 'Softelements For Elementor', 'softelements-for-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'softelements-for-elementor' ) . '</strong>',
			SOFTELEMENTS_MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
	}
}

/**
 * Returns instance of Woo_Product_Widgets_Elementor_Settings
 *
 * @return object
 */
function softelements_addon_loaders() {
	return Softelements_For_Elementor_Activator::get_instance();
}