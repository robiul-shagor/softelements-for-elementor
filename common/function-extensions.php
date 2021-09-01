<?php
/**
 * Filters function defination
 *
 * @package softelements
 * @since 1.0.0
 * @author softelements
 *
 */
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'softelements_is_adminbar_menu_enabled' ) ) {
	/**
	 * Check if Adminbar is enabled
	 *
	 * @return bool
	 */
	function softelements_is_adminbar_menu_enabled() {
		return apply_filters( 'softelements/extensions/adminbar_menu', true );
	}
}

if ( ! function_exists( 'softelements_is_background_overlay_enabled' ) ) {
	/**
	 * Check if Background Overlay is enabled
	 *
	 * @return bool
	 */
	function softelements_is_background_overlay_enabled() {
		return apply_filters( 'softelements/extensions/background_overlay', true );
	}
}

if ( ! function_exists( 'softelements_is_css_transform_enabled' ) ) {
	/**
	 * Check if CSS Transform is enabled
	 *
	 * @return bool
	 */
	function softelements_is_css_transform_enabled() {
		return apply_filters( 'softelements/extensions/css_transform', true );
	}
}

if ( ! function_exists( 'softelements_is_floating_effects_enabled' ) ) {
	/**
	 * Check if Floating Effects is enabled
	 *
	 * @return bool
	 */
	function softelements_is_floating_effects_enabled() {
		return apply_filters( 'softelements/extensions/floating_effects', true );
	}
}

if ( ! function_exists( 'softelements_is_grid_layer_enabled' ) ) {
	/**
	 * Check if Grid Layer is enabled
	 *
	 * @return bool
	 */
	function softelements_is_grid_layer_enabled() {
		return apply_filters( 'softelements/extensions/grid_layer', true );
	}
}

if ( ! function_exists( 'softelements_is_wrapper_link_enabled' ) ) {
	/**
	 * Check if Wrapper Link is enabled
	 *
	 * @return bool
	 */
	function softelements_is_wrapper_link_enabled() {
		return apply_filters( 'softelements/extensions/wrapper_link', true );
	}
}

if ( ! function_exists( 'softelements_is_clone_enabled' ) ) {
	/**
	 * Check if Clone is enabled
	 *
	 * @return bool
	 */
	function softelements_is_clone_enabled() {
		return apply_filters( 'softelements/extensions/happy_clone', true );
	}
}

if ( ! function_exists( 'softelements_is_on_demand_cache_enabled' ) ) {
	/**
	 * Check if On Demand Cache is enabled
	 *
	 * @return bool
	 */
	function softelements_is_on_demand_cache_enabled() {
		return apply_filters( 'softelements/extensions/on_demand_cache', true );
	}
}

if ( ! function_exists( 'softelements_is_equal_height_enabled' ) ) {
	/**
	 * Check if equal height is enabled
	 *
	 * @return bool
	 */
	function softelements_is_equal_height_enabled() {
		return apply_filters( 'softelements/extensions/equal_height', true );
	}
}

if ( ! function_exists( 'softelements_is_shape_divider_enabled' ) ) {
	/**
	 * Check if Shape Divider is enabled
	 *
	 * @return bool
	 */
	function softelements_is_shape_divider_enabled() {
		return apply_filters( 'softelements/extensions/shape_divider', true );
	}
}
