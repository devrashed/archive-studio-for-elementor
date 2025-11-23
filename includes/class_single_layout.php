<?php 
/**
 * Get Single Layout Meta Value
 *
 */ 


//include_once dirname( __FILE__ ) . '../templates/single-loyout-1.php';
//require_once __DIR__ . '/templates/single-loyout-1.php';

//require_once plugin_dir_path(__FILE__) . 'templates/single-layout-1.php';

class class_single_layout {
    
    public function __construct() {       
     add_filter( 'single_template', [$this, 'rk_event_organizer_single_template']);
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


    /* public function get_layout( $post_id ) {
        $layout = get_post_meta( $post_id, '_single_layout', true );
        return $layout ? $layout : 'default';
    } */


}


?>