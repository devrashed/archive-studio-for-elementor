<?php get_header(); ?>

<div class="wcp_single_container">

    <!-- Main Content -->
    <main class="wcp_single_main">

        <?php while ( have_posts() ) : the_post(); ?>

        <article class="wcp_single_article">

            <!-- Featured Image -->
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="wcp_single_featured">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <!-- Title -->
            <h1 class="wcp_single_title"><?php the_title(); ?></h1>

            <!-- Meta -->
            <div class="wcp_single_meta">
                <span class="wcp_single_author"><?php the_author(); ?></span>
                <span class="wcp_single_date"><?php echo get_the_date(); ?></span>
            </div>

            <!-- Content -->
            <div class="wcp_single_content">
                <?php the_content(); ?>
            </div>

            <!-- Tags -->
            <div class="wcp_single_tags">
                <?php the_tags('<strong>Tags:</strong> ', ''); ?>
            </div>

            <!-- Author Box -->
            <div class="wcp_author_box">
                <div class="wcp_author_avatar">
                    <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                </div>
                <div class="wcp_author_details">
                    <h4><?php the_author(); ?></h4>
                    <p><?php echo get_the_author_meta('description'); ?></p>
                </div>
            </div>

            <!-- Comments -->
            <div class="wcp_single_comments">
                <?php comments_template(); ?>
            </div>

        </article>

        <?php endwhile; ?>

    </main>

    <!-- Right Sidebar -->
    <aside class="wcp_single_sidebar">
        <?php get_sidebar(); ?>
    </aside>

</div>

<?php get_footer(); ?>
