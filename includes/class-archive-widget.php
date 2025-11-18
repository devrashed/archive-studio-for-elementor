<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! class_exists( 'EAW_Archive_Widget' ) ) {

    class EAW_Archive_Widget extends Widget_Base {

        public function get_name() {
            return 'eaw_archive_widget';
        }

        public function get_title() {
            return __( 'Archive Layout', 'eaw' );
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
                    'label' => __( 'Layout Settings', 'eaw' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
            );

            $this->add_control(
                'layout_type',
                [
                    'label' => __( 'Layout Type', 'eaw' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'grid',
                    'options' => [
                        'grid' => __( 'Grid Layout', 'eaw' ),
                        'list' => __( 'List Layout', 'eaw' ),
                        'masonry' => __( 'Masonry Layout', 'eaw' ),
                    ],
                ]
            );

            $this->add_control(
                'posts_per_page',
                [
                    'label' => __( 'Posts Per Page', 'eaw' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 6,
                ]
            );

            $this->add_control(
                'columns',
                [
                    'label' => __( 'Columns (for grid / masonry)', 'eaw' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3,
                    'min' => 1,
                    'max' => 6,
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

            $this->end_controls_section();

            // Style tab: spacing
            $this->start_controls_section(
                'style_section',
                [
                    'label' => __( 'Style', 'eaw' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'gap',
                [
                    'label' => __( 'Gap (px)', 'eaw' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 20,
                    'min' => 0,
                    'max' => 100,
                ]
            );

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

                // Wrapper classes and inline css variables for columns/gap
                echo '<div class="eaw-archive eaw-' . $layout . '" data-columns="' . $columns . '" style="--eaw-gap:' . $gap . 'px;">';

                while ( $query->have_posts() ) {
                    $query->the_post();
                    ?>
                    <article class="eaw-item">
                        <a class="eaw-link" href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="eaw-thumb"><?php the_post_thumbnail('medium'); ?></div>
                            <?php endif; ?>
                            <h3 class="eaw-title"><?php the_title(); ?></h3>
                        </a>
                        <?php if ( 'yes' === $settings['show_excerpt'] ) : ?>
                            <div class="eaw-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></div>
                        <?php endif; ?>
                    </article>
                    <?php
                }

                echo '</div>'; // .eaw-archive

                // Basic pagination (if not within main loop)
                $big = 999999999;
                echo '<div class="eaw-pagination">';
                echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, $paged ),
                    'total' => $query->max_num_pages
                ) );
                echo '</div>';

                wp_reset_postdata();
            } else {
                echo '<p>' . __( 'No posts found.', 'eaw' ) . '</p>';
            }
        }
    }
}
