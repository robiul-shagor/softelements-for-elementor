<?php

/**
 * Helper functions
 *
 * @package Uidons
 */
defined('ABSPATH') || die();

/**
 * Call a shortcode function by tag name.
 *
 * @since  1.0.0
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
function softelments_do_shortcode($tag, array $atts = [], $content = null) {
	global $shortcode_tags;
	if (!isset($shortcode_tags[$tag])) {
		return false;
	}
	return call_user_func($shortcode_tags[$tag], $atts, $content, $tag);
}

/**
 * Sanitize html class string
 *
 * @param $class
 * @return string
 */
function softelments_sanitize_html_class_param($class) {
	$classes   = !empty($class) ? explode(' ', $class) : [];
	$sanitized = [];
	if (!empty($classes)) {
		$sanitized = array_map(function ($cls) {
			return sanitize_html_class($cls);
		}, $classes);
	}
	return implode(' ', $sanitized);
}

function softelments_is_script_debug_enabled() {
	return (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG);
}

/**
 * @param $settings
 * @param array $field_map
 */

function softelments_prepare_data_prop_settings(&$settings, $field_map = []) {
	$data = [];
	foreach ($field_map as $key => $data_key) {
		$setting_value                          = softelments_get_setting_value($settings, $key);
		list($data_field_key, $data_field_type) = explode('.', $data_key);
		$validator                              = $data_field_type . 'val';

		if (is_callable($validator)) {
			$val = call_user_func($validator, $setting_value);
		} else {
			$val = $setting_value;
		}
		$data[$data_field_key] = $val;
	}
	return wp_json_encode($data);
}

/**
 * @param $settings
 * @param $keys
 * @return mixed
 */
function softelments_get_setting_value(&$settings, $keys) {
	if (!is_array($keys)) {
		$keys = explode('.', $keys);
	}
	if (is_array($settings[$keys[0]])) {
		return softelments_get_setting_value($settings[$keys[0]], array_slice($keys, 1));
	}
	return $settings[$keys[0]];
}

function softelments_is_localhost() {
	return isset($_SERVER['REMOTE_ADDR']) && in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']);
}

function softelments_get_css_cursors() {
	return [
		'default'      => __('Default', 'softelements-for-elementor'),
		'alias'        => __('Alias', 'softelements-for-elementor'),
		'all-scroll'   => __('All scroll', 'softelements-for-elementor'),
		'auto'         => __('Auto', 'softelements-for-elementor'),
		'cell'         => __('Cell', 'softelements-for-elementor'),
		'context-menu' => __('Context menu', 'softelements-for-elementor'),
		'col-resize'   => __('Col-resize', 'softelements-for-elementor'),
		'copy'         => __('Copy', 'softelements-for-elementor'),
		'crosshair'    => __('Crosshair', 'softelements-for-elementor'),
		'e-resize'     => __('E-resize', 'softelements-for-elementor'),
		'ew-resize'    => __('EW-resize', 'softelements-for-elementor'),
		'grab'         => __('Grab', 'softelements-for-elementor'),
		'grabbing'     => __('Grabbing', 'softelements-for-elementor'),
		'help'         => __('Help', 'softelements-for-elementor'),
		'move'         => __('Move', 'softelements-for-elementor'),
		'n-resize'     => __('N-resize', 'softelements-for-elementor'),
		'ne-resize'    => __('NE-resize', 'softelements-for-elementor'),
		'nesw-resize'  => __('NESW-resize', 'softelements-for-elementor'),
		'ns-resize'    => __('NS-resize', 'softelements-for-elementor'),
		'nw-resize'    => __('NW-resize', 'softelements-for-elementor'),
		'nwse-resize'  => __('NWSE-resize', 'softelements-for-elementor'),
		'no-drop'      => __('No-drop', 'softelements-for-elementor'),
		'not-allowed'  => __('Not-allowed', 'softelements-for-elementor'),
		'pointer'      => __('Pointer', 'softelements-for-elementor'),
		'progress'     => __('Progress', 'softelements-for-elementor'),
		'row-resize'   => __('Row-resize', 'softelements-for-elementor'),
		's-resize'     => __('S-resize', 'softelements-for-elementor'),
		'se-resize'    => __('SE-resize', 'softelements-for-elementor'),
		'sw-resize'    => __('SW-resize', 'softelements-for-elementor'),
		'text'         => __('Text', 'softelements-for-elementor'),
		'url'          => __('URL', 'softelements-for-elementor'),
		'w-resize'     => __('W-resize', 'softelements-for-elementor'),
		'wait'         => __('Wait', 'softelements-for-elementor'),
		'zoom-in'      => __('Zoom-in', 'softelements-for-elementor'),
		'zoom-out'     => __('Zoom-out', 'softelements-for-elementor'),
		'none'         => __('None', 'softelements-for-elementor'),
	];
}

function softelments_get_css_blend_modes() {
	return [
		'normal'      => __('Normal', 'softelements-for-elementor'),
		'multiply'    => __('Multiply', 'softelements-for-elementor'),
		'screen'      => __('Screen', 'softelements-for-elementor'),
		'overlay'     => __('Overlay', 'softelements-for-elementor'),
		'darken'      => __('Darken', 'softelements-for-elementor'),
		'lighten'     => __('Lighten', 'softelements-for-elementor'),
		'color-dodge' => __('Color Dodge', 'softelements-for-elementor'),
		'color-burn'  => __('Color Burn', 'softelements-for-elementor'),
		'saturation'  => __('Saturation', 'softelements-for-elementor'),
		'difference'  => __('Difference', 'softelements-for-elementor'),
		'exclusion'   => __('Exclusion', 'softelements-for-elementor'),
		'hue'         => __('Hue', 'softelements-for-elementor'),
		'color'       => __('Color', 'softelements-for-elementor'),
		'luminosity'  => __('Luminosity', 'softelements-for-elementor'),
	];
}

/**
 * Check elementor version
 *
 * @param string $version
 * @param string $operator
 * @return bool
 */
function softelments_is_elementor_version($operator = '<', $version = '2.6.0') {
	return defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, $version, $operator);
}

/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */
function softelments_render_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = []) {
	// Check if its already migrated
	$migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
	// Check if its a new widget without previously selected icon using the old Icon control
	$is_new = empty($settings[$old_icon_id]);

	$attributes['aria-hidden'] = 'true';

	if (softelments_is_elementor_version('>=', '2.6.0') && ($is_new || $migrated)) {
		\Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);
	} else {
		if (empty($attributes['class'])) {
			$attributes['class'] = $settings[$old_icon_id];
		} else {
			if (is_array($attributes['class'])) {
				$attributes['class'][] = $settings[$old_icon_id];
			} else {
				$attributes['class'] .= ' ' . $settings[$old_icon_id];
			}
		}
		printf('<i %s></i>', \Elementor\Utils::render_html_attributes($attributes));
	}
}

/**
 * List of happy icons
 *
 * @return array
 */
function softelments_get_happy_icons() {
	return \Uidons\Elementor\Icons_Manager::get_happy_icons();
}

/**
 * Get elementor instance
 *
 * @return \Elementor\Plugin
 */
function softelments_elementor() {
	return \Elementor\Plugin::instance();
}

/**
 * Escaped title html tags
 *
 * @param string $tag input string of title tag
 * @return string $default default tag will be return during no matches
 */

function softelments_escape_tags($tag, $default = 'span', $extra = []) {

	$supports = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p'];

	$supports = array_merge($supports, $extra);

	if (!in_array($tag, $supports, true)) {
		return $default;
	}

	return $tag;
}

/**
 * Get a list of all the allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return array
 */
function softelments_get_allowed_html_tags($level = 'basic') {
	$allowed_html = [
		'b'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'i'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'u'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		's'      => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'br'     => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'em'     => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'del'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'ins'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'sub'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'sup'    => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'code'   => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'mark'   => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'small'  => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'strike' => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'abbr'   => [
			'title' => [],
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'span'   => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
		'strong' => [
			'class' => [],
			'id'    => [],
			'style' => [],
		],
	];

	if ('intermediate' === $level) {
		$tags = [
			'a'       => [
				'href'  => [],
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'q'       => [
				'cite'  => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'img'     => [
				'src'    => [],
				'alt'    => [],
				'height' => [],
				'width'  => [],
				'class'  => [],
				'id'     => [],
				'style'  => [],
			],
			'dfn'     => [
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'time'    => [
				'datetime' => [],
				'class'    => [],
				'id'       => [],
				'style'    => [],
			],
			'cite'    => [
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'acronym' => [
				'title' => [],
				'class' => [],
				'id'    => [],
				'style' => [],
			],
			'hr'      => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
		];

		$allowed_html = array_merge($allowed_html, $tags);
	}

	return $allowed_html;
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function softelments_kses_intermediate($string = '') {
	return wp_kses($string, softelments_get_allowed_html_tags('intermediate'));
}

/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param string $string
 * @return string
 */
function softelments_kses_basic($string = '') {
	return wp_kses($string, softelments_get_allowed_html_tags('basic'));
}

/**
 * Get a translatable string with allowed html tags.
 *
 * @param string $level Allowed levels are basic and intermediate
 * @return string
 */
function softelments_get_allowed_html_desc($level = 'basic') {
	if (!in_array($level, ['basic', 'intermediate'])) {
		$level = 'basic';
	}

	$tags_str = '<' . implode('>,<', array_keys(softelments_get_allowed_html_tags($level))) . '>';
	return sprintf(__('This input field has support for the following HTML tags: %1$s', 'softelements-for-elementor'), '<code>' . esc_html($tags_str) . '</code>');
}

function softelments_has_pro() {
	return defined('softelments_PRO_VERSION');
}

function softelments_get_b64_icon() {
	return 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiI+PGcgZmlsbD0iI0ZGRiI+PHBhdGggZD0iTTI4LjYgNy44aC44Yy41IDAgLjktLjUuOC0xIDAtLjUtLjUtLjktMS0uOC0zLjUuMy02LjgtMS45LTcuOC01LjMtLjEtLjUtLjYtLjctMS4xLS42cy0uNy42LS42IDEuMWMxLjIgMy45IDQuOSA2LjYgOC45IDYuNnoiLz48cGF0aCBkPSJNMzAgMTEuMWMtLjMtLjYtLjktMS0xLjYtMS0uOSAwLTEuOSAwLTIuOC0uMi00LS44LTctMy42LTguNC03LjEtLjMtLjYtLjktMS4xLTEuNi0xQzguMyAxLjkgMS44IDcuNC45IDE1LjEuMSAyMi4yIDQuNSAyOSAxMS4zIDMxLjIgMjAgMzQuMSAyOSAyOC43IDMwLjggMTkuOWMuNy0zLjEuMy02LjEtLjgtOC44em0tMTEuNiAxLjFjLjEtLjUuNi0uOCAxLjEtLjdsMy43LjhjLjUuMS44LjYuNyAxLjFzLS42LjgtMS4xLjdsLTMuNy0uOGMtLjQtLjEtLjgtLjYtLjctMS4xek0xMC4xIDExYy4yLTEuMSAxLjQtMS45IDIuNS0xLjYgMS4xLjIgMS45IDEuNCAxLjYgMi41LS4yIDEuMS0xLjQgMS45LTIuNSAxLjYtMS0uMi0xLjgtMS4zLTEuNi0yLjV6bTE0LjYgMTAuNkMyMi44IDI2IDE3LjggMjguNSAxMyAyN2MtMy42LTEuMi02LjItNC41LTYuNS04LjItLjEtMSAuOC0xLjcgMS43LTEuNmwxNS40IDIuNWMuOSAwIDEuNCAxIDEuMSAxLjl6Ii8+PHBhdGggZD0iTTE3LjEgMjIuOGMtMS45LS40LTMuNy4zLTQuNyAxLjctLjIuMy0uMS43LjIuOS42LjMgMS4yLjUgMS45LjcgMS44LjQgMy43LjEgNS4xLS43LjMtLjIuNC0uNi4yLS45LS43LS45LTEuNi0xLjUtMi43LTEuN3oiLz48L2c+PC9zdmc+';
}

/**
 * @param $suffix
 */
function softelments_get_dashboard_link($suffix = '#home') {
	return add_query_arg(['page' => 'happy-addons' . $suffix], admin_url('admin.php'));
}

/**
 * @return mixed
 */
function softelments_get_current_user_display_name() {
	$user = wp_get_current_user();
	$name = 'user';
	if ($user->exists() && $user->display_name) {
		$name = $user->display_name;
	}
	return $name;
}

/**
 * Get All Post Types
 * @param array $args
 * @param array $diff_key
 * @return array|string[]|WP_Post_Type[]
 */
function softelments_get_post_types($args = [], $diff_key = []) {
	$default = [
		'public'            => true,
		'show_in_nav_menus' => true,
	];
	$args       = array_merge($default, $args);
	$post_types = get_post_types($args, 'objects');
	$post_types = wp_list_pluck($post_types, 'label', 'name');

	if (!empty($diff_key)) {
		$post_types = array_diff_key($post_types, $diff_key);
	}
	return $post_types;
}

/**
 * Get All Taxonomies
 * @param array $args
 * @param string $output
 * @param bool $list
 * @param array $diff_key
 * @return array|string[]|WP_Taxonomy[]
 */
function softelments_get_taxonomies($args = [], $output = 'object', $list = true, $diff_key = []) {

	$taxonomies = get_taxonomies($args, $output);
	if ('object' === $output && $list) {
		$taxonomies = wp_list_pluck($taxonomies, 'label', 'name');
	}

	if (!empty($diff_key)) {
		$taxonomies = array_diff_key($taxonomies, $diff_key);
	}

	return $taxonomies;
}

if (!function_exists('softelments_get_section_icon')) {
	/**
	 * Get happy addons icon for panel section heading
	 *
	 * @return string
	 */
	function softelments_get_section_icon() {
		return '<i style="float: right" class="uidons ui-dons uidons-section-icon"></i>';
	}
}

/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */
function softelments_render_button_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = []) {
	// Check if its already migrated
	$migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
	// Check if its a new widget without previously selected icon using the old Icon control
	$is_new = empty($settings[$old_icon_id]);

	$attributes['aria-hidden'] = 'true';
	$is_svg                    = (isset($settings[$new_icon_id], $settings[$new_icon_id]['library']) && 'svg' === $settings[$new_icon_id]['library']);

	if (softelments_is_elementor_version('>=', '2.6.0') && ($is_new || $migrated)) {
		if ($is_svg) {
			echo '<span class="uidons-btn-icon uidons-btn-icon--svg">';
		}
		\Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);
		if ($is_svg) {
			echo '</span>';
		}
	} else {
		if (empty($attributes['class'])) {
			$attributes['class'] = $settings[$old_icon_id];
		} else {
			if (is_array($attributes['class'])) {
				$attributes['class'][] = $settings[$old_icon_id];
			} else {
				$attributes['class'] .= ' ' . $settings[$old_icon_id];
			}
		}
		printf('<i %s></i>', \Elementor\Utils::render_html_attributes($attributes));
	}
}

/**
 * Get database settings of a widget by widget id and element
 *
 * @param array $elements
 * @param string $widget_id
 * @param array $value
 */

function softelments_get_ele_widget_element_settings($elements, $widget_id) {

	if (is_array($elements)) {
		foreach ($elements as $d) {
			if ($d && !empty($d['id']) && $d['id'] == $widget_id) {
				return $d;
			}
			if ($d && !empty($d['elements']) && is_array($d['elements'])) {
				$value = softelments_get_ele_widget_element_settings($d['elements'], $widget_id);
				if ($value) {
					return $value;
				}
			}
		}
	}

	return false;
}

/**
 * Get database settings of a widget by widget id and post id
 *
 * @param number $post_id
 * @param string $widget_id
 * @param array
 */

function softelments_get_ele_widget_settings($post_id, $widget_id) {

	$elementor_data = @json_decode(get_post_meta($post_id, '_elementor_data', true), true);

	if ($elementor_data) {
		$element = softelments_get_ele_widget_element_settings($elementor_data, $widget_id);
		return isset($element['settings'])? $element['settings']: '';
	}

	return false;
}

/**
 * get credentials function
 *
 * @param string $key
 *
 * @return void
 * @since 1.0.0
 */
function softelments_get_credentials($key = '') {
	if ( ! class_exists( 'Uidons\Elementor\Credentials_Manager' ) ) {
    	include_once( softelments_DIR_PATH . 'classes/credentials-manager.php' );
	}
	$creds = Uidons\Elementor\Credentials_Manager::get_saved_credentials();
	if(!empty($key)) {
		return isset($creds[$key])? $creds[$key]: esc_html__('invalid key', 'softelements-for-elementor');
	}
	return $creds;
}

/**
 * Get plugin missing notice
 *
 * @param string $plugin
 * @return void
 */
function softelments_show_plugin_missing_alert( $plugin ) {
	if ( current_user_can( 'activate_plugins' ) && $plugin ) {
		printf(
			'<div %s>%s</div>',
			'style="margin: 1rem;padding: 1rem 1.25rem;border-left: 5px solid #f5c848;color: #856404;background-color: #fff3cd;"',
			$plugin . __( ' is missing! Please install and activate ', 'softelements-for-elementor' ) . $plugin . '.'
			);
	}
}