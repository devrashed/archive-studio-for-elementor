<?php
/**
 * Plugin Name: Elementor Archive Widget
 * Description: Elementor widget to design archive pages with Grid, List, or Masonry layout. Ready-to-install.
 * Version: 1.0
 * Author: Rashed khan
 * Text Domain: eaw
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once plugin_dir_path( __FILE__ ) . 'includes/Class_archive_dashboard.php';

class elementor_archive_widget {

    public function __construct() {
        new Class_archive_dashboard();
        //add_filter('elementor/theme/use_theme_template', '__return_false');
        add_action( 'plugins_loaded', [ $this, 'check_elementor' ] );
        add_action( 'elementor/widgets/register', [ $this, 'register_widget' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        //add_filter( 'single_template', [$this, 'rk_event_organizer_single_template']);
        add_filter('template_include', [$this, 'rk_event_organizer_template_include'], 99);

    }

    /**
     * Check Elementor is active
     */
    public function check_elementor() {

        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', function() {
                if ( current_user_can( 'activate_plugins' ) ) {
                    echo '<div class="notice notice-warning"><p><strong>Elementor Archive Widget:</strong> This plugin requires <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> to be installed and active.</p></div>';
                }
            });
            return false;
        }
        return true;
    }

    /**
     * Register Elementor Widget
     */
    public function register_widget( $widgets_manager ) {

        // Elementor active check
        if ( ! $this->check_elementor() ) {
            return;
        }
        require_once __DIR__ . '/includes/class-archive-widget.php';
        // Register widget
        $widgets_manager->register( new \EAW_Archive_Widget() );
    }

    /**
     * Enqueue plugin CSS & JS
     */
    public function enqueue_assets() {

        wp_enqueue_style('eaw-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', array(), time(), false );
        wp_enqueue_style('single-style', plugin_dir_url( __FILE__ ) . 'assets/css/single_page.css', array(), time(), false);
        wp_register_script( 'eaw-script', plugin_dir_url( __FILE__ ) . 'assets/js/script.js', array('jquery'), time(), true);
       
    }


    /* public function rk_event_organizer_single_template( $single ) {

        global $post;

        if ( $post->post_type === 'post' ) {

            $selected_layout = get_option('layout_option');

            if ( $selected_layout === 'layout_1' ) {
                $template = plugin_dir_path(__FILE__) . 'templates/single-layout-1.php';

                if ( file_exists($template) ) {
                    return $template;
                }
            }
        }

        return $single;
    }
 */
    public function rk_event_organizer_template_include( $template ) {
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
new elementor_archive_widget();
