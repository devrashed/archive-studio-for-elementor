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


/* 
// Check Elementor is active
function eaw_check_elementor_active() {
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', function() {
            if ( current_user_can( 'activate_plugins' ) ) {
                echo '<div class="notice notice-warning"><p><strong>Elementor Archive Widget:</strong> This plugin requires <a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor</a> to be installed and active.</p></div>';
            }
        } );
        return false;
    }
    return true;
}

// Register widget
function eaw_register_widget( $widgets_manager ) {
    if ( ! eaw_check_elementor_active() ) {
        return;
    }
    require_once( __DIR__ . '/includes/class-archive-widget.php' );
    // Register
    $widgets_manager->register( new \EAW_Archive_Widget() );
}
add_action( 'elementor/widgets/register', 'eaw_register_widget' );

// Enqueue scripts & styles
function eaw_enqueue_assets() {
    wp_register_style( 'eaw-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css' );
    wp_enqueue_style( 'eaw-style' );

    wp_register_script( 'eaw-script', plugin_dir_url( __FILE__ ) . 'assets/js/script.js', array('jquery'), false, true );
    wp_enqueue_script( 'eaw-script' );
}
add_action( 'wp_enqueue_scripts', 'eaw_enqueue_assets' );
 */


////require_once __DIR__ . '/includes/class_single_layout.php';

class elementor_archive_widget {

    private $singlepage;

    public function __construct() {

        //$singlepage = new class_single_layout();

        add_action( 'plugins_loaded', [ $this, 'check_elementor' ] );
        add_action( 'elementor/widgets/register', [ $this, 'register_widget' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        add_filter( 'single_template', [$this, 'rk_event_organizer_single_template']);
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

        // Include widget file
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


    public function rk_event_organizer_single_template( $single ) {
        global $post;
        // Check if CPT is event_organizer
        if ( $post->post_type == 'post' ) {
            // Path of the template inside plugin
            $template = plugin_dir_path( __FILE__ ) . 'templates/single-layout-1.php';
            // If file exists, load it
            if ( file_exists( $template ) ) {
                return $template;
            }
        }
        return $single;
    }

}

// Initialize the plugin
new elementor_archive_widget();
