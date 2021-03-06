<?php
/**
 * Main plugin class
 *
 * @package SatisPress
 * @license GPL-2.0-or-later
 * @since 0.3.0
 */

declare ( strict_types = 1 );

namespace SatisPress;

use Cedaro\WP\Plugin\Plugin as BasePlugin;

/**
 * Main plugin class - composition root.
 *
 * @since 0.3.0
 */
class Plugin extends BasePlugin implements Composable {
	/**
	 * Compose the object graph.
	 *
	 * @since 0.3.0
	 */
	public function compose() {
		/**
		 * Start composing the object graph in SatisPress.
		 *
		 * @since 0.3.0
		 */
		do_action( 'satispress_compose' );

		$container = $this->container;

		// Register hook providers.
		$this
			->register_hooks( $container->get( 'hooks.i18n' ) )
			->register_hooks( $container->get( 'hooks.capabilities' ) )
			->register_hooks( $container->get( 'hooks.rewrite_rules' ) )
			->register_hooks( $container->get( 'hooks.ajax.api_key' ) )
			->register_hooks( $container->get( 'hooks.custom_vendor' ) )
			->register_hooks( $container->get( 'hooks.request_handler' ) )
			->register_hooks( $container->get( 'hooks.package_archiver' ) );

		if ( is_admin() ) {
			$this
				->register_hooks( $container->get( 'hooks.upgrade' ) )
				->register_hooks( $container->get( 'hooks.admin_assets' ) )
				->register_hooks( $container->get( 'screen.edit_user' ) )
				->register_hooks( $container->get( 'screen.manage_plugins' ) )
				->register_hooks( $container->get( 'screen.settings' ) );
		}

		if ( \function_exists( 'members_plugin' ) ) {
			$this
				->register_hooks( $container->get( 'plugin.members' ) );
		}

		/**
		 * Finished composing the object graph in SatisPress.
		 *
		 * @since 0.3.0
		 */
		do_action( 'satispress_composed' );
	}
}
