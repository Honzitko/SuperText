<?php
/**
 * Plugin Name: SuperText for Elementor
 * Plugin URI: https://yoursite.com/supertext
 * Description: Advanced text styling widget for Elementor with gradients, highlights, animations, and hover effects.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yoursite.com
 * Text Domain: supertext
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('SUPERTEXT_VERSION', '1.0.0');
define('SUPERTEXT_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SUPERTEXT_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SUPERTEXT_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Main SuperText Plugin Class
 */
class SuperText_Plugin {
    
    /**
     * Single instance of the class
     */
    private static $_instance = null;
    
    /**
     * Main SuperText Instance
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('plugins_loaded', array($this, 'init'));
    }
    
    /**
     * Initialize the plugin
     */
    public function init() {
        // Check if Elementor is installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', array($this, 'admin_notice_missing_elementor'));
            return;
        }
        
        // Check Elementor version
        if (!version_compare(ELEMENTOR_VERSION, '3.0.0', '>=')) {
            add_action('admin_notices', array($this, 'admin_notice_minimum_elementor_version'));
            return;
        }
        
        // Initialize plugin
        $this->init_hooks();
    }
    
    /**
     * Initialize hooks
     */
    private function init_hooks() {
        add_action('elementor/widgets/register', array($this, 'register_widgets'));
        add_action('elementor/frontend/after_enqueue_styles', array($this, 'enqueue_styles'));
        add_action('elementor/frontend/after_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('elementor/editor/before_enqueue_scripts', array($this, 'enqueue_editor_scripts'));
    }
    
    /**
     * Register widgets
     */
    public function register_widgets($widgets_manager) {
        try {
            require_once SUPERTEXT_PLUGIN_PATH . 'includes/widgets/supertext-widget.php';
            
            if (class_exists('SuperText_Widget')) {
                $widgets_manager->register(new SuperText_Widget());
            }
        } catch (Exception $e) {
            error_log('SuperText Plugin Error: ' . $e->getMessage());
        }
    }
    
    /**
     * Enqueue frontend styles
     */
    public function enqueue_styles() {
        if (file_exists(SUPERTEXT_PLUGIN_PATH . 'assets/css/supertext.css')) {
            wp_enqueue_style(
                'supertext-style',
                SUPERTEXT_PLUGIN_URL . 'assets/css/supertext.css',
                array(),
                SUPERTEXT_VERSION
            );
        }
    }
    
    /**
     * Enqueue frontend scripts
     */
    public function enqueue_scripts() {
        if (file_exists(SUPERTEXT_PLUGIN_PATH . 'assets/js/supertext.js')) {
            wp_enqueue_script(
                'supertext-script',
                SUPERTEXT_PLUGIN_URL . 'assets/js/supertext.js',
                array('jquery'),
                SUPERTEXT_VERSION,
                true
            );
        }
    }
    
    /**
     * Enqueue editor scripts
     */
    public function enqueue_editor_scripts() {
        if (file_exists(SUPERTEXT_PLUGIN_PATH . 'assets/js/supertext-editor.js')) {
            wp_enqueue_script(
                'supertext-editor',
                SUPERTEXT_PLUGIN_URL . 'assets/js/supertext-editor.js',
                array('jquery'),
                SUPERTEXT_VERSION,
                true
            );
        }
    }
    
    /**
     * Admin notice for missing Elementor
     */
    public function admin_notice_missing_elementor() {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'supertext'),
            '<strong>' . esc_html__('SuperText for Elementor', 'supertext') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'supertext') . '</strong>'
        );
        
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
    
    /**
     * Admin notice for minimum Elementor version
     */
    public function admin_notice_minimum_elementor_version() {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'supertext'),
            '<strong>' . esc_html__('SuperText for Elementor', 'supertext') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'supertext') . '</strong>',
            '3.0.0'
        );
        
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
}

// Initialize the plugin
SuperText_Plugin::instance();
