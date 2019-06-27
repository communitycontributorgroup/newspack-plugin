<?php
/**
 * Site Kit plugin configuration manager.
 *
 * @package Newspack
 */

namespace Newspack;

defined( 'ABSPATH' ) || exit;

require_once NEWSPACK_ABSPATH . '/includes/configuration_managers/class-configuration-manager.php';

/**
 * Provide an interface for configuring and querying the configuration of Google Site Kit.
 */
class Site_Kit_Configuration_Manager extends Configuration_Manager {

	/**
	 * The slug of the plugin.
	 *
	 * @var string
	 */
	public $slug = 'google-site-kit';

	/**
	 * If Site Kit is active and set up, this will return info about all of the modules. Otherwise, this will return an empty array. See link below for array format.
	 *
	 * @see https://github.com/google/site-kit-wp/blob/9a262cd18c33995ce5ec81bc300ff055dff2a153/includes/Core/Modules/Modules.php#L123-L137
	 * @return array
	 */
	public function get_modules_info() {
		return apply_filters( 'googlesitekit_modules_data', array() );
	}

	/**
	 * Get info about one module. See `get_modules_info` docblock for link to info format.
	 * Recognized modules are: 'search-console', 'adsense', 'analytics', 'pagespeed-insights', 'optimize', 'tagmanager'.
	 *
	 * @param string The module slug.
	 * @return array Module info if module is found, otherwise empty array.
	 */
	public function get_module_info( $module ) {
		$modules = $this->get_modules_info();
		if ( empty( $modules[ $module ] ) ) {
			return [];
		}
		return $modules[ $module ];
	}

	/**
	 * Get whether a specific module is configured.
	 *
	 * @param string The module slug. See `get_module_info` for valid slugs.
	 * @return bool Whether the module is configured.
	 */
	public function is_module_configured( $module ) {
		$module_info = $this->get_module_info( $module );
		return ! empty( $module_info['setupComplete'] );
	}

	/**
	 * Get whether the Site Kit plugin is active and set up.
	 *
	 * @return bool Whether Site Kit is active and set up.
	 */
	public function is_configured() {
		return $this->is_active() && ! empty( $this->get_modules_info() );
	}

	/**
	 * Configure Site Kit for Newspack use.
	 * This can't actually do anything, since Site Kit is partially set up in Google.
	 *
	 * @return bool || WP_Error Return true if successful, or WP_Error if not.
	 */
	public function configure() {
		return true;
	}
}