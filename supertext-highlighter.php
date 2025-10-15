<?php
/**
 * Plugin Name:       SuperText Highlighter
 * Description:       Interactive gradient highlighter demo within the WordPress admin area.
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Version:           1.0.0
 * Author:            SuperText Team
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       supertext-highlighter
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class SuperText_Highlighter_Plugin {
    private const MENU_SLUG = 'supertext-highlighter';

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'register_menu_page' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    public function register_menu_page(): void {
        add_menu_page(
            __( 'SuperText Highlighter', 'supertext-highlighter' ),
            __( 'SuperText Highlighter', 'supertext-highlighter' ),
            'manage_options',
            self::MENU_SLUG,
            [ $this, 'render_admin_page' ],
            'dashicons-edit',
            65
        );
    }

    public function enqueue_assets( string $hook ): void {
        if ( 'toplevel_page_' . self::MENU_SLUG !== $hook ) {
            return;
        }

        wp_enqueue_style(
            'supertext-highlighter',
            plugins_url( 'assets/css/supertext-highlighter.css', __FILE__ ),
            [],
            $this->get_version()
        );

        wp_enqueue_script(
            'supertext-highlighter',
            plugins_url( 'assets/js/supertext-highlighter.js', __FILE__ ),
            [],
            $this->get_version(),
            true
        );
    }

    public function render_admin_page(): void {
        echo '<div class="wrap supertext-highlighter-admin" data-supertext-highlighter-root="">';
        $this->render_view( 'admin-page' );
        echo '</div>';
    }

    private function render_view( string $view ): void {
        $path = plugin_dir_path( __FILE__ ) . 'views/' . $view . '.php';

        if ( file_exists( $path ) ) {
            include $path;
        }
    }

    private function get_version(): string {
        static $version = null;

        if ( null === $version ) {
            $version = '1.0.0';
        }

        return $version;
    }
}

new SuperText_Highlighter_Plugin();
