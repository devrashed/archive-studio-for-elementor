<?php
/**
 * Plugin Name: Archive Studio Elementor
 * Description: Elementor widget to design archive pages with Grid, Masonry, Portrait layout and more design. Just install and Ready-to-USE.
 * Requires at least: 5.4
 * Author: Rashed Khan
 * Requires Plugins: elementor
 * Tested up to: 6.9
 * Requires PHP: 7.4
 * Version: 1.0.1
 * Text Domain: archive-studio-for-elementor
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * 
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/archstel-archive-dashboard.php';

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
    deactivate_plugins( plugin_basename( __FILE__ ) );
    add_action( 'admin_notices', function() {
        echo '<div class="notice notice-error is-dismissible">';
        echo '<p><strong>' . esc_html__( 'Archive Studio Elementor:', 'archive-studio-for-elementor' ) . '</strong> ' . esc_html__( 'This plugin cannot be installed because', 'archive-studio-for-elementor' ) . ' <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> ' . esc_html__( 'is not active. This plugin has been deactivated.', 'archive-studio-for-elementor' ) . '</p>';
        echo '</div>';
    } );
    return;
}


class archstel_archive_studio_for_elementor {

    public function __construct() {
        new archstel_archive_dashboard();
        add_action( 'plugins_loaded', [ $this, 'archstel_check_elementor' ] );
        add_action( 'elementor/widgets/register', [ $this, 'archstel_register_widget' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'archstel_enqueue_assets' ] );
        add_filter( 'template_include', [$this, 'archstel_event_organizer_template_include'], 99);
    }

    /**
     * Check Elementor is active
     */
    public function archstel_check_elementor() {
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', function() {
                if ( current_user_can( 'activate_plugins' ) ) {
                    echo '<div class="notice notice-warning"><p><strong>' . esc_html__( 'Elementor Archive Widget:', 'archive-studio-for-elementor' ) . '</strong> ' . esc_html__( 'This plugin requires', 'archive-studio-for-elementor' ) . ' <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> ' . esc_html__( 'to be installed and active.', 'archive-studio-for-elementor' ) . '</p></div>';
                }
            });
            return false;
        }
        return true;
    }

    /**
     * Register Elementor Widget
     */
    public function archstel_register_widget( $widgets_manager ) {
        // Elementor active check
        if ( ! $this->archstel_check_elementor() ) {
            return;
        }
        require_once __DIR__ . '/includes/archstel-archive-widget.php';
        // Register widget
        $widgets_manager->register( new \archstel_archive_widget() );
    }

    /**
     * Enqueue plugin CSS & JS
     */
    public function archstel_enqueue_assets() {
        $version = defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : '1.0.3';
        wp_enqueue_style('eaw-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', array(), $version, false );
        wp_enqueue_style('single-style', plugin_dir_url( __FILE__ ) . 'assets/css/single_page.css', array(), $version, false );
        wp_register_script( 'eaw-script', plugin_dir_url( __FILE__ ) . 'assets/js/script.js', array('jquery'), $version, true);
    }

    public function archstel_event_organizer_template_include( $template ) {
        if ( is_singular('post') ) {

            $selected_layout = get_option('layout_option');

            if ($selected_layout === 'layout_1') {
                $new_template = plugin_dir_path(__FILE__) . 'templates/single-layout-1.php';

                if ( file_exists($new_template) ) {
                    return $new_template;
                }
            }
        }
        return $template;
    }

}

// Initialize the plugin
new archstel_archive_studio_for_elementor();