<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! class_exists( 'wpcft_Archive_Widget' ) ) {

    class wpcft_Archive_Widget extends Widget_Base {

        public function get_name() {
            return 'wpcft_archive_widget';
        }

        public function get_title() {
            return __( 'Archive Layout', 'elementor-archive-studio' );
        }

        public function get_icon() {
            return 'eicon-post-list';
        }

        public function get_categories() {
            return [ 'general' ];
        }

        public function get_keywords() {
            return [ 'archive', 'posts', 'grid', 'masonry', 'list' ];
        }

        protected function register_controls() {

            $this->start_controls_section(
                'layout_section',
                [
                    'label' => __( 'Layout Settings', 'elementor-archive-studio' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'layout_type',
                [
                    'label' => __( 'Layout Type', 'elementor-archive-studio' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'grid',
                    'options' => [
                        'grid' => __( 'Grid Layout', 'elementor-archive-studio' ),
                        'portrait' => __( 'Portrait Layout', 'elementor-archive-studio' ),
                        'portraitcard' => __( 'Portrait Card Layout', 'elementor-archive-studio' ),
                        'custom-masonry' => __( 'Custom Masonry', 'elementor-archive-studio' ),
                    ],
                ]
            );


            $this->add_control(
                'pageination_style',
                [
                    'label' => __( 'Pagination Style', 'elementor-archive-studio' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'numeric',
                    'options' => [
                        'numeric' => __( 'Numeric style', 'elementor-archive-studio' ),
                        'Load' => __( 'Load more', 'elementor-archive-studio' ),
                        'select' => __( 'Select option', 'elementor-archive-studio' ),
                        'infinite' => __( 'Infinite scroll', 'elementor-archive-studio' ),
                        'nextprevious' => __( 'Next Previous', 'elementor-archive-studio' ),
                    ],
                ]
            );

            $this->add_control(
                'posts_per_page',
                [
                    'label' => __( 'Posts Per Page', 'elementor-archive-studio' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 6,
                ]
            );

            $this->add_control(
                'columns',
                [
                    'label' => __( 'Columns (For Grid / Masonry)', 'elementor-archive-studio' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 20,
                    'min' => 1,
                    'max' => 50,
                    'condition' => [
                        'layout_type!' => [ 'portrait', 'portraitcard' ],
                    ],
                ]
            );
            
            $this->add_control(
                'row_gap',
                [
                    'label' => __( 'Row Gap', 'elementor-archive-studio' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 20,
                    'min' => 1,
                    'max' => 50,
                    'condition' => [
                        'layout_type' => [ 'portrait', 'portraitcard' ],
                    ],
                    'selectors' => [
                            "{{WRAPPER}} .card" => 'margin-bottom: {{SIZE}}px;',
                             "{{WRAPPER}} .wcp_blog-card" => 'margin-bottom: {{SIZE}}px;',
                        ],
                ]
            );

            $this->add_control(
                'read_more',
                [
                    'label' => __( 'Read More', 'elementor-archive-studio' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Yes',
                    'label_off' => 'No',
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'meta_category',
                [
                    'label' => __( 'Category', 'elementor-archive-studio' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Yes',
                    'label_off' => 'No',
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'meta_date',
                [
                    'label' => __( 'Date', 'elementor-archive-studio' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Yes',
                    'label_off' => 'No',
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );   

             $this->add_control(
                'meta_author',
                [
                    'label' => __( 'Author', 'elementor-archive-studio' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Yes',
                    'label_off' => 'No',
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );   


            $this->add_control(
                'show_excerpt',
                [
                    'label' => __( 'Show Excerpt', 'eaw' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => 'Yes',
                    'label_off' => 'No',
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'excerpt_length',
                [
                    'label' => __( 'Excerpt Length', 'elementor-archive-studio' ),
                    'type'  => Controls_Manager::NUMBER,
                    'default' => 20,
                    'condition' => [
                        'show_excerpt' => 'yes',
                    ],
                ]
            );


            $this->end_controls_section();
                // Style tab: spacing
                $this->start_controls_section(
                    'style_section',
                    [
                        'label' => __( 'Style', 'elementor-archive-studio' ),
                        'tab'   => Controls_Manager::TAB_STYLE,
                    ]
                );
                
                // Typography
                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name'     => 'wpcu_typography',
                        'selector' => '{{WRAPPER}} .your-class',
                    ]
                );

                // Text Shadow
                $this->add_group_control(
                    \Elementor\Group_Control_Text_Shadow::get_type(),
                    [
                        'name'     => 'wepcu_shadow',
                        'selector' => '{{WRAPPER}} .your-class',
                    ]
                );


                // --------------------------------------------
                //          NORMAL & HOVER TABS
                // --------------------------------------------

                $this->start_controls_tabs( 'badge_style_tabs' );


                // NORMAL TAB
                $this->start_controls_tab(
                    'badge_normal',
                    [
                        'label' => __( 'Normal', 'elementor-archive-studio' ),
                    ]
                );

                $this->add_control(
                    'badge_link_color_normal',
                    [
                        'label'     => __( 'Text Color', 'elementor-archive-studio' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .category-badge a' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->end_controls_tab();


                // HOVER TAB
                $this->start_controls_tab(
                    'badge_hover',
                    [
                        'label' => __( 'Hover', 'elementor-archive-studio' ),
                    ]
                );

                $this->add_control(
                    'badge_link_color_hover',
                    [
                        'label'     => __( 'Hover Text Color', 'elementor-archive-studio' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .category-badge a:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'badge_transition_duration',
                    [
                        'label'     => __( 'Transition Duration (ms)', 'elementor-archive-studio' ),
                        'type'      => Controls_Manager::NUMBER,
                        'default'   => 300,
                        'selectors' => [
                            '{{WRAPPER}} .category-badge, {{WRAPPER}} .category-badge a' => 'transition: all {{VALUE}}ms;',
                        ],
                    ]
                );

                $this->end_controls_tab();
                // END TABS
                $this->end_controls_tabs();

            $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();

            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

            // Main query: respect archive context if possible
            $query_args = [
                'post_type' => 'post',
                'posts_per_page' => $settings['posts_per_page'],
                'paged' => $paged,
            ];

            // If we're in an archive context, try to mirror it
            if ( is_category() ) {
                $query_args['cat'] = get_queried_object_id();
            } elseif ( is_tag() ) {
                $query_args['tag_id'] = get_queried_object_id();
            } elseif ( is_post_type_archive() ) {
                $post_type_obj = get_query_var( 'post_type' );
                if ( $post_type_obj ) {
                    $query_args['post_type'] = $post_type_obj;
                }
            }

            $query = new WP_Query( $query_args );

            if ( $query->have_posts() ) {
                $layout = esc_attr( $settings['layout_type'] );
                $columns = intval( $settings['columns'] );
                $gap = intval( $settings['gap'] );
                $rowgap = intval( $settings['row_gap'] );
                $page = esc_attr( $settings['pageination_style'] );
                $wordlength = intval( $settings['excerpt_length'] );
                $meta_cate = esc_attr( $settings['meta_category'] );
                $meta_date = esc_attr( $settings['meta_date'] );
                $meta_more = esc_attr( $settings['read_more'] );
                $mata_author = esc_attr( $settings['meta_author'] );

                if( 'grid' === $layout) {

                    // Wrapper classes and inline css variables for columns/gap
                    echo '<div class="eaw-archive eaw-grid" data-columns="' . $columns . '" style="--eaw-gap:' . $columns . 'px;">';

                    while ( $query->have_posts() ) {
                        $query->the_post();
                        ?>
                        <article class="eaw-item">
                            <a class="eaw-link" href="<?php the_permalink(); ?>">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="eaw-thumb"><?php the_post_thumbnail('medium'); ?></div>
                                <?php endif; ?>
                                <h3 class="eaw-title"><?php the_title(); ?></h3>

                                <div class="eaw-meta"> 
                                    <?php if ( 'yes' === $meta_cate ) : ?>      
                                        <span class="eaw-category">
                                        <?php
                                            $categories = get_the_category();
                                            if ( ! empty( $categories ) ) {
                                                $cat_names = wp_list_pluck( $categories, 'name' );
                                                echo esc_html( implode( ', ', $cat_names ) );
                                            }
                                        ?>
                                    </span>   
                                     <?php endif; if ( 'yes' === $meta_date ) : ?>  
                                    <span class="eaw-date">
                                        <?php echo get_the_date(); ?> 
                                    </span>  
                                    <?php endif; ?>
                                    <?php if ( 'yes' === $mata_author ) : ?>      
                                    <span class="author"><?php the_author(); ?></span>
                                     <?php endif; ?>     
                                </div>

                            </a>
                            <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                                <div class="eaw-excerpt">
                                    <?php 
                                        $content = apply_filters( 'the_content', get_the_content() );
                                        $content = wp_strip_all_tags( $content );
                                        echo wp_trim_words( $content, $wordlength );
                                    ?>
                            </div>
                            <?php endif; ?>
                     
                          <?php //if ( 'yes' === $meta_more ) : ?>     
                          <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                               <div class="eaw-meta-more"><a href="<?php the_permalink(); ?>">Read More</a></div>
                          <?php endif; ?>

                        </article>
                        <?php
                    }

                echo '</div>'; // .eaw-archive
            
                } elseif ('portrait' === $layout){
               
                    while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>
                        <article class="card">
                            <div class="card-left">
                                    <?php 
                                    if ( 'yes' === $meta_cate ) : 
                                    $categories = get_the_category();
                                    if ( ! empty( $categories ) ) : ?>
                                        <div class="category-badge-wrapper">
                                            <?php foreach ( $categories as $cat ) : ?>
                                                <span class="category-badge">
                                                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                                                        <?php echo esc_html( $cat->name ); ?>
                                                    </a>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; endif; ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <img class="card-image" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php endif;  ?>
                                </a>                                                              
                            </div>

                            <div class="card-right">
                                <h3 class="card-title"> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a> </h3>
                                <div class="card-meta">
                                  <?php if ( 'yes' === $mata_author ) : ?>   
                                    <span class="author"><?php the_author(); ?></span>
                                  <?php endif; if ( 'yes' === $meta_date ) : ?>   
                                    <span class="date"><?php echo get_the_date(); ?> </span>
                                    <?php endif; ?>
                                </div>

                                <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                                    <div class="card-excerpt">
                                    <?php 
                                        $content = apply_filters( 'the_content', get_the_content() );
                                        $content = wp_strip_all_tags( $content );
                                        echo wp_trim_words( $content, $wordlength );
                                    ?></div>
                                <?php endif; ?>
                                   <?php //if ( 'yes' === $meta_more ) : ?> 
                                   <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                              <div class="card_read-more"><a href="<?php the_permalink(); ?>">Read More</a></div>    
                                   <?php endif; ?>
                            </div>      
                           
                        </article>  
                 <?php 
                    }                

                } elseif ('portraitcard' === $layout){
               
                    while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>
                        <article class="wcp_blog-card">
                            <div class="wcp_card-content">
                                <h3 class="wcp_card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="wcp_card-meta">
                                 <?php if ( 'yes' === $mata_author ) : ?> 
                                    <span class="wcp_author"><?php the_author(); ?></span>
                                    <?php endif; if ( 'yes' === $meta_date ) : ?>       
                                    <span class="wcp_date"><?php echo get_the_date(); ?> </span>
                                    <?php endif; ?>
                                </div>

                                 <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                                    <div class="wcp_card-excerpt">
                                        <?php 
                                        $content = apply_filters( 'the_content', get_the_content() );
                                        $content = wp_strip_all_tags( $content );
                                        echo wp_trim_words( $content, $wordlength );
                                         ?> </div>
                                <?php endif; ?>

                                <?php if ( 'yes' === $meta_cate ) : ?>                                      
                                <div class="wcp_card-tags">
                                    <?php
                                            $categories = get_the_category();
                                            if ( ! empty( $categories ) ) : ?>
                                                <span class="wcp_tag">
                                                    <?php foreach ( $categories as $cat ) : ?>
                                                        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                                                           <span class="wcp_tag_line"> # </span> <?php echo esc_html( $cat->name ); ?>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </span>
                                            <?php endif; ?>                                    
                                </div>
                                <?php endif; ?>
                                <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                                <div class="wcp_read-more"><a href="<?php the_permalink(); ?>">Read More</a></div>
                                <?php endif; ?>
                            </div>   
                            
                            <div class="wcp_card-image">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>
                            </div>
                        </article>  
                 <?php 
                    }                

                } elseif ('custom-masonry' === $layout){ 

                        echo '<div class="masonry-columns" style="column-gap:' . $columns . 'px;  margin-bottom:' . $columns . 'px;" >';
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                ?>
                                <div class="masonry-item" style="margin-bottom: <?php echo $columns; ?>px;">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="featured-image-wrapper">
                                            <?php the_post_thumbnail('medium_large', array('class' => 'featured-image')); ?>
                                            <div class="image-overlay"></div>
                                            <?php 
                                            $categories = get_the_category();
                                            if ( ! empty( $categories ) ) {
                                                echo '<span class="category-badge">' . esc_html( $categories[0]->name ) . '</span>';
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="post-content">
                                        <h3 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>

                                        <div class="post-meta">
                                            <?php echo get_the_date(); ?> • <?php the_author(); ?>
                                        </div>

                                        <div class="post-excerpt">
                                               <?php 
                                                    $content = apply_filters( 'the_content', get_the_content() );
                                                    $content = wp_strip_all_tags( $content );
                                                    echo wp_trim_words( $content, $wordlength );
                                                ?>    
                                        </div>
                                    </div>
                                </div>

                                <?php
                            } // end while

                            echo '</div>'; // close masonry-columns

                } // end layout types   

                
                // Basic pagination (if not within main loop)
                if ( 'numeric' === $page ) {

                        $big = 999999999;
                        echo '<div class="eaw-pagination">';
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, $paged ),
                            'total' => $query->max_num_pages
                        ) );
                        echo '</div>';

                    } elseif ( 'nextprevious' === $page ) {
                        
                    // Next / Previous Pagination (No Numbers)
                        echo '<div class="eaw-pagination eaw-prev-next">';
                        $prev_link = get_previous_posts_link(__('« Previous', 'eaw'));
                        $next_link = get_next_posts_link(__('Next »', 'eaw'), $query->max_num_pages);
                        if ( $prev_link ) {
                            echo '<span class="eaw-prev">' . $prev_link . '</span>';
                        }
                        if ( $next_link ) {
                            echo '<span class="eaw-next">' . $next_link . '</span>';
                        }
                        echo '</div>';

                    } elseif ( 'Load' === $page){
                        // Load More pagination (NO AJAX)
                        $total_pages = $query->max_num_pages;
                        echo '<div class="eaw-load-more">';
                        if ( $paged < $total_pages ) {
                            $next_page_url = get_pagenum_link( $paged + 1 );
                            echo '<a href="' . esc_url($next_page_url) . '" class="eaw-loadmore-btn">Load More</a>';
                        }
                        echo '</div>';

                    } elseif ('select' === $page ){

                        // Select Dropdown Pagination
                        $total_pages = $query->max_num_pages;
                        if ( $total_pages > 1 ) {
                            echo '<div class="eaw-select-pagination">';
                            echo '<select onchange="if (this.value) window.location.href=this.value">';
                            for ( $i = 1; $i <= $total_pages; $i++ ) {
                                $page_url = get_pagenum_link( $i );
                                $selected = ( $i == $paged ) ? ' selected' : '';
                                echo '<option value="' . esc_url( $page_url ) . '"' . $selected . '>' . sprintf( __( 'Page %d', 'eaw' ), $i ) . '</option>';
                            }
                            echo '</select>';
                            echo '</div>';
                        }
                        
                    } elseif ('infinite' === $page ){
                        // Infinite Scroll Pagination (Basic Implementation)
                        $total_pages = $query->max_num_pages;
                        if ( $paged < $total_pages ) {
                            $next_page_url = get_pagenum_link( $paged + 1 );
                            echo '<div class="eaw-infinite-scroll" data-next-page="' . esc_url($next_page_url) . '">';
                            echo '<span class="eaw-loading-message">Scroll down to load more...</span>';
                            echo '</div>';
                        }
                    }

                wp_reset_postdata();

            } else {
                echo '<p>' . __( 'No posts found.', 'eaw' ) . '</p>';
            }
        }

    }
}

