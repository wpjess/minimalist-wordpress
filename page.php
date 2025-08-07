<?php get_header(); ?>

<div class="site-content">
    <main class="content-area">
        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                    
                    <?php
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'anthropic-minimal' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>
            </article>

            <?php
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>

        <?php endwhile; ?>
    </main>
</div>

<?php get_footer(); ?>