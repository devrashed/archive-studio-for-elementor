<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! class_exists( 'archstel_archive_widget' ) ) {

    class archstel_archive_widget extends Widget_Base {

        public function get_name() {
            return 'archstel_archive_widget';
        }

        public function get_title() {
            return __( 'Archive Studio', 'archive-studio-for-elementor' );
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
                    'label' => __( 'Layout Settings', 'archive-studio-for-elementor' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'layout_type',
                [
                    'label' => __( 'Layout Type', 'archive-studio-for-elementor' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'grid',
                    'options' => [
                        'grid' => __( 'Grid Layout', 'archive-studio-for-elementor' ),
                        'masonry' => __( 'Masonry', 'archive-studio-for-elementor' ),
                        'portrait' => __( 'Portrait Layout', 'archive-studio-for-elementor' ),
                        'portraitcard' => __( 'Portrait Card Layout', 'archive-studio-for-elementor' ),
                        
                    ],
                ]
            );


            $this->add_control(
                'pageination_style',
                [
                    'label' => __( 'Pagination Style', 'archive-studio-for-elementor' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'numeric',
                    'options' => [
                        'numeric' => __( 'Numeric style', 'archive-studio-for-elementor' ),
                        'Load' => __( 'Load more', 'archive-studio-for-elementor' ),
                        'select' => __( 'Select option', 'archive-studio-for-elementor' ),
                        'infinite' => __( 'Infinite scroll', 'archive-studio-for-elementor' ),
                        'nextprevious' => __( 'Next Previous', 'archive-studio-for-elementor' ),
                    ],
                ]
            );

            $this->add_control(
                'posts_per_page',
                [
                    'label' => __( 'Posts Per Page', 'archive-studio-for-elementor' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 6,
                ]
            );

            $this->add_control(
                'columns',
                [
                    'label' => __( 'Columns (For Grid / Masonry)', 'archive-studio-for-elementor' ),
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
                    'label' => __( 'Row Gap', 'archive-studio-for-elementor' ),
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
                    'label' => __( 'Read More', 'archive-studio-for-elementor' ),
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
                    'label' => __( 'Category', 'archive-studio-for-elementor' ),
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
                    'label' => __( 'Date', 'archive-studio-for-elementor' ),
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
                    'label' => __( 'Author', 'archive-studio-for-elementor' ),
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
                    'label' => __( 'Show Excerpt', 'archive-studio-for-elementor' ),
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
                    'label' => __( 'Excerpt Length', 'archive-studio-for-elementor' ),
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
                        'label' => __( 'Title', 'archive-studio-for-elementor' ),
                        'tab'   => Controls_Manager::TAB_STYLE,
                    ]
                );
                
                // Typography
                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name'     => 'wpcu_typography',
                        'selector' => '{{WRAPPER}} .wf-post-title, {{WRAPPER}} .wf-card-title, {{WRAPPER}} .wf-archive-title 
                                       {{WRAPPER}} .wf-archive-card-title',
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
                        'label' => __( 'Normal', 'archive-studio-for-elementor' ),
                    ]
                );

                $this->add_control(
                    'badge_link_color_normal',
                    [
                        'label'     => __( 'Text Color', 'archive-studio-for-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .wf-post-title a' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .wf-card-title a' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .wf-archive-card-title a' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .wf-archive-title a' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->end_controls_tab();


                // HOVER TAB
                $this->start_controls_tab(
                    'badge_hover',
                    [
                        'label' => __( 'Hover', 'archive-studio-for-elementor' ),
                    ]
                );

                $this->add_control(
                    'badge_link_color_hover',
                    [
                        'label'     => __( 'Hover Text Color', 'archive-studio-for-elementor' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .category-badge a:hover' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .wf-post-title a:hover' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .wf-card-title a:hover' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .wf-archive-card-title a:hover' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .wf-archive-title a:hover' => 'color: {{VALUE}};',

                        ],
                    ]
                );

                $this->add_control(
                    'badge_transition_duration',
                    [
                        'label'     => __( 'Transition Duration (ms)', 'archive-studio-for-elementor' ),
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

                $this->start_controls_section(
                    'description_style_section',
                    [
                        'label' => __( 'Description', 'archive-studio-for-elementor' ),
                        'tab'   => Controls_Manager::TAB_STYLE,
                    ]
                );

                // Typography for description
                $this->add_group_control(
                    \Elementor\Group_Control_Typography::get_type(),
                    [
                        'name'     => 'description_typography',
                        'selector' => '{{WRAPPER}} .wf-archive-excerpt, {{WRAPPER}} .wf-archive-card-excerpt, {{WRAPPER}} .wf-card-excerpt, 
                        {{WRAPPER}} .wf-post-excerpt',
                    ]
                );
            $this->end_controls_section(); // End Description section 
            
            
            $this->end_controls_section();

            $this->start_controls_section(
                'meta_style_section',
                [
                    'label' => __( 'Meta', 'archive-studio-for-elementor' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

            // Typography for description
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name'     => 'meta_typography',
                    'selector' => '{{WRAPPER}} .wf-post-meta, {{WRAPPER}} .wf-card-meta, {{WRAPPER}} .wf-archive-meta, {{WRAPPER}} .wf-archive-card-meta',
                ]
            );
            $this->end_controls_section(); // End Meta section 
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
                $page = esc_attr( strtolower( $settings['pageination_style'] ) );
                $wordlength = intval( $settings['excerpt_length'] );
                $meta_cate = esc_attr( $settings['meta_category'] );
                $meta_date = esc_attr( $settings['meta_date'] );
                $meta_more = esc_attr( $settings['read_more'] );
                $mata_author = esc_attr( $settings['meta_author'] );

                if( 'grid' === $layout) {

                    echo '<div class="wf-archive-grid" data-columns="' . $columns . '" style="--eaw-gap:' . $columns . 'px;">';
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        ?>
                        <article class="wf-archive-item">
                            <a class="wf-archive-link" href="<?php the_permalink(); ?>">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="wf-archive-thumb"><?php the_post_thumbnail('medium'); ?></div>
                                <?php endif; ?>
                                <h3 class="wf-archive-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                <div class="wf-archive-meta"> 
                                    <?php if ( 'yes' === $meta_cate ) : ?>      
                                        <span class="wf-archive-category">
                                        <?php
                                            $categories = get_the_category();
                                            if ( ! empty( $categories ) ) {
                                                $cat_names = wp_list_pluck( $categories, 'name' );
                                                echo esc_html( implode( ', ', $cat_names ) );
                                            }
                                        ?>
                                    </span>   
                                     <?php endif; if ( 'yes' === $meta_date ) : ?>  
                                    <span class="wf-archive-date">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </span>  
                                    <?php endif; ?>
                                    <?php if ( 'yes' === $mata_author ) : ?>      
                                    <span class="author"><?php echo esc_html( get_the_author() ); ?></span>
                                     <?php endif; ?>     
                                </div>

                            </a>
                            <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                                <div class="wf-archive-excerpt">
                                    <?php 
                                        $content = apply_filters( 'the_content', get_the_content() );
                                        $content = wp_strip_all_tags( $content );
                                        echo esc_html( wp_trim_words( $content, absint( $wordlength ) ) );
                                    ?>
                            </div>
                            <?php endif; ?>
                       
                          <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                               <div class="wf-archive-meta-more"><a href="<?php the_permalink(); ?>">Read More</a></div>
                          <?php endif; ?>

                        </article>
                        <?php
                    }

                echo '</div>'; // .eaw-archive
            
                } elseif ('portrait' === $layout){
               
                    while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>
                        <article class="wf-archive-card">
                            <div class="wf-archive-card-left">
                                    <?php 
                                    if ( 'yes' === $meta_cate ) : 
                                    $categories = get_the_category();
                                    if ( ! empty( $categories ) ) : ?>
                                        <div class="wf-archive-category-badge-wrapper">
                                            <?php foreach ( $categories as $cat ) : ?>
                                                <span class="wf-archive-category-badge">
                                                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                                                        <?php echo esc_html( $cat->name ); ?>
                                                    </a>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; endif; ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <img class="wf-archive-card-image" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php endif;  ?>
                                </a>                                                              
                            </div>

                            <div class="wf-archive-card-right">
                                <h3 class="wf-archive-card-title"> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a> </h3>
                                <div class="wf-archive-card-meta">
                                  <?php if ( 'yes' === $mata_author ) : ?>   
                                    <span class="author"><?php echo esc_html( get_the_author() ); ?></span>
                                  <?php endif; if ( 'yes' === $meta_date ) : ?>   
                                    <span class="date"><?php echo esc_html( get_the_date() ); ?> </span>
                                    <?php endif; ?>
                                </div>

                                <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                                    <div class="wf-archive-card-excerpt">
                                    <?php 
                                        $content = apply_filters( 'the_content', get_the_content() );
                                        $content = wp_strip_all_tags( $content );
                                        echo esc_html( wp_trim_words( $content, absint( $wordlength ) ) );
                                    ?></div>
                                <?php endif; ?>
                                   <?php //if ( 'yes' === $meta_more ) : ?> 
                                   <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                              <div class="wf-archive-card_read-more"><a href="<?php the_permalink(); ?>">Read More</a></div>    
                                   <?php endif; ?>
                            </div>      
                           
                        </article>  
                 <?php 
                    }                

                } elseif ('portraitcard' === $layout){
               
                    while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>
                        <article class="wf-blog-card">
                            <div class="wf-card-content">
                                <h3 class="wf-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="wf-card-meta">
                                 <?php if ( 'yes' === $mata_author ) : ?> 
                                    <span class="wf-author"><?php the_author(); ?></span>
                                    <?php endif; if ( 'yes' === $meta_date ) : ?>       
                                    <span class="wf-date"><?php echo esc_html( get_the_date() ); ?> </span>
                                    <?php endif; ?>
                                </div>

                                 <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                                    <div class="wf-card-excerpt">
                                        <?php 
                                        $content = apply_filters( 'the_content', get_the_content() );
                                        $content = wp_strip_all_tags( $content );
                                        echo esc_html( wp_trim_words( $content, absint( $wordlength ) ) );
                                         ?> </div>
                                <?php endif; ?>

                                <?php if ( 'yes' === $meta_cate ) : ?>                                      
                                <div class="wf-card-tags">
                                    <?php
                                            $categories = get_the_category();
                                            if ( ! empty( $categories ) ) : ?>
                                                <span class="wf-tag">
                                                    <?php foreach ( $categories as $cat ) : ?>
                                                        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
                                                           <span class="wf-tag_line"> # </span> <?php echo esc_html( $cat->name ); ?>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </span>
                                            <?php endif; ?>                                    
                                </div>
                                <?php endif; ?>
                                <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                                <div class="wf-read-more"><a href="<?php the_permalink(); ?>">Read More</a></div>
                                <?php endif; ?>
                            </div>   
                            
                            <div class="wf-card-image">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title_attribute(); ?>">
                                    <?php endif; ?>
                            </div>
                        </article>  
                 <?php 
                    }                

                } elseif ('masonry' === $layout){ 

                        echo '<div class="wf-masonry-columns" style="column-gap:' . $columns . 'px;  margin-bottom:' . $columns . 'px;" >';
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                ?>
                                <div class="wf-masonry-item" style="margin-bottom: <?php echo $columns; ?>px;">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="wf-featured-image-wrapper">
                                            <?php the_post_thumbnail('medium_large', array('class' => 'featured-image')); ?>
                                            <div class="wf-image-overlay"></div>
                                            <?php 
                                            $categories = get_the_category();
                                                if ( ! empty( $categories ) ) {
                                                    echo '<span class="wf-category-badge">' . esc_html( $categories[0]->name ) . '</span>';
                                                }
                                            ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="wf-post-content">
                                        <h3 class="wf-post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>

                                        <div class="wf-post-meta">
                                            <?php echo esc_html( get_the_date() ); ?> • <?php the_author(); ?>
                                        </div>

                                        <div class="wf-post-excerpt">
                                               <?php 
                                                    $content = apply_filters( 'the_content', get_the_content() );
                                                    $content = wp_strip_all_tags( $content );
                                                    echo esc_html( wp_trim_words( $content, absint( $wordlength ) ) );
                                                ?>    
                                        </div>
                                    </div>
                                </div>

                                <?php
                            } // end while

                            echo '</div>'; // close masonry-columns

                } // end layout types   

        

            if ( 'numeric' === $page ) {

                    $big = 999999999;

                    echo '<div class="eaw-pagination">';
                    echo wp_kses_post(
                        paginate_links(
                            array(
                                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                'format'    => '?paged=%#%',
                                'current'   => absint( $paged ),
                                'total'     => absint( $query->max_num_pages ),
                                'prev_text' => esc_html__( '« Previous', 'archive-studio-for-elementor' ),
                                'next_text' => esc_html__( 'Next »', 'archive-studio-for-elementor' ),
                            )
                        )
                    );
                    echo '</div>';

                } elseif ( 'nextprevious' === $page ) {
                    
                    echo '<div class="eaw-pagination eaw-prev-next">';
                    $prev_link = get_previous_posts_link(__('« Previous', 'archive-studio-for-elementor'));
                    $next_link = get_next_posts_link(__('Next »', 'archive-studio-for-elementor'), $query->max_num_pages);
                    if ( $prev_link ) {
                        echo '<span class="eaw-prev">' . $prev_link . '</span>';
                    }
                    if ( $next_link ) {
                        echo '<span class="eaw-next">' . $next_link . '</span>';
                    }
                    echo '</div>';

                } elseif ( 'load' === $page ) {

                    $total_pages = absint( $query->max_num_pages );

                    if ( $paged < $total_pages ) {
                        echo '<div class="eaw-load-more">';
                        echo '<a class="eaw-loadmore-btn" href="' . esc_url( get_pagenum_link( $paged + 1 ) ) . '">';
                        echo esc_html__( 'Load More', 'archive-studio-for-elementor' );
                        echo '</a>';
                        echo '</div>';
                    }

                } elseif ( 'select' === $page ) {
                   
                   $total_pages = (int) $query->max_num_pages;
                   if ( $total_pages > 1 ) {

                    echo '<div class="eaw-select-pagination">';
                    echo '<select onchange="if ( this.value ) { window.location.href = this.value; }">';

                    for ( $i = 1; $i <= $total_pages; $i++ ) {

                        $page_url = get_pagenum_link( $i );

                        printf(
                            '<option value="%1$s"%2$s>%3$s</option>',
                            esc_url( $page_url ),
                            selected( $i, $paged, false ),
                            sprintf(esc_html__( 'Page %d', 'archive-studio-for-elementor' ),$i )
                        );
                    }

                    echo '</select>';
                    echo '</div>';
                }

                } elseif ( 'infinite' === $page ) {

                    $total_pages = absint( $query->max_num_pages );

                    if ( $paged < $total_pages ) {
                        echo '<div class="eaw-infinite-scroll" data-next-page="' . esc_url( get_pagenum_link( $paged + 1 ) ) . '">';
                        echo '<span class="eaw-loading-message">';
                        echo esc_html__( 'Scroll down to load more...', 'archive-studio-for-elementor' );
                        echo '</span>';
                        echo '</div>';
                    }
                }

                wp_reset_postdata();


            } else {
                echo '<p>' . esc_html__( 'No posts found.', 'archive-studio-for-elementor' ) . '</p>';
            }
        }

    }
}
